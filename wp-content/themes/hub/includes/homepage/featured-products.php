<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Featured Products Component
 *
 * Display the featured products
 *
 * @author Tiago
 * @since 1.2.0
 * @package WooFramework
 * @subpackage Component
 */

	$settings = array(
			'homepage_featured_products_title' => __( 'Staff Picks', 'woothemes' ),
			'homepage_featured_products_byline' => __( 'Featured Products', 'woothemes' ),
			'homepage_featured_products_number' => '5'
		);

	$settings = woo_get_dynamic_values( $settings );

?>

<section id="featured-products" class="home-section">

	<div class="wrapper">

		<?php if ( ( '' != $settings['homepage_featured_products_title'] ) || ( '' != $settings['homepage_featured_products_byline'] ) ): ?>
		<header class="section-title">
			<?php if ( '' != $settings['homepage_featured_products_byline'] ): ?><span class="heading"><?php echo stripslashes( esc_html( $settings['homepage_featured_products_byline'] ) ); ?></span><?php endif; ?>
			<?php if ( '' != $settings['homepage_featured_products_title'] ): ?><h1><?php echo stripslashes( esc_html( $settings['homepage_featured_products_title'] ) ); ?></h1><?php endif; ?>
		</header>
		<?php endif; ?>

	</div><!-- /.wrapper -->

	<?php
		echo do_shortcode( '[featured_products per_page="' . esc_attr( $settings['homepage_featured_products_number'] ) . '" columns="5"]' );
	?>

</section><!-- /#featured-products -->