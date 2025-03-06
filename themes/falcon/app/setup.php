<?php

/**
 * Theme setup.
 */

namespace App;

use function Roots\bundle;

add_action( 'init', 'App\handleACFOptionPanel' );
function handleACFOptionPanel() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		// dump('ACF is active');

		acf_add_options_page(
			array(
				'page_title' => 'CGL General Settings',
				'menu_title' => 'CGL Settings',
				'menu_slug'  => 'cgl-general-settings',
				'capability' => 'edit_posts',
				'redirect'   => false,
			)
		);

	}
}


/**
 * Register the theme assets.
 *
 * @return void
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		bundle( 'app-scripts' )->enqueue(['handle' => 'app-scripts', 'in_footer' => true]);
		bundle( 'app-styles' )->enqueue([ 'handle' => 'app-styles' ]);
	},
	100
);

/**
 * Register the theme assets with the block editor.
 *
 * @return void
 */
add_action(
	'enqueue_block_editor_assets',
	function () {
		bundle( 'editor-scripts' )->enqueue();
		bundle( 'editor-styles' )->enqueue();
	},
	100
);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action(
	'after_setup_theme',
	function () {
		/**
		 * Disable full-site editing support.
		 *
		 * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
		 */
		remove_theme_support( 'block-templates' );

		/**
		 * Register the navigation menus.
		 *
		 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
		 */
		register_nav_menus(
			array(
				'primary_navigation'  => __( 'Primary Navigation', 'sage' ),
				'footer_navigation_1' => __( 'Footer Navigation 1', 'sage' ),
				'footer_navigation_2' => __( 'Footer Navigation 2', 'sage' ),
				'footer_navigation_3' => __( 'Footer Navigation 3', 'sage' ),
			)
		);

		/**
		 * Disable the default block patterns.
		 *
		 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
		 */
		remove_theme_support( 'core-block-patterns' );

		/**
		 * Enable plugins to manage the document title.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable post thumbnail support.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Enable responsive embed support.
		 *
		 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
		 */
		// add_theme_support('responsive-embeds');

		/**
		 * Enable HTML5 markup support.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
		 */
		add_theme_support(
			'html5',
			array(
				'caption',
				'comment-form',
				'comment-list',
				'gallery',
				'search-form',
				'script',
				'style',
			)
		);

		/**
		 * Enable selective refresh for widgets in customizer.
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );
		/**
		 * support appearance tools
		 */
		add_theme_support( 'appearance-tools' );
		add_theme_support( 'link-color' );
		add_theme_support( 'border' );
		add_theme_support( 'custom-spacing' );
		// add_theme_support( 'responsive-embeds' );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );

		add_editor_style( 'style-editor.css' );
		add_theme_support( 'custom-line-height' );
	},
	20
);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action(
	'widgets_init',
	function () {
		$config = array(
			'before_widget' => '<section class="widget %1$s %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		);

		register_sidebar(
			array(
				'name' => __( 'Primary', 'sage' ),
				'id'   => 'sidebar-primary',
			) + $config
		);

		register_sidebar(
			array(
				'name' => __( 'Footer', 'sage' ),
				'id'   => 'sidebar-footer',
			) + $config
		);
	}
);
