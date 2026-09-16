# Sariyah WordPress Theme

Custom block-based WordPress theme for the Sariyah event website.

## Stack

- WordPress block theme / Full Site Editing
- Gutenberg
- Advanced Custom Fields (ACF)
- ACF JSON field groups
- Server-rendered custom blocks
- `theme.json` design system

## Custom blocks

- Hero
- Event Introduction
- Event Stats
- Why Attend / Features
- Speakers
- Schedule
- Pricing
- Gallery
- Testimonials
- Sponsors / Partners
- Contact

## Requirements

- WordPress 6.5+
- PHP 7.4+
- Advanced Custom Fields with the field types used by the theme (ACF Pro is recommended for repeater and gallery fields)

## Editing the homepage

The homepage is assembled from the `sariyah/homepage` block pattern and rendered through `templates/front-page.html`.

Each Sariyah section is an ACF-powered Gutenberg block, so structured event content can be edited directly in the block editor.

## Development notes

Custom blocks are registered from their `block.json` metadata files. ACF JSON field groups are stored in `acf-json/` for version control and synchronization.
