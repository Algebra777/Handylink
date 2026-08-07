# HandyLink Project Plan

## Project scope

This repository currently contains 25 static HTML prototype screens styled with Tailwind via CDN. There is no backend, no database, no package manager, and no Git history yet. The goal is to turn this into a working marketplace app for customers, artisans, admins, bookings, reviews, payments, and messaging while preserving the existing screens as-is.

## Recommended stack

- Backend: Laravel (PHP)
  - Reason: simple for a single non-expert maintainer, strong built-in auth and CRUD tooling, and a mature ecosystem.
- Database: MySQL
  - Reason: reliable relational storage for users, artisans, bookings, reviews, payments, messages, and admin workflows.
- Authentication: Laravel Breeze or Jetstream with role-based access
  - Reason: fast setup for customer, artisan, and admin roles.
- File storage: Laravel storage with local disk for MVP, then S3-compatible storage later
  - Reason: simple and practical for documents, profile photos, and verification files.
- Real-time messaging: Laravel Echo + Pusher or Laravel WebSockets locally
  - Reason: standard, well-documented chat integration without introducing a more complex stack.
- Payments: Stripe first, with Paystack and Flutterwave available as additional options for the Nigerian market
  - Reason: Stripe is the easiest default, while Paystack and Flutterwave better fit local market needs. The plan is to support multiple providers through a payment abstraction layer rather than hard-coding one provider only.
- Frontend integration: keep the existing HTML/Tailwind screens as-is and connect them to Laravel routes/views
  - Reason: avoids a risky frontend rewrite while still making the screens dynamic.

## Integration order

1. Initialize Git and create a clean baseline commit of the current static prototype state.
2. Scaffold the Laravel application and create a simple route/view shell.
3. Create the database schema and migrations.
4. Implement authentication and role-based access.
5. Build the core booking flow: browse artisans -> select service -> schedule -> review/pay -> confirm.
6. Add admin approval and CRUD workflows.
7. Wire payments and booking status transitions.
8. Add messaging and notifications.
9. Finish validation, error handling, and polish.

## Screen-to-phase mapping

### Phase 1: Foundation and app shell

These screens will be the base entry points and route shells for the app:

- handylink_home_1/code.html
- handylink_home_2/code.html
- find_artisans/code.html

### Phase 2: Authentication and account setup

These screens will be connected to login, registration, profile management, and role-based routing:

- handylink_home_1/code.html
- handylink_home_2/code.html
- artisan_profile/code.html
- artisan_dashboard_overview/code.html
- admin_overview/code.html

### Phase 3: Core booking flow

These screens will be connected to the main customer journey:

- find_artisans/code.html
- artisan_profile/code.html
- booking_select_service/code.html
- booking_schedule/code.html
- booking_review_pay/code.html
- booking_confirmed/code.html
- booking_job_details/code.html

### Phase 4: Admin approval and CRUD workflows

These screens will be wired to admin review, moderation, and management actions:

- admin_overview/code.html
- admin_artisan_verification/code.html
- admin_verification_queue_mobile/code.html
- admin_review_artisan_documents/code.html
- admin_review_documents_mobile/code.html
- admin_category_manager/code.html
- admin_platform_fees/code.html
- admin_settings_overview/code.html
- admin_global_alerts/code.html
- admin_bookings_disputes/code.html
- admin_mobile_overview/code.html

### Phase 5: Payments, earnings, and job status

These screens will be connected to payment completion, job lifecycle, and artisan earnings:

- booking_review_pay/code.html
- booking_confirmed/code.html
- artisan_dashboard_earnings/code.html
- artisan_dashboard_my_jobs/code.html
- artisan_dashboard_overview/code.html

### Phase 6: Messaging and notifications

These screens will be connected to real-time communication and alerts:

- messages_with_alex_morgan/code.html
- booking_job_details/code.html
- artisan_dashboard_my_jobs/code.html
- admin_global_alerts/code.html

## Implementation notes

- The existing UI should not be restyled or redesigned during the implementation; functionality will be added to the existing screens.
- The 25 screens will remain as-is for now and be mapped to routes/views rather than being reorganized.
- Admin access will stay inside the same app and be gated by role.
- Any payment provider credentials, webhook secrets, or real messaging credentials must be placed in environment variables and never hard-coded.

## Decisions confirmed

- Hosting target for now: local development first.
- Screen organization: keep the 25 screens as-is for now.
- Admin model: keep it inside the same app, gated by role.
- Payments: support Stripe, Paystack, and Flutterwave as options, with Stripe as the initial default for implementation.
