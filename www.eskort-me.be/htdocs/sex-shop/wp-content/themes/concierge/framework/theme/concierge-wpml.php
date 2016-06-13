<?php 

	

	function concierge_wpml_languages(){


		global $concierge_option_data;

		$languages = icl_get_languages('skip_missing=0');
		$wpml_select = $concierge_option_data['concierge-wpml-select'];
	
		echo '<div class="header-language">';

			if($wpml_select === 'name'){


				foreach ($languages as $language) {

					if($language['active']){						
						echo '<a class="header-btn" href="'.$language['url'].'">';
							echo '<span>'.$language['translated_name'].'</span>';
							echo '<i class="fa fa-angle-down"></i>';
						echo '</a>';				
					}
				}

				echo '<nav class="header-form">';
					echo '<ul class="custom-list">';
						foreach ($languages as $language) {
						
							if( !$language['active'] ){
								
								echo '<li><a href="'.$language['url'].'">'.$language['translated_name'].'</a></li>';
								
							}
						}
					echo '</ul>';
				echo '</nav>';

			}elseif($wpml_select === 'code'){


				foreach ($languages as $language) {

					if($language['active']){						
						echo '<a class="header-btn" href="'.$language['url'].'">';
							echo '<span>'.$language['language_code'].'</span>';
							echo '<i class="fa fa-angle-down"></i>';
						echo '</a>';				
					}
				}

				echo '<nav class="header-form">';
					echo '<ul class="custom-list">';
						foreach ($languages as $language) {
						
							if( !$language['active'] ){
								
								echo '<li><a href="'.$language['url'].'">'.$language['language_code'].'</a></li>';
								
							}
						}
					echo '</ul>';
				echo '</nav>';


			}else{


				foreach ($languages as $language) {

					if($language['active']){						
						echo '<a class="header-btn" href="'.$language['url'].'">';
							echo '<span><img src="'.$language['country_flag_url'].'"></span>';
							echo '<i class="fa fa-angle-down"></i>';
						echo '</a>';				
					}
				}

				echo '<nav class="header-form">';
					echo '<ul class="custom-list">';
						foreach ($languages as $language) {
						
							if( !$language['active'] ){
								
								echo '<li><a href="'.$language['url'].'"><img src="'.$language['country_flag_url'].'"></a></li>';
								
							}
						}
					echo '</ul>';
				echo '</nav>';
			}





		echo '</div>'; /*end header*/
		
		

	}	

 ?>
