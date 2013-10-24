<div class="tournaments view">
<h2><?php echo __('Tournament'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tournament['Tournament']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($tournament['Tournament']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('League'); ?></dt>
		<dd>
			<?php echo $this->Html->link($tournament['League']['name'], array('controller' => 'leagues', 'action' => 'view', $tournament['League']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Challonge Id'); ?></dt>
		<dd>
			<?php echo h($tournament['Tournament']['challonge_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tournament'), array('action' => 'edit', $tournament['Tournament']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tournament'), array('action' => 'delete', $tournament['Tournament']['id']), null, __('Are you sure you want to delete # %s?', $tournament['Tournament']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tournaments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tournament'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Leagues'), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New League'), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Matches'), array('controller' => 'matches', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Match'), array('controller' => 'matches', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tournament Participants'), array('controller' => 'tournament_participants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tournament Participant'), array('controller' => 'tournament_participants', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Matches'); ?></h3>
	<?php if (!empty($tournament['Match'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Tournament Id'); ?></th>
		<th><?php echo __('Team1 Id'); ?></th>
		<th><?php echo __('Team2 Id'); ?></th>
		<th><?php echo __('Winner'); ?></th>
		<th><?php echo __('Loser'); ?></th>
		<th><?php echo __('Tie'); ?></th>
		<th><?php echo __('Team1 Score'); ?></th>
		<th><?php echo __('Team2 Score'); ?></th>
		<th><?php echo __('Challonge Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tournament['Match'] as $match): ?>
		<tr>
			<td><?php echo $match['id']; ?></td>
			<td><?php echo $match['tournament_id']; ?></td>
			<td><?php echo $match['team1_id']; ?></td>
			<td><?php echo $match['team2_id']; ?></td>
			<td><?php echo $match['winner']; ?></td>
			<td><?php echo $match['loser']; ?></td>
			<td><?php echo $match['tie']; ?></td>
			<td><?php echo $match['team1_score']; ?></td>
			<td><?php echo $match['team2_score']; ?></td>
			<td><?php echo $match['challonge_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'matches', 'action' => 'view', $match['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'matches', 'action' => 'edit', $match['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'matches', 'action' => 'delete', $match['id']), null, __('Are you sure you want to delete # %s?', $match['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Match'), array('controller' => 'matches', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Tournament Participants'); ?></h3>
	<?php if (!empty($tournament['TournamentParticipant'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Tournament Id'); ?></th>
		<th><?php echo __('Team Id'); ?></th>
		<th><?php echo __('Challonge Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($tournament['TournamentParticipant'] as $tournamentParticipant): ?>
		<tr>
			<td><?php echo $tournamentParticipant['id']; ?></td>
			<td><?php echo $tournamentParticipant['tournament_id']; ?></td>
			<td><?php echo $tournamentParticipant['team_id']; ?></td>
			<td><?php echo $tournamentParticipant['challonge_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tournament_participants', 'action' => 'view', $tournamentParticipant['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tournament_participants', 'action' => 'edit', $tournamentParticipant['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tournament_participants', 'action' => 'delete', $tournamentParticipant['id']), null, __('Are you sure you want to delete # %s?', $tournamentParticipant['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Tournament Participant'), array('controller' => 'tournament_participants', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
