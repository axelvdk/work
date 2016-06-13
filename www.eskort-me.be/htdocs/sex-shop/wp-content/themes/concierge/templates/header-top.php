
<?php global $concierge_option_data; ?>


<?php if(isset($concierge_option_data['concierge-top-header']) && $concierge_option_data['concierge-top-header'] == 1) : ?>

	<div class="header-tool-bar">
	    <div class="container">
	      	<div class="row">

		        <!-- Start Header-Left -->
		        <div class="col-lg-4 col-md-5 col-xs-12 header-left">

		            <!-- Start Header-Contact -->
			        <ul class="custom-list header-contact">

			        	<?php if(isset($concierge_option_data['concierge-phone']) && !empty($concierge_option_data['concierge-phone'])) : ?>
			            <li><i class="fa fa-phone"></i><?php echo esc_attr($concierge_option_data['concierge-phone'] ); ?></li>
			        	<?php endif; ?>

			        	<?php if(isset($concierge_option_data['concierge-email']) && !empty($concierge_option_data['concierge-email'])) : ?>
			            <li><i class="fa fa-envelope"></i><a href="mailto:<?php echo esc_attr($concierge_option_data['concierge-email']); ?>"><?php echo esc_attr($concierge_option_data['concierge-email']); ?></a></li>
			        	<?php endif; ?>

			        </ul>
		            <!-- End Header-Contact -->

		        </div>
		        <!-- End Header-Left -->

	        	<!-- Start Header-Right -->
	        	<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 col-lg-offset-4 col-md-offset-2 header-right">

					<!-- Start Social -->
					<?php if(isset($concierge_option_data['concierge-share-button']) && $concierge_option_data['concierge-share-button'] == 1) : ?>
					<ul class="header-social custom-list">
						<?php if(isset($concierge_option_data['concierge-share-button-facebook']) && $concierge_option_data['concierge-share-button-facebook'] == 1) : ?>
						<li><a  href="http://www.facebook.com/sharer.php?u=<?php home_url();?> "><i class="fa fa-facebook-square"></i></a></li>
						<?php endif; ?>
						<?php if(isset($concierge_option_data['concierge-share-button-twitter']) && $concierge_option_data['concierge-share-button-twitter'] == 1) : ?>
						<li><a  href="http://twitthis.com/twit?url=<?php home_url(); ?>"><i class="fa fa-twitter-square"></i></a></li>
						<?php endif; ?>
						<?php if(isset($concierge_option_data['concierge-share-button-linkedin']) && $concierge_option_data['concierge-share-button-linkedin'] == 1) : ?>
						<li><a href="http://www.linkedin.com/shareArticle??url=<?php home_url();?>"><i class="fa fa-linkedin-square"></i></a></li>
						<?php endif; ?>
					</ul> 
					<?php endif; ?>
					<!-- End Social -->

					<!-- Start Header-Login -->
					<?php if(isset($concierge_option_data['concierge-login-option']) && $concierge_option_data['concierge-login-option'] == 1) : ?>

					
					<div class="header-login">
		
						<?php $current_user = wp_get_current_user(); ?>	

						<?php if(is_user_logged_in()){ ?>

							<button class="login-toggle header-btn"><i class="fa fa-user"></i> <a href="<?php echo esc_url(home_url()); ?>" title="Logout"><?php echo esc_attr($current_user->user_login ); ?></a></button>

							<div class="header-form header-form-login">			
									
								 <div class = "profile-alignment"><a href="<?php echo esc_url(home_url( ).'/wp-admin/profile.php'); ?>" title="Logout"><i class="fa fa-edit"></i><?php _e( '&nbsp;Profile' , 'casa' ); ?></a></div>		
								 <div class = "profile-alignment"><a href="<?php echo esc_url(wp_logout_url( home_url() )); ?>" title="Logout"><i class="fa fa-power-off"></i><?php _e( '&nbsp;Logout' , 'casa' ); ?></a></div>
								
							</div>

						<?php }else{ ?>

							<button class="login-toggle header-btn"><i class="fa fa-power-off"></i><?php _e( ' Login' , 'casa' ); ?></button>
							<div class="header-form">

								<form id="loginform" class="default-form" action="login" role="form" method="post">
									
									<p class="status"></p>

									<p class="form-row">					
										<input type="text" name="login_username" id="user_login" class="input" value="" size="20" placeholder="User name">
									</p>
									<p class="form-row">					
										<input type="password" name="login_password" id="user_pass" class="input" value="" size="20" placeholder="Password">
									</p>
									
									<p class="submit form-row">
										<input type="submit" name="wp-submit" id="bg-login" class="submit-btn button" value="Log In">
										<input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url()); ?>">
										<input type="hidden" name="testcookie" value="1">
									</p>
									<a href="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>"><?php _e('Forgot Password?', 'takeaway'); ?></a>
									<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
									
								</form>

							</div>

						<?php } ?>


					</div>


					<?php endif; ?>
					<!-- End Header-Login -->

					<!-- Start Header-Language -->

					
					<?php 

						include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

					    if ( is_plugin_active('sitepress-multilingual-cms/sitepress.php') && $concierge_option_data['concierge-top-language'] == 1){
					    	
					    	concierge_wpml_languages();

					    }else{  ?>


							<?php if(isset($concierge_option_data['concierge-top-language']) && $concierge_option_data['concierge-top-language'] == 1) : ?>
							<div class="header-language">
								<?php if(isset($concierge_option_data['concierge-language']) && is_array($concierge_option_data['concierge-language']) && !empty($concierge_option_data['concierge-language'])) : ?>
								<button class="header-btn">
									<i class="fa fa-globe"></i>
									EN
								</button>
								<nav class="header-form">
									<ul class="custom-list">
										<?php foreach($concierge_option_data['concierge-language'] as $key => $value){ ?>

										<li ><a href="#"><?php echo esc_attr($value); ?></a></li>
										
										<?php } ?>
									</ul>
								</nav>
								<?php endif; ?>
							</div>
							<?php endif; ?>

					<?php } ?>
					<!-- End Header-Language -->

		        </div>
		        <!-- End Header-Right -->

	      	</div>
	    </div>
	</div>

<?php endif; ?>
