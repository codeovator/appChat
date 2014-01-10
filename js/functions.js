$(document).ready(function(){
	$('section').hide();
	$('#header').show();
	$('#footer').show();

	$('#start-chat').click(function(){
		if($('#is_fb_logged').val()==0){
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

});