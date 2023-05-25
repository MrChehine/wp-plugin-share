<?php
$name = $name ?? '';
$type = $type ?? '';
$options = $options ?? [];
?>

<?php if($name == 'placement') : ?>
	<?php foreach($options as $position) : ?>
		<div>
			<input type="<?= $type ?>" name="<?= $name ?>" value="<?= $position[0] ?>" id="<?= $position[0] ?>" <?= $position[1] ?> >
			<label for="<?= $position[0] ?>"><?= ucfirst($position[0]) ?></label>
		</div>
	<?php endforeach; ?>

<?php elseif ($name == 'active_buttons') : ?>
	<?php foreach($options as $id => $site) : ?>
		<div style="display: flex; align-items: center; margin-bottom: 32px">
			<input type="<?= $type ?>" name="<?= $name ?>[]" value="<?= $id ?>" id="<?= $id ?>" <?= $site[1] ?>>
			<img src="<?= $site[0]['icon'] ?>" width="32px" style="margin: 0 16px;">
			<label for="<?= $id ?>"><?= ucfirst($site[0]['label']) ?></label>
		</div>
	<?php endforeach; ?>

<?php elseif($name == 'post_types') : ?>
	<?php foreach($options as $id => $post_type) : ?>
		<div>
			<input type="<?= $type ?>" name="<?= $name ?>[]" value="<?= $id ?>" id="<?= $id ?>" <?= $post_type[1] ?> >
			<label for="<?= $id ?>"><?= ucfirst($post_type[0]) ?></label>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
