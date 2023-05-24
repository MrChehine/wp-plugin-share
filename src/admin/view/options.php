<?php
$name = $name ?? '';
$type = $type ?? '';
$options = $options ?? [];
?>

<?php if($name == 'placement') : ?>
	<?php foreach($options as $position) : ?>
		<div>
			<input type="<?= $type ?>" name="<?= $name ?>" value="<?= $position ?>" id="<?= $position ?>">
			<label for="<?= $position ?>"><?= ucfirst($position) ?></label>
		</div>
	<?php endforeach; ?>

<?php elseif ($name == 'active_buttons') : ?>
	<?php foreach($options as $id => $site) : ?>
		<div style="display: flex; align-items: center; margin-bottom: 32px">
			<input type="<?= $type ?>" name="<?= $name ?>[]" value="<?= $id ?>" id="<?= $id ?>">
			<img src="<?= $site['icon'] ?>" width="32px" style="margin: 0 16px;">
			<label for="<?= $id ?>"><?= ucfirst($site['label']) ?></label>
		</div>
	<?php endforeach; ?>

<?php elseif($name == 'post_types') : ?>
	<?php foreach($options as $id => $post_type) : ?>
		<div>
			<input type="<?= $type ?>" name="<?= $name ?>[]" value="<?= $id ?>" id="<?= $id ?>">
			<label for="<?= $id ?>"><?= ucfirst($post_type) ?></label>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
