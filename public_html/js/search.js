$(window).load(function(){
    $('#searchValue').keyup(function(){
        var searchField = $('#searchValue').val();
        var regex = new RegExp(searchField, "i");
        var output = '<div class="result-rows">';
        var count = 1;
        $.getJSON('http://ratingweb.coderxlsn.me/ajax/search', function(data) {

        if (data.length<1) {
        	$('#search-results').fadeOut(500);
        	$('.no-results').fadeIn(500);
        }
        else {

	        $.each(data, function(key, val) {

	        output += '<ul>'
	        output += '<li><a href="#"' + val.name + '</a></li>';
	        output += '</ul>'
	        output += '</div>'

	      	count++;

	      	$('#search-results').html(output);
	    	$('#search-results').fadeIn(500);

	    	});

        }
    
        }); 
    });
});