//JQUERY = Libraire = une boite à outils 
$(document).ready(function() {
    console.log('1: jquery ready');
    
    $('button#btn').on('click', function() {
        $('#product-list td').css('font-weight', 600);
        $('input[type="submit"]').val('A');
        $(this).text('DONT');
    });
    
    $('.delete-btn').on('click', function() {
        $(this).parents('tr').first().detach();
    });
    
    $('#search-form').on('submit', function(event) {
        
        event.preventDefault();
        $.get(
            'ajax.php',
            {pk: $('#pk-search').val()}
        )
        .done(function(data) {
           $('#ajax-rsp').html(data);  
        });
        
    });
	
	$('button#edit').on('click', function(){
		var $tr = $(this).parents('tr').first();
		var name = $tr.find('.name').html();
		var prix = $tr.find('.prix').html();
		var quantity = $tr.find('.quantity').html();
		var pk = $tr.find('.pk').html();
		$('input#pk').val(pk);
		$('input#name').val(name);
		$('input#price').val(prix);
		$('input#quantity').val(quantity);
	});
	
	
	$('button#edit_util').on('click', function(){
		var $tr = $(this).parents('tr').first();
		var username = $tr.find('.username').html();
		var password = $tr.find('.password').html();
		var pk = $tr.find('.pk').html();
		$('input#pk').val(pk);
		$('input#username').val(username);
		$('input#password').val(password);
	});
    
});

