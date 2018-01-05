<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/*---------------------------------------------------------------------------------*/
/* Subscribe widget */
/*---------------------------------------------------------------------------------*/
class Woo_Subscribe extends WP_Widget {
	var $defaults = array( 'title' => '', 'form' => '', 'social' => '', 'single' => '', 'page' => '' );

	function __construct() {
		$widget_ops = array( 'description' => 'Add a subscribe/connect widget.' );
		parent::__construct( false, __( 'Woo - Subscribe / Connect', 'woothemes' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		$instance = wp_parse_args( $instance, $this->defaults );
		extract( $instance, EXTR_SKIP );
		if ( !is_singular() || ($single != 'on' && is_single()) || ($page != 'on' && is_page()) ) {
		?>
			<?php echo $before_widget; ?>
			<?php woo_subscribe_connect('true', $title, $form, $social); ?>
			<?php echo $after_widget; ?>
		<?php
		}
	}

	function update($new_instance, $old_instance) {
		foreach( array_keys( $this->defaults ) as $setting ) {
			$new_instance[$setting] = sanitize_text_field( $new_instance[$setting] );
		}

		if ( '' == $new_instance['title'] ) {
			$new_instance['title'] = __('Subscribe', 'woothemes');
		}

		foreach ( array( 'form', 'social', 'single', 'page' ) as $checkbox ) {
			if ( 'on' != $new_instance[$checkbox] )
					$new_instance[$checkbox] = '';
		}

		return $new_instance;
	}

	function form($instance) {
		$instance = wp_parse_args( $instance, $this->defaults );
		extract( $instance, EXTR_SKIP );
?>
		<p><em>Setup this widget in your <a href="<?php echo admin_url( 'admin.php?page=woothemes' ); ?>">options panel</a> under <strong>Subscribe &amp; Connect</strong></em>.</p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title (optional):','woothemes'); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $title ); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('form'); ?>" name="<?php echo $this->get_field_name('form'); ?>" type="checkbox" <?php checked( $form, 'on' ); ?>> <?php _e('Disable Subscription Form', 'woothemes'); ?></input>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('social'); ?>" name="<?php echo $this->get_field_name('social'); ?>" type="checkbox" <?php checked( $social, 'on' ); ?>> <?php _e('Disable Social Icons', 'woothemes'); ?></input>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('single'); ?>" name="<?php echo $this->get_field_name('single'); ?>" type="checkbox" <?php checked( $single, 'on' ); ?>> <?php _e('Disable in Posts', 'woothemes'); ?></input>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('page'); ?>" name="<?php echo $this->get_field_name('page'); ?>" type="checkbox" <?php checked( $page, 'on' ); ?>> <?php _e('Disable in Pages', 'woothemes'); ?></input>
		</p>
<?php
	}
}

function register_woo_subscribe_widget() {
	register_widget( 'Woo_Subscribe' );
}
add_action( 'widgets_init', 'register_woo_subscribe_widget' );
