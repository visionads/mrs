
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */
    $.backstretch("assets/img/backgrounds/1.jpg");

    
    $('#top-navbar-1').on('shown.bs.collapse', function(){
    	$.backstretch("resize");

    });
    $('#top-navbar-1').on('hidden.bs.collapse', function(){
    	$.backstretch("resize");
    });
    
    /*
        Form
    */
    $('.quote-form fieldset:first-child').fadeIn('slow');
    
    $('.quote-form input[type="text"], .quote-form input[type="password"], .quote-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    // next step
    $('.quote-form .btn-next').on('click', function() {
    	var parent_fieldset = $(this).parents('fieldset');
		//console.log(parent_fieldset);
    	var next_step = true;
    	
    	//parent_fieldset.find('input[type="text"], input[type="password"], textarea').each(function() {
    	//	if( $(this).val() == "" ) {
    	//		$(this).addClass('input-error');
    	//		next_step = false;
    	//	}
    	//	else {
    	//		$(this).removeClass('input-error');
    	//	}
    	//});
    	
    	if( next_step ) {
    		parent_fieldset.fadeOut(400, function() {
	    		$(this).next().fadeIn();
	    	});
    	}
    	
    });
    
    // previous step
    $('.quote-form .btn-previous').on('click', function() {
    	$(this).parents('fieldset').fadeOut(400, function() {
    		$(this).prev().fadeIn();
    	});
    });
    
    // submit
    $('.quote-form').on('submit', function(e) {
    	
    	$(this).find('input[type="text"], input[type="password"], textarea').each(function() {
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    });
    
    
});
