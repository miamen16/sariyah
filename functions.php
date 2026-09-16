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

function sariyah_setup(): void {
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style.css' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'wp-block-styles' );
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
 * Register all Sariyah blocks from their block.json metadata.
 *
 * ACF 6+ integrates with block.json directly, so do not gate registration
 * behind the legacy acf_register_block_type() function.
 */
function sariyah_register_blocks(): void {
    $blocks = array(
        'hero',
        'event-intro',
        'event-stats',
        'features',
        'speakers',
        'schedule',
        'pricing',
        'gallery',
        'testimonials',
        'sponsors',
        'contact',
    );

    foreach ( $blocks as $block ) {
        $block_json = get_theme_file_path( 'blocks/' . $block . '/block.json' );

        if ( ! file_exists( $block_json ) ) {
            continue;
        }

        register_block_type( $block_json );
    }
}
add_action( 'init', 'sariyah_register_blocks' );

function sariyah_enqueue_block_assets(): void {
    $blocks = array(
        'hero', 'event-intro', 'event-stats', 'features', 'speakers', 'schedule',
        'pricing', 'gallery', 'testimonials', 'sponsors', 'contact',
    );

    foreach ( $blocks as $block ) {
        $file = get_theme_file_path( 'blocks/' . $block . '/style.css' );
        if ( file_exists( $file ) ) {
            wp_enqueue_style(
                'sariyah-' . $block,
                get_theme_file_uri( 'blocks/' . $block . '/style.css' ),
                array(),
                (string) filemtime( $file )
            );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'sariyah_enqueue_block_assets' );
add_action( 'enqueue_block_editor_assets', 'sariyah_enqueue_block_assets' );

function sariyah_acf_admin_notice(): void {
    if ( function_exists( 'get_field' ) || ! current_user_can( 'activate_plugins' ) ) {
        return;
    }

    echo '<div class="notice notice-warning"><p><strong>Sariyah:</strong> Advanced Custom Fields (ACF) is required to edit the custom Sariyah event blocks. Please install and activate ACF 6+.</p></div>';
}
add_action( 'admin_notices', 'sariyah_acf_admin_notice' );
