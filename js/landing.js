var curView = "dashboard";

function autoScrollTo(el) {
    var top = $("#" + el).offset().top;
    $("html, body").animate({ scrollTop: top }, 400);
}

// We only want this stuff to run when jQuery is initialized and the
// document is ready (also helps page-load speed):
$(document).ready( function() {
	
	// Use this rather than onClick to take advantage of 
	// event bubbling.
	$('body').on( 'click', '.panel-selector', function(event) {
		switchTo( '' + $('this').attr('data-param') );
	});
	
	function switchTo(panel) {
		if (curView == panel) {
		  if (curView == "dashboard") {
			return;
		  }
		  panel = "dashboard";
		}
	
		$("." + panel).slideToggle(300);
		$("." + curView).slideToggle(300);
		curView = panel;
	}

	$('#login-form').submit( function(event) {
		event.preventDefault();
		event.stopImmediatePropagation();
		
		$.ajax({
			url: 'user_manager.php',
			type: 'POST',
			data: $('#login-form').serialize(),
			success: function( data ) {
				if( data == 'false' )
				{
					alert( 'Invalid Login Details (note, this is a placeholder, will be fancy animation or w/e)' );
				}
				else
				{
					// We logged in successfully, refresh the page:
					location.reload();
				}
			},
			error: function( data ) {
				alert( 'Server Error (sigh)' );
			}
		});
	});
	
	$('#log-out').click( function(event) {
		$.ajax({
			url: 'user_manager.php',
			type: 'POST',
			data: { logout : true },
			success: function( data ) {
				location.reload();
			},
			error: function( data ) {
				alert( 'Server Error (sigh)' );
			}
		});
	});
});