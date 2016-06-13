<?php 

	global $concierge_option_data;

 ?>


<?php if(isset($concierge_option_data['concierge-partners-switch']) && !empty($concierge_option_data['concierge-partners-switch'])) : ?>

	
	<?php if(isset($concierge_option_data['concierge-our-partners']) && !empty($concierge_option_data['concierge-our-partners'])){ ?>
		
		
			<div class="container">
				<div class="row">

					<!-- Start Preamble -->
					<div class="col-lg-12 preamble">
						<h5><?php _e('Our Partners','concierge'); ?></h5>
					</div>
					<!-- End Preamble -->

					<!-- Start Partner -->

					<?php foreach ($concierge_option_data['concierge-our-partners'] as $key => $value) { ?>

						<?php if(!empty($value['image'])){ ?>
							<div class="col-lg-3 col-md-3 col-sm-3 company">
								<a href="<?php echo esc_url($value['url']); ?>"><img src="<?php echo esc_url($value['image']); ?>" alt=""></a>
							</div>
						<?php } ?>

					<?php } ?>

				</div>
			</div>
		

	<?php } ?>

<?php endif; ?>