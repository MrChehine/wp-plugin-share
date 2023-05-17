<?php
/**
 * Plugin Name: OOP Social Share
 * Plugin URI: https://wordpress.org/plugins/disable-comments/
 * Description: Adds social share buttons to posts.
 * Version: 2.4.3
 * Author: MahdX
 * License: GPL-3.0+
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 */

use OopSocialShare\MahdxShare;

require_once 'vendor/autoload.php';

if(!defined('MAHDX_PLUGIN_ROOT_URI')) {
	define('MAHDX_PLUGIN_ROOT_URI', plugins_url("/", __FILE__));
}
if(!defined('MAHDX_ASSETS_URI')) {
	define('MAHDX_ASSETS_URI', MAHDX_PLUGIN_ROOT_URI . 'assets/');
}

$plugin = new MahdxShare();
$plugin->init();
