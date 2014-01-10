$(document).ready(function(){
	$('section').hide();
	$('#header').show();
	$('#footer').show();

	$('#start-chat').click(function(){
		if($('#is_fb_logged').val()==1){
			$('#header').hide(200);
			$('#banner').show(200);
			$('.my-name').html('Hello '+$('#user-name').val());
		}else{
			if($('#user-name').val()==''){
				alert('Please enter your name');
			}else{
				$('#header').hide(200);
				$('#banner').show(200);
				$('.my-name').html('Hello '+$('#user-name').val());
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