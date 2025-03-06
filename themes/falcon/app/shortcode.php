<?php
/*
 * Theme shortcodes.
 */
namespace App;

use WP_Query;

// shortcode




/**
 * Shortcode method to get cusotm field data
 *
 * @param [type] $atts attributes for shortcode.
 * @return HTML
 */
function wpdocs_bartag_func( $atts ) {

	$atts  = shortcode_atts(
		array(
			'key' => '',
		),
		$atts,
		'custom_field_data'
	);
	$query = new \WP_Query(
		array(
			'post_type'      => 'post',
			'posts_per_page' => 1,
			'orderby'        => 'rand',
		)
	);

	// $custom_field_key = $atts['key'] ? $atts['key'] : '';
	ob_start();
	// $meta_value = get_post_meta( get_the_ID(), $custom_field_key );
	// echo esc_html( $meta_value[0] );
	?>
	<h2>Hello shortcode</h2>
	<?php
	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			?>
			<h2><?php the_title(); ?></h2>
			<?php
		}
	}

	return ob_get_clean();
}

add_shortcode( 'custom_field_data', __NAMESPACE__ . '\wpdocs_bartag_func' );