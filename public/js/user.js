$(document).ready(function(){
	$('#loginWidtAccLeft').ajaxForm({url:'/ajax/login',type:'POST',success: function(data) { 
		if (data == 'Ok') {
               	location.reload(); 
        };
    }});
	$('#registerWidtAccLeft').ajaxForm({url:'/ajax/reg',type:'POST',success: function(data) { 
		if (data == 'Ok') {
               	location.reload(); 
        };
    }});

	$('#login_as_member').click(function(){
		$('.m_area').fadeIn(700);
	})
});