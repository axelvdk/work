<?php  
/**
 * Template Name: Contact-us
 *
 */
get_header();

?>


<?php 

	$company_address_info = get_post_meta(get_the_ID(), '_concierge_contact_address', true);

 ?>



<!-- Start Contact -->
<section class="contact-map style-2">

	<!-- Start Map Contact -->
	<div id="map-contact2" style="width: 100%; height: 577px;"></div>
	<!-- End Map Contact -->

	<div class="container">

		<!-- Start Contact-Form -->
		<div class="col-lg-6 col-lg-offset-6 col-md-6 col-md-offset-6 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
			<div class="contact-form">
				<h5 class="contact-form-title"><?php _e('Send us a message','concierge'); ?></h5>
				<img src="<?php echo esc_url(CONCIERGE_IMAGE); ?>divisor2.png" alt="" class="divisor">
				<form id = "send_mail_to_office" class="default-form">
					<p class="alert-message warning"><i class="ico fa fa-exclamation-circle"></i> <?php _e('All fields are required!','conciege'); ?></p>
					<div class="row">

						<?php if(isset($company_address_info) && !empty($company_address_info)) : ?>

							<?php $agency_send_mail = array(); ?>
				
							<?php foreach($company_address_info as $key => $value) { ?>


								<?php foreach($value['_email'] as $email_key => $email_value){ ?>	
									<?php

										$agency_send_mail[$email_value] = $value['_location']; 
										
									?>
								<?php } ?>	


							<?php } ?>	

						<?php endif; ?>

							<?php _log($agency_send_mail); ?>

								<div class="col-lg-12">
									<p class="form-row">
										<span class="people select-box">
											<?php if(isset($agency_send_mail)) : ?>
											<select name="email_to" data-placeholder="">
												
												<?php foreach($agency_send_mail as $agency_key => $agency_value){ ?>
													<option value ="<?php echo esc_attr($agency_key); ?>"><?php echo esc_attr($agency_value); ?></option>
												<?php } ?>
												
											</select>
											<?php endif; ?>
										</span>
									</p>
								</div>
							

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<p class="form-row">
								<input class="required" name="name" type="text" placeholder="Name">
							</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<p class="form-row">
								<input class="required" name="phone" type="text" placeholder="Phone">
							</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<p class="form-row">
								<input class="required" name="email" type="text" placeholder="Email">
							</p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<p class="form-row">
								<input class="required" name="topics" type="text" placeholder="Topic">
							</p>
						</div>
					</div>
					<p class="form-row">
						<textarea name="message" placeholder="How we can help?"></textarea>
					</p>
					<button class="btn light"><?php _e('Send Message','concierge'); ?></button>
					<div class="send-mail-success">
						<h5 class="success-msg"> <?php _e( 'Message send successfully !', 'concierge' ); ?></h5>
					</div>  

				</form>
			</div>
		</div>
		<!-- End Contact-Form -->
	</div>

</section>
<!-- End Contact -->



<!-- Start Locations -->
<section class="locations">
	<div class="container">
		<div class="row">

			<!-- Start Location-Agency -->
			<div class="location-agency">

				
				<?php if(isset($company_address_info) && !empty($company_address_info)) : ?>
				
					<?php foreach($company_address_info as $key => $value) { ?>

						
						<div class="col-lg-6 col-md-6">
							<h3 class="location-agency-title"><?php echo esc_attr($value['_location']); ?></h3>
							<h5 class="location-agency-subtitle"><?php _e('Office','concierge'); ?></h5>

							<ul class="custom-list location-agency-contact col-lg-6 col-md-6">

								<?php foreach($value['_field'] as $field_key => $field_value){ ?>	
									<li><?php echo esc_attr($field_value); ?></li>
								<?php } ?>

							</ul>
							
							<ul class="custom-list location-agency-contact col-lg-6 col-md-6">
								<?php foreach($value['_phone'] as $phone_key => $phone_value){ ?>	
									<li><?php echo esc_attr('Phone '.intval($phone_key+1).' :&nbsp; '); ?><?php echo esc_attr($phone_value); ?></li>
								<?php } ?>	
								<?php foreach($value['_fax'] as $fax_key => $fax_value){ ?>	
									<li><?php echo esc_attr('Fax '.intval($fax_key+1).' :&nbsp; '); ?><?php echo esc_attr($fax_value); ?></li>
								<?php } ?>						
							</ul>

							<ul class="custom-list location-agency-contact col-lg-6 col-md-6">

								<?php foreach($value['_field2'] as $field_key => $field_value){ ?>	
									<li><?php echo esc_attr($field_value); ?></li>
								<?php } ?>

							</ul>

							<ul class="custom-list location-agency-contact col-lg-6 col-md-6">
								<?php foreach($value['_email'] as $email_key => $email_value){ ?>	
									<li><?php echo esc_attr('Email '.intval($email_key+1).' :&nbsp; '); ?><?php echo esc_attr($email_value); ?></li>
								<?php } ?>	
								<?php foreach($value['_website'] as $website_key => $website_value){ ?>	
									<li><?php echo esc_attr('Website '.intval($website_key+1).' :&nbsp; '); ?><?php echo esc_attr($website_value); ?></li>
								<?php } ?>	
							</ul>




						</div>

					<?php } ?>	

				<?php endif; ?>


			<!-- End Location-Agency -->

		</div>
	</div>
</section>
<!-- End Locations -->

<!-- Start Partners -->
<section class="partners">
<?php get_template_part( 'templates/concierge', 'partner'); ?>  
</section>  
<!-- End Partners --> 



<?php get_footer();   ?>
	