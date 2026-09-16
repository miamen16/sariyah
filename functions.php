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
}
add_action( 'after_setup_theme', 'sariyah_setup' );

function sariyah_register_acf_blocks(): void {
    if ( ! function_exists( 'acf_register_block_type' ) ) {
        return;
    }

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
        if ( file_exists( $block_json ) ) {
            register_block_type( $block_json );
        }
    }
}
add_action( 'init', 'sariyah_register_acf_blocks' );
