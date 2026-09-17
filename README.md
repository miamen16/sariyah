# Sariyah WordPress Theme

Custom block-based WordPress theme for a WooCommerce storefront, using Gutenberg blocks and ACF PRO for editorial controls.

## Stack

- WordPress block theme / Full Site Editing
- Gutenberg
- WooCommerce
- Advanced Custom Fields PRO
- ACF JSON field groups
- Server-rendered custom blocks
- `theme.json` design system

## WooCommerce blocks

### Product Card
Reusable dynamic product card powered directly by WooCommerce product data. Supports product image, sale badge, rating, price and purchase/view-product actions.

### Product Grid
Dynamic product grid with configurable source, product count, columns and optional product category filtering. Sources include latest, featured, best sellers and sale products.

### Product Categories
Dynamic `product_cat` grid using WooCommerce category names, links, counts and category thumbnails.

### Best Sellers
Dynamic grid ordered by WooCommerce product popularity.

### Latest Products
Dynamic grid ordered by product publication date.

## Existing content blocks

The repository also contains the original Sariyah content blocks, including Hero, Event Introduction, Event Stats, Features, Speakers, Schedule, Pricing, Gallery, Testimonials, Sponsors and Contact. They remain available for compatibility with existing content but are no longer used by the default shop homepage pattern.

## Requirements

- WordPress 6.6+
- PHP 7.4+
- WooCommerce
- Advanced Custom Fields PRO 6+

## Editing the homepage

The homepage is assembled from the `sariyah/homepage` block pattern and rendered through `templates/front-page.html`.

The default storefront flow is:

1. Hero
2. Trust Bar
3. Product Categories
4. Best Sellers
5. Promo Banner
6. Featured Products
7. Product Carousel
8. Sale Products
9. Latest Products
10. Newsletter
11. Latest News

Product and category data comes from WooCommerce rather than ACF repeaters. ACF PRO is used for block-level editorial settings such as headings, descriptions, item counts and columns.

## Development notes

Custom blocks are registered automatically from every `blocks/*/block.json` metadata file. ACF JSON field groups are stored in `acf-json/` for version control and synchronization.
