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

	/*function wbcr_mac_rating_widget_url($page_url, $plugin_name)
	{
		if( $plugin_name == WMAC_Plugin::app()->getPluginName() ) {
			return 'https://goo.gl/v4QkW5';
		}

		return $page_url;
	}

	add_filter('wbcr_factory_pages_000_imppage_rating_widget_url', 'wbcr_mac_rating_widget_url', 10, 2);

	function wbcr_mac_group_options($options)
	{
		$options[] = array(
			'name' => 'disable_comments',
			'title' => __('Disable comments on the entire site', 'minify-and-combine'),
			'tags' => array('disable_all_comments'),
			'values' => array('disable_all_comments' => 'disable_comments')
		);
		$options[] = array(
			'name' => 'disable_comments_for_post_types',
			'title' => __('Select post types', 'minify-and-combine'),
			'tags' => array()
		);
		$options[] = array(
			'name' => 'comment_text_convert_links_pseudo',
			'title' => __('Replace external links in comments on the JavaScript code', 'minify-and-combine'),
			'tags' => array('recommended', 'seo_optimize')
		);
		$options[] = array(
			'name' => 'pseudo_comment_author_link',
			'title' => __('Replace external links from comment authors on the JavaScript code', 'minify-and-combine'),
			'tags' => array('recommended', 'seo_optimize')
		);
		$options[] = array(
			'name' => 'remove_x_pingback',
			'title' => __('Disable X-Pingback', 'minify-and-combine'),
			'tags' => array('recommended', 'defence', 'disable_all_comments')
		);
		$options[] = array(
			'name' => 'remove_url_from_comment_form',
			'title' => __('Remove field "site" in comment form', 'minify-and-combine'),
			'tags' => array()
		);

		return $options;
	}

	add_filter("wbcr_clearfy_group_options", 'wbcr_mac_group_options');

	function wbcr_mac_allow_quick_mods($mods)
	{
		$mods['disable_all_comments'] = array(
			'title' => __('One click disable all comments', 'minify-and-combine'),
			'icon' => 'dashicons-testimonial'
		);
		
		return $mods;
	}

	add_filter("wbcr_clearfy_allow_quick_mods", 'wbcr_mac_allow_quick_mods');

	function wbcr_mac_set_plugin_meta($links, $file)
	{
		if( $file == WMAC_PLUGIN_BASE ) {

			$url = 'https://clearfy.pro';

			if( get_locale() == 'ru_RU' ) {
				$url = 'https://ru.clearfy.pro';
			}

			$url .= '?utm_source=wordpress.org&utm_campaign=' . WMAC_Plugin::app()->getPluginName();

			$links[] = '<a href="' . $url . '" style="color: #FF5722;font-weight: bold;" target="_blank">' . __('Get ultimate plugin free', 'minify-and-combine') . '</a>';
		}

		return $links;
	}

	if( !defined('LOADING_HTML_MINIFY_AS_ADDON') ) {
		add_filter('plugin_row_meta', 'wbcr_mac_set_plugin_meta', 10, 2);
	}*/



