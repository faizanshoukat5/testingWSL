# Changes summary (files changed — why — impact)

This file lists only the files changed during the recent hardening/refactor work and for each file: 1) why it was changed, and 2) the impact of that change.

| File | Why changed | Impact |
|---|---|---|
| `env/main-config.php` | Casted `$_SESSION['dbNo']` to `(int)` to stop unsafe table-name suffixing and ensure numeric-only session DB identifiers. | Prevents SQL/table-name injection and eliminates type-related runtime errors when building dynamic table names. |
| `testdb.php` | Added a quick DB connectivity check (points to `testing_wsl`). | Quick verification that the app connects to the correct test database during local development. |
| `austria-admission-head/models/uploadHelper.php` | Centralized file-upload logic and validation (`upload_single_file()` helper). | Single, reviewed upload path: consistent validation, randomized filenames, easier future policy changes and fewer duplicate upload checks. |
| `austria-admission-head/models/escape.php` | Added `e()` HTML-escaping helper. | Standardized output escaping to reduce XSS risk in edited views. |
| `austria-admission-head/getState.php` | Converted AJAX branches to null-safe code and (where edited) to prepared statements; removed direct array-offsets on null results. | Eliminates PHP warnings/notices for missing DB rows and closes multiple null-safety/XSS gaps in AJAX endpoints. Improves robustness of UI flows. |
| `austria-admission-head/controllers/Assign_programs.php` | Fixed parse error and converted concatenated SQL to prepared statements. | Removes runtime parse error and prevents SQL injection on program-assignment operations. |
| `austria-admission-head/controllers/Apply_programs.php` | Rewrote raw SQL to prepared statements and added session/DB guards. | Prevents SQL injection and avoids fatal errors when controller is called directly. |
| `austria-admission-head/controllers/Admission_documents.php` | Replaced inline upload logic with `upload_single_file()` and parameterized queries. | Centralized validation for document uploads and closed SQLi vectors. |
| `austria-admission-head/controllers/Profile_setting.php` | Converted to prepared statements and used upload helper for profile images. | Hardened profile updates against SQLi and file‑upload inconsistencies. |
| `austria-admission-head/controllers/Universities_and_programs.php` | Parameterized bulk inserts/updates and removed unsafe concatenation. | Safer database writes for university/program records and improved query reliability. |
| `austria-admission-head/controllers/Visa_process.php` | Converted raw queries to prepared statements and switched file handling to the upload helper. | Eliminates SQLi exposure in visa-processing flows and unifies upload validation. |
| `austria-admission-head/controllers/Master_universities.php` | Replaced concatenated INSERT/UPDATE with prepared statements. | Prevents SQL injection and enforces correct data types on insert/update. |
| `austria-admission-head/controllers/Bachelor_universities.php` | Converted to prepared statements; fixed CGPA insert handling. | Removes injection risk and fixes incorrect insert behavior. |
| `austria-admission-head/controllers/FAQs_section.php` | Converted concatenated SQL into prepared statements. | Secures FAQ create/update endpoints against SQLi. |
| `austria-admission-head/controllers/Clients_previous_degree.php` | Replaced raw SQL with prepared statements. | Hardened previous-degree operations and added null-safety where required. |
| `austria-admission-head/controllers/All_clients.php` | Converted high-risk queries to prepared statements and added guards. | Reduces SQLi surface area in client listing/updates and stabilizes controller when called without bootstrap. |
| `austria-admission-head/controllers/Change_password.php` | Replaced string-concatenation SQL with prepared statements. | Prevents credential-related SQLi and improves error handling. |
| `austria-admission-head/controllers/Master_universities.php` | (See above) Prepared statements for inserts/updates. | (See above) |
| `austria-admission-head/views/print-programs.html.php` | Replaced `SELECT *` where edited and applied `e()` escaping to output. | Smaller, explicit SELECTs and escaped output reduce data leakage and XSS risk. |
| `austria-admission-head/views/Assign_programs.html.php` | Reduced `SELECT *` usage and escaped displayed values. | Less data returned from DB and safer UI rendering (reduced XSS potential). |

---

Notes: only the files above were changed as part of this hardening pass. Changes focused on three goals: remove SQL injection vectors (prepared statements), centralize and validate file uploads, and eliminate runtime PHP warnings / XSS by adding null‑safety and escaping.  
If you want, I can produce a follow-up README entry that shows the exact commits or diff hunks for each file.