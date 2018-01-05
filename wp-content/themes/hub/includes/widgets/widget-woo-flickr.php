<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/*---------------------------------------------------------------------------------*/
/* Flickr widget */
/*---------------------------------------------------------------------------------*/
class Woo_flickr extends WP_Widget {
	var $defaults = array( 'id' => '', 'number' => '', 'type' => 'user', 'sorting' => 'latest', 'size' => 's' );

	function __construct() {
		$widget_ops = array( 'description' => 'This Flickr widget populates photos from a Flickr ID.' );
		parent::__construct( false, __( 'Woo - Flickr', 'woothemes' ), $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args, EXTR_SKIP );
		$instance = wp_parse_args( $instance, $this->defaults );
		extract( $instance, EXTR_SKIP );

		echo $before_widget;
		echo $before_title; ?>
		<?php _e( 'Photos on <span>flick<span>r</span></span>', 'woothemes' ); ?>
        <?php echo $after_title; ?>
        <div class="wrap fix">
            <script type="text/javascript" src="<?php echo esc_url( 'https://www.flickr.com/badge_code_v2.gne?count=' . $number . '&amp;display=' . $sorting . '&amp;layout=x&amp;source=' . $type . '&amp;' . $type . '=' . $instance['id'] . '&amp;size=' . $size ); ?>"></script>
        </div><?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		foreach( array_keys( $this->defaults ) as $setting ) {
			$new_instance[$setting] = sanitize_text_field( $new_instance[$setting] );
		}

		if ( ! in_array( $new_instance['sorting'], array( 'random', 'latest' ) ) )
			$new_instance['sorting'] = $this->defaults['sorting'];

		if ( ! in_array( $new_instance['size'], array( 's', 'm', 't' ) ) )
			$new_instance['size'] = $this->defaults['size'];

		if ( ! in_array( $new_instance['type'], array( 'group', 'user' ) ) )
			$new_instance['type'] = $this->defaults['type'];

		return $new_instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( $instance, $this->defaults );
		extract( $instance, EXTR_SKIP );
?>
			<p>
				<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e( 'Flickr ID (<a href="http://www.idgettr.com">idGettr</a>):', 'woothemes' ); ?></label>
				<input type="text" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo esc_attr( $id ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'id' ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number:', 'woothemes' ); ?></label>
				<select name="<?php echo $this->get_field_name( 'number' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>">
				<?php for ( $i = 1; $i <= 10; $i += 1 ) { ?>
					<option value="<?php echo $i; ?>" <?php selected( $number, $i ); ?>><?php echo $i; ?></option>
				<?php } ?>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'type' ); ?>"><?php _e( 'Type:', 'woothemes' ); ?></label>
				<select name="<?php echo $this->get_field_name( 'type' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'type' ); ?>">
					<option value="user" <?php selected( $type, 'user' ); ?>><?php _e( 'User', 'woothemes' ); ?></option>
					<option value="group" <?php selected( $type, 'group' ); ?>><?php _e( 'Group', 'woothemes' ); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'sorting' ); ?>"><?php _e( 'Sorting:', 'woothemes' ); ?></label>
				<select name="<?php echo $this->get_field_name( 'sorting' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'sorting' ); ?>">
					<option value="latest" <?php selected( $sorting, 'latest' ); ?>><?php _e( 'Latest', 'woothemes' ); ?></option>
					<option value="random" <?php selected( $sorting, 'random' ); ?>><?php _e( 'Random', 'woothemes' ); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e( 'Size:', 'woothemes' ); ?></label>
				<select name="<?php echo $this->get_field_name( 'size' ); ?>" class="widefat" id="<?php echo $this->get_field_id( 'size' ); ?>">
					<option value="s" <?php selected( $size, 's' ); ?>><?php _e( 'Square', 'woothemes' ); ?></option>
					<option value="m" <?php selected( $size, 'm' ); ?>><?php _e( 'Medium', 'woothemes' ); ?></option>
					<option value="t" <?php selected( $size, 't' ); ?>><?php _e( 'Thumbnail', 'woothemes' ); ?></option>
				</select>
			</p>
		<?php
	}
}

function register_woo_flickr_widget() {
	register_widget( 'Woo_flickr' );
}
add_action( 'widgets_init', 'register_woo_flickr_widget' );
