$(function(){

	var resultSet = $('#result-set');
	var result = $('#result');
	var search = $('#search');
	var loading = $('.loading');

	if (!Modernizr.input.placeholder)
	{
		
		var placeholderText = search.attr('placeholder');
		
		search.attr('value',placeholderText);
		search.addClass('placeholder');
		
		search.focus(function() {				
			if( (search.val() == placeholderText) )
			{
				search.attr('value','');
				search.removeClass('placeholder');
			}
		});
		
		search.blur(function() {				
			if ( (search.val() == placeholderText) || ((search.val() == '')) )                      
			{	
				search.addClass('placeholder');					  
				search.attr('value',placeholderText);
			}
		});
	}  

	$('#submit').click(function() {
		var searchContent = search.val()
		var placeholderText = search.attr('placeholder');

		loading.show();
  		
  		$.ajax({
  			type: "post",
  			url: "process.php",
  			data: { url: searchContent }
		}).done(function( response ) {
			loading.hide();

			var obj = $.parseJSON(response);

			$.each( obj, function( key, value ) {
				//resultset.append('<div class="row"><span>'+value.url+'</span><span>'+value.text+'</span><span>'+value.image+'</span></div>');
				resultSet.append('<tr class="row"><td>'+value.url+'</td><td>'+value.text+'</td><td>'+value.image+'</td></tr>');
			});

			$("html, body").animate({ scrollTop: "300px" }, 'slow'); 			
		});

	});

})