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

	public function loadStylesheet(): void
	{
		global $pagenow;
		if($pagenow == $this->parent_slug && $_GET['page'] == $this->menu_slug) {
			wp_register_style( 'mahdx-social-share-admin-style', plugins_url("oop-social-share/src/admin/view/css/style.css"));
			wp_enqueue_style( 'mahdx-social-share-admin-style');
		}
	}


	/**
	 * Executed when calling the hool 'admin_init'. It registers a new section and adds to it the fields
	 * @return void
	 */
	public function settingsInit(): void
	{
		//Add a new section
		$section_id = 'mahdx-social-sahre-general-settings-section';
		$this->addSettingsSection($section_id, 'Social Share General Settings',$this->menu_slug);
		//Add fields
		$this->registerField('radio','placement','Placement: ', $section_id, $this->menu_slug, ['top','bottom','none']);
		$this->registerField('checkbox','sites','Sites', $section_id, $this->menu_slug, get_option('mahdx_social_share')['buttons']);
		$this->registerField('checkbox','post_types','Post Types', $section_id, $this->menu_slug,get_post_types(['public' => true]));

	}

	/**
	 * Set up a settings section
	 *
	 * @param string $section_id
	 * @param string $section_title
	 * @param string $settings_page
	 *
	 * @return void
	 */
	private function addSettingsSection(string $section_id, string $section_title, string $settings_page): void
	{
		add_settings_section(
			$section_id,
			$section_title,
			'',
			$settings_page); //$this->menu_slug == option_group
	}

	/**
	 * Create a settings field in 2 steps
	 *      1) register settings field into a settings section
	 *      2) add settings field
	 *
	 * @param string $option_type
	 * @param string $option_name used in `name` attribute in HTML input tags
	 * @param string $field_label
	 * @param string $section_id
	 * @param string $settings_page must be the same for `add_settings_section()`, `register_setting()` and `add_setting_field()`
	 * @param array $args
	 *
	 * @return void
	 */
	private function registerField(string $option_type, string $option_name, string $field_label, string $section_id, string $settings_page, array $args = []): void
	{
		register_setting($settings_page,$option_name);
		add_settings_field(
			$option_name,
			$field_label,
			[$this, 'renderField'],
			$settings_page,
			$section_id,
			[
				'name' => $option_name,
				'type' => $option_type,
				'args' => $args,
			]
		);
	}

	public function renderField($args): void
	{
		$view = dirname( __FILE__, 1 ) . '/view/options.php';
		ob_start();
		$name = $args['name'];
		$type = $args['type'];
		$options = $args['args'];
		include $view;
		echo ob_get_clean();
	}

}