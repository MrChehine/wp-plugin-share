<?php

namespace OopSocialShare\Ui;

class ButtonResolver {

	private array $options;

	public function __construct()
	{
	}

	public function init(): void
	{
		if(get_option('mahdx_social_share'))
		{
			$this->options = get_option('mahdx_social_share');
		}
	}

	/**
	 * @param string $id
	 * @param string $label
	 * @param string $url
	 * @param string $icon
	 *
	 * @return void
	 */
	public function addCustomButton(string $id, string $label, string $url, string $icon): void
	{
		$this->options['buttons'][$id] = [
			"label" => $label,
			"url"   => $url,
			"icon"  => $icon
		];
		update_option('mahdx_social_share',$this->options);
	}

}