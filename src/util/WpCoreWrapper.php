<?php

namespace OopSocialShare\Util;

class WpCoreWrapper {

	private string $wp_version = '6.2';

	/**
	 * @param string $hook_name
	 * @param callable|string $callback
	 *
	 * @return void
	 */
	public function add_action(string $hook_name, callable|string $callback): void
	{
		add_action($hook_name,$callback);
	}

	/**
	 * @param string $parent_slug
	 * @param string $page_title
	 * @param string $menu_title
	 * @param string $capability
	 * @param string $menu_slug
	 * @param callable|string|array $callback
	 * @param int|float|null $position
	 *
	 * @return string|false
	 */
	public function add_submenu_page(string $parent_slug,
		string $page_title,
		string $menu_title,
		string $capability,
		string $menu_slug,
		callable|string|array $callback = '',
		int|float $position = null): string|false
	{
		return add_submenu_page($parent_slug,$page_title,$menu_title,$capability,$menu_slug,$callback,$position);
	}

	/**
	 * @param string $name
	 * @param string $value
	 *
	 * @return bool
	 */
	public function update_option(string $name, string $value): bool
	{
		return $this->update_option($name,$value);
	}




}