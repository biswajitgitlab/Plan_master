# Dynamic Event Registration & Approval System

This CodeIgniter 3 project is a dynamic event management system handling robust registration flows, participant quotas by role, and multi-tiered approval chains.

## 1. Quota Enforcement Logic
- **Role-Based Allocation**: During event creation, the Admin can define seat limits (quotas) per user role (e.g., Employee, External, Manager).
- **Enforcement on Registration**: When a user registers, the system verifies their role against the event's quota limits.
- **Automatic Waitlisting**: If the number of existing active registrations (not rejected) for their role has reached or exceeded the quota, their registration status is automatically set to `waitlisted`. Otherwise, it defaults to `pending`.
- **Waitlist Promotion**: If an approved or pending participant is rejected (or cancels), a space frees up in the quota. The system will look for the first waitlisted user in that role and promote them to `pending` status, entering them into the approval pipeline.

## 2. Dynamic Registration Forms
- **Event-Specific Schemas**: Admins can define custom registration forms for each event using a JSON-based schema (Field Name, Field Label, Field Type (text, number, select, textarea), and Required status).
- **Form Generation**: The registration page dynamically parses this JSON schema and builds the HTML form fields tailored specifically to that event.
- **Data Storage**: Participant responses are collected into an array, encoded into a JSON string, and securely stored in the `form_data` column of the `registrations` table. This allows for arbitrary question-answer sets without needing to alter database columns.

## 3. Tiered Approval Flow
- **Approval Bands**: Admins can define "Approval Bands" for an event. These are sequential levels of approval required for a registration to be fully accepted. For example: Level 1 (Manager) -> Level 2 (Sub-Admin).
- **Sequential Review**: When a registration is created (and not waitlisted), it starts at `current_approval_level = 1`. Approvers assigned to Level 1 evaluate it first.
- **Advancing the Pipeline**: When an approver approves the registration, the system increments the `current_approval_level`. It checks if there are higher levels remaining. If there are, the registration remains `pending` but moves to the next approver. If there are no more levels, the status changes to `approved`.
- **Immediate Rejection**: If any approver in the chain rejects the registration, its status is immediately set to `rejected`, and the process terminates.

## Deliverables Checklist
1. **CI3 Project Code**: Located in the `ci3_event_system` directory.
2. **SQL Dump**: `ci3_event_system.sql` file provided at the root.
3. **README**: This document.
4. **Screenshots**: *Please capture the screenshots (Event Creation, Registration Form, Approval Page) and place them in the project folder before sharing the final zip.*
