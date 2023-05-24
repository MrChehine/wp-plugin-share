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

	public function renderButton(string $id, string $post_url, string $post_title, string $excerpt = '') : string
	{
		$button = $this->options['buttons'][$id];
		ob_start();
		$url = sprintf($button['url'],$post_url,$post_title, $excerpt);
		$icon = $button['icon'];
		$label = $button['label'];
		include "template.php";
		$html = ob_get_clean();
		return $html;
	}

	public function renderShareDiv($content): string
	{
		global $post;
		$this->options = get_option('mahdx_social_share');
		$buttons = $this->options['active_buttons'];
		if($buttons && is_singular() && in_array(get_post_type(), $this->options['post_types']))
		{
			$post_url = get_permalink();
			$post_title = $post->post_title;
			$html = "<div class='mahdx-social-share-container'>";
			foreach ($buttons as $id)
			{
				$html .= $this->renderButton($id, $post_url, $post_title);
			}
			$html .= "</div>";
			$placement = $this->options['placement'];
			switch ($placement)
			{
				case 'top': $html .= $content;
					$content = $html;
					break;
				case 'bottom': $content .= $html;
					break;
			}

			return $content;
		}
		return $content;
	}

	public function loadStylesheet(): void
	{
		if(is_singular()) {
			wp_register_style( 'mahdx-social-share-style', plugins_url("oop-social-share/src/assets/style.css"));
			wp_enqueue_style( 'mahdx-social-share-style');
		}
	}

}