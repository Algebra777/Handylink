---
name: HandyLink Admin
colors:
  surface: '#faf8ff'
  surface-dim: '#d8d9e6'
  surface-bright: '#faf8ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f2f3ff'
  surface-container: '#ecedfa'
  surface-container-high: '#e7e7f4'
  surface-container-highest: '#e1e1ee'
  on-surface: '#191b24'
  on-surface-variant: '#424656'
  inverse-surface: '#2e303a'
  inverse-on-surface: '#eff0fd'
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
  background: '#faf8ff'
  on-background: '#191b24'
  surface-variant: '#e1e1ee'
typography:
  display-lg:
    fontFamily: Poppins
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
    letterSpacing: -0.02em
  headline-md:
    fontFamily: Poppins
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  title-sm:
    fontFamily: Poppins
    fontSize: 18px
    fontWeight: '500'
    lineHeight: 28px
  body-base:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  table-text:
    fontFamily: Inter
    fontSize: 13px
    fontWeight: '400'
    lineHeight: 18px
  label-caps:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.05em
  mono-data:
    fontFamily: Inter
    fontSize: 13px
    fontWeight: '500'
    lineHeight: 18px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  sidebar-width: 240px
  topbar-height: 64px
  gutter: 24px
  container-padding: 32px
  table-row-height: 48px
  stack-sm: 8px
  stack-md: 16px
---

## Brand & Style
The design system focuses on a **Corporate / Modern** aesthetic tailored for high-density administrative tasks. It prioritizes utility, clarity, and trust, facilitating the management of a complex service marketplace. The interface is characterized by a "utility-first" mindset, balancing the approachability of the consumer brand with the rigorous efficiency required for back-office operations. 

The style utilizes a structured layout with a persistent sidebar to provide immediate access to the deep information architecture. It employs a blend of soft shadows for depth and minimal borders for structural integrity, ensuring that data-heavy screens remain scannable and professional.

## Colors
The palette is rooted in professional stability and functional clarity. 
- **Primary (#0F62FE):** Used for primary actions, active navigation states, and key interactive elements.
- **Secondary (#10B981):** Reserved for success states, verified artisan badges, and positive financial trends.
- **Accent (#F59E0B):** Utilized for warnings, pending verification queues, and high-priority disputes.
- **Backgrounds:** The design system supports a light-mode default using #F8FAFC for low eye strain during long sessions, with a dark-mode alternative at #0F172A for high-contrast environments.
- **Surface Neutrals:** Use varying shades of Slate (from 50 to 900) to differentiate between the sidebar, top bar, and main content canvas.

## Typography
The system employs a dual-font strategy. **Poppins** provides a friendly yet authoritative voice for headings and page titles, maintaining brand continuity with the mobile experience. **Inter** is the workhorse for the administrative interface, chosen for its exceptional legibility in data tables, sidebars, and form fields.

For data-heavy views, use `table-text` for standard row content. `label-caps` is specifically intended for table headers and sidebar category labels to create clear visual hierarchy.

## Layout & Spacing
The layout follows a **Fixed Shell** model with a fluid content area.
- **Sidebar:** A persistent 240px left-hand column contains the primary navigation. It uses a vertical stack with 4px spacing between items.
- **Topbar:** A 64px fixed header houses global search, notifications, and profile. It remains stuck to the top of the viewport.
- **Main Content:** The area utilizes a 32px padding from the shell edges. Content within cards uses a 24px internal margin.
- **Grid:** Use a 12-column grid for the main content area to align dashboard widgets and form layouts.
- **Responsiveness:** On smaller desktop viewports, the sidebar may collapse into an icon-only rail (64px) to maximize data visibility.

## Elevation & Depth
This design system uses **Tonal Layers** combined with **Ambient Shadows** to define the z-axis.
- **Level 0 (Background):** #F8FAFC. The base canvas for the entire application.
- **Level 1 (Sidebar/Topbar):** White surface with a subtle 1px border (Slate-200) to separate navigation from the canvas.
- **Level 2 (Cards/Containers):** White surface with a "Soft" shadow: `0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1)`.
- **Level 3 (Modals/Popovers):** White surface with a high-diffusion shadow to imply significant distance from the page.

## Shapes
The design system uses a strategic mix of corner radii to balance brand warmth with functional density:
- **Large Radius (16px):** Applied to primary containers, cards, modals, and buttons. This aligns with the "HandyLink" friendly brand identity.
- **Small Radius (8px):** Applied to utility elements such as text inputs, dropdowns, and hover states for table rows. This tighter radius allows for higher information density and a more "tool-like" feel in complex workflows.

## Components
### Navigation
- **Sidebar Items:** Use Lucide/Feather outline icons (20px). Active state includes a Primary (#0F62FE) left-edge indicator and a light-blue tinted background.
- **Breadcrumbs:** Small 12px Inter text with chevron separators; used on every internal page for orientation.

### Data Tables
- **Rows:** 48px height for high density. On hover, apply an 8px rounded background tint (Slate-100).
- **Status Chips:** 24px height, pill-shaped, using low-opacity backgrounds of the status color (e.g., Success uses 10% opacity of #10B981 with 100% opacity text).

### Controls
- **Buttons:** Primary buttons use 16px rounding and semi-bold Poppins text. Secondary buttons use a Slate-200 border.
- **Inputs:** 8px rounding, 40px height. Use a 1px Slate-300 border, turning Primary (#0F62FE) on focus.
- **Search:** Global search in the top bar should be a full-width expandable input or a large fixed-width bar with a ⌘K keyboard shortcut hint.

### Cards
- **Dashboard Widgets:** Use the 16px radius. Include a standard header with Title (title-sm) and an optional "View All" link or context menu.