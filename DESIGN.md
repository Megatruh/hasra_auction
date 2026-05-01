# Hasra Auction — Old Money Design System

Version: 1.0

This document defines the visual direction and UI rules for **Hasra Auction** using the **Old Money** aesthetic: understated luxury, calm confidence, editorial layouts, premium materials, and timeless typography.

---

## 1) Design North Star

### Keywords
Quiet luxury • Heritage • Tailored • Editorial • Warm minimal • Museum-grade whitespace

### What we avoid
Neon colors • Heavy gradients • Overly playful visuals • Excessive shadows • Loud animations

### User feeling
“This auction platform is trustworthy, curated, and premium.”

---

## 2) Brand Personality & Voice

### Tone
- Polite, concise, and assured
- Focus on clarity: price, status, and next action

### Microcopy style
- Use Indonesian, formal-friendly.
- Prefer short labels: **“Tawar Sekarang”**, **“Harga Saat Ini”**, **“Grade”**, **“Dimulai”**, **“Selesai”**.
- Error messages: helpful, not blaming.
	- Example: “Nominal harus lebih tinggi dari harga saat ini.”

---

## 3) Layout System

### Container
- Page max width: `max-w-7xl`
- Content centering: `mx-auto`
- Page padding: `px-4 sm:px-6 lg:px-8`

### Grid
- Product/detail page: `grid grid-cols-1 lg:grid-cols-3 gap-8`
	- Left: images + details (`lg:col-span-2`)
	- Right: sticky bidding card (`sticky top-8`)

### Spacing
- Section rhythm: 24–32px (`space-y-6`, `space-y-8`)
- Cards: padding 16–24px (`p-4`, `p-6`)
- Use whitespace as the “luxury” cue.

---

## 4) Color Palette (Old Money)

Use muted, warm neutrals with a single refined accent.

### Core neutrals
- **Background**: warm off-white
	- Tailwind: `bg-gray-50` or custom off-white (#FAF7F2)
- **Surface**: paper white
	- `bg-white`
- **Text Primary**: near-black
	- `text-gray-900`
- **Text Secondary**: muted gray
	- `text-gray-600` / `text-gray-500`
- **Borders**: soft, low-contrast
	- `border-gray-200`

### Accent (primary action)
- **Indigo/Navy** (quiet, authoritative)
	- `bg-indigo-600 hover:bg-indigo-700` (primary button)
	- Links: `text-indigo-600 hover:text-indigo-700`

### Status colors
- Active: green (restrained)
	- `bg-green-100 text-green-800 border-green-300`
- Pending: warm amber
	- `bg-yellow-100 text-yellow-800 border-yellow-300`
- Closed: neutral gray
	- `bg-gray-100 text-gray-800 border-gray-300`

### Grade badge colors
- Grade A: green
- Grade B: amber/yellow
- Others: burnt orange
	- `bg-orange-100 text-orange-800 border-orange-300`

---

## 5) Typography

Old Money UI works best with a **serif headline + clean sans body**.

### Recommended pairing
- Headlines: Serif (e.g., "Playfair Display", "Cormorant Garamond", "Source Serif")
- Body/UI: Sans (e.g., "Inter", "Instrument Sans")

### Tailwind guidance (if not adding new fonts)
- Headings: `font-semibold` / `font-bold` + slightly tighter tracking
	- `tracking-tight`
- Body: `text-gray-700` with `leading-relaxed`

### Type scale
- H1: `text-3xl lg:text-4xl font-bold`
- H2: `text-xl font-bold`
- Body: `text-sm` to `text-base`
- Micro: `text-xs text-gray-500`

---

## 6) Surfaces, Borders, Shadows

Old Money = subtle depth.

- Cards: `bg-white rounded-lg shadow-sm`
- Hover lift: `hover:shadow-md transition`
- Avoid deep shadows or glow.
- Borders are preferred over shadows when possible: `border border-gray-200`.

---

## 7) Imagery Direction

### Photography
- Natural light, clean garage/studio, muted contrast.
- Avoid oversaturated filters.
- Highlight materials: leather, stitching, trim.

### Image layout (auction detail)
- 3-image grid:
	- 1 large image left
	- 2 stacked images right
- Always: `object-cover`, `rounded-lg`, `overflow-hidden`.

### Fallbacks
- If image missing, show a neutral placeholder with minimal label.

---

## 8) Components

### 8.1 Buttons

**Primary (CTA)**
- Use for: “Tawar Sekarang”, “Buat Lelang”, “Simpan”
- Tailwind:
	- `bg-indigo-600 hover:bg-indigo-700 text-white font-semibold`
	- `rounded-lg px-4 py-3 shadow-sm hover:shadow-md transition`

**Secondary**
- Use for: “Kembali”, “Batal”
- Tailwind:
	- `border border-gray-300 text-gray-900 hover:bg-gray-50`

**Disabled**
- `opacity-60 cursor-not-allowed` and remove hover effects.

### 8.2 Inputs
- `border border-gray-300 rounded-lg px-4 py-3`
- Focus ring: `focus:ring-2 focus:ring-indigo-500 focus:border-transparent`
- Error state: `border-red-500` + helper text `text-red-600 text-xs`

### 8.3 Badges (Grade/Status)
- Use `border-2` and soft fills.
- Keep text short.

### 8.4 Alerts (Flash messages)

**Success**
- `bg-green-50 border border-green-200 text-green-900`

**Error**
- `bg-red-50 border border-red-200 text-red-900`

Rule: alerts should be readable, not huge; include an icon.

### 8.5 Cards
- `bg-white rounded-lg p-6 shadow-sm`
- Use `space-y-4` inside cards.

---

## 9) Auction Detail Page (Reference Spec)

### Information hierarchy
1. Car title: `Merk Model (Tahun)`
2. Grade badge (A/B/other)
3. Price card:
	 - “Harga Saat Ini”
	 - Amount (large)
	 - Highest bidder name
4. Bid form
5. Description

### Price formatting
- Always display in Rupiah: `Rp 1.234.567`
- Use consistent separators.

### Bid form rule
- Minimum should be displayed under input.
- Error feedback near input.

---

## 10) Motion & Interactions

- Default transition: `transition` or `transition duration-200`
- Hover: small shadow lift, subtle scale on images (max 1–2%)
- Avoid continuous animations.

---

## 11) Icons

Icon style: outline/solid but consistent per screen.
- Prefer Heroicons.
- Size: 16–20px for UI, 24px for emphasis.

---

## 12) Accessibility

- Contrast: maintain readable contrast (especially on badges).
- Tap targets: minimum 44px height for main buttons.
- Focus states must be visible.
- Use semantic headings (H1 → H2) for screen readers.

---

## 13) Tailwind Utility Conventions

- Prefer composition via utilities for speed.
- Avoid “random” colors; stick to palette above.
- Standard rounding: `rounded-lg`.
- Standard shadows: `shadow-sm` default; `hover:shadow-md`.

---

## 14) Ready-to-use Tailwind Snippets

### Primary button
`bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg px-4 py-3 shadow-sm hover:shadow-md transition`

### Card
`bg-white rounded-lg p-6 shadow-sm`

### Badge (base)
`border-2 rounded-lg px-4 py-2 font-semibold`

### Muted helper text
`text-xs text-gray-500`

---

## 15) Future Enhancements (Optional)

- Introduce a serif heading font for stronger Old Money identity.
- Add a “Provenance” section (service history, ownership notes).
- Add a “Condition notes” layout: small, editorial bullet lists.

