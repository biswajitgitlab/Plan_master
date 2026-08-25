Project Title:
Dynamic Event Registration &amp; Approval System with Quotas
Background:
Your company organizes internal and external events (trainings, seminars, webinars).
We need a system where:
1. Admins create events, define participant quotas, and set approval steps.
(administrator)
2. Users register for events (dynamic forms).
3. Approvers approve or reject registrations based on approval bands. (sub-admin)

Modules:
Admin Panel
 Create event (name, description, dates)
 Define quotas per role (employee, external, manager, etc.)
 Set approval bands (sequence of approvers)
User Panel
 View upcoming events
 Register (form changes by event).
 If quota full → waitlist option
Approver Panel
 See registrations waiting for approval in their dashboard (sub-admin login with
limited access. Check registration list event wise &amp; approve/reject user registration)
 Approve or reject

Deliverables:
1. CI3 project code
2. SQL dump (database file)
3. Screenshots (Event creation, Registration form, Approval page)
4. README explaining quota logic, approval flow, dynamic forms
Evaluation Criteria:
 CI3 routing, controllers, models
 MySQL: joins, FK constraints
 PHP logic: quota enforcement &amp; approvals
 JS/jQuery: dynamic form &amp; validation
 Code clarity &amp; security