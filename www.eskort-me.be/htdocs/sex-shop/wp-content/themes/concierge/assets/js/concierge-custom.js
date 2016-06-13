(function($){

	"use strict";

	/*start for reponsive videos*/
	$(".post-content").fitVids();
	/*end for responsive videos*/

	// get test settings
    var byRow = $('body').hasClass('test-rows');

    // apply matchHeight to each item container's items
    $('.items-container').each(function() {
        $(this).children('.item').matchHeight(byRow);
    });


	jQuery("div.custom-list").first().addClass("first-widget");


	/*casa comment from modification start*/

	$('.post-comments').children('.comment-respond').addClass('post-addcomment');
	$('.post-comments').children('.comment-respond').children('form.comment-form').addClass('default-form');
	$('.post-comments').children('.comment-respond').children('form.comment-form').children('p.form-submit').hide();
	
	/*casa comment from modification end*/


	// typehead to see all country list

	var substringMatcher = function(strs) {
	  return function findMatches(q, cb) {
	    var matches, substrRegex;
	 
	    // an array that will be populated with substring matches
	    matches = [];
	 
	    // regex used to determine if a string contains the substring `q`
	    substrRegex = new RegExp(q, 'i');
	 
	    // iterate through the pool of strings and for any string that
	    // contains the substring `q`, add it to the `matches` array
	    $.each(strs, function(i, str) {
	      if (substrRegex.test(str)) {
	        // the typeahead jQuery plugin expects suggestions to a
	        // JavaScript object, refer to typeahead docs for more info
	        matches.push({ value: str });
	      }
	    });
	 
	    cb(matches);
	  };
	};


	 
	if(typeof(vechicle_location) != "undefined"){

		$('.typeahead').typeahead({
			hint: true,
			highlight: true,
			minLength: 1
		},
		{
			name: 'states',
			displayKey: 'value',
			source: substringMatcher(vechicle_location)
		});

	} 

	
	/*typehead to see all country list end*/




	/*banner-inline search start*/

	$('.home-page-fleet-search').submit(function(){

		var type    = $('.banner-search-inner ul.tab-title-list li.active a').data("rel"),
			typeTax = $('.banner-search-inner ul.tab-title-list li.active a').data("typeTax");
		
		var searchFormData = $(this).serializeArray();

		console.log(typeTax);

		var dataObj = {};

		var search_page_id = $('#search-page-id').val();


		$(searchFormData).each(function(i, field){
		  dataObj[field.name] = field.value;
		});


		console.log(dataObj);

		var createSearchBar = '';

		if(dataObj.location != '' && dataObj.location != undefined){		

			createSearchBar += 'location='+dataObj.location+'&';

			if(dataObj.location_tax != '' && dataObj.location_tax != undefined){		

				createSearchBar += 'locationTax='+dataObj.location_tax+'&';
			}
		}

		

		if(dataObj.model != '' && dataObj.model != undefined){		

			createSearchBar += 'model='+dataObj.model+'&';

			if(dataObj.model_tax != '' && dataObj.model_tax != undefined){		

				createSearchBar += 'modelTax='+dataObj.model_tax+'&';
			}	
		}
			


		if(type != '' && type != undefined){		

			createSearchBar += 'vechicleType='+type+'&';

			if(dataObj.vechicle_type_tax != '' && dataObj.vechicle_type_tax != undefined){		

				createSearchBar += 'vechicleTypeTax='+dataObj.vechicle_type_tax+'&';
			}
		}	



		if(dataObj.hireOn != '' && dataObj.hireOn != undefined){
			createSearchBar += 'pickUpDate='+dataObj.hireOn+'&'; 
		}

		if(dataObj.retunOn != '' && dataObj.retunOn != undefined){
			createSearchBar += 'returnDate='+dataObj.retunOn+'&'; 
		}



		console.log(createSearchBar);



		window.location.href = search_page_id+'#/?'+createSearchBar;


		return false;

	});


	/*banner-inline header search end*/


	/*concierge send mail to agency office start*/

	$(".send-mail-success").hide();

	$('#send_mail_to_office').submit(function(e){

		
		var formData = $(this).serializeArray();

		
		$.ajax({
			type:'POST',
			url: ajaxurl,
			data: {'action':'concierge_user_data_for_message', 'form_data': formData	},
			success: function(result){
				
				
				$(".send-mail-success").show().delay(5000).fadeOut();				
			}

		});

		return false;

	});

	/*concierge send mail to agency office end*/



	/*start home page styling */

	$( "section.content-block:nth-child(3)" ).css( "margin-top", "80px" );
	$( "section.content-block:nth-child(5)" ).css( "margin-top", "80px" );
	$( "section.pricing" ).next('.partner-home').css( "margin-top", "0px" );
	$( "section#essentials" ).next('.testimonials-home').css( "margin-top", "0px" );
	$( "section.testimonials-home" ).next('.concierge-tabs').css( "margin-top", "100px" );
	$( "section.testimonials-home" ).next('.partner-home').css( "margin-top", "0px" );


	/*end home page styling*/


	/*start cart page redirect*/

	var cartPageUrl = $('.cart-page-url').val();

	var url = window.location.href;

	if(url.search("=") != -1){

		var splitUrl = url.split("?");
		var splitUrlAgain = splitUrl[1].split("=");

		if(splitUrlAgain[0] == 'add-to-cart'){
			window.location = cartPageUrl;
		}

	}
	
	
	/*end cart page redirect*/



	/*start login script*/

	$('#bg-login').click(function(e){
        e.preventDefault();
        console.log('hi');

        var get_all_data = $('#loginform').serializeArray();

        console.log(get_all_data);

        $.ajax({
        	
            url: ajaxurl+'?action=bg_login',
            type: 'POST',
            dataType:"json",
            data: get_all_data,
            success:function(result){

            	console.log(result);
			    if(!result.loggedin){
			        $(".status").html(result.message).show(0).delay(5000).hide(0);
			    }else{

					$(".status").html(result.message).show(0).delay(5000).hide(0);
					window.location.href = result.url;
			    }

            }
        });

    });


	/*end login script*/









})(jQuery);	