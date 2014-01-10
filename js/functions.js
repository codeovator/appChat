$(document).ready(function(){
	$('section').hide();
	$('#header').show();
	$('#footer').show();


	$("#header .atlas").hover(function(){
		$('.chat').html('ch');
		$('.atlas').html('atlas');
		$('.atlas').addClass('atlas-css');
	},function(){
		$('.chat').html('chat');
		$('.atlas').html('las');
		$('.atlas').removeClass('atlas-css');
	});
	$("#header .chat").hover(function(){
		$('.chat').html('chat');
		$('.atlas').html('las');
		$('.chat').addClass('chat-css');
	},function(){
		$('.chat').html('chat');
		$('.atlas').html('las');
		$('.chat').removeClass('chat-css');
	});

	$('#start-chat').click(function(){
		if($('#is_fb_logged').val()==1){
			$('#header').hide(200);
			$('#banner').show(200);
			$('.my-name').html('Howdy, '+ ($('#user-name').val()).toUpperCase());
		}else{
			if($('#user-name').val()==''){
				alert('Please enter your name');
			}else{
				$('#header').hide(200);
				$('#banner').show(200);
				$('.my-name').html('Howdy, '+ ($('#user-name').val()).toUpperCase());
			}
		}
	});

	$('#start-map').click(function(){
		if($('#is_fb_logged').val()==1){
			$('#banner').hide(200);
			$('#map').show(200);
		}else{
			$('#banner').hide(200);
			$('#map').show(200);
		}
	});

});