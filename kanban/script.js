$( function() {
	$('#backlog').click( function( ev ) {
		ev.preventDefault();
		if ( ev.target.href == undefined ) {
			return false;
		}
		var kanbanId = $('#index th:first').attr('data-id');
		var backlogId = $('#index td:first').html( ev.target.href.match(/id=([a-zA-Z0-9]+)/)[1] );
	});
});
