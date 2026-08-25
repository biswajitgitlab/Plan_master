---
name: Reliant Enterprise
colors:
  surface: '#f7f9fb'
  surface-dim: '#d8dadc'
  surface-bright: '#f7f9fb'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f2f4f6'
  surface-container: '#eceef0'
  surface-container-high: '#e6e8ea'
  surface-container-highest: '#e0e3e5'
  on-surface: '#191c1e'
  on-surface-variant: '#414754'
  inverse-surface: '#2d3133'
  inverse-on-surface: '#eff1f3'
  outline: '#727785'
  outline-variant: '#c1c6d6'
  surface-tint: '#005bc0'
  primary: '#005bbf'
  on-primary: '#ffffff'
  primary-container: '#1a73e8'
  on-primary-container: '#ffffff'
  inverse-primary: '#adc7ff'
  secondary: '#515f74'
  on-secondary: '#ffffff'
  secondary-container: '#d5e3fc'
  on-secondary-container: '#57657a'
  tertiary: '#9e4300'
  on-tertiary: '#ffffff'
  tertiary-container: '#c55500'
  on-tertiary-container: '#0e0200'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#d8e2ff'
  primary-fixed-dim: '#adc7ff'
  on-primary-fixed: '#001a41'
  on-primary-fixed-variant: '#004493'
  secondary-fixed: '#d5e3fc'
  secondary-fixed-dim: '#b9c7df'
  on-secondary-fixed: '#0d1c2e'
  on-secondary-fixed-variant: '#3a485b'
  tertiary-fixed: '#ffdbcb'
  tertiary-fixed-dim: '#ffb691'
  on-tertiary-fixed: '#341100'
  on-tertiary-fixed-variant: '#783100'
  background: '#f7f9fb'
  on-background: '#191c1e'
  surface-variant: '#e0e3e5'
typography:
  headline-lg:
    fontFamily: Inter
    fontSize: 30px
    fontWeight: '700'
    lineHeight: 38px
    letterSpacing: -0.02em
  headline-lg-mobile:
    fontFamily: Inter
    fontSize: 24px
    fontWeight: '700'
    lineHeight: 32px
  headline-md:
    fontFamily: Inter
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-md:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.05em
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  unit: 4px
  container-padding: 24px
  gutter: 16px
  stack-sm: 8px
  stack-md: 16px
  stack-lg: 32px
---

## Brand & Style

This design system is built for the high-stakes environment of enterprise event management. The brand personality is rooted in **reliability, efficiency, and clarity**. It prioritizes function over form, ensuring that event coordinators can navigate complex data sets and high-volume logistics without cognitive fatigue.

The design style is **Modern Professionalism**—a refined take on minimalism that utilizes a flat aesthetic with purposeful depth. The interface stays out of the way, using ample whitespace and a systematic information hierarchy to surface critical actions. The emotional response is one of calm control and institutional trust.

## Colors

The palette is anchored by **Trustworthy Blue**, a primary color that signals action and professional authority. 

- **Primary:** Used for main actions, active states, and focus indicators.
- **Surface & Backgrounds:** A range of ultra-light grays (`#F8FAFC` to `#F1F5F9`) distinguishes different UI containers without the harshness of pure white.
- **Typography:** High-contrast Dark Gray (`#1E293B`) is used for primary text to ensure maximum readability and WCAG AAA compliance.
- **Semantic Colors:** Green (Success) and Red (Danger) are reserved strictly for status badges and destructive actions like event cancellations or rejections.

## Typography

The design system utilizes **Inter** across all levels. Inter's tall x-height and exceptional legibility make it ideal for data-heavy enterprise dashboards.

- **Headlines:** Use tighter letter spacing and semi-bold/bold weights to create a strong visual anchor.
- **Body Text:** Standardized at 14px for density and 16px for long-form reading.
- **Labels:** Small, uppercase, and slightly tracked-out to distinguish metadata from content.
- **Mobile scaling:** Headlines scale down to prevent awkward line breaks in narrow containers, while body text remains constant to preserve legibility.

## Layout & Spacing

This design system follows a **Fixed-Fluid Hybrid Grid**. 
- **Desktop:** 12-column grid with a maximum content width of 1440px. Gutters are fixed at 16px.
- **Tablet:** 8-column grid with 16px margins.
- **Mobile:** 4-column grid with 16px margins.

Spacing follows a strict 4px base unit. Component internal padding should favor the "stack" variables to maintain vertical rhythm. Use larger padding (32px+) for section separation to provide visual breathing room in complex views.

## Elevation & Depth

Visual hierarchy is established through **Tonal Layering** supplemented by **Ambient Shadows**.

1. **Base Layer:** The lowest level (`#F8FAFC`), used for the main application background.
2. **Surface Layer:** White (`#FFFFFF`) cards and panels. These use a 1px border (`#E2E8F0`) and a very soft, diffused shadow (0px 1px 3px rgba(0,0,0,0.05)) to suggest they are lifted.
3. **Overlay Layer:** Modals and dropdowns use a more pronounced shadow (0px 10px 15px -3px rgba(0,0,0,0.1)) to indicate temporary interaction priority.

Avoid heavy blacks or colorful glows; shadows should feel natural and light-dependent.

## Shapes

The design system uses a **Soft (0.25rem)** roundedness logic. This provides a professional "tech" feel that is more approachable than sharp corners but more serious than highly rounded pill shapes.

- **Default (4px):** Buttons, Input Fields, Checkboxes.
- **Large (8px):** Event Cards, Modals, Container sections.
- **Pill:** Reserved exclusively for **Status Badges** to distinguish them from interactive buttons.

## Components

### Buttons
- **Primary:** Solid `#1A73E8` with white text. High emphasis.
- **Secondary:** White background with `#E2E8F0` border and `#475569` text.
- **Ghost:** No border or background until hover; used for secondary navigation or utility actions.

### Input Fields
- **State:** 1px border (`#CBD5E1`). On focus, the border changes to primary blue with a 2px soft outer glow.
- **Labels:** Always positioned above the field in `label-md` style.

### Status Badges (Chips)
- **Pending:** Light amber background with dark amber text.
- **Approved:** Light green background with dark green text.
- **Waitlisted:** Light gray background with dark gray text.
- **Shape:** Always pill-shaped to avoid confusion with buttons.

### Event Cards
- Minimalist white surface with 1px border. 
- Headers use `headline-md`. 
- Footers are separated by a subtle 1px horizontal rule to house primary actions like "View Details" or "Edit."

### Lists & Tables
- Enterprise views should use "Zebra-striping" (alternating light gray rows) only in very dense tables. 
- Row hover states are mandatory for row-level interactions.