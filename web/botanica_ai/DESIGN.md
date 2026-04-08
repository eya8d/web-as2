# Design System Document: The Botanical Atelier

## 1. Overview & Creative North Star
**Creative North Star: "The Living Herbarium"**

This design system moves away from the sterile, rigid grids of traditional medical or AI software. Instead, it treats the interface as a curated collection of botanical specimens. We aim for a "High-End Editorial" feel that balances the precision of AI with the softness of nature.

The system breaks the "template" look by using intentional white space, generous radius scales, and an asymmetric layout logic where content feels like it is resting on a bed of soft moss. We prioritize **breathing room** and **tonal depth** over structural lines, ensuring the experience feels as calming as a greenhouse.

---

### 2. Colors: Tonal Atmosphere
The palette is rooted in a regenerative green spectrum. We avoid harsh contrasts, opting instead for a "low-stress" visual environment.

*   **The "No-Line" Rule:** Explicitly prohibit 1px solid borders for sectioning or containment. Boundaries must be defined solely through background color shifts. For example, a card (`surface-container-lowest`) should sit on a background (`surface`) without a stroke.
*   **Surface Hierarchy & Nesting:** Use the surface tiers to create physical layers.
    *   **Base Layer:** `surface` (#f4fbf4) for the main background.
    *   **Secondary Layer:** `surface-container-low` (#ecf6ed) for grouped sections.
    *   **Interactive Layer:** `surface-container-highest` (#d6e6db) for primary cards.
*   **The Glass & Gradient Rule:** For floating elements or top-level navigation, use Glassmorphism. Implement a `surface-container-lowest` color at 80% opacity with a `20px` backdrop-blur. 
*   **Signature Textures:** Main CTAs should not be flat. Use a subtle linear gradient from `primary` (#3b6944) to `primary-dim` (#2f5d38) at a 135-degree angle to provide "soul" and depth.

---

### 3. Typography: Editorial Authority
The typography uses a clean, sans-serif Arabic pairing to ensure high readability while maintaining a premium feel.

*   **Display & Headlines (Plus Jakarta Sans):** Used for large headers and plant titles. The wide apertures and modern geometry feel authoritative yet approachable. 
*   **Body & Titles (Be Vietnam Pro):** Used for all diagnostic descriptions and Arabic body text. The balanced x-height ensures clarity in technical AI explanations.
*   **The Scale:**
    *   **Display-LG (3.5rem):** For hero diagnostic scores.
    *   **Headline-SM (1.5rem):** For section titles (e.g., "Quick Tips").
    *   **Body-MD (0.875rem):** For secondary descriptions and treatment advice.
    *   **Label-MD (0.75rem):** For metadata like timestamps or botanical classifications.

---

### 4. Elevation & Depth: Tonal Layering
Depth is achieved through "Tonal Stacking" rather than drop shadows.

*   **The Layering Principle:** Place a `surface-container-lowest` card on a `surface-container-low` section to create a soft, natural lift. This mimics the way leaves overlap in nature.
*   **Ambient Shadows:** If a "floating" action button is required, shadows must be extra-diffused. 
    *   *Spec:* `offset: 0, 8px; blur: 24px; color: rgba(40, 53, 46, 0.06);`
*   **The Ghost Border:** If a border is required for accessibility, use `outline-variant` (#a6b6ab) at 15% opacity. Never use 100% opaque borders.
*   **Glassmorphism:** Use for the Bottom Navigation bar. It should feel like a pane of frosted glass hovering over the content, allowing the "greenery" of the scrollable content to bleed through slightly.

---

### 5. Components: Botanical Primitives

*   **Cards (The Rounded Leaf):** Use `xl` (1.5rem) or `lg` (1.0rem) corner radius. Forbid the use of divider lines. Separate card content using vertical white space and font weight shifts.
*   **Buttons:**
    *   **Primary:** Gradient-filled (`primary` to `primary-dim`), `full` (9999px) rounded corners.
    *   **Secondary:** `surface-container-highest` background with `on-primary-container` text.
*   **Toggle Switches:** The "active" track should use `primary` (#3b6944). The "inactive" track should be a soft `surface-variant`. The thumb must always be `surface-container-lowest` (pure white/cream) to ensure a tactile feel.
*   **Bottom Navigation:**
    *   **Active State:** Use a pill-shaped "Active Indicator" behind the icon using `primary-container`.
    *   **Inactive State:** `on-surface-variant` icons with no background.
*   **Input Fields:** Use a "soft-box" style. `surface-container-low` background, no border, with a `sm` radius. Upon focus, transition the background to `surface-container-high`.
*   **Diagnostic Chips:** Use for plant health status (e.g., "Healthy," "Needs Water"). Use `secondary-container` for positive states and `error-container` for alerts.

---

### 6. Do’s and Don’ts

**Do:**
*   **Do** use asymmetric margins (e.g., 24px left, 16px right) on certain editorial headers to break the "app-like" feel.
*   **Do** use high-quality imagery of plants that fill the width of the cards.
*   **Do** use `title-lg` for Arabic headlines to accommodate the visual weight of the script.

**Don’t:**
*   **Don’t** use pure black (#000000) for text. Use `on-surface` (#28352e) to keep the contrast natural.
*   **Don’t** use standard "drop shadows" with high opacity. They create a "dirty" look on light green surfaces.
*   **Don’t** use hard 90-degree corners. Everything in this system must feel organic and "grown."
*   **Don’t** use dividers or lines to separate list items. Use the Spacing Scale (16px or 24px) to create breathing room.