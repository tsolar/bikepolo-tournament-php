$(function(){
	$('input[type="checkbox"]').on('click', function(){
		console.log($(this).data('team-id'));
		console.log($(this).data('player-id'));
		console.log($(this).data('attr'));
		console.log($(this).is(':checked'));
		
		var team_id = $(this).data('team-id');
		var player_id = $(this).data('player-id');
		var attr = $(this).data('attr');
		var checked = $(this).is(':checked') ? 1 : 0;
		
		var data = {
			team_id: team_id,
			player_id: player_id,
			attr: attr,
			checked: checked
		};
		
		$.post('/teams/setMembershipAttr', data).done(function(){
			console.log('asingado');
			//window.location.reload(true);
		});
	})
});


