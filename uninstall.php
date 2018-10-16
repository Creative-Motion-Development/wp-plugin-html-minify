<?php

	// if uninstall.php is not called by WordPress, die
	if( !defined('WP_UNINSTALL_PLUGIN') ) {
		die;
	}

	// remove plugin options
	global $wpdb;

	if( !function_exists('is_plugin_active_for_network') ) {
		require_once(ABSPATH . 'wp-admin/includes/plugin.php');
	}

	if( is_multisite() && is_plugin_active_for_network(plugin_basename(dirname(__FILE__) . '/html-minify.php')) ) {
		$wpdb->query("DELETE FROM {$wpdb->sitemeta} WHERE meta_key LIKE 'wbcr_htm_%';");
	} else {
		$wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE 'wbcr_htm_%';");
	}




