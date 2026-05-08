# Implementation Guide: Family Tree Modernization

This guide details the technical and design implementation of the updated Family Tree landing page.

## 1. Design System

### Typography
- **Headings:** `Fraunces` (Serif) – Used for an editorial, high-end feel.
- **Body:** `Instrument Sans` (Sans-Serif) – Used for clarity and modern legibility.
- **Scaling:** Uses `clamp()` functions to ensure titles automatically shrink on mobile without manual media query overrides for every element.

### Color Palette
- **Primary:** `--yellow` (#f0c132) - Energy and urgency.
- **Backgrounds:** 
  - `--black` (#0a0a0a) for hero/program sections.
  - `--stone` (#e8e4dc) for operational sections.
  - `--warm-white` (#f5f2ec) for story/content.

## 2. Technical Architecture

### CSS Organization
The CSS is structured as follows:
- **Root Variables:** Global tokens for colors and spacing.
- **Base Styles:** Resets and global typography.
- **Component Styles:** Modular sections (Hero, Partners, Stats, etc.).
- **Animations:** Custom `@keyframes` for reveal effects and the marquee.

### JavaScript Modules
- **Reveal Engine:** Uses `IntersectionObserver` to trigger `.reveal` animations as the user scrolls.
- **Transformation Slider:** 
  - Data-driven approach using `tsData` array.
  - Real-time DOM updates for weather, image, and description.
- **Particle System:** Lightweight canvas/div-based floating particles in the hero section.

## 3. Advanced Features

### Infinity Marquee
Implemented via a duplicated logo container and a `translateX(-50%)` animation. This ensures a seamless loop without a visible reset point.

### Clean URLs
Managed by `.htaccess`. The rules allow `yourdomain.com/about` to load `about.html` without showing the extension in the address bar.

## 4. Deployment Checklist
1. **Hosting:** Ensure Apache is used if clean URLs are required.
2. **Assets:** Verify all images in `img/` and `Icons/` are compressed for web.
3. **Analytics:** Add tracking scripts to the `<head>` of `index.html`.
