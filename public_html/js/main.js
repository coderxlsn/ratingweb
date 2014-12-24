$(document).ready(function(){
//login-form popup
	$('.l_f1').click(function(){
		$('#overlay1').fadeIn(700);
		$('#popup-login').fadeIn(700);
	});

	$('.l_f2').click(function(){
		$('#overlay1').fadeIn(700);
		$('#popup-reg').fadeIn(700);
	})

	$('#overlay1').click(function(){
		$(this).fadeOut(700);
		$('.popup-login').fadeOut(700);
	});

	$('.f_close').click(function(){
		$('#overlay1').fadeOut(700);
		$('.popup-login').fadeOut(700);
	});
//login-form popup

//notice
	$('.n_close').click(function(){ 
		$('.notice').fadeOut(700);
	});
//notice

//colorpicker
$('#colSelBg').ColorPicker({
			color: '#0000ff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colSelBg div').css('backgroundColor', '#' + hex);
				$('.cp_bg').html('#' + hex);
			}
		});

		$('#colSelWt').ColorPicker({
			color: '#0000ff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colSelWt div').css('backgroundColor', '#' + hex);
				$('.cp_wt').html('#' + hex);
			}
		});

		$('#colSelRg').ColorPicker({
			color: '#0000ff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colSelRg div').css('backgroundColor', '#' + hex);
				$('.cp_rg').html('#' + hex);
			}
		});

		$('#colSelRt').ColorPicker({
			color: '#0000ff',
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colSelRt div').css('backgroundColor', '#' + hex);
				$('.cp_rt').html('#' + hex);
			}
		});
//colorpicker

//iframe_settings
	$('input[name="iframe_width"]').on('input',function(){
	    var iframe_width = $(this).val();
	    iframe.attr("width",iframe_width);
	    outputHtml(iframe);
	});
	 
	$('input[name="iframe_height"]').on('input',function(){
	    var iframe_height = $(this).val();
	    iframe.attr("height",iframe_height);
	    outputHtml(iframe);
	});
	var iframe = $('<iframe />', {
	    id: 'iframe_text_code',
	    name: 'test2',
	    frameborder: 0,
	    attr: {
	        width: 350,
	        height: 100
	    }
	});
	function outputHtml(obj){
	    $('.iframe_code').val(obj.prop('outerHTML'));
	}
	outputHtml(iframe);
//iframe_settings
})