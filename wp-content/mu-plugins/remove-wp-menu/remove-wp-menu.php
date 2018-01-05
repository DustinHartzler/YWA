<?php 
/*
Plugin Name: Remove Admin Bar WP Menu
Plugin URI: http://aaronjholbrook.com
Description: Remove the Admin Bar WP Menu/Icon
Version: 1.0
Author: Aaron Holbrook
Author URI: http://aaronjholbrook.com
License: GPLv2
Copyright 2013  Aaron Holbrook (email : aaron@a7web.com, twitter : @aaronjholbrook)
*/


add_action( 'add_admin_bar_menus', 'remove_wp_admin_bar_wp_menu', 1 );
/**
 * Remove WP Admin Bar WP Menu
 * 
 * @return null void
 */
function remove_wp_admin_bar_wp_menu() {
  remove_action( 'admin_bar_menu', 'wp_admin_bar_wp_menu', 10 );
}



