(function($){

	/*start template showing*/

	"use strict";
	
	$('#concierge_front_page').hide();	

	var currentTemplate = $('#page_template').val();

	if(currentTemplate === 'Home-page.php' || currentTemplate === 'templates/about.php'){
		$('#concierge_front_page').show();
	}


	$('#page_template').change(function(){

		var template = $(this).val();
		
		if(template === 'Home-page.php' || template === 'templates/about.php'){					
			$('#concierge_front_page').show('slow');
		}else{
			$('#concierge_front_page').hide('slow');			
		}


	});

	/*end template showing*/


	/*admin panel include map start*/	

	$('#_concierge_property_address_map_canvas').closest("table").addClass("google_map");
	jQuery(".google_map").parent().append('<div id="map_canvas" style="height: 450px; width: 100%">' );


	$('#_map_ca_0').closest("table").addClass("google_map");
	jQuery(".google_map").parent().append('<div id="map_canvas" style="height: 450px; width: 100%">' );

	/*admin panel include map end*/



	/*page templete show or hide start*/

	$('#concierge_contact_address').hide();
	$('#_concierge_property_address_page_templates').closest('#concierge_property_address').hide();

	var currentTemplate = $('#page_template').val();

	if(currentTemplate === 'templates/contact-us.php'){
		
		$('#concierge_contact_address').show();
		$('#_concierge_property_address_page_templates').closest('#concierge_property_address').show();
		
	}


	$('#page_template').change(function(){

		var template = $(this).val();

		if(template === 'templates/contact-us.php'){
			
			$('#concierge_contact_address').show('slow');
			$('#_concierge_property_address_page_templates').closest('#concierge_property_address').show('slow');	

		}else{

			$('#concierge_contact_address').hide('slow');
			$('#_concierge_property_address_page_templates').closest('#concierge_property_address').hide('slow');
		}		
	});

	/*page templete show or hide end */



	/*arranging meta according to product type start*/

	if($("input[type='radio'][name='tax_input[vechicle_type][]']").length){


		var defaultSelectedType = $("input[type='radio'][name='tax_input[vechicle_type][]']").closest('input');	
		var findType = defaultSelectedType[0].nextSibling.data.trim();
	

		if(findType === 'Car transfer'){
			$('#car_transfer_modeldiv').show();
			$('#luxury_cars_modeldiv').hide();
			$('#private_jet_modeldiv').hide();
			$('#yachts_modeldiv').hide();
		}else if(findType === 'Private Jet Charter'){
			$('#car_transfer_modeldiv').hide();
			$('#luxury_cars_modeldiv').hide();
			$('#private_jet_modeldiv').show();
			$('#yachts_modeldiv').hide();
		}else if(findType === 'Limmo/Luxury Cars'){
			$('#car_transfer_modeldiv').hide();
			$('#luxury_cars_modeldiv').show();
			$('#private_jet_modeldiv').hide();
			$('#yachts_modeldiv').hide();
		}else{
			$('#car_transfer_modeldiv').hide();
			$('#luxury_cars_modeldiv').hide();
			$('#private_jet_modeldiv').hide();
			$('#yachts_modeldiv').show();

		}


	}
	

	
	

	$("input[type='radio'][name='tax_input[vechicle_type][]']").change(function() {



        var selectedType = $("input[type='radio'][name='tax_input[vechicle_type][]']:checked").closest('input');      
		
		var findChangeType = selectedType[0].nextSibling.data.trim();
		
		if(findChangeType === 'Car transfer'){
			$('#car_transfer_modeldiv').show('slow');
			$('#luxury_cars_modeldiv').hide('slow');
			$('#private_jet_modeldiv').hide('slow');
			$('#yachts_modeldiv').hide('slow');
			$('#pricing_tablediv').hide('slow');
			$('#concierge_pricing_table').hide('slow');
			
		}else if(findChangeType === 'Private Jet Charter'){
			$('#car_transfer_modeldiv').hide('slow');
			$('#luxury_cars_modeldiv').hide('slow');
			$('#private_jet_modeldiv').show('slow');
			$('#yachts_modeldiv').hide('slow');
			$('#pricing_tablediv').hide('slow');
			$('#concierge_pricing_table').hide('slow');

		}else if(findChangeType === 'Limmo/Luxury Cars'){
			$('#car_transfer_modeldiv').hide('slow');
			$('#luxury_cars_modeldiv').show('slow');
			$('#private_jet_modeldiv').hide('slow');
			$('#yachts_modeldiv').hide('slow');
			$('#pricing_tablediv').hide('slow');
			$('#concierge_pricing_table').hide('slow');
		}else{
			$('#car_transfer_modeldiv').hide('slow');
			$('#luxury_cars_modeldiv').hide('slow');
			$('#private_jet_modeldiv').hide('slow');
			$('#yachts_modeldiv').show('slow');
			$('#pricing_tablediv').hide('slow');
			$('#concierge_pricing_table').hide('slow');

		}


    });

	/*arranging meta according to product type end*/



	var defaultTerm = $("input[type='checkbox'][name='tax_input[pricing_table][]']").closest('input');	
	var findTypeTerm = defaultTerm[0].nextSibling.data.trim();
	


	

})(jQuery);