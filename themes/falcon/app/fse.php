<?php
/**
 * Full Site Editing (FSE) support for Sage theme.
 *
 * This file adds comprehensive FSE functionality while maintaining Sage structure.
 *
 * @package Sage
 */

namespace App;

// Add theme support for Full Site Editing features.
add_action(
	'after_setup_theme',
	function () {
		// Selective FSE support - keep Blade templates while enhancing block editor.
		
		// Enable block templates only for specific post types (not overriding main templates).
		add_theme_support( 'block-templates' );
		
		// Enable template parts for optional FSE components.
		add_theme_support( 'block-template-parts' );
		
		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add support for wide and full width blocks.
		add_theme_support( 'align-wide' );

		// Add support for custom line height.
		add_theme_support( 'custom-line-height' );

		// Add support for custom units.
		add_theme_support( 'custom-units' );

		// Add support for custom spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for link color control.
		add_theme_support( 'link-color' );

		// Add support for border controls.
		add_theme_support( 'border' );

		// Add support for appearance tools.
		add_theme_support( 'appearance-tools' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for dark editor style.
		add_theme_support( 'dark-editor-style' );
	}
);

// Enqueue block editor styles.
add_action(
	'enqueue_block_editor_assets',
	function () {
		// Simply skip editor styles enqueue since it's optional for FSE.
		// The theme.json will handle most of the styling needs.
	}
);

// Add custom block patterns.
add_action(
	'init',
	function () {
		register_block_pattern(
			'sage/hero-section',
			array(
				'title'       => __( 'Hero Section', 'sage' ),
				'description' => _x( 'A large hero section with title and description', 'Block pattern description', 'sage' ),
				'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"8rem","bottom":"8rem"}}},"backgroundColor":"primary","textColor":"white"} -->
<div class="wp-block-group alignfull has-white-color has-primary-background-color has-text-color has-background" style="padding-top:8rem;padding-bottom:8rem"><!-- wp:heading {"textAlign":"center","level":1,"fontSize":"xx-large"} -->
<h1 class="wp-block-heading has-text-align-center has-xx-large-font-size">Welcome to Your Site</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","fontSize":"large"} -->
<p class="has-text-align-center has-large-font-size">This is a beautiful hero section that showcases your content in style.</p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->',
				'categories'  => array( 'header' ),
			)
		);

		register_block_pattern(
			'sage/call-to-action',
			array(
				'title'       => __( 'Call to Action', 'sage' ),
				'description' => _x( 'A call to action section with button', 'Block pattern description', 'sage' ),
				'content'     => '<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"4rem","bottom":"4rem"}}},"backgroundColor":"secondary"} -->
<div class="wp-block-group alignfull has-secondary-background-color has-background" style="padding-top:4rem;padding-bottom:4rem"><!-- wp:heading {"textAlign":"center","level":2} -->
<h2 class="wp-block-heading has-text-align-center">Ready to Get Started?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Join thousands of satisfied customers today.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons"><!-- wp:button {"backgroundColor":"primary","textColor":"white"} -->
<div class="wp-block-button"><a class="wp-block-button__link has-white-color has-primary-background-color has-text-color has-background wp-element-button">Get Started</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->',
				'categories'  => array( 'call-to-action' ),
			)
		);
	}
);

// Add block pattern categories.
add_action(
	'init',
	function () {
		register_block_pattern_category(
			'sage-layouts',
			array( 'label' => __( 'Sage Layouts', 'sage' ) )
		);

		register_block_pattern_category(
			'sage-content',
			array( 'label' => __( 'Sage Content', 'sage' ) )
		);
	}
);

// Customize block editor settings.
add_filter(
	'block_editor_settings_all',
	function ( $settings ) {
		// Add custom color palette.
		$settings['colors'] = array(
			array(
				'name'  => __( 'Primary', 'sage' ),
				'slug'  => 'primary',
				'color' => '#007cba',
			),
			array(
				'name'  => __( 'Secondary', 'sage' ),
				'slug'  => 'secondary',
				'color' => '#6c757d',
			),
			array(
				'name'  => __( 'Success', 'sage' ),
				'slug'  => 'success',
				'color' => '#28a745',
			),
			array(
				'name'  => __( 'Danger', 'sage' ),
				'slug'  => 'danger',
				'color' => '#dc3545',
			),
			array(
				'name'  => __( 'Warning', 'sage' ),
				'slug'  => 'warning',
				'color' => '#ffc107',
			),
			array(
				'name'  => __( 'Info', 'sage' ),
				'slug'  => 'info',
				'color' => '#17a2b8',
			),
			array(
				'name'  => __( 'Light', 'sage' ),
				'slug'  => 'light',
				'color' => '#f8f9fa',
			),
			array(
				'name'  => __( 'Dark', 'sage' ),
				'slug'  => 'dark',
				'color' => '#343a40',
			),
		);

		// Add custom font sizes.
		$settings['fontSizes'] = array(
			array(
				'name' => __( 'Small', 'sage' ),
				'slug' => 'small',
				'size' => '0.875rem',
			),
			array(
				'name' => __( 'Normal', 'sage' ),
				'slug' => 'normal',
				'size' => '1rem',
			),
			array(
				'name' => __( 'Medium', 'sage' ),
				'slug' => 'medium',
				'size' => '1.25rem',
			),
			array(
				'name' => __( 'Large', 'sage' ),
				'slug' => 'large',
				'size' => '1.5rem',
			),
			array(
				'name' => __( 'Extra Large', 'sage' ),
				'slug' => 'x-large',
				'size' => '2rem',
			),
			array(
				'name' => __( 'Huge', 'sage' ),
				'slug' => 'xx-large',
				'size' => '3rem',
			),
		);

		return $settings;
	}
);

// Add custom block styles.
add_action(
	'init',
	function () {
		// Register custom block style for buttons.
		register_block_style(
			'core/button',
			array(
				'name'  => 'outline',
				'label' => __( 'Outline', 'sage' ),
			)
		);

		// Register custom block style for groups.
		register_block_style(
			'core/group',
			array(
				'name'  => 'rounded',
				'label' => __( 'Rounded', 'sage' ),
			)
		);

		// Register custom block style for images.
		register_block_style(
			'core/image',
			array(
				'name'  => 'rounded',
				'label' => __( 'Rounded', 'sage' ),
			)
		);
	}
);

// Modify theme.json programmatically.
add_filter(
	'wp_theme_json_data_theme',
	function ( $theme_json ) {
		$new_data = array(
			'version'  => 2,
			'settings' => array(
				'layout'     => array(
					'contentSize' => '1200px',
					'wideSize'    => '1400px',
				),
				'spacing'    => array(
					'blockGap'            => '1.5rem',
					'margin'              => true,
					'padding'             => true,
					'customSpacingSize'   => true,
					'spacingScale'        => array(
						'operator'   => '*',
						'increment'  => 1.5,
						'steps'      => 7,
						'mediumStep' => 1.5,
						'unit'       => 'rem',
					),
					'spacingSizes'        => array(
						array(
							'size' => '0.5rem',
							'slug' => '30',
							'name' => 'Small',
						),
						array(
							'size' => '1rem',
							'slug' => '40',
							'name' => 'Medium',
						),
						array(
							'size' => '1.5rem',
							'slug' => '50',
							'name' => 'Large',
						),
						array(
							'size' => '2rem',
							'slug' => '60',
							'name' => 'Extra Large',
						),
					),
				),
				'typography' => array(
					'customFontSize'  => true,
					'lineHeight'      => true,
					'dropCap'         => false,
					'fontStyle'       => true,
					'fontWeight'      => true,
					'letterSpacing'   => true,
					'textDecoration'  => true,
					'textTransform'   => true,
				),
				'color'      => array(
					'custom'         => true,
					'customGradient' => true,
					'link'           => true,
				),
				'border'     => array(
					'color'  => true,
					'radius' => true,
					'style'  => true,
					'width'  => true,
				),
			),
			'styles'   => array(
				'spacing'    => array(
					'blockGap' => '1.5rem',
				),
				'typography' => array(
					'fontFamily' => 'var(--wp--preset--font-family--system)',
					'fontSize'   => '1rem',
					'lineHeight' => '1.6',
				),
				'elements'   => array(
					'link'    => array(
						'color' => array(
							'text' => 'var(--wp--preset--color--primary)',
						),
					),
					'heading' => array(
						'typography' => array(
							'fontWeight' => '600',
							'lineHeight' => '1.2',
						),
					),
				),
				'blocks'     => array(
					'core/button' => array(
						'border'  => array(
							'radius' => '0.375rem',
						),
						'spacing' => array(
							'padding' => array(
								'top'    => '0.75rem',
								'right'  => '1.5rem',
								'bottom' => '0.75rem',
								'left'   => '1.5rem',
							),
						),
					),
					'core/group'  => array(
						'spacing' => array(
							'margin' => array(
								'top'    => '0',
								'bottom' => '0',
							),
						),
					),
				),
			),
		);

		return $theme_json->update_with( $new_data );
	}
);

// Add custom CSS classes to blocks.
add_filter(
	'render_block',
	function ( $block_content, $block ) {
		// Add custom classes based on block type.
		if ( 'core/group' === $block['blockName'] ) {
			$block_content = str_replace( 'class="wp-block-group', 'class="wp-block-group sage-group', $block_content );
		}

		if ( 'core/button' === $block['blockName'] ) {
			$block_content = str_replace( 'class="wp-block-button', 'class="wp-block-button sage-button', $block_content );
		}

		return $block_content;
	},
	10,
	2
);

// Control which templates use FSE vs Blade.
add_filter(
	'get_block_templates',
	function ( $query_result, $query ) {
		// Allow FSE only for specific templates, preserve Blade for main theme templates.
		$allowed_fse_templates = array(
			'single-product',     // WooCommerce product pages.
			'archive-product',    // WooCommerce shop pages.
			'page-landing',       // Custom landing pages.
			'404',                // 404 pages.
		);

		if ( isset( $query['slug'] ) && ! in_array( $query['slug'], $allowed_fse_templates, true ) ) {
			// Remove from FSE handling for main templates (index, single, page, etc.).
			$filtered_result = array();
			foreach ( $query_result as $template ) {
				if ( ! in_array( $template->slug, array( 'index', 'single', 'page', 'archive', 'home', 'front-page' ), true ) ) {
					$filtered_result[] = $template;
				}
			}
			return $filtered_result;
		}

		return $query_result;
	},
	10,
	2
);

// Add template part areas for hybrid approach.
add_filter(
	'default_wp_template_part_areas',
	function ( $areas ) {
		$areas[] = array(
			'area'        => 'hero',
			'area_tag'    => 'section',
			'label'       => __( 'Hero Section', 'sage' ),
			'description' => __( 'Hero sections for landing pages', 'sage' ),
			'icon'        => 'cover-image',
		);

		$areas[] = array(
			'area'        => 'call-to-action',
			'area_tag'    => 'section',
			'label'       => __( 'Call to Action', 'sage' ),
			'description' => __( 'Call to action sections', 'sage' ),
			'icon'        => 'megaphone',
		);

		$areas[] = array(
			'area'        => 'content-area',
			'area_tag'    => 'div',
			'label'       => __( 'Content Area', 'sage' ),
			'description' => __( 'Flexible content areas', 'sage' ),
			'icon'        => 'layout',
		);

		return $areas;
	}
);

// Helper function to render FSE template parts in Blade templates.
if ( ! function_exists( 'render_fse_part' ) ) {
	/**
	 * Render an FSE template part within Blade templates.
	 *
	 * @param string $slug The template part slug.
	 * @param string $area The template part area (optional).
	 * @return void
	 */
	function render_fse_part( $slug, $area = null ) {
		if ( function_exists( 'block_template_part' ) ) {
			block_template_part( $slug, $area );
		}
	}
}
