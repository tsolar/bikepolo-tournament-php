<div class="players view">
	<div class="header col-md-12">
		<div class="logo">
			<?php echo $this->element('Players/photo'); ?>
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
			echo (!empty($player['Player']['description'])) ? $player['Player']['description'] : __('.');
			?>
		</p>
		<h3>
			<?php echo __('Teams'); ?>
		</h3>
		<ul class="list-unstyled">
			<?php foreach ($player['TeamMembership'] as $tm): ?>
				<?php if ($tm['approved']) : ?>
					<li>
						<a href="/teams/view/<?php echo $tm['Team']['id']; ?>">
							<?php echo $tm['Team']['name']; ?>
						</a>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
