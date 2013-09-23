<?php
/*
  if (!empty($user['SocialAccount'])) {
  echo $this->Html->tag('h3', __('My associated accounts are:'));
  ?>
  <ul class="list-unstyled">
  <?php
  foreach ($user['SocialAccount'] as $sa) {
  $data = json_decode($sa['data'], 1);
  echo $this->Html->tag('li', $sa['provider'] . $this->Html->image($data['auth']['info']['image'], array('alt' => '')));
  }
  ?>
  </ul>
  <?php
  }
 * 
 */
?>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			<?php echo __('My teams') ?>
		</h3>
	</div>
	<div class="panel-body">
		<ul class="list-unstyled">
			<?php foreach ($teams as $team) { ?>
				<li>
					<?php
					if (!empty($team['Team']['id'])) {
						if ($team['TeamMembership']['approved']) {

							echo $this->Html->link($team['Team']['name'], Router::url('/teams/view/' . $team['Team']['id']), array('class' => 'button'));
						} else {
							echo $this->Html->link($team['Team']['name'], Router::url('/teams/view/' . $team['Team']['id']), array('class' => 'button')) . ' ' . __('(not approved)');
						}
					}
					?>
				</li>
			<?php } ?>
		</ul>
	</div>
	<div class="panel-footer">
		<a href="/teams/add" class="btn btn-primary btn-xs" >
			<?php echo __('Add team'); ?>
		</a>
	</div>
</div>