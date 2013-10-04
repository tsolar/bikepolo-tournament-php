<?php if (!empty($player['Player']['photo'])) : ?>
	<img alt="<?php echo $player['Player']['name']; ?>" src="<?php echo $player['Player']['photo'] ?>">
<?php elseif (!empty($player['User']['email'])): ?>
	<?php echo $this->Gravatar->image($player['User']['email'], array('size' => '100', 'default' => 'identicon')); ?>
<?php else: ?>
	<img alt="<?php echo $player['Player']['name']; ?>" src="holder.js/100x100/auto/text:Sin foto">
<?php endif; ?>
