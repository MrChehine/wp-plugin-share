<?php

namespace OopSocialShare;

use OopSocialShare\Admin\AdminSettings;
use OopSocialShare\Ui\ButtonResolver;
use OopSocialShare\Util\MahdxShareHelper;
use OopSocialShare\Util\WpCoreWrapper;

class MahdxShare {

	private WpCoreWrapper $core_wrapper;
	private AdminSettings $admin_settings;
	private ButtonResolver $button_resolver;
	private MahdxShareHelper $helper;

	public function __construct() {
	}


	public function prepareObjects(): void
	{
		$core_wrapper = new WpCoreWrapper();
		$button_resolber = new ButtonResolver();
		$helper = new MahdxShareHelper();
		$admin_settings = new AdminSettings($core_wrapper,$helper);

		$this->core_wrapper = $core_wrapper;
		$this->button_resolver = $button_resolber;
		$this->helper = $helper;
		$this->admin_settings = $admin_settings;
	}

	public function init(): void
	{
		$this->prepareObjects();
		$this->core_wrapper->add_action('admin_menu', [$this->admin_settings,'createPage']);
		$this->core_wrapper->add_action('wp_ajax_mahdx_social_share_save_settings', [$this->admin_settings,'handleSettingsUpdate']);
	}

	public function activate(): void
	{
		//TODO
	}

	public function deactivate(): void
	{
		//TODO
	}

	public function uninstall(): void
	{
		//TODO
	}

}