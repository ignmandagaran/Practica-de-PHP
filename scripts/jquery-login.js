$(document).ready(function(fn) {
 
    // on submit form
	$("#login_form").submit(function( event ) {			
 
        var debug = true;
        // Stop form from submitting normally
        event.preventDefault();
        
		$("#access").attr("disabled", true); // Disable access button
        $("#message-area").removeClass()
                          .addClass('messagebox')
                          .html('<img src="imagenes/2.gif" alt="validando ..." />')
                          .fadeIn(2000);	
 
        // Send data to login file    
		$.post("login.php", { 
            email: $("#email").val(),
            password: $('#password').val()             
        }, function(data) {
 
            // Login Successful 
            if (data.auth=='x100') {
 
                // fadeTo(duration, opacity, function)
		  	    $("#message-area").fadeTo(200, 0.1, function() {			 
                    $(this).html('Comprobando usuario ...')
                           .addClass('text-info')
                           .fadeTo(900, 1, function() { 			  	
                                
                        $('#message-area').removeClass('text-info');
                        $('#message-area').html('Acceso exitos!')
                                          .addClass('text-success')
                                          .fadeTo(900,1);
 
                        // if access ok, reload or redirect to page 
                        //document.location='index.php';
                        //document.location.reload();
                    });			  
                });
            
            // if any error found ... 
		    } else {
 
				// Enable access button again fot retry again
                $("#access").attr("disabled", false); 
                
                // Show message error
		  	    $("#message-area").fadeTo(200, 0.1, function() { 			 
                    $(this).html('Error al intentar iniciar sesión :(')
                           .addClass('text-danger')
                           .fadeTo(900, 1);
			    });		
            }		
            
            // Debug Console
            if (debug == true) {
                console.log("todo: "+JSON.stringify(data)); // cobnvert data json to string
                console.log("email: "+data.email);
                console.log("passw: "+data.password);  
                console.log("auth: "+data.auth); }    
 
        }, "json"); // return json data
        
 		return false;
	});
 
});