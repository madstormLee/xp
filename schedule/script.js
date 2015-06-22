$( function() {
var clock = function() {
	var date = new Date;
	$('#clock').html( date );
};
clock();
});
