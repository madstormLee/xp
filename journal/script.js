var Calendar = function( target ) {
	var my = this;

	this.init = function() {
		$.get( target.attr('data-init-href'), my.onLoad );
		target.click( my.click );
	};

	this.onLoad = function( data, test ) {
		var html = $(data);
		var yearMonth = html.find('caption').html();

		$("#days li a:contains('"+yearMonth+"')").each( function( num, unit ) {
			var el = $(unit);
			var day = new Date( el.html() );
			html.find( 'td.day-' + day.getDate() )
			.append( el.clone().html( el.attr('data-count') ) )
			.addClass('event');
		});

		target.html( html );
	};

	this.click = function( ev ) {
		var el = $(ev.target);
		if ( el.up('#calendarNavi').length > 0 ) {
			$.get( el.attr('href'), my.onLoad );
			return false;
		}
	};

	this.init();
};

/********************* assign *********************/
$( function() {
	new Calendar( $('#calendar') );

	/********************* days *********************/
	$('dl.days a.toggleId').click( function( ev ) {
		$('dl.days dd').hide();
		$( $(ev.target).attr('href') ).show();
		return false;
	});
	$('dl.days a.toggleId')[0].click();

});
