<?php

/*
  Plugin Name: Convert Number in Tibetan
  Plugin URI: https://github.com/amep-lotus/Convert-Number-in-Tibetan
  Description: This plugin will help you to display date in Tibetan date format and language.
  Tags: date,translator,translate,tibetan date format, tibetan
  Version: 1.0
  Author: Pema Zomkyi   
  Author URI: http://www.tibinfotech.com/
  License: GPLv2 or later
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */


require_once('inc/admin.php'); //Admin Panel

require_once('inc/display.php'); //Displaying the date


//On deactivate, set the date format back to default date format

register_deactivation_hook(__FILE__, 'tbdateformat_deactivate');

function tbdateformat_deactivate() {
    update_option('date_format', 'm/d/Y');
}

//adding setting links next to deactivate link

function tbdateformat_action_links( $links ) {
	$links = array_merge($links, array(
		'<a href="' . esc_url( admin_url( '/options-general.php?page=translate-to-tb' ) ) . '">' . __( 'Settings', 'textdomain' ) . '</a>'
	));
	return $links;
}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'tbdateformat_action_links' );
