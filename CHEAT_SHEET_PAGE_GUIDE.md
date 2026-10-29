# Cheat Sheet Product Page Architecture & Implementation Guide

This document is the master engineering and design reference for implementing the single unified Cheat Sheet Product Page template across all states and vehicles in the **Drive** WordPress theme.

---

## 1. Route & Template Architecture

Every cheat sheet page uses a single unified WordPress template:

| Item | Value |
| :--- | :--- |
| **URL Pattern** | `/[state]/[vehicle]-cheat-sheet` (also handles optional trailing slash) |
| **Example URL** | `/california/car-cheat-sheet/`, `/texas/cdl-cheat-sheet/` |
| **Supported Vehicles** | `car` &middot; `motorcycle` &middot; `truck` (slug: `truck` or `cdl`; label: `Truck (CDL)`) |
| **Core Template File** | `templates/cheat-sheets/single-cheat-sheet.php` |
| **Sub-components Directory** | `template-parts/cheat-sheets/` |
| **CSS Component** | `assets/css/components/cheat-sheet-page.css` |
| **JS Component** | `assets/js/components/cheat-sheet-page.js` |
| **Header & Footer** | Reuses global `get_header()` (`site-header.php`) and `get_footer()` (`site-footer.php`) without modifications |

---

## 2. Dynamic State × Vehicle Fields

All copy, questions, badges, and cover assets dynamically adapt based on query context:

| Vehicle | Display Name | Question Count | Cover Graphic | Last "What's Inside" Tile | Other Cheat Sheets Displayed |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **`car`** | Car | 150 | `intersection-car.jpg` / `cover-thumb-car.jpg` | Demerit points explained | Motorcycle &middot; Truck (CDL) |
| **`motorcycle`** | Motorcycle | 150 | `intersection-motorcycle.jpg` / `cover-thumb-moto.jpg` | Demerit points explained | Car &middot; Truck (CDL) |
| **`truck` / `cdl`**| Truck (CDL) | 250 | `intersection-cdl.jpg` / `cover-thumb-truck.jpg` | CDL endorsements explained | Car &middot; Motorcycle |

### State-Level Injections:
- State name in hero H1, section headings, FAQ accordion, metadata, and breadcrumbs.
- Official state handbook download link in the **Compare** section.
- Official handbook edition `[Month YYYY]` in the **FAQ** section.

---

## 3. Ordered Sections & Semantic IDs

| # | Section | ID | Desktop Layout | Mobile Layout | Notes |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **1** | **Header** | `site-header` | Logo, State picker, Vehicle tabs | Compact mobile header | Reused from existing theme |
| **2** | **Hero** | `hero` | Left: Copy, price, CTA.<br>Right: Cover mockup + 2 sample pages | Stack: Title &rarr; Cover &rarr; Price &rarr; Full-width CTA | Hero design will be tailored next |
| **3** | **Trust Strip** | `trust` | 5 items horizontal row | 2-column grid | Money-back, PDF, instant access, etc. |
| **4** | **What's Inside** | `inside` | Bento grid: 4 cols, "150/250" tile spans 2&times;2 | Single-column stacked cards | Dynamic question count & vehicle specifics |
| **5** | **Take a Look Inside** | `look` | 3-page interactive carousel with side peeking (scale 0.86, center 1.18) | Mobile touch-swipe carousel with peeking | Prev/next arrows + pagination dots |
| **6** | **How It Works** | `how` | 960&times;540 video poster + 3 horizontal steps with progress line | 16:9 responsive video + vertical steps | Animated progress fill |
| **7** | **Cheat Sheet vs Handbook** | `compare` | Interactive toggle switch, comparison card | Full-width segmented toggle | Default: "Our cheat sheet" |
| **8** | **Pricing Card** | `pricing` | Split card: Dark "What you get" left + White price/checkout right | Stacked cards | Target anchor for all page CTAs |
| **9** | **Money-Back Guarantee** | `guarantee` | Charcoal background strip with 3 inline badge steps | Stacked steps in a dark rounded box | 100% money-back guarantee |
| **10** | **FAQ** | `faq` | Accessible accordion, 820px max-width, first item open | Full-width accordion | `aria-expanded`, + rotates 45&deg; |
| **11** | **Final CTA** | `final` | Full-width conversion banner with cover mockup + price button | Stacked compact final CTA | Scrolls to `#pricing` or links to checkout |
| **12** | **Other Cheat Sheets** | `other-sheets` | 2 cards side-by-side for the remaining two vehicles | Vertically stacked cards | Cross-sells the alternate 2 vehicles |
| **&mdash;** | **Sticky Buy Bar** | `.sticky-buy` | Hidden on desktop (`display: none`) | `position: sticky; bottom: 0;` | Price + "Buy Now" button above mobile footer |
| **13** | **Footer** | `site-footer` | Standard shared dark footer with DMV disclaimer | Standard mobile footer | Reused from existing theme |

---

## 4. Design Tokens, Colors & Typography

### Color Palette
- **Charcoal (`#2B2D42`)**: Primary text, dark backgrounds, header, footer.
- **Teal (`#00B4A6`)**: SVG icons, subtle highlights, active states on dark surfaces.
- **Accessible Teal (`#00796F`)**: Used for teal text on white/light backgrounds (WCAG AA).
- **Orange (`#F26419`)**: Primary CTA buttons, numbers (`150`/`250`), video play button.
- **Light Grey (`#F4F5F7`)**: Neutral section backgrounds and inactive surfaces.
- **Charcoal Tints (`#383A52`, `#4A4C66`)**: Elevated cards on dark backgrounds.
- **Muted Body Text (`#55576D`)**: High-legibility text on light sections.
- **Borders (`#E6E7EB`, `#DCDDE3`, `#C9CAD3`)**: Dividers and clean card outlines.

### Typography (Plus Jakarta Sans)
- **H1**: Desktop `56px / 1.08` (Weight 800, `-0.025em`) &middot; Mobile `34px / 1.12`
- **H2**: Desktop `40px / 1.18` (Weight 800, `-0.02em`) &middot; Mobile `28px / 1.2`
- **Body / Lead**: Desktop `18px / 1.6` (Weight 400) &middot; Mobile `16px / 1.6`
- **Eyebrow**: Desktop `13px` (Weight 700, Uppercase, `0.12em`) &middot; Mobile `12px`
- **Primary CTA**: Desktop `18px` (Weight 800, `56px` height, radius `14px`) &middot; Mobile `17px` (`52px` height, full-width)

---

## 5. Accessibility & Motion Rules
1. **WCAG AA Compliance**: All contrast ratios meet AA standards.
2. **Reduced Motion**: All animations wrapped in `@media (prefers-reduced-motion: reduce)` fallbacks.
3. **Keyboard & ARIA**:
   - FAQ buttons use `aria-expanded="true/false"`.
   - Compare switch buttons use `aria-pressed="true/false"`.
   - Modals and carousels support touch swipe and `Tab` navigation.

