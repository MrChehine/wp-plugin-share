<?php

$plugin_base_name = plugin_basename(dirname(__FILE__,'2').'/oop-social-share.php');
$assets = plugin_dir_url($plugin_base_name). 'assets/icons';

$buttons = [
	"facebook" => [
		"label" => "Facebook",
		"url"   => 'https://www.facebook.com/sharer.php?u=%1$s&t=%2$s',
		"icon"  => "{$assets}/facebook_icon.png"
	],
	"twitter" => [
		"label" => "Twitter",
		"url"   => 'https://twitter.com/share?text=%2$s&url=%1$s%3$s',
		"icon"  => "{$assets}/twitter_icon.png"
	],
	"linkedin" => [
		"label" => "Linkedin",
		"url"   => 'https://www.linkedin.com/shareArticle?mini=true&url=%1$s&title=%2$s',
		"icon"  => "{$assets}/linkedin_icon.png"
	],
	"reddit" => [
		"label" => "Reddit",
		"url"   => 'https://www.reddit.com/submit?url=%1$s&title=%2$s',
		"icon"  => "{$assets}/reddit_icon.png"
	],
	"tumbler" => [
		"label" => "Tumbler",
		"url"   => 'https://www.tumblr.com/share?v=3&u=%1$s&t=%2$s',
		"icon"  => "{$assets}/tumbler_icon.png"
	],
	"gmail" => [
		"label" => "Gmail",
		"url"   => 'https://mail.google.com/mail/u/0/?view=cm&fs=1&su=%2$s&body=%1$s&ui=2&tf=1',
		"icon"  => "{$assets}/gmail_icon.png"
	]

];

return $buttons;