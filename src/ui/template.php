<?php
//Initialize the variables to get rid of IDE errors
$url = $url ?? '';
$icon = $icon ?? '';
$label = $label ?? '';
?>

<div class="mahdx-social-share-button-container">
	<a href="<?= $url ?>" target="_blank" class="mahdx-social-share-link">
		<img src="<?= $icon ?>" class="mahdx-social-share-button-icon">
		<button class="mahdx-social-share-button"><?= $label ?></button>
	</a>
</div>