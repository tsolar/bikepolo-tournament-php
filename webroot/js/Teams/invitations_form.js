$(function() {
	console.log(team_id);
	$.post('/teams/getPlayersNotInTeam', {team_id: team_id}).done(function(html) {
		$('.players-list').html(html);
	})
});


