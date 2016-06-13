(function($) {
"use strict";   
 

              


 			//Shortcodes
            tinymce.PluginManager.add( 'zillaShortcodes', function( editor, url ) {

				editor.addCommand("zillaPopup", function ( a, params )
				{
					var popup = params.identifier;
					tb_show("Insert Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 800);
				});
     
                editor.addButton( 'zilla_button', {
                    type: 'splitbutton',
                  //  image: "https://dl.dropboxusercontent.com/u/37351231/icon.png",
                    icon: false,
                    text:'Shortcode',
					title:  'Shortcodes',
					onclick : function(e) {},
					menu: [

							{text: 'Service',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Service',identifier: 'service'})
								 
							}},

							{text: 'About Us',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'About Us',identifier: 'about_us'})
								 
							}},

							{text: 'Our Team',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Our Team',identifier: 'our_team'})
								 
							}},

							{text: 'Testimonial',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Testimonial',identifier: 'testimonial'})
								 
							}},

							{text: 'Pricing',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Pricing',identifier: 'pricing'})
								 
							}},

							{text: 'Partner',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Partner',identifier: 'partner'})
								 
							}},

							{text: 'Accordion',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Accordion',identifier: 'accordion'})
								 
							}},

							{text: 'Buttons',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Buttons',identifier: 'button'})
								 //editor.insertContent('Title: ');
							}},
							{text: 'Content Block',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Content Block',identifier: 'content_block'})
								 //editor.insertContent('Title: ');
							}},

							{text: 'Content Block With Social Link',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Content Block With Social Link',identifier: 'content_block_socila_link'})
								 //editor.insertContent('Title: ');
							}},	

							{text: 'Typography',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'typography',identifier: 'typography'})
								 //editor.insertContent('Title: ');
							}},

							{

					            text: 'Columns',
					            menu: [
					            	{text: 'row', onclick: function() {editor.insertContent('[row] [/row]');}},
					                {text: 'One Half', onclick: function() {editor.insertContent('[one_half] your content here [/one_half]');}},
					                {text: 'One Half Last', onclick: function() {editor.insertContent('[[one_half_last]your content here[/one_half_last]');}},
					                {text: 'One Third', onclick: function() {editor.insertContent('[one_third] your content here [/one_third]');}},
					                {text: 'One Third Last', onclick: function() {editor.insertContent('[one_third_last] your content here [/one_third_last]');}},
					                {text: 'One Fourth', onclick: function() {editor.insertContent('[one_fourth] your content here [/one_fourth]');}},
					                {text: 'One Fourth Last', onclick: function() {editor.insertContent('[one_fourth_last] your content here [/one_fourth_last]');}},
					                {text: 'Three Fourth', onclick: function() {editor.insertContent('[three_fourth] your content here [/three_fourth]');}},
					                {text: 'Three Fourth Last', onclick: function() {editor.insertContent('[three_fourth_last] your content here [/three_four_last]');}},
					                {text: 'One Fourth Second', onclick: function() {editor.insertContent('[one_fourth_second] your content here [/one_fourth_second]');}},
					                {text: 'One Fourth Third', onclick: function() {editor.insertContent('[one_fourth_third] your content here [/one_fourth_third]');}},
					                {text: 'One Half Second', onclick: function() {editor.insertContent('[one_half_second] your content here [/one_half_second]');}},
					                {text: 'One Third Second', onclick: function() {editor.insertContent('[one_third_second] your content here [/one_third_second]');}},
					                {text: 'One Column', onclick: function() {editor.insertContent('[one_column] your content here [/one_column]');}},
					               
					            ]
							},

							/*{text: 'Download',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Download',identifier: 'download'})
								 //editor.insertContent('Title: ');
							}},*/
							{text: 'List',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'List',identifier: 'list'})
								 //editor.insertContent('Title: ');
							}},

							{text: 'Progress',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Progress',identifier: 'progress'})
								 //editor.insertContent('Title: ');
							}},

							/*{text: 'Profile',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Profile',identifier: 'profile'})
								 //editor.insertContent('Title: ');
							}},*/


							/*{text: 'Portfolio',onclick:function(){
								//editor.execCommand("zillaPopup", false, {title: 'Download',identifier: 'download'})
								 editor.insertContent('[portfolio item="10" tags="yes" category=""]');
							}},*/


							{text: 'Tabs',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Tabs',identifier: 'tabs'})
								 //editor.insertContent('Title: ');
							}},
							/*{text: 'Timeline',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Timeline',identifier: 'timeline'})
								 //editor.insertContent('Title: ');
							}},*/

							/*{text: 'Toggle',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Toggle',identifier: 'toggle'})
								 //editor.insertContent('Title: ');
							}},
*/

							/*{text: 'Video',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'Video',identifier: 'video'})
								 //editor.insertContent('Title: ');
							}},*/

							/*{text: 'Checkbox',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'checkbox',identifier: 'checkbox'})
								 //editor.insertContent('Title: ');
							}},

							{text: 'Radio',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'radio',identifier: 'radio'})
								 //editor.insertContent('Title: ');
							}},*/

							/*{text: 'Rating',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'rating',identifier: 'rating'})
								 //editor.insertContent('Title: ');
							}},*/

							{text: 'Location',onclick:function(){
								editor.execCommand("zillaPopup", false, {title: 'location',identifier: 'location'})
								 //editor.insertContent('Title: ');
							}},




					]

                
        	  });
         
          });
         

 
})(jQuery);



