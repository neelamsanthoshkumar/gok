# NetWorth Theme

A clean, SEO-friendly WordPress theme tailored for celebrity net worth sites.

## Installation

1. Copy the `networth-theme` folder into `wp-content/themes/`.
2. In WordPress Admin, go to Appearance → Themes and activate "NetWorth Theme".
3. Go to Settings → Permalinks and click "Save Changes" to flush rewrite rules (required for the Celebrity CPT).

## Features

- Custom Post Type: Celebrity (`celebrity`)
- Meta fields: Net Worth (USD), Profession, Birth Date, Nationality
- Archive and single templates for Celebrities
- Primary menu, sidebar widget area, custom logo, thumbnails

## Usage

- Create new Celebrity posts under Celebrities → Add New. Fill in the meta fields.
- Set a featured image for better presentation.
- Assign the Primary Menu under Appearance → Menus.
- Add widgets to the Primary Sidebar under Appearance → Widgets.

## Development

- Styles: `style.css`
- Scripts: `assets/js/theme.js`
- Templates:
  - `single-celebrity.php`, `archive-celebrity.php`
  - `template-parts/content-celebrity.php`
  - Core: `header.php`, `footer.php`, `index.php`, `single.php`, `page.php`, `search.php`, `404.php`, `sidebar.php`

## Requirements

- WordPress 6.0+
- PHP 7.4+