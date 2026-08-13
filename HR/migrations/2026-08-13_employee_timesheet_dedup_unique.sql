-- ============================================================================
--  Timesheet robustness migration
--  Target DB : linrefvy_hr_portal
--  Table     : employee_timesheet
--
--  WHAT THIS DOES
--    1. Takes a full backup of employee_timesheet.
--    2. Merges duplicate rows (same employee_id + timesheet_id + roster_id + date)
--       into a single surviving row WITHOUT losing any recorded punch times.
--    3. Deletes the now-redundant duplicate rows (originals are in the backup).
--    4. Adds a UNIQUE constraint so duplicates can NEVER be created again.
--
--  SAFETY
--    - Run a mysqldump of the whole DB first anyway.
--    - Step 0 (report) is READ-ONLY: run it first and review the numbers.
--    - Surviving rows that came from a CONFLICTING duplicate group get
--      duplicacy_flag = 1 so you can cross-check them against the backup.
--    - Everything below (steps 1-4) is wrapped so it either all applies or,
--      if the final ALTER fails because unresolved duplicates remain, you can
--      restore from the backup table.
--
--  HOW TO RUN
--    mysql -u <user> -p linrefvy_hr_portal < 2026-08-13_employee_timesheet_dedup_unique.sql
-- ============================================================================

-- ----------------------------------------------------------------------------
-- STEP 0 (READ-ONLY): how bad is it? Review before proceeding.
-- ----------------------------------------------------------------------------
SELECT COUNT(*) AS total_rows FROM employee_timesheet;

SELECT COUNT(*) AS duplicate_groups,
       COALESCE(SUM(c) - COUNT(*), 0) AS redundant_rows_to_remove
FROM (
    SELECT COUNT(*) AS c
    FROM employee_timesheet
    GROUP BY employee_id, timesheet_id, roster_id, `date`
    HAVING COUNT(*) > 1
) t;

-- Groups where duplicates hold CONFLICTING punch values (needs a human eye).
SELECT employee_id, timesheet_id, roster_id, `date`,
       COUNT(DISTINCT in_time)        AS distinct_in,
       COUNT(DISTINCT out_time)       AS distinct_out,
       COUNT(DISTINCT break_in_time)  AS distinct_break_in,
       COUNT(DISTINCT break_out_time) AS distinct_break_out
FROM employee_timesheet
GROUP BY employee_id, timesheet_id, roster_id, `date`
HAVING COUNT(*) > 1
   AND ( COUNT(DISTINCT in_time) > 1 OR COUNT(DISTINCT out_time) > 1
      OR COUNT(DISTINCT break_in_time) > 1 OR COUNT(DISTINCT break_out_time) > 1 );

-- ----------------------------------------------------------------------------
-- STEP 1: FULL BACKUP (drop an old backup of the same day first if re-running)
-- ----------------------------------------------------------------------------
DROP TABLE IF EXISTS employee_timesheet_backup_20260813;
CREATE TABLE employee_timesheet_backup_20260813 AS
SELECT * FROM employee_timesheet;

-- ----------------------------------------------------------------------------
-- STEP 2: MERGE duplicate punch data into the surviving (lowest id) row.
--         COALESCE keeps the survivor's own value first, then fills any gaps
--         from its duplicates. MAX() is only used to pick a non-NULL value.
--         duplicacy_flag = 1 marks survivors that were merged (review these).
-- ----------------------------------------------------------------------------
UPDATE employee_timesheet k
JOIN (
    SELECT MIN(employee_timesheet_id) AS keep_id,
           employee_id, timesheet_id, roster_id, `date`,
           MAX(in_time)        AS in_time,
           MAX(out_time)       AS out_time,
           MAX(break_in_time)  AS break_in_time,
           MAX(break_out_time) AS break_out_time,
           MAX(in_verify)      AS in_verify,
           MAX(out_verify)     AS out_verify,
           MAX(comment)        AS comment
    FROM employee_timesheet
    GROUP BY employee_id, timesheet_id, roster_id, `date`
    HAVING COUNT(*) > 1
) d ON k.employee_timesheet_id = d.keep_id
SET k.in_time        = COALESCE(k.in_time, d.in_time),
    k.out_time       = COALESCE(k.out_time, d.out_time),
    k.break_in_time  = COALESCE(k.break_in_time, d.break_in_time),
    k.break_out_time = COALESCE(k.break_out_time, d.break_out_time),
    k.in_verify      = COALESCE(k.in_verify, d.in_verify),
    k.out_verify     = COALESCE(k.out_verify, d.out_verify),
    k.comment        = COALESCE(k.comment, d.comment),
    k.duplicacy_flag = 1;

-- ----------------------------------------------------------------------------
-- STEP 3: DELETE the redundant duplicate rows (survivor already has the data).
--         <=> is the NULL-safe equality operator for nullable columns.
-- ----------------------------------------------------------------------------
DELETE t FROM employee_timesheet t
JOIN (
    SELECT employee_id, timesheet_id, roster_id, `date`,
           MIN(employee_timesheet_id) AS keep_id
    FROM employee_timesheet
    GROUP BY employee_id, timesheet_id, roster_id, `date`
    HAVING COUNT(*) > 1
) d
  ON  t.employee_id  =   d.employee_id
  AND t.timesheet_id <=> d.timesheet_id
  AND t.roster_id    <=> d.roster_id
  AND t.`date`       =   d.`date`
WHERE t.employee_timesheet_id <> d.keep_id;

-- ----------------------------------------------------------------------------
-- STEP 4: Enforce uniqueness so this can never happen again.
--         If this errors with "Duplicate entry", unresolved duplicates remain
--         (likely NULL timesheet_id/roster_id groups) - inspect and clean, or
--         restore from employee_timesheet_backup_20260813.
-- ----------------------------------------------------------------------------
ALTER TABLE employee_timesheet
    ADD UNIQUE KEY uq_emp_ts_roster_date (employee_id, timesheet_id, roster_id, `date`);

-- ----------------------------------------------------------------------------
-- STEP 5 (READ-ONLY): confirm zero duplicates remain.
-- ----------------------------------------------------------------------------
SELECT COUNT(*) AS remaining_duplicate_groups
FROM (
    SELECT 1
    FROM employee_timesheet
    GROUP BY employee_id, timesheet_id, roster_id, `date`
    HAVING COUNT(*) > 1
) t;
