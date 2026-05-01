# Hasra Auction — Old Money Design System (v2.0 - Tailwind 4)

Visual Identity: Quiet Luxury, Editorial, Museum-grade Whitespace.

---

## 1) Typography Strategy (Tailwind 4 @theme)
- **Primary (Headings):** 'Playfair Display' (Serif). Digunakan untuk merk mobil, judul halaman, dan angka harga.
- **Secondary (Body/UI):** 'Inter' (Sans). Digunakan untuk deskripsi, label form, dan navigasi.
- **Rules:** - Judul besar: `font-serif tracking-tight text-gray-950`
  - Body: `font-sans text-gray-700 leading-relaxed`

---

## 2) Color Palette (Muted & Timeless)
- **Base:** `#FAF8F5` (Off-white/Bone) sebagai `bg-page`.
- **Primary:** `indigo-600` (Modern accent) atau `slate-900` (Classic accent).
- **Surface:** `white` dengan `border-gray-200` (Bukan shadow tebal).

---

## 3) Component Rules

### Auth (Login & Register)
- Layout: Clean centered container.
- Card: Border 1px, shadow minimal. 
- Input: Fokus pada `ring-indigo-600` dengan border tipis.

### Auction Card (Dashboard)
- Image: Ratio 16:9, subtle hover scale.
- Typography: Merk (Serif), Harga (Bold Sans).
- CTA: Tombol solid indigo tanpa gradasi.

### Auction Detail (The Gallery View)
- Hero: Judul mobil sangat besar (4xl) dengan font Serif.
- Stats Grid: Informasi teknis (mesin, warna, grade) dalam kotak-kotak minimalis.
- Sticky Action: Kotak penawaran di sisi kanan yang tetap terlihat (sticky).

---

## 4) Tailwind 4 Implementation Note
- Gunakan `@theme` block di CSS untuk mendefinisikan font.
- Manfaatkan nilai spacing baru dan engine performa tinggi Tailwind 4.