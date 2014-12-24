$(window).load(function(){
    $('#searchValue').keyup(function(){
        var searchField = $('#searchValue').val();
        var output = '<div class="result-rows">';
        var count = 1;
        $.getJSON('/ajax/search?key='+searchField, function(data) {
        	
        if (data.length<1) {
        	$('#search-results').fadeOut(500);
        	$('.no-results').fadeIn(500);
        }
        else {
        	output += '<ul>'
	        for(i=0;i < data.length;i++){
	    	    output += '<li><a href="'+ data[i].uri +'">' + data[i].name + '</a></li>';
	        }
        	output += '</ul>'
        	output += '</div>'
	
        	$('#search-results').html('');
	      	$('#search-results').html(output);
	    	$('#search-results').fadeIn(500);
        }
    
        }); 
    });
});