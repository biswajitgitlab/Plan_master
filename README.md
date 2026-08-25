# Dynamic Event Registration & Approval System with Quotas

A modern, enterprise-grade Event Management & Registration Platform built on Laravel, featuring dynamic form schema generation, role-based quota management, automatic waitlisting, and sequential multi-tiered approval workflows.

---

## 🌟 Key Features & Architecture

### 1. Dynamic Form Builder & Validation
- **Custom JSON Schema**: Admins define event-specific dynamic fields (e.g. text inputs, select dropdowns, textareas, checkboxes) during event creation.
- **Custom Rule Engine**: Enforced on server-side via `App\Rules\ValidDynamicForm` ensuring required field compliance, regex validation, and type safety before storing responses in JSON format inside the `registrations` table.

### 2. Role-Based Quota Management & Automatic Waitlisting
- **Quota Allocation**: Admins set capacity limits per user role (`Employee`, `Manager`, `External`, `User`) in `event_quotas`.
- **Enforcement**: Upon registration submission, the system counts existing active registrations (`pending` or `approved`) for the registering user's role.
- **Automatic Waitlisting**: If the quota limit for the user's role is reached, the status is automatically set to `waitlisted`.

### 3. Multi-Tiered Sequential Approval Bands
- **Sequential Approvals**: Admins construct ordered approval bands (`level_sequence`: Level 1 -> Level 2 -> Level 3...).
- **Role Gating**: Approvers assigned to a specific level review candidate registrations in their Approver Panel when `current_approval_level` reaches their sequence.
- **Waitlist Promotion**: When a registration is rejected, the system automatically checks if a waitlisted candidate of the same role exists, promotes them to `pending`, and notifies the Level 1 approvers.

### 4. Real-time Notifications & Middleware Security
- **Notifications**: Integrated Laravel Mail/Database notifications (`RegistrationRequiresApproval`, `RegistrationStatusUpdated`) alerting users upon status transitions.
- **Role Authorization**: Protected with `IsApprover` middleware and Spatie Permission role checks (`Admin`, `Approver`, `Manager`, `User`).

---

## 🚀 Quick Start Guide

### Prerequisites
- PHP >= 8.2
- MySQL / MariaDB
- Composer & Node.js / npm

### Installation Steps

1. **Clone & Install Dependencies**
   ```bash
   cd event_system
   composer install
   npm install && npm run build
   ```

2. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Database Migration & Seeding**
   ```bash
   php artisan migrate --seed
   ```
   *Seeders populate default roles, sample events, approval bands, quotas, and test accounts.*

4. **Run Development Server**
   ```bash
   php artisan serve
   ```

5. **Run Automated Test Suite**
   ```bash
   ./vendor/bin/phpunit
   ```

---

## 🗄️ SQL Dump & Deliverables

- **SQL Dump**: `event_system.sql` (Located at the root of the workspace) containing pre-built schema, foreign key constraints, roles, and sample data.
- **Automated Tests**: Comprehensive PHPUnit test suite validating registration limits, approval cascades, and validation rules (`25/25 tests passing`).
