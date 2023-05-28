<?php
/**
 * Plugin Name: HTML Мinify
 * Plugin URI: https://webcraftic.com
 * Description: Ever look at the HTML markup of your website and notice how sloppy and amateurish it looks? The HTML Мinify options cleans up sloppy looking markup and minifies, which also speeds up download.
 * Author: Webcraftic <wordpress.webraftic@gmail.com>
 * Version: 1.1.1
 * Text Domain: html-minify
 * Domain Path: /languages/
 * Author URI: https://webcraftic.com
 * Framework Version: FACTORY_000_VERSION
 */

/*
 * #### CREDITS ####
 * This plugin is based on the plugin Autoptimize by the author Frank Goossens, we have finalized this code for our project and our goals.
 * Many thanks to Frank Goossens for the quality solution for optimizing scripts in Wordpress.
 *
 * Public License is a GPLv2 compatible license allowing you to change and use this version of the plugin for free.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * -----------------------------------------------------------------------------
 * CHECK REQUIREMENTS
 * Check compatibility with php and wp version of the user's site. As well as checking
 * compatibility with other plugins from Webcraftic.
 * -----------------------------------------------------------------------------
 */

require_once( dirname( __FILE__ ) . '/libs/factory/core/includes/class-factory-requirements.php' );

// @formatter:off
$whtml_plugin_info = array(
	'prefix'         => 'wbcr_htm_', // префикс для базы данных и полей формы
	'plugin_name'    => 'wbcr_html_minify', // имя плагина, как уникальный идентификатор
	'plugin_title'   => __( 'Webcraftic HTML Minify', 'html-minify' ), // заголовок плагина

	// PLUGIN SUPPORT
	'support_details'      => array(
		'url'       => 'https://webcraftic.com',
		'pages_map' => array(
			'support'  => 'support',           // {site}/support
			'docs'     => 'docs'               // {site}/docs
		)
	),

	// PLUGIN ADVERTS
	'render_adverts' => true,
	'adverts_settings'    => array(
		'dashboard_widget' => true, // show dashboard widget (default: false)
		'right_sidebar'    => true, // show adverts sidebar (default: false)
		'notice'           => true, // show notice message (default: false)
	),

	// FRAMEWORK MODULES
	'load_factory_modules' => array(
		array( 'libs/factory/bootstrap', 'factory_bootstrap_000', 'admin' ),
		array( 'libs/factory/forms', 'factory_forms_000', 'admin' ),
		array( 'libs/factory/pages', 'factory_pages_000', 'admin' ),
		array( 'libs/factory/clearfy', 'factory_templates_000', 'all' ),
		array( 'libs/factory/adverts', 'factory_adverts_000', 'admin')
	)
);

$whtml_compatibility = new Wbcr_Factory000_Requirements( __FILE__, array_merge( $whtml_plugin_info, array(
	'plugin_already_activate'          => defined( 'WHTM_PLUGIN_ACTIVE' ),
	'required_php_version'             => '5.4',
	'required_wp_version'              => '4.2.0',
	'required_clearfy_check_component' => false
) ) );


/**
 * If the plugin is compatible, then it will continue its work, otherwise it will be stopped,
 * and the user will throw a warning.
 */
if ( ! $whtml_compatibility->check() ) {
	return;
}

/**
 * -----------------------------------------------------------------------------
 * CONSTANTS
 * Install frequently used constants and constants for debugging, which will be
 * removed after compiling the plugin.
 * -----------------------------------------------------------------------------
 */

// This plugin is activated
define( 'WHTM_PLUGIN_ACTIVE', true );
define( 'WHTM_PLUGIN_VERSION', $whtml_compatibility->get_plugin_version() );
define( 'WHTM_PLUGIN_DIR', dirname( __FILE__ ) );
define( 'WHTM_PLUGIN_BASE', plugin_basename( __FILE__ ) );
define( 'WHTM_PLUGIN_URL', plugins_url( '', __FILE__ ) );


#comp remove
// Эта часть кода для компилятора, не требует редактирования.
// Все отладочные константы будут удалены после компиляции плагина.

// Сборка плагина
// build: free, premium, ultimate
if ( ! defined( 'BUILD_TYPE' ) ) {
	define( 'BUILD_TYPE', 'free' );
}
// Языки уже не используются, нужно для работы компилятора
// language: en_US, ru_RU
if ( ! defined( 'LANG_TYPE' ) ) {
	define( 'LANG_TYPE', 'en_EN' );
}

// Тип лицензии
// license: free, paid
if ( ! defined( 'LICENSE_TYPE' ) ) {
	define( 'LICENSE_TYPE', 'free' );
}

// wordpress language
if ( ! defined( 'WPLANG' ) ) {
	define( 'WPLANG', LANG_TYPE );
}

/**
 * Включить режим отладки миграций с версии x.x.x до x.x.y. Если true и
 * установлена константа FACTORY_MIGRATIONS_FORCE_OLD_VERSION, ваш файл
 * миграции будет вызваться постоянно.
 */
if ( ! defined( 'FACTORY_MIGRATIONS_DEBUG' ) ) {
	define( 'FACTORY_MIGRATIONS_DEBUG', false );

	/**
	 * Так как, после первого выполнения миграции, плагин обновляет
	 * опцию plugin_version, чтобы миграция больше не выполнялась,
	 * в тестовом режиме миграций, старая версия плагина берется не
	 * из опции в базе данных, а из текущей константы.
	 *
	 * Новая версия плагина всегда берется из константы WHTM_PLUGIN_VERSION
	 * или из комментариев к входному файлу плагина.
	 */
	//define( 'FACTORY_MIGRATIONS_FORCE_OLD_VERSION', '1.1.9' );
}

/**
 * Включить режим отладки обновлений плагина и обновлений его премиум версии.
 * Если true, плагин не будет кешировать результаты проверки обновлений, а
 * будет проверять обновления через установленный интервал в константе
 * FACTORY_CHECK_UPDATES_INTERVAL.
 */
if ( ! defined( 'FACTORY_UPDATES_DEBUG' ) ) {
	define( 'FACTORY_UPDATES_DEBUG', false );

	// Через какой интервал времени проверять обновления на удаленном сервере?
	define( 'FACTORY_CHECK_UPDATES_INTERVAL', MINUTE_IN_SECONDS );
}

/**
 * Включить режим отладки для рекламного модуля. Если FACTORY_ADVERTS_DEBUG true,
 * то рекламный модуля не будет кешировать запросы к сереверу. Упрощает настройку
 * рекламы.
 */
if ( ! defined( 'FACTORY_ADVERTS_DEBUG' ) ) {
	define( 'FACTORY_ADVERTS_DEBUG', false );
}

/**
 * Остановить показ рекламы для всех плагинов созданных на Factory фреймворке.
 * Это может пригодиться в некоторых случаях, при неисправностях или из-за
 * файрвола в стране пользователя. Чтобы реклама не обременяла пользователя
 * он может ее заблокировать.
 */
if ( ! defined( 'FACTORY_ADVERTS_BLOCK' ) ) {
	define( 'FACTORY_ADVERTS_BLOCK', false );
}

// the compiler library provides a set of functions like onp_build and onp_license
// to check how the plugin work for diffrent builds on developer machines

require_once( WHTM_PLUGIN_DIR . '/libs/onepress/compiler/boot.php' );
// creating a plugin via the factory

// #fix compiller bug new Factory000_Plugin
#endcomp

/**
 * -----------------------------------------------------------------------------
 * PLUGIN INIT
 * -----------------------------------------------------------------------------
 */

require_once( WHTM_PLUGIN_DIR . '/libs/factory/core/boot.php' );
require_once( WHTM_PLUGIN_DIR . '/includes/class-plugin.php' );

try {
	new WHTM_Plugin( __FILE__, array_merge( $whtml_plugin_info, array(
		'plugin_version'     => WHTM_PLUGIN_VERSION,
		'plugin_text_domain' => $whtml_compatibility->get_text_domain(),
	) ) );
} catch( Exception $e ) {
	// Plugin wasn't initialized due to an error
	define( 'WHTM_PLUGIN_THROW_ERROR', true );

	$whtml_plugin_error_func = function () use ( $e ) {
		$error = sprintf( "The %s plugin has stopped. <b>Error:</b> %s Code: %s", 'Webcraftic Html minify', $e->getMessage(), $e->getCode() );
		echo '<div class="notice notice-error"><p>' . $error . '</p></div>';
	};

	add_action( 'admin_notices', $whtml_plugin_error_func );
	add_action( 'network_admin_notices', $whtml_plugin_error_func );
}
// @formatter:on