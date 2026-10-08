# Homepage Developer Guide — dmvlearnerspermittest.com
**Date:** Oct 7, 2026 · @Humaiz Ahmed

---

## Overview
The homepage design is final (Hero A) and lives in Figma as editable layers with color variables, text styles and components. Build from Figma; use this guide for behaviour, rules and what is still a placeholder.

| Item | Link / location |
| :--- | :--- |
| **Figma file** | DMV Learners Permit Test — Homepage (Final) |
| **Desktop page** | Frame: `Homepage · Desktop 1440` · Status: Final |
| **Final Hero A** | (page: Homepage — Desktop) |
| **Components** | Components (right of the Claude Design canvas (sections 02-09 have mobile boards)) |
| **Mobile designs (390 px)** | Frame: `Hero visual · REPLACE with custom image (TBD)` |
| **Hero right visual** | Final Hero + header mobile still to come |
| **How It Works video** | Placeholder Frame Layer: `Video slot · 1280x800…` |
| **Features background photo** | Placeholder: `bg/road · REPLACE with road photo…` |
| **Testimonials Section 06** | Placeholder: Phase 2 — hidden at launch |

> All copy in the design is English and final for layout, but marked text in `[square brackets]` must be replaced with real content before launch.

---

## Design Tokens

Use only these values; they exist in Figma as the **Brand** and **Spacing** variable collections and as text styles.

### Colors
**Contrast rules:**
- Never white text on teal;
- Teal text only on charcoal;
- Orange buttons use white text at 16 px bold or larger.

| Token | Hex | Use |
| :--- | :--- | :--- |
| `charcoal` | `#2B2D42` | Primary: dark sections, headings, secondary buttons |
| `charcoal2` | `#383A52` | Cards and chips on dark backgrounds |
| `charcoal3` | `#4A4C66` | Placeholder bars, dashed borders on dark |
| `line` | `#3D3F57` | Divider lines on dark |
| `teal` | `#00B4A6` | Accents, icons, map, highlights on dark only |
| `tealDark` | `#00796F` | Teal text on light backgrounds (eyebrows, stamps) |
| `orange` | `#F26419` | Primary CTA buttons, stars, logo "Test" — nothing else |
| `white` | `#FFFFFF` | Light sections, cards |
| `grey50` | `#F4F5F7` | Light grey sections, chips |
| `grey200` | `#E6E7EB` | Card borders |
| `grey300` | `#DCDDE3` | Input / chip borders |
| `muted` | `#55576D` | Body text on light |
| `light` | `#C9CAD3` | Body text on dark |

### Typography — Plus Jakarta Sans
*(Google Fonts, 400/500/600/700/800)*

| Style | Size / Line Height | Weight |
| :--- | :--- | :--- |
| **Display/H1** | 60 / 112%, letter-spacing -2% | Bold 700 |
| **Heading/H2** | 46 / 115%, letter-spacing -2% | ExtraBold 800 |
| **Heading/H3** | 20 / 130% | Bold 700 |
| **Body/Large** | 18 / 160% | Regular 400 |
| **Body/Default** | 16 / 160% | Regular 400 |
| **Body/Small** | 14 / 150% | Regular 400 |
| **Label/Eyebrow** | 13 / 120%, +12%, uppercase | Bold 700 |
| **Label/Button** | 19 / 100% | ExtraBold 800 |
| **Label/UI** | 15 / 120% | SemiBold 600 |
| **Logo wordmark** | 21, letter-spacing -2% | ExtraBold 800 |

*Mobile:* H1 36 px, H2 30 px, body 15–16 px.

### Spacing, Radius, Effects
- **Content max-width:** 1200 px (testimonials 1240 px)
- **Section side padding:** 120 px desktop, 20 px mobile
- **Section vertical padding:** 96–112 px desktop, 56–64 px mobile
- **Spacing scale:** 8, 12, 16, 24, 32, 56, 64, 96
- **Radius:**
  - Buttons: 12–14 px
  - Cards: 18–22 px
  - Sections/bands: 24 px
  - Pills: 999 px
- **Shadow (cards on dark):** `0 16px 32px rgba(20, 21, 33, 0.25)`
- **Gradients:** No gradients except the testimonials fade.
- **Touch targets:** At least 44 × 44 px.

---

## Buttons (Figma Components)

| Component | Look | Where |
| :--- | :--- | :--- |
| **Button/Primary** | Orange fill, white label, arrow | Hero, map "Continue", Features (max 3 per page) |
| **Button/Secondary** | Charcoal fill, white label, arrow | How It Works "Get Started" |
| **Button/Outline** | Grey50 fill, 2 px charcoal border | Bottom CTA |

**Hover States:**
- Primary: `#D9561A`
- Outline: turns charcoal with white text
- Secondary: `#383A52`

---

## Sections and Behaviour
**Section order is locked:**
Header → Hero → State Selector → Features → How It Works → YouTube → Testimonials → FAQ → CTA → Footer.

| # | Section (id) | Background | Key behaviour |
| :--- | :--- | :--- | :--- |
| **01** | **Header** | Charcoal | Logo left (one-line). Right: state dropdown + Car / Motorcycle / Truck toggle. No nav links. |
| **02** | **Hero** `#hero` | Charcoal | "Choose Your State" smoothscrolls to `#state-selector`. Right visual = image slot. |
| **03** | **State Selector** `#state-selector` | Grey50 | Interactive US map + region chips + dropdown + "Continue". |
| **04** | **Features** `#features` | Charcoal + road photo | 2×2 cards; "Start Practicing Free" → `#state-selector`. |
| **05** | **How It Works** `#how-it-works` | White | 3 steps synced with a looping video. "Get Started" → `#state-selector`. |
| **06** | **YouTube banner** `#youtube-banner` | White + charcoal band | "Subscribe on YouTube" opens channel in a new tab. |
| **07** | **Testimonials** `#testimonials` | White | Phase 2, behind a feature flag. Masonry + fade + View more. |
| **08** | **FAQ** `#faq` | White | Accordion, 5 questions, one open at a time. |
| **09** | **CTA** `#cta-band` | Grey50 | Help link + outline button → `#state-selector`. |
| **10** | **Footer** `#site-footer` | Charcoal | Nav columns, full DMV disclaimer, legal links. |

---

## Detailed Section Specifications

### 01. Header
- **State dropdown:** Native `<select>` (50 states, show only the 40 covered once the list is final).
- **Vehicle toggle:** Radio group (`role="radiogroup"`), selected tile `charcoal2` with teal icon.
- **State Storage:** Save state + vehicle in `localStorage`.
- **Navigation:** On content pages, changing them navigates to the matching page (e.g. `/texas/car-practice-test`); on the homepage it only saves.
- **Mobile (< 768 px):** Hide the wordmark (icon only) and collapse the picker into a chip `"CA · Car ⌄"` that opens a sheet.

### 02. State Selector Map
- **Map structure:** Inline SVG, one `<path>` per state with `tabindex="0"`, `role="link"`, `aria-label="[State Name]"`.
- **Region shades:**
  - West: teal at 22%
  - Midwest: teal at 36%
  - South: teal at 50%
  - Northeast: teal at 66%
- **Hover / focus:** State fill 100% teal + white tooltip with the state name only (no counts, no live users).
- **Click / Enter:** Go to the state hub page `/[state]`.
- **Region chip hover/click:** That region at 75%, others at 10%.
- **Not-covered states:** Fill `#E6E7EB`, no hover, no click, no tooltip.
- **Validation:** "Continue" without a selection shows *"Please choose a state first."*

### 03. Features
- **Card component:** Card/Feature (icon tile 64 px, H3 title, 15 px description).
- **Behavior:** Cards are static; optional hover lift −4 px / 200 ms.

### 04. How It Works
- **Video:** `<video autoplay muted loop playsinline preload="metadata" poster="…">` with WebM + MP4. Load only when in viewport.
- **Chapters:**
  - 0–5 s: Step 01
  - 5–10 s: Step 02
  - 10 s+: Step 03
- **Active step:** State=Active (`grey50` fill, 2 px teal border, teal number).
- **Seeking:** Clicking a step seeks the video to that chapter.
- **Controls:** A visible pause button is required (autoplay over 5 s).
- `prefers-reduced-motion`: No autoplay, show the poster.

### 06. Testimonials (Phase 2)
- **Desktop:** 4 columns, distribute reviews round-robin; grid max-height: 760px; `overflow: hidden` + white fade + "View more" pill.
- **Card fields:** Name, initials avatar (no faces), rating, review text. No date. Real reviews only; the rating badge must state its source.
- **Responsive columns:** 4 → 3 (≤1200) → 2 (≤900) → 1 (≤600).

### 07. FAQ
- **Markup:** Each question = `<h3><button aria-expanded aria-controls>` ; answer `role="region"`.
- **Behavior:** Answers stay in the HTML (hidden with CSS) for SEO.
- **Schema:** Add `FAQPage` JSON-LD with the same five Q&As.

### 09. Footer
- **Columns:** Practice, Popular states (only covered states), Company, Legal.
- **Disclaimer:** The disclaimer box text is mandatory and must not be shortened.

---

## Responsive Rules
Build mobile-first: most traffic comes from YouTube on phones. Designed at 1440 desktop and 390 mobile.

| Breakpoint | Rules |
| :--- | :--- |
| **≥ 1200 px** | Layout as in Figma, content max-width 1200 px |
| **900–1199 px** | Hero visual stacks under the copy below 900; testimonials 3 → 2 columns |
| **600–899 px** | Features grid 1 column; How It Works video above the steps; FAQ help card under the accordion |
| **< 600 px** | Side padding 20 px; buttons full width; footer links in a 2-column grid; testimonials 1 column |

- **Hero:** On mobile, headline 36 px, CTA full width, visual below the copy (or hidden if the final image does not crop well).
- **Map:** Keep the map, but on mobile show the dropdown "Or pick from the list" prominently — small states (RI, DE, CT) are hard to tap.
- **Header:** Icon-only logo + compact state/vehicle chip under 768 px.
- **Zero Horizontal Scroll:** Nothing scrolls horizontally at 390 px.

---

## Assets and Placeholders

| Asset | Size / format | Status |
| :--- | :--- | :--- |
| **Logo icon + one-line wordmark** | SVG (wordmark outlined), header 40 px icon | Ready in Figma (`logo/icon`) |
| **Feature icons ×4** | SVG, 64 and 128 px, 24-grid, 2 px stroke | Ready (`icon/practice-test`, `icon/mock-test`, `icon/cheat-sheet`, `icon/states`) |
| **UI icons** | SVG, currentColor (arrow, check, chevron, car, motorcycle, truck, play, mail, external) | Ready in Figma |
| **US map** | Inline SVG, 975 × 610 viewBox, one path per state | Ready (`map/us-states`); prefer full-detail us-atlas paths in code |
| **Favicon** | 32 × 32 and 16 × 16 PNG + SVG; apple-touch-icon 180 × 180 | Logo icon on charcoal tile — export from logo |
| **Hero right image** | ~1000 × 960 WebP (2x), square/portrait crop for mobile | To come |
| **How It Works video** | 1280 × 800, MP4 + WebM, 10–20 s, muted loop, < 3 MB + poster WebP | To come |
| **Features background** | ~1920 × 1080 WebP road photo, no people, charcoal overlay 55–70% | To come |
| **OG image** | 1200 × 630 | To come |

---

## Accessibility, SEO and Trust Rules (Launch Blockers)

### Trust / Legal
- Show *"Not affiliated with any state DMV"* in the State Selector and the full disclaimer in the footer on every page.
- **No invented numbers:** No user counts, pass rates, "live" activity or fake reviews. The map has no counts.
- State-specific rules in content must be checked against the official state handbook.
- Hero trust line reads **"Free to start"** (paid tier coming), not "Free to use".

### Accessibility (WCAG AA)
- Real `<button>` and `<a>` elements; visible focus ring 2 px teal.
- Icon-only controls have `aria-label`; decorative SVGs `aria-hidden="true"`.
- Map states keyboard reachable (`Tab`, `Enter`). Tooltip also shows on focus.
- Video has a pause button; respect `prefers-reduced-motion`.
- Check text contrast with the color rules in Design tokens.

### SEO
- One `<h1>` (hero headline); each section title is `<h2>`.
- `FAQPage` JSON-LD for the FAQ; `Organization` schema with the logo.
- Footer "Popular states" link to `/[state]` hub pages (internal linking).
- Lazy-load the video and below-the-fold images; WebP images with width/height set.

### Analytics Events

| Event | Trigger |
| :--- | :--- |
| `hero_cta_click` | Hero "Choose Your State" |
| `map_state_click` | State clicked on the map (with state) |
| `state_continue_click` | Dropdown + Continue |
| `header_vehicle_change` | Vehicle toggle in header |
| `youtube_subscribe_click` | YouTube banner button |
| `faq_open` | FAQ item opened (with question) |
| `cta_bottom_click` | Bottom CTA button |

---

## Routes and Site Flow

5 page types, tests only in the dashboard. The homepage sends users to the state hub; content pages pass state and vehicle to the dashboard (`/dashboard?state=california&vehicle=car`).

| Route | Purpose | Index |
| :--- | :--- | :--- |
| `/` | Homepage | Yes |
| `/[state]` | State hub, choose vehicle (40 pages) | Yes |
| `/[state]/[vehicle]-practice-test` | Content + CTA to dashboard (120 pages) | Yes |
| `/[state]/[vehicle]-cheatsheet` | Cheat sheet + PDF download (120 pages) | Yes |
| `/dashboard/…` | Practice, mock tests, results | No (noindex) |
| `/pricing`, `/login`, `/signup` | Account and plans | Pricing yes, others no |

---

## Handoff Checklist
- [x] **Fonts:** Plus Jakarta Sans 400–800 with `font-display: swap`
- [x] **Colors and text styles:** Match the Figma variables exactly
- [x] **Header picker:** Saves state + vehicle in `localStorage` and routes correctly
- [x] **Map:** Hover name only, click to `/[state]`, non-covered states disabled
- [x] **Video slot:** Pause button and reduced-motion fallback
- [x] **FAQ accordion:** Single-open + `FAQPage` schema
- [x] **Testimonials:** Behind `show_testimonials` flag (off at launch)
- [x] **DMV disclaimer:** In State Selector and footer
- [x] **All [bracketed] placeholder text:** Replaced or hidden
- [x] **Mobile checked:** 390 px and 320 px with zero horizontal scroll
- [x] **Analytics events:** Wired
