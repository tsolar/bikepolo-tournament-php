<div class="teams view">
	<h2>
		<?php echo __('Team') . ' ' . $team['Team']['name']; ?>
	</h2>
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
	<div class="players">

		<div class="related">
			<h3><?php echo __('Related Team Memberships'); ?></h3>
			<?php if (!empty($team['TeamMembership'])): ?>
				<table cellpadding = "0" cellspacing = "0" class="table table-hover">
					<tr>
						<th><?php echo __('Player name'); ?></th>
					</tr>
					<?php
					$i = 0;
					foreach ($team['TeamMembership'] as $teamMembership):
						if($teamMembership['approved']):
						?>
						<tr>
							<td><?php echo $teamMembership['Player']['name']; ?></td>
						</tr>
						<?php elseif ($teamMembership['Player']['id'] == $current_user['Player']['id']): ?>
						<tr>
							<td>
								<?php echo $teamMembership['Player']['name']; ?>
								<span class="label label-warning">
									<?php echo __('Waiting approval'); ?>
								</span>
							</td>
						</tr>
						<?php endif; ?>
				<?php endforeach; ?>
				</table>
			<?php endif; ?>
		</div>
	</div>
	<script>
		var team_id = <?php echo $team['Team']['id']; ?>;
	</script>