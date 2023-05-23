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

	private array $options;

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
		$plugin_base_name = plugin_basename(dirname(__FILE__,'2').'/oop-social-share.php');

		$this->core_wrapper->add_action('activate_'.$plugin_base_name, [$this,'activate']);
		$this->core_wrapper->add_action('wp_enqueue_scripts', [$this->button_resolver,'loadStylesheet']);
		$this->core_wrapper->add_action('admin_enqueue_scripts', [$this->admin_settings,'loadStylesheet']);
		$this->core_wrapper->add_action('admin_init', [$this->button_resolver,'init']);
		$this->core_wrapper->add_action('admin_init', [$this->admin_settings,'settingsInit']);
		$this->core_wrapper->add_action('admin_menu', [$this->admin_settings,'createPage']);
		$this->core_wrapper->add_action('wp_ajax_mahdx_social_share_save_settings', [$this->admin_settings,'handleSettingsUpdate']);

		add_filter('the_content', [$this->button_resolver,'renderShareDiv']);
	}

	public function activate(): void
	{
		$this->options['buttons'] = include dirname( __FILE__, 1 ) . '/config/config.php';
		$this->options['active_buttons'] = $this->options['buttons'];
		update_option('mahdx_social_share', $this->options);
	}

	public function deactivate(): void
	{
		//TODO
	}

	public function uninstall(): void
	{
		delete_option('mahdx_social_share');
	}

}