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
		//$this->renderButton("facebook");
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

	public function renderButton(string $id) : string
	{
		$button = $this->options['buttons'][$id];
		ob_start();
		$url = $button['url'];
		$icon = $button['icon'];
		$label = $button['label'];
		include "template.php";
		$html = ob_get_clean();
		return $html;
	}

	public function renderShareDiv($content): string
	{
		$this->options = get_option('mahdx_social_share');
		$buttons = $this->options['active_buttons'];
		if($buttons && is_single())
		{
			$html = "<div>";
			foreach ($buttons as $id => $details)
			{
				$html .= $this->renderButton($id);
			}
			$html .= "</div>";
			$content .= $html;
			return $content;
		}
		return $content;
	}

}