<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * Testimonials Component
 *
 * Display Testimonials. Requires "Testimonials" by WooThemes.
 *
 * @author Tiago
 * @since 1.0.0
 * @package WooFramework
 * @subpackage Component
 */

	$settings = array(
			'homepage_testimonials_title' => __( 'What others are saying', 'woothemes' ),
			'homepage_testimonials_byline' => __( 'Testimonials', 'woothemes' ),
			'homepage_testimonials_number' => '5',
			'homepage_testimonials_bg' => ''
		);

	$settings = woo_get_dynamic_values( $settings );

	// Enqueue JavaScript
	wp_enqueue_script( 'testimonials' );

?>

<section id="testimonials" class="home-section">

	<div id="testimonials-holder">

		<?php
			$bg_style = '';
			$bg_img = '';
			if ( '' != $settings['homepage_testimonials_bg'] ) {
				$bg_img = esc_url( $settings['homepage_testimonials_bg'] );
				$bg_img = ' style="background-image:url(' . $bg_img . ');"';
			}
		?>

		<div id="testimonials-bg" data-stellar-background-ratio="0.5"<?php echo $bg_img; ?>></div><!-- /#testimonials-bg -->

		<div class="wrapper">

			<?php if ( ( '' != $settings['homepage_testimonials_title'] ) || ( '' != $settings['homepage_testimonials_byline'] ) ): ?>
			<header class="section-title">
				<?php if ( '' != $settings['homepage_testimonials_byline'] ): ?><span class="heading"><?php echo stripslashes( esc_html( $settings['homepage_testimonials_byline'] ) ); ?></span><?php endif; ?>
				<?php if ( '' != $settings['homepage_testimonials_title'] ): ?><h1><?php echo stripslashes( esc_html( $settings['homepage_testimonials_title'] ) ); ?></h1><?php endif; ?>
			</header>
			<?php endif; ?>

			<?php

				$args = array(
					'limit' =>	intval( $settings['homepage_testimonials_number'] ),
					'size' 	=>	65
				);

				$testimonials = woothemes_get_testimonials( $args );

				if ( ! empty( $testimonials ) ) {

			?>

			<div class="slide-nav">
				<ul>
					<?php foreach ( $testimonials as $testimonial ) : ?>
						<li>
							<a href="#" class="avatar-link"><?php echo $testimonial->image; ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div><!-- /.slide-nav -->

			<div class="slides">
				<ul class="testimonials-list">
					<?php foreach ( $testimonials as $testimonial ) : ?>
						<li>
							<div class="testimonial">
								<?php echo apply_filters( 'woothemes_testimonials_content', apply_filters( 'the_content', $testimonial->post_content ), $testimonial ); ?>
								<cite class="author">
									<span class="title"><?php echo get_the_title( $testimonial ); ?></span>
									<?php if ( isset( $testimonial->byline ) && '' != $testimonial->byline ) : ?>
										<span class="byline"><?php echo $testimonial->byline; ?></span><!--/.byline-->
									<?php endif; ?>
									<?php if ( isset( $testimonial->url ) && '' != $testimonial->url ) : ?>
										<span class="url">
											<a href="<?php echo esc_url( $testimonial->url ); ?>"><?php echo apply_filters( 'woothemes_testimonials_author_link_text', esc_url( $testimonial->url ) ); ?></a>
										</span><!--/.url-->
									<?php endif; ?>
								</cite><!--/.author-->
							</div><!--/.testimonial-->
						</li>
					<?php endforeach; ?>
				</ul>
			</div><!-- /.slides -->

			<?php
				} else {
					echo do_shortcode( '[box type="alert"]' . __( 'Setup this section by adding <strong>Testimonials</strong> in <em>Testimonials > Add New</em>.', 'woothemes' ) . '[/box]' );
				}
			?>

		</div><!-- /.wrapper -->

	</div><!-- /.testimonials-holder -->

</section><!-- /#our-team -->