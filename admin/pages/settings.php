<?php
	
	/**
	 * The page Settings.
	 *
	 * @since 1.0.0
	 */
	
	// Exit if accessed directly
	if( !defined('ABSPATH') ) {
		exit;
	}
	
	class WHM_SettingsPage extends Wbcr_FactoryPages000_ImpressiveThemplate {
		
		/**
		 * The id of the page in the admin menu.
		 *
		 * Mainly used to navigate between pages.
		 * @see Wbcr_FactoryPages000_AdminPage
		 *
		 * @since 1.0.0
		 * @var string
		 */
		public $id = "html_minify"; // Уникальный идентификатор страницы
		public $page_menu_dashicon = 'dashicons-testimonial'; // Иконка для закладки страницы, дашикон
		//public $page_parent_page = "image_optimizer"; // Уникальный идентификатор родительской страницы

		/**
		 * @param Wbcr_Factory000_Plugin $plugin
		 */
		public function __construct(Wbcr_Factory000_Plugin $plugin)
		{
			// Заголовок страницы
			$this->menu_title = __('HTML Minify', 'html-minify');

			// Если плагин загружен, как самостоятельный, то мы меняем настройки страницы и делаем ее внешней,
			// а не внутренней страницей родительского плагина. Внешнии страницы добавляются в Wordpress меню "Общие"

			if( !defined('LOADING_HTML_MINIFY_AS_ADDON') ) {
				// true - внутреняя, false- внешняя страница
				$this->internal = false;
				// меню к которому, нужно прикрепить ссылку на страницу
				$this->menu_target = 'options-general.php';
				// Если true, добавляет ссылку "Настройки", рядом с действиями активации, деактивации плагина, на странице плагинов.
				$this->add_link_to_plugin_actions = true;
			}

			parent::__construct($plugin);
		}

		// Метод позволяет менять заголовок меню, в зависимости от сборки плагина.
		public function getMenuTitle()
		{
			return defined('LOADING_HTML_MINIFY_AS_ADDON')
				? __('HTML Minify', 'html-minify')
				: __('General', 'html-minify');
		}

		/**
		 * Подключаем скрипты и стили для страницы
		 *
		 * @see Wbcr_FactoryPages000_AdminPage
		 *
		 * @param $scripts
		 * @param $styles
         * 
		 * @since 1.0.0
		 * @return void
		 */
		public function assets($scripts, $styles)
		{
			parent::assets($scripts, $styles);

			// Способ подключения стилей
			$this->styles->add(WHM_PLUGIN_URL . '/admin/assets/css/general.css');

			// Способ подключения скриптов
			$this->scripts->add(WHM_PLUGIN_URL . '/admin/assets/js/general.js');
		}

		/**
		 * Регистрируем уведомления для страницы
		 *
		 * @see libs\factory\pages\themplates\FactoryPages000_ImpressiveThemplate
		 * @param $notices
         * 
		 * @return array
		 */
		public function getActionNotices($notices)
		{

			$notices[] = array(
				'conditions' => array(
					'wbcr_hm_clear_cache_success' => 1
				),
				'type' => 'success',
				'message' => __('Кеш успешно очищен.', 'html-minify')
			);

			$notices[] = array(
				'conditions' => array(
					'wbcr_hm_test_success' => 1
				),
				'type' => 'success',
				'message' => __('Пример успешного выполненного уведомления.', 'html-minify')
			);

			$notices[] = array(
				'conditions' => array(
					'wbcr_hm_test_error' => 1,
					'wbcr_hm_code' => 'interal_error'
				),
				'type' => 'danger',
				'message' => __('Пример уведомления об ошибке.', 'html-minify')
			);

			return $notices;
		}

		/**
		 * Вызывается всегда при загрузке страницы, перед опциями формы с типом страницы options
		 */
		protected function warningNotice()
		{
			$this->printErrorNotice(__("The backup folder wp-content/uploads/backup/ cannot be created or is not writable by the server, original images cannot be saved!", 'wbcr_factory_pages_000'));
		}
		
		/**
		 * Метод должен передать массив опций для создания формы с полями.
		 * Созданием страницы и формы занимается фреймворк
		 *
		 * @since 1.0.0
		 * @return mixed[]
		 */
		public function getOptions()
		{
			$options = array();

			$options[] = array(
				'type' => 'html',
				'html' => '<div class="wbcr-factory-page-group-header"><strong>' . __('HTML Options', 'html-minify') . '</strong><p>' . __('Описание раздела оптимизация', 'html-minify') . '</p></div>'
			);

			// Переключатель
			$options[] = array(
				'type' => 'checkbox',
				'way' => 'buttons',
				'name' => 'html_optimize',
				'title' => __('Optimize HTML Code?', 'clearfy'),
				'layout' => array('hint-type' => 'icon', 'hint-icon-color' => 'grey'),
				//'hint' => __('Храните все данные EXIF ​​с ваших изображений. EXIF - это информация, хранящаяся на ваших фотографиях, таких как скорость затвора, компенсация экспозиции, ISO и т. Д. Подробнее ... Если вы фотограф, вам может быть интересен этот параметр, если вы показываете на своих страницах некоторую информацию, такую ​​как модель вашей камеры.', 'html-minify'),
				'default' => false,
				// когда чекбокс включен показываем поле с классом .factory-control-resize_larger_w
				/*'eventsOn' => array(
					'show' => '.factory-control-resize_larger_w'
				),*/
				// когда чекбокс выключен, скрываем поле с классом .factory-control-resize_larger_w
				/*'eventsOff' => array(
					'hide' => '.factory-control-resize_larger_w'
				)*/
			);

			// Переключатель
			$options[] = array(
				'type' => 'checkbox',
				'way' => 'buttons',
				'name' => 'html_keepcomments',
				'title' => __('Keep HTML comments?', 'clearfy'),
				'layout' => array('hint-type' => 'icon', 'hint-icon-color' => 'grey'),
				'hint' => __('Enable this if you want HTML comments to remain in the page.', 'html-minify'),
				'default' => false
			);

			$formOptions = array();
			
			$formOptions[] = array(
				'type' => 'form-group',
				'items' => $options,
				//'cssClass' => 'postbox'
			);
			
			return apply_filters('wbcr_hm_settings_form_options', $formOptions);
		}

		/**
		 * Действие для страницы
		 * Если мы перейдем по ссылке
		 * http://testwp.test/wp-admin/options-general.php?page=image_optimizer-wbcr_image_optimizer&action=simple
		 * То будет вызван этот медот для дальнейшей обрабоки действия
		 */
		public function simpleAction()
		{
			// Получение get переменных
			$var1 = $this->plugin->request->get('var1');
			// Получение post переменных
			$var2 = $this->plugin->request->post('var2');

			// Получение опций из таблицы wp_options
			$option = $this->plugin->getOption('test', 'default');

			// Обновление опций из таблицы wp_options
			$this->plugin->updateOption('test', '1');

			// Удаление опций из таблицы wp_options
			$this->plugin->deleteOption('test');
		}
	}