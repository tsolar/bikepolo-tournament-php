<div class="teams view">
	<div class="header col-md-12">
		<div class="logo">
			<?php if (!empty($team['Team']['logo'])) : ?>
				<img class="img-responsive" alt="<?php echo $team['Team']['name']; ?>" src="<?php echo $team['Team']['logo'] ?>">
			<?php else: ?>
				<img alt="<?php echo $team['Team']['name']; ?>" src="holder.js/100x100/auto/text:Sin logo">
			<?php endif; ?>
		</div>
		<div class="name">
			<h2>
				<?php echo __('Team') . ' ' . $team['Team']['name']; ?>
			</h2>
		</div>
	</div>
	<div class="col-md-8">
		<div class="photo">
			<?php if (!empty($team['Team']['photo'])) : ?>
				<img class="img-responsive" alt="<?php echo $team['Team']['name']; ?>" src="<?php echo $team['Team']['photo'] ?>">
			<?php else: ?>
				<img alt="<?php echo $team['Team']['name']; ?>" src="holder.js/100%x300/auto/">
			<?php endif; ?>
		</div>
		<div class="description">
			<p>
				<?php if (!empty($team['Team']['description'])): ?>
					<?php echo nl2br($team['Team']['description']); ?>
				<?php else: ?>
					<?php echo __('No description'); ?>
				<?php endif; ?>
			</p>
		</div>
	</div>
	<div class="players col-md-4">
		<?php if (!empty($team['TeamMembership'])): ?>
			<?php foreach ($team['TeamMembership'] as $teamMembership): ?>
				<?php if ($teamMembership['approved']): ?>
					<div class="media player">
						<a class="pull-left thumbnail" href="/players/view/<?php echo $teamMembership['Player']['id']; ?>">
							<!--<img class="media-object img-polaroid img-responsive" src="holder.js/150x150/auto/text:Sin foto" alt="...">-->
							<?php echo $this->Players->getPhoto($teamMembership['Player']['id']); ?>
						</a>
						<div class="media-body">
							<h4 class="media-heading"><?php echo $teamMembership['Player']['name']; ?></h4>
							<p><?php echo nl2br($teamMembership['Player']['description']); ?></p>
						</div>
					</div>
				<?php else: ?>
					<?php if (!empty($current_user) && $teamMembership['Player']['id'] == $current_user['Player']['id']): ?>
						<div class="media player">
							<a class="pull-left thumbnail" href="/players/view/<?php echo $teamMembership['Player']['id']; ?>">
								<!--<img class="media-object img-polaroid img-responsive" src="holder.js/150x150/auto/text:Sin foto" alt="...">-->
								<?php echo $this->Players->getPhoto($teamMembership['Player']['id']); ?>
							</a>
							<div class="media-body">
								<h4 class="media-heading"><?php echo $teamMembership['Player']['name']; ?></h4>
								<p><?php echo nl2br($teamMembership['Player']['description']); ?></p>
								<div class="status">
									<span class="label label-warning">
										<?php echo __('Waiting approval'); ?>
									</span>
								</div>
							</div>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
	</div>
	<div class="footer col-md-12">
		<?php
		if (!empty($current_user)) {
			if (!(empty($is_admin))) {
				echo $this->element('Teams/admin_actions');
			} else {
				if (empty($has_membership)) {
					echo $this->element('Teams/not_member_actions');
				} else {
					
				}
			}
		}
		?>
	</div>
</div>
<script>
	var team_id = <?php echo $team['Team']['id']; ?>;
</script>