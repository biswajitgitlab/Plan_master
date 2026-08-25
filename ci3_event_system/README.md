# CodeIgniter 3 - Dynamic Event Registration & Approval System with Quotas

This is the **CodeIgniter 3 (CI3)** implementation of the Dynamic Event Registration, Role Quota Management, and Multi-Tiered Approval System as specified in `task.md`.

---

## 🌟 Architecture & Features (CI3)

### 1. Controllers & Routing (`application/controllers/`)
- `Auth.php`: Login & Session Authentication with role Quick-Fill.
- `Admin.php`: Administrator dashboard to create events, set participant quotas per role, set multi-level approval bands, and define JSON schemas for dynamic form fields.
- `Events.php`: User-facing event directory and dynamic registration form with quota checks and automatic waitlist logic.
- `Approvals.php`: Approver dashboard for Sub-Admins / Approvers with status filter tabs (`Pending`, `Approved`, `Rejected`, `Waitlisted`, `All`), multi-step sequential approval forwarding, and waitlist promotion upon rejection.

### 2. Database Models (`application/models/`)
- `User_model.php`: Handles user lookup and role retrieval.
- `Event_model.php`: Manages event creation, updating, and detail views.
- `Quota_model.php`: Handles capacity limit configuration per role (`Employee`, `Manager`, `External`, `User`).
- `Approval_model.php`: Manages sequential approval bands (`level_sequence`).
- `Registration_model.php`: Manages dynamic form submissions, MySQL JOIN queries, FK integrity, approval logs, and automated waitlist promotion.

### 3. Dynamic Form Validation & JS / jQuery (`application/views/admin/create_event.php`)
- Interactive jQuery form schema builder allowing admins to append dynamic text/select inputs on-the-fly.
- Client-side validation ensuring required dynamic inputs are filled prior to submission.

---

## 🗄️ Database & Installation Setup

1. **Database Import**:
   Import `ci3_event_system.sql` into MySQL:
   ```bash
   mysql -u root -p ci3_event_system < ci3_event_system.sql
   ```

2. **Run Local Server**:
   ```bash
   cd ci3_event_system
   php -S localhost:8080
   ```
   Open `http://localhost:8080` in your browser.

3. **Default Credentials**:
   - **Admin**: `admin@example.com` / `password`
   - **Approver Level 1**: `approver1@example.com` / `password`
   - **Approver Level 2**: `approver2@example.com` / `password`
   - **Employee**: `employee@example.com` / `password`
   - **Manager**: `manager@example.com` / `password`
   - **External User**: `external@example.com` / `password`
