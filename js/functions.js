$(document).ready(function(){
	$('section').hide();
	$('#header').show();
	$('#footer').show();

	$('#start-chat').click(function(){
		$('#header').hide(200);
		$('#banner').show(200);
		$('.my-name').html('Hello '+$('#user-name').val());
	});

});