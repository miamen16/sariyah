<?php
/**
 * Sariyah theme bootstrap.
 *
 * @package Sariyah
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once get_theme_file_path( 'inc/woocommerce.php' );

function sariyah_setup(): void {
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style.css' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
}
add_action( 'after_setup_theme', 'sariyah_setup' );

function sariyah_register_block_category( array $categories ): array {
    foreach ( $categories as $category ) {
        if ( isset( $category['slug'] ) && 'sariyah' === $category['slug'] ) {
            return $categories;
        }
    }

    array_unshift(
        $categories,
        array(
            'slug'  => 'sariyah',
            'title' => 'Sariyah',
        )
    );

    return $categories;
}
add_filter( 'block_categories_all', 'sariyah_register_block_category' );

/**
 * Register every block directory that contains a block.json file.
 *
 * This keeps block registration in sync automatically as new Sariyah blocks
 * are added to the theme.
 */
function sariyah_register_blocks(): void {
    $block_directories = glob( get_theme_file_path( 'blocks/*/block.json' ) );

    if ( false === $block_directories ) {
        return;
    }

    foreach ( $block_directories as $block_json ) {
        register_block_type( dirname( $block_json ) );
    }
}
add_action( 'init', 'sariyah_register_blocks' );

function sariyah_acf_admin_notice(): void {
    if ( function_exists( 'acf' ) || ! current_user_can( 'activate_plugins' ) ) {
        return;
    }

    echo '<div class="notice notice-warning"><p><strong>Sariyah:</strong> ACF PRO 6+ is required for the custom Sariyah blocks.</p></div>';
}
add_action( 'admin_notices', 'sariyah_acf_admin_notice' );
