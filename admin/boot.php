<?php
	/**
	 * Admin boot
	 * @author Webcraftic <wordpress.webraftic@gmail.com>
	 * @copyright Webcraftic 25.05.2017
	 * @version 1.0
	 */

	// Exit if accessed directly
	if( !defined('ABSPATH') ) {
		exit;
	}

	function wbcr_htm_group_options($options)
	{
		$options[] = array(
			'name' => 'html_optimize',
			'title' => __('Optimize HTML Code?', 'html-minify'),
			'tags' => array('optimize_html', 'optimize_code', 'hide_my_wp'),
			'values' => array()
		);
		$options[] = array(
			'name' => 'html_keepcomments',
			'title' => __('Keep HTML comments?', 'html-minify'),
			'tags' => array(),
			'values' => array()
		);

		return $options;
	}

	add_filter("wbcr_clearfy_group_options", 'wbcr_htm_group_options');

	/**
	 * Adds a new mode to the Quick Setup page
	 *
	 * @param array $mods
	 * @return mixed
	 */
	function wbcr_htm_allow_quick_mods($mods)
	{
		if( !defined('WMAC_PLUGIN_ACTIVE') ) {
			$title = __('One click optimize html code', 'html-minify');
		} else {
			$title = __('One click optimize html code and scripts', 'html-minify');
		}

		$mod['optimize_code'] = array(
			'title' => $title,
			'icon' => 'dashicons-performance'
		);

		return $mod + $mods;
	}

	add_filter("wbcr_clearfy_allow_quick_mods", 'wbcr_htm_allow_quick_mods');


