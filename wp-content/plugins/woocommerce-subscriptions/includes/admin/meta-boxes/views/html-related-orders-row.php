<?php
/**
 * Display a row in the related orders table for a subscription or order
 *
 * @var array $order A WC_Order or WC_Subscription order object to display
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<tr>
	<td style="border-top: 0;">
		<a href="<?php echo esc_url( get_edit_post_link( $order->id ) ); ?>">
			<?php echo sprintf( esc_html_x( '#%s', 'hash before order number', 'woocommerce-subscriptions' ), esc_html( $order->get_order_number() ) ); ?>
		</a>
	</td>
	<td style="border-top: 0;">
		<?php echo esc_html( $order->relationship ); ?>
	</td>
	<td style="border-top: 0;">
		<?php

		$timestamp_gmt = strtotime( $order->post->post_date_gmt );

		if ( $timestamp_gmt > 0 ) {

			// translators: php date format
			$t_time    = get_the_time( _x( 'Y/m/d g:i:s A', 'post date', 'woocommerce-subscriptions' ), $post );
			$time_diff = $timestamp_gmt - current_time( 'timestamp', true );

			if ( $time_diff > 0 && $time_diff < WEEK_IN_SECONDS ) {
				// translators: placeholder is human time difference (e.g. "3 weeks")
				$date_to_display = sprintf( _x( 'In %s', 'used in "Related Orders" as the date when the related order happened in relation to now. Date is in the future.', 'woocommerce-subscriptions' ), human_time_diff( current_time( 'timestamp', true ), $timestamp_gmt ) );
			} elseif ( $time_diff < 0 && absint( $time_diff ) < WEEK_IN_SECONDS ) {
				// translators: placeholder is human time difference (e.g. "3 weeks")
				$date_to_display = sprintf( _x( '%s ago', 'used in "Related Orders" as the date when the related order happened in relation to now. Date is in the past.', 'woocommerce-subscriptions' ), human_time_diff( current_time( 'timestamp', true ), $timestamp_gmt ) );
			} else {
				$timestamp_site  = strtotime( get_date_from_gmt( date( 'Y-m-d H:i:s', $timestamp_gmt ) ) );
				$date_to_display = date_i18n( wc_date_format(), $timestamp_site ) . ' ' . date_i18n( wc_time_format(), $timestamp_site );
			}
		} else {
			$t_time = $date_to_display = __( 'Unpublished', 'woocommerce-subscriptions' );
		} ?>
		<abbr title="<?php echo esc_attr( $t_time ); ?>">
			<?php echo esc_html( apply_filters( 'post_date_column_time', $date_to_display, $order->post ) ); ?>
		</abbr>
	</td>
	<td style="border-top: 0;">
		<?php echo esc_html( ucwords( $order->get_status() ) ); ?>
	</td>
	<td style="border-top: 0; text-align:right;">
		<span class="amount"><?php echo wp_kses( $order->get_formatted_order_total(), array( 'small' => array(), 'span' => array( 'class' => array() ) ) ); ?></span>
	</td>
</tr>
