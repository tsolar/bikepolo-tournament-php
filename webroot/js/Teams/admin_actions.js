$(function() {
	$('#sendInvitationsModal').on('click', '.send-invitations', function() {
		$.post('/teams/sendInvitations', {team_id: team_id, players: $('#sendInvitationsModal').find('select').val()}).done(function() {
			$('#sendInvitationsModal').modal('hide');
		});
	})
});