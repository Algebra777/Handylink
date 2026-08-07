---
name: HandyLink
colors:
  surface: '#f8f9ff'
  surface-dim: '#cbdbf5'
  surface-bright: '#f8f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#eff4ff'
  surface-container: '#e5eeff'
  surface-container-high: '#dce9ff'
  surface-container-highest: '#d3e4fe'
  on-surface: '#0b1c30'
  on-surface-variant: '#424656'
  inverse-surface: '#213145'
  inverse-on-surface: '#eaf1ff'
  outline: '#737687'
  outline-variant: '#c3c6d8'
  surface-tint: '#0052dd'
  primary: '#004ccd'
  on-primary: '#ffffff'
  primary-container: '#0f62fe'
  on-primary-container: '#f3f3ff'
  inverse-primary: '#b4c5ff'
  secondary: '#006c49'
  on-secondary: '#ffffff'
  secondary-container: '#6cf8bb'
  on-secondary-container: '#00714d'
  tertiary: '#9e3100'
  on-tertiary: '#ffffff'
  tertiary-container: '#c84000'
  on-tertiary-container: '#fff1ed'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#dbe1ff'
  primary-fixed-dim: '#b4c5ff'
  on-primary-fixed: '#00174c'
  on-primary-fixed-variant: '#003da9'
  secondary-fixed: '#6ffbbe'
  secondary-fixed-dim: '#4edea3'
  on-secondary-fixed: '#002113'
  on-secondary-fixed-variant: '#005236'
  tertiary-fixed: '#ffdbd0'
  tertiary-fixed-dim: '#ffb59d'
  on-tertiary-fixed: '#390c00'
  on-tertiary-fixed-variant: '#832700'
  background: '#f8f9ff'
  on-background: '#0b1c30'
  surface-variant: '#d3e4fe'
typography:
  display-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  display-lg-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
    letterSpacing: -0.02em
  headline-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
    letterSpacing: -0.01em
  headline-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 20px
    letterSpacing: 0.05em
  label-sm:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '500'
    lineHeight: 16px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 4px
  xs: 4px
  sm: 8px
  md: 16px
  lg: 24px
  xl: 32px
  2xl: 48px
  3xl: 64px
  container-max: 1280px
  gutter: 24px
---

## Brand & Style
The design system for this platform is built on the pillars of **Trust, Professionalism, and Seamless Utility**. It adopts a **Premium Minimalist** aesthetic that draws inspiration from industry leaders in the service economy. 

The visual language balances the high-tech precision of a digital marketplace with the human-centric warmth of craftsmanship. Key stylistic drivers include:
- **Clarity over Clutter:** Generous whitespace and a rigid systematic grid to reduce cognitive load during the booking process.
- **Modern Layering:** A sophisticated use of glassmorphism and soft shadows to create a clear sense of depth and hierarchy.
- **Trust-Driven Cues:** Crisp iconography and high-contrast typography that signal reliability and verification.

## Colors
This design system utilizes a high-trust palette. **Primary Blue (#0F62FE)** is the core action color, used for primary buttons and critical path interactions. **Secondary Green (#10B981)** is reserved for "Verified" statuses, successful bookings, and positive growth indicators. **Accent Amber (#F59E0B)** is used sparingly for ratings, warnings, and urgent alerts.

The system supports a full **Dark Mode** implementation. In Dark Mode, the background shifts to a deep navy (#0F172A) to maintain premium contrast levels, while primary colors maintain their vibrancy through adjusted luminance for accessibility.

## Typography
The typography strategy pairings prioritize readability and modern flair. **Plus Jakarta Sans** (serving as the modern alternative for display needs) is used for all headlines to provide a friendly yet structured character. **Inter** is the workhorse for all UI elements and body text, chosen for its exceptional legibility and neutral, professional tone.

- **Scale:** Use `display-lg` exclusively for hero sections on desktop.
- **Mobile Adaptivity:** Headlines larger than 24px should drop by one tier on mobile devices to prevent awkward line breaks.
- **Labels:** Use `label-md` for small headers or category tags to create clear hierarchy.

## Layout & Spacing
The layout follows a **Fluid 12-Column Grid** for desktop and a **4-Column Grid** for mobile. 

- **Desktop (1280px+):** 24px gutters with 80px side margins.
- **Tablet (768px - 1024px):** 16px gutters with 40px side margins.
- **Mobile (< 768px):** 16px gutters with 16px side margins.

A strict **8px base unit** governs all spatial relationships. Every margin, padding, and gap should be a multiple of 8px (e.g., 16, 24, 32) to ensure mathematical harmony across all screen sizes. Vertical spacing between logical sections should default to `2xl` (48px) to maintain a premium, airy feel.

## Elevation & Depth
This design system uses a combination of **Ambient Shadows** and **Glassmorphism** to establish its hierarchy:

1.  **Level 0 (Flat):** Used for the main canvas background.
2.  **Level 1 (Low):** Soft 1px border with a 4px blur shadow. Used for persistent cards or list items.
3.  **Level 2 (Medium):** 12px blur shadow with 5% opacity. Used for hover states and navigation bars.
4.  **Level 3 (High):** 24px blur shadow with 10% opacity. Reserved for modals, dropdowns, and floating action buttons.

**Glassmorphism Application:**
Apply a `backdrop-filter: blur(12px)` and `background: rgba(255, 255, 255, 0.7)` to sticky navigation bars and overlaying cards to create a sense of lightness and modern tech-sophistication.

## Shapes
The shape language is defined by **rounded, approachable geometry**. To align with the requested 16px aesthetic, the system uses a 0.5rem base for standard components.

- **Base Components:** (Buttons, Inputs, Small Cards) use `rounded-md` (8px).
- **Primary Containers:** (Main Feed Cards, Modals) use `rounded-xl` (16px).
- **Interactive Pill:** (Chips, Tags, Search Bars) use `rounded-full` for a distinct, modern look.

## Components
- **Buttons:** Primary buttons feature a subtle gradient and a soft shadow. Use 16px (1rem) vertical padding for a "chunky," premium feel. Secondary buttons should be ghost-styled with a 1px border.
- **Cards:** Artisan profiles should be contained in cards with a 16px corner radius, featuring a subtle white-to-transparent gradient stroke to define edges on light backgrounds.
- **Input Fields:** Use a 12px padding with a light gray fill (#F1F5F9). On focus, the border should transition to the Primary Blue with a 3px soft outer glow.
- **Verified Badge:** A Secondary Green chip with a small "check" icon, using the `label-sm` font style.
- **Floating Action Button (FAB):** For mobile, use a circular Primary Blue button with a high elevation (Level 3 shadow) for the "Post a Job" action.
- **Glass Navigation:** The top header should remain fixed with a glassmorphic background blur to keep content visible as it scrolls beneath.