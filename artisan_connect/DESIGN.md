---
name: Artisan Connect
colors:
  surface: '#f8f9ff'
  surface-dim: '#ccdbf3'
  surface-bright: '#f8f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#eff4ff'
  surface-container: '#e6eeff'
  surface-container-high: '#dce9ff'
  surface-container-highest: '#d5e3fc'
  on-surface: '#0d1c2e'
  on-surface-variant: '#404847'
  inverse-surface: '#233144'
  inverse-on-surface: '#eaf1ff'
  outline: '#707977'
  outline-variant: '#bfc8c6'
  surface-tint: '#316763'
  primary: '#003633'
  on-primary: '#ffffff'
  primary-container: '#134e4a'
  on-primary-container: '#87beb8'
  inverse-primary: '#9ad1cb'
  secondary: '#855300'
  on-secondary: '#ffffff'
  secondary-container: '#fea619'
  on-secondary-container: '#684000'
  tertiary: '#2c3032'
  on-tertiary: '#ffffff'
  tertiary-container: '#434648'
  on-tertiary-container: '#b1b4b6'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#b5ede7'
  primary-fixed-dim: '#9ad1cb'
  on-primary-fixed: '#00201e'
  on-primary-fixed-variant: '#144f4b'
  secondary-fixed: '#ffddb8'
  secondary-fixed-dim: '#ffb95f'
  on-secondary-fixed: '#2a1700'
  on-secondary-fixed-variant: '#653e00'
  tertiary-fixed: '#e0e3e5'
  tertiary-fixed-dim: '#c4c7c9'
  on-tertiary-fixed: '#191c1e'
  on-tertiary-fixed-variant: '#444749'
  background: '#f8f9ff'
  on-background: '#0d1c2e'
  surface-variant: '#d5e3fc'
typography:
  display-lg:
    fontFamily: Public Sans
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Public Sans
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
    letterSpacing: -0.01em
  headline-lg-mobile:
    fontFamily: Public Sans
    fontSize: 28px
    fontWeight: '600'
    lineHeight: 34px
  headline-md:
    fontFamily: Public Sans
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  body-lg:
    fontFamily: Public Sans
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Public Sans
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-md:
    fontFamily: Public Sans
    fontSize: 14px
    fontWeight: '500'
    lineHeight: 20px
    letterSpacing: 0.01em
  label-sm:
    fontFamily: Public Sans
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  xs: 4px
  sm: 12px
  md: 24px
  lg: 40px
  xl: 64px
  gutter: 16px
  margin-mobile: 20px
  margin-desktop: auto
  max-width: 1200px
---

## Brand & Style

This design system is built on a **Corporate / Modern** foundation infused with **Humanist Warmth**. The goal is to bridge the gap between digital efficiency and the physical craft of local artisans. 

The aesthetic prioritizes clarity and high-quality whitespace to reduce cognitive load for users seeking urgent services. By utilizing soft, organic shapes and a grounded color palette, the UI evokes a sense of reliability and neighborly trust. The style avoids unnecessary decoration, focusing instead on "functional elegance" where every shadow and radius serves to guide the user toward booking and communication.

## Colors

The color strategy centers on a **Deep Teal** primary to establish immediate professional authority and calm. This is paired with a **Warm Amber** accent, used sparingly for primary actions (CTAs) and "active" status indicators to represent energy, craft, and visibility.

- **Primary (Deep Teal):** Used for headers, primary navigation, and core brand elements.
- **Secondary (Amber):** Reserved for high-priority buttons and interactive highlights.
- **Surface & Backgrounds:** We use a "Soft Slate" spectrum for backgrounds to differentiate content areas without the harshness of pure white (#FFFFFF). 
- **Feedback:** Use standard semantic colors (Green for success, Red for urgent errors) but slightly desaturated to match the professional tone.

## Typography

**Public Sans** is selected for its institutional clarity and neutral-yet-friendly personality. It ensures high legibility for users of all ages, which is critical for a service marketplace.

- **Headlines:** Use a Semi-Bold weight (600) with slight negative letter spacing to feel "tucked in" and professional.
- **Body:** Standardized at 16px for optimal readability. Use a Slate Grey (#475569) instead of pure black to soften the reading experience.
- **Labels:** Utilize Medium weights (500) for UI metadata and uppercase styles for small category tags to create clear hierarchy.

## Layout & Spacing

The design system utilizes a **12-column Fixed Grid** for desktop and a **Fluid 4-column Grid** for mobile devices. 

- **Vertical Rhythm:** Built on an 8px baseline. All components should have heights and internal paddings that are multiples of 8.
- **Margins:** Mobile views require a generous 20px margin to ensure touch targets for artisan cards don't feel cramped against the screen edge.
- **Sectioning:** Use large `xl` (64px) spacing between distinct content sections (e.g., between "Featured Electricians" and "How it Works") to maintain the "breathing" quality of the brand.

## Elevation & Depth

This system uses **Ambient Shadows** to create a natural, tactile feel without looking cluttered. 

- **Level 1 (Static Cards):** A very soft, wide-spread shadow (Y: 4px, Blur: 12px, 5% Opacity Black) to lift cards off the soft grey background.
- **Level 2 (Hover/Active):** An increased shadow (Y: 8px, Blur: 20px, 8% Opacity) to provide feedback that an element is interactive.
- **Surface Layering:** Use Tonal Layers for navigation. The top app bar should be pure white (#FFFFFF) with a thin 1px border (#E2E8F0) rather than a shadow to keep the top of the page feeling light and anchored.

## Shapes

The shape language is consistently **Rounded**, signifying approachability and friendliness.

- **Components:** Buttons, Input Fields, and Cards all share the `rounded-lg` (16px) standard.
- **Iconography:** Use minimalist line-art icons with rounded terminals (ends). Avoid sharp 90-degree corners in any custom illustrations or iconography to maintain the "Human" brand personality.
- **Avatar Containers:** Use a soft-squircle shape rather than a perfect circle to distinguish the brand's unique "hand-crafted" aesthetic.

## Components

### Buttons
- **Primary:** Deep Teal background with White text. 16px corner radius. Minimum height of 48px for mobile accessibility.
- **Secondary/CTA:** Warm Amber background. Used exclusively for "Book Now" or "Contact" actions.

### Cards (Artisan Profiles)
- White background with the Level 1 Ambient Shadow.
- 16px internal padding. 
- Top-right corner reserved for "Verified" badge (Deep Teal circle with white checkmark).
- Subtext (Specialty/Location) uses `label-md` in a lighter slate color.

### Input Fields
- 1px Slate-200 border with a 16px corner radius.
- On focus, the border transitions to Deep Teal with a 2px stroke.
- Placeholder text is a soft grey to differentiate from user input.

### Chips & Tags
- Used for service categories (e.g., "Plumbing", "Emergency").
- Subtly tinted background based on the category, or a simple light-grey fill with `label-sm` bold text.

### Lists
- Use horizontal dividers (#F1F5F9) only when necessary. Preference is given to "Card-based" lists with 12px vertical gaps to emphasize the distinct nature of each artisan's service.