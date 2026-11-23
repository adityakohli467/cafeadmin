-- HR DB (linrefvy_hr_portal): per-branch timezone used for clock in/out and timesheets.
ALTER TABLE `customer_branches`
  ADD COLUMN `timezone` VARCHAR(64) NOT NULL DEFAULT 'Australia/Melbourne';

-- Ipswich (QLD) has no daylight saving. Adjust the name filter to match the actual branch.
-- UPDATE `customer_branches` SET `timezone` = 'Australia/Brisbane' WHERE `branch_name` LIKE '%Ipswich%';
