-- Recommended indexes for Austria Admission dashboard queries
-- Review and apply on a staging database first. Adjust index names if your DB uses a different naming convention.

-- 1) clients tables: support filters used frequently in WHERE clauses and GROUP/JOIN
-- The application uses suffixed tables like clients1 and clients2 (see session dbNo).
-- Apply indexes for both variants below. Remove any statement you don't need.
CREATE INDEX IF NOT EXISTS idx_clients_client_country_1 ON clients1(client_country);
CREATE INDEX IF NOT EXISTS idx_clients_client_countryfrom_1 ON clients1(client_countryfrom);
CREATE INDEX IF NOT EXISTS idx_clients_doc_pro_pay_ack_1 ON clients1(client_document_status, client_pro_confirm_status, client_pay_confirm_status, ack_confirm_status);
CREATE INDEX IF NOT EXISTS idx_clients_client_applied_1 ON clients1(client_applied(255));
CREATE INDEX IF NOT EXISTS idx_clients_case_change_status_1 ON clients1(case_status, change_status);
CREATE INDEX IF NOT EXISTS idx_clients_client_process_status_1 ON clients1(client_process_status);
CREATE INDEX IF NOT EXISTS idx_clients_due_after_ad_status_1 ON clients1(due_after_ad_status);

CREATE INDEX IF NOT EXISTS idx_clients_client_country_2 ON clients2(client_country);
CREATE INDEX IF NOT EXISTS idx_clients_client_countryfrom_2 ON clients2(client_countryfrom);
CREATE INDEX IF NOT EXISTS idx_clients_doc_pro_pay_ack_2 ON clients2(client_document_status, client_pro_confirm_status, client_pay_confirm_status, ack_confirm_status);
CREATE INDEX IF NOT EXISTS idx_clients_client_applied_2 ON clients2(client_applied(255));
CREATE INDEX IF NOT EXISTS idx_clients_case_change_status_2 ON clients2(case_status, change_status);
CREATE INDEX IF NOT EXISTS idx_clients_client_process_status_2 ON clients2(client_process_status);
CREATE INDEX IF NOT EXISTS idx_clients_due_after_ad_status_2 ON clients2(due_after_ad_status);

-- 2) austria_clients_programs tables: used in JOINs and many filters
CREATE INDEX IF NOT EXISTS idx_acp_aus_clients_id_1 ON austria_clients_programs1(aus_clients_id);
CREATE INDEX IF NOT EXISTS idx_acp_aus_university_name_1 ON austria_clients_programs1(aus_university_name(255));
CREATE INDEX IF NOT EXISTS idx_acp_assign_program_status_1 ON austria_clients_programs1(aus_assign_status, aus_program_status, aus_direct_applied_status);
CREATE INDEX IF NOT EXISTS idx_acp_sops_deadline_1 ON austria_clients_programs1(aus_sops_assign_to, aus_sops_status, aus_deadline_hold_status, aus_additional_activities_status);
CREATE INDEX IF NOT EXISTS idx_acp_change_close_status_1 ON austria_clients_programs1(aus_change_program_status, close, status);

CREATE INDEX IF NOT EXISTS idx_acp_aus_clients_id_2 ON austria_clients_programs2(aus_clients_id);
CREATE INDEX IF NOT EXISTS idx_acp_aus_university_name_2 ON austria_clients_programs2(aus_university_name(255));
CREATE INDEX IF NOT EXISTS idx_acp_assign_program_status_2 ON austria_clients_programs2(aus_assign_status, aus_program_status, aus_direct_applied_status);
CREATE INDEX IF NOT EXISTS idx_acp_sops_deadline_2 ON austria_clients_programs2(aus_sops_assign_to, aus_sops_status, aus_deadline_hold_status, aus_additional_activities_status);
CREATE INDEX IF NOT EXISTS idx_acp_change_close_status_2 ON austria_clients_programs2(aus_change_program_status, close, status);

-- 3) JSON column optimization suggestion (manual change required):
-- If you frequently query JSON_CONTAINS(acp.aus_program_name, JSON_QUOTE(...)), consider adding a generated (virtual) column that extracts the program name and index it, or normalize programs into a separate table.
-- Example (MariaDB/MySQL 5.7+):
-- ALTER TABLE austria_clients_programs
-- ADD COLUMN aus_program_first_name VARCHAR(255) GENERATED ALWAYS AS (JSON_UNQUOTE(JSON_EXTRACT(aus_program_name, '$[0]'))) VIRTUAL,
-- ADD INDEX idx_acp_program_first_name (aus_program_first_name);

-- NOTES:
-- - "IF NOT EXISTS" in CREATE INDEX is supported in recent MySQL versions; remove it if your server is older.
-- - Adding indexes speeds reads but adds overhead on writes; choose indexes that match your most common dashboard queries.
-- - Test with EXPLAIN to ensure the new indexes are used.

-- To apply on MySQL CLI:
-- SOURCE path/to/this/file.sql;  OR copy-paste the specific CREATE INDEX statements.
