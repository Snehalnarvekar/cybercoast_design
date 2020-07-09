jQuery(document).ready(function($) {

	//Add license key
	var licenseKeyForm = $('.rella-license-key-form');
	licenseKeyForm.each(function() {
		var lkf = $(this);	
		lkf.on( 'submit', function(e) {
			var key = jQuery("#rella-license-key", lkf).val();
			if ( key == "" ) {
				jQuery('#rella-license-key', lkf).focus();
				return false;
			} 
			lkf.addClass('form-submitting');
			$.ajax({
				type: 'POST',
				url: ajax_rella_license_key_form_object.ajaxurl,
				data: { 
					'action': 'add_license_key',
					'rella_license_key': $('#rella-license-key', lkf ).val(),
					'security': $('#rella-license-key-nonce', lkf ).val(),
					 },
				success: function(data){
					lkf.removeClass('form-submitting');
					$('#rella_rlk_response').html(data);
				},
				error: function( jqXHR, textStatus, errorThrown ) {
					//alert(jqXHR.status); // I would like to get what the error is
				}
			} );
			e.preventDefault();
		});
	});
	
	//Activate license key
	var activelicenseKeyForm = $('.rella-activate-license-key-form');
	activelicenseKeyForm.each(function() {
		var lkf = $(this);	
		lkf.on( 'submit', function(e) {
			lkf.addClass('form-submitting');
			$.ajax({
				type: 'POST',
				url: ajax_rella_license_key_form_object.ajaxurl,
				data: { 
					'action': 'activate_license_key',
					'security': $('#rella-active-license-key-nonce', lkf ).val(),
					 },
				success: function(data){
					lkf.removeClass('form-submitting');
					$('#rella_activate_key_response').html(data);
				},
				error: function( jqXHR, textStatus, errorThrown ) {
					//alert(jqXHR.status); // I would like to get what the error is
				}
			} );
			e.preventDefault();
		});
	});
	
	//Deactivate license key
	var deactivelicenseKeyForm = $('.rella-deactivate-license-key-form');
	deactivelicenseKeyForm.each(function() {
		var lkf = $(this);	
		lkf.on( 'submit', function(e) {
			lkf.addClass('form-submitting');
			$.ajax({
				type: 'POST',
				url: ajax_rella_license_key_form_object.ajaxurl,
				data: { 
					'action': 'deactivate_license_key',
					'security': $('#rella-deactive-license-key-nonce', lkf ).val(),
					 },
				success: function(data){
					lkf.removeClass('form-submitting');
					$('#rella_deactivate_key_response').html(data);
				},
				error: function( jqXHR, textStatus, errorThrown ) {
					alert(jqXHR.status); // I would like to get what the error is
				}
			} );
			e.preventDefault();
		});
	});

});