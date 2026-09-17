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

/**
 * Load Sariyah block styles explicitly.
 *
 * Block metadata still declares each style file, but explicit loading keeps
 * custom ACF/server-rendered blocks styled reliably across frontend, template
 * rendering and the block editor.
 */
function sariyah_enqueue_block_styles(): void {
    $block_styles = glob( get_theme_file_path( 'blocks/*/style.css' ) );

    if ( false === $block_styles ) {
        return;
    }

    foreach ( $block_styles as $style_file ) {
        $block_directory = dirname( $style_file );
        $block_slug      = basename( $block_directory );
        $handle          = 'sariyah-block-' . sanitize_key( $block_slug );
        $relative_path   = 'blocks/' . $block_slug . '/style.css';
        $version         = file_exists( $style_file ) ? (string) filemtime( $style_file ) : null;

        wp_enqueue_style(
            $handle,
            get_theme_file_uri( $relative_path ),
            array(),
            $version
        );
    }
}
add_action( 'wp_enqueue_scripts', 'sariyah_enqueue_block_styles', 20 );
add_action( 'enqueue_block_editor_assets', 'sariyah_enqueue_block_styles', 20 );

function sariyah_acf_admin_notice(): void {
    if ( function_exists( 'acf' ) || ! current_user_can( 'activate_plugins' ) ) {
        return;
    }

    echo '<div class="notice notice-warning"><p><strong>Sariyah:</strong> ACF PRO 6+ is required for the custom Sariyah blocks.</p></div>';
}
add_action( 'admin_notices', 'sariyah_acf_admin_notice' );
