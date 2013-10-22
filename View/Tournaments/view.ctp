
<h1>
    <?php echo $tournament->name; ?>
</h1>
<iframe src="http://<?php echo $tournament->subdomain; ?>.challonge.com/<?php echo $tournament->url; ?>/module" width="100%" height="500" frameborder="0" scrolling="auto" allowtransparency="true"></iframe>

<h2>
    <?php echo __('Matches') ?>
</h2>
<?php 
foreach ($matches->match as $m) :
    $tournament_id =$m->{'tournament-id'};
    ?>

<a href="/matches/view/<?php echo $tournament_id .'/'. $m->id; ?>">asd</a>
<?php
endforeach;
?>
<?php

debug($matches);
debug($tournament);

