<div class="tournaments form">
    <script>
        $(function() {
            $('.test').html('hola');
            $.post(
                    'https://api.challonge.com/v1/tournaments.json',
                    {
                        name: 'asdasd',
                        tournament_type: 'simple elimination',
                        url: 'asdasd'
                    },
                    function(data) {
                        $('.test').html(data);

                    }
            )
        });
    </script>
    <div class="test"></div>
    <?php echo $this->Form->create('Tournament'); ?>
    <fieldset>
        <legend><?php echo __('Admin Add Tournament'); ?></legend>
        <?php
        echo $this->Form->input('name');
        echo $this->Form->input('league_id');
        echo $this->Form->input('type');
        //echo $this->Form->input('challonge_id');
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>

        <li><?php echo $this->Html->link(__('List Tournaments'), array('action' => 'index')); ?></li>
        <li><?php echo $this->Html->link(__('List Leagues'), array('controller' => 'leagues', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New League'), array('controller' => 'leagues', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Matches'), array('controller' => 'matches', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Match'), array('controller' => 'matches', 'action' => 'add')); ?> </li>
        <li><?php echo $this->Html->link(__('List Tournament Participants'), array('controller' => 'tournament_participants', 'action' => 'index')); ?> </li>
        <li><?php echo $this->Html->link(__('New Tournament Participant'), array('controller' => 'tournament_participants', 'action' => 'add')); ?> </li>
    </ul>
</div>
