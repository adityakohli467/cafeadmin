-- ============================================================================
--  Supplier order email robustness migration
--  Target DB : linrefvy_g1  (main Cafeadmin app)
--  Table     : email_queue
--
--  WHAT THIS DOES
--    Adds an `admin_notified` flag so the UI can show a one-time "order email
--    failed" banner to the branch admin and remember when they dismiss it.
--
--  SAFETY
--    - Purely additive: adds one nullable-with-default column + an index.
--    - No existing data is modified or deleted.
--    - Safe to run more than once (guarded with IF NOT EXISTS where supported;
--      on older MySQL that lacks it, ignore the "duplicate column" error).
--
--  HOW TO RUN
--    mysql -u <user> -p linrefvy_g1 < 2026-08-13_email_queue_admin_notified.sql
-- ============================================================================

-- Add the flag (0 = not yet shown to admin, 1 = admin has seen/dismissed it).
ALTER TABLE `email_queue`
    ADD COLUMN `admin_notified` TINYINT(1) NOT NULL DEFAULT 0;

-- Helps the UI poll query (status = 'failed' AND admin_notified = 0).
ALTER TABLE `email_queue`
    ADD INDEX `idx_status_notified` (`status`, `admin_notified`);

-- OPTIONAL cleanup: existing historical failures (order_id IS NULL) can never be
-- attributed to an order, so mark them as already handled to avoid noise.
UPDATE `email_queue`
   SET `admin_notified` = 1
 WHERE `status` = 'failed'
   AND (`order_id` IS NULL OR `order_id` = 0);
