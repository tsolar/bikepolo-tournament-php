<div class="players view">
	<div class="header col-md-12">
		<div class="logo">
			<?php if (!empty($player['Player']['photo'])) : ?>
				<img alt="<?php echo $player['Player']['name']; ?>" src="<?php echo $player['Player']['photo'] ?>">
			<?php else: ?>
				<img alt="<?php echo $player['Player']['name']; ?>" src="holder.js/100x100/auto/text:Sin foto">
			<?php endif; ?>
		</div>
		<div class="name">
			<h2>
				<?php echo __('Player') . ' ' . $player['Player']['name']; ?>
			</h2>
		</div>
	</div>

	<div class="col-md-12">
		<p>
			<?php 
			echo !empty($player['Player']['description']) ? $player['Player']['description'] : __('No description');
			?>
		</p>
		<h3>
			<?php echo __('Teams'); ?>
		</h3>
		<ul class="list-unstyled">
			<?php foreach ($player['TeamMembership'] as $tm): ?>
				<li>
					<a href="/teams/view/<?php echo $tm['Team']['id']; ?>">
						<?php echo $tm['Team']['name']; ?>
					</a>
				</li>

			<?php endforeach; ?>
		</ul>
	</div>
</div>
