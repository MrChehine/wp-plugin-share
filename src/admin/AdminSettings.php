<?php

namespace OopSocialShare\Admin;

use OopSocialShare\Util\MahdxShareHelper;
use OopSocialShare\Util\WpCoreWrapper;

class AdminSettings {

	private string $parent_slug;
	private string $page_title;
	private string $menu_title;
	private string $capability;
	private string $menu_slug;

	private string $template_page;

	private string $options;

	private WpCoreWrapper $core_wrapper;
	private MahdxShareHelper $helper;

	/**
	 * @param WpCoreWrapper $core_wrapper
	 * @param MahdxShareHelper $helper
	 */
	public function __construct( WpCoreWrapper $core_wrapper, MahdxShareHelper $helper ) {
		$this->core_wrapper = $core_wrapper;
		$this->helper       = $helper;

		$this->parent_slug = 'options-general.php';
		$this->page_title = 'Mahdx Share';
		$this->menu_title = 'Mahdx Share';
		$this->capability = 'manage_options';
		$this->menu_slug = 'mahdx-social-share';
		$this->template_page = dirname(__FILE__).'/view/default.php';
	}

	public function createPage(): void
	{
		$this->core_wrapper->add_submenu_page($this->parent_slug,$this->page_title,$this->menu_title,$this->capability,$this->menu_slug,[$this, 'loadView']);
	}

	public function loadView(): void
	{
		require_once $this->template_page;
	}

	/**
	 * Executed when the admin save the settings
	 *
	 * @return void
	 */
	public function handleSettingsUpdate(): void
	{
		if(isset($_POST)) {
			//handle the request (update options)
		}
	}


}