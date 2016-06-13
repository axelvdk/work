<?php
/**
 * Template Name: ATMF Search Page
 *
 * A template used to demonstrate how to include the template
 * using this plugin.
 *
 * @package ATMF
 * @since 	1.0.0
 * @version	1.0.0
 */

 	get_header();

 	global $concierge_option_data;
?>

<!--START : DO NOT DELETE THIS BLOCK -->
<div id="dso" style="display: none;">
    <?php do_action('atmf_hidden_data_show'); ?>
</div>
<!--END: DO NOT DELETE THIS BLOCK -->

<section class="fleets">
	<div data-ng-app="atmf" ng-cloak>
		<div data-ng-controller="AtmfFrontEnd">
			<div class="container">
				<div class="row items-container">
				
					<!-- start of main  -->
					<div class="col-lg-3 item sidebar" rel="sidebar">
						<div class="fleets-filters toggle-container">
							<h5 class="fleets-filters-title toggle-title"><?php _e('Filters','concierge'); ?></h5>
							<aside class="toggle-content">
								<?php  get_search_sidebar(); ?>
							</aside>
						</div>
					</div>
					<!-- end of sidebar  -->

					<div class="col-md-9 fleet-list">

						<div class="fleets-listing-header clearfix">	
							<h5><?php _e('Available Vechicles','concierge'); ?></h5>

							<input type="hidden" id="selectView"  value="<?php echo esc_attr($concierge_option_data['concierge_select_template_view']); ?>">

				            
				            <!-- Start pagination  -->
				           
							<!-- End pagination  -->
							<div class="fleet-list-inner">

								<div class="list-grid-toggle">

									<?php if($concierge_option_data['concierge_select_template_view'] === 'list'): ?>

										<ul class="view-toggle">
							                <li class="listView"><a href="#"  data-ng-click="postView='list'; activeLayout = !activeLayout;" data-layout="with-thumb" data-ng-class="activeLayout ? '': 'active' "><i class="fa fa-list-ul"></i></a></li>
							                <li class = "gridView"><a href="#"  data-ng-click="postView='grid'; activeLayout = !activeLayout;" data-layout=""  data-ng-class="activeLayout ? 'active': '' "><i class="fa  fa-th"></i></a></li>
							            </ul>

						        	<?php endif; ?>

						        	<?php if($concierge_option_data['concierge_select_template_view'] === 'grid'): ?>

										<ul class="view-toggle">
							                <li class="listView"><a href="#"  data-ng-click="postView='list'; activeLayout = !activeLayout;" data-layout="with-thumb" data-ng-class="activeLayout ? 'active': '' "><i class="fa fa-list-ul"></i></a></li>
							                <li class = "gridView"><a href="#"  data-ng-click="postView='grid'; activeLayout = !activeLayout;" data-layout=""  data-ng-class="activeLayout ? '': 'active' "><i class="fa  fa-th"></i></a></li>
							            </ul>

						        	<?php endif; ?>

					            </div>

					            <!-- Start pagination  -->
								<dir-pagination-controls boundary-links="true"  on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php  echo UOU_ATMF_URL .'/assets/js/vendor/angular-utils-pagination/dirPagination.tpl.html';  ?>"></dir-pagination-controls>
								<!-- End pagination  -->


					            <div class="select-number" >

					                <select class="form-control"  data-ng-model="postsPerPage">
					                    <option value="3">3</option>
					                    <option value="6">6</option>
					                    <option value="9">9</option>
					                    <option value="12">12</option>
					                    <option value="15">15</option>
					                    <option value="18">18</option>
					                    <option value="21">21</option>
					                    <option value="24">24</option>
					                </select>
					            </div>
				            </div>		           


			        	</div>
			        </div>

					<!-- Start of main  -->	
					<div class="col-md-9 item main" rel="main">
						<div class="fleet-listing">
							<div class="row">
								 <ul data-ng-if="postView == 'list' " class="custom-list fleet-list layout-list">
									<?php  get_search_result(); ?>
								</ul>
								<ul data-ng-if="postView == 'grid' " class="custom-list fleet-list  layout-grid">
									<?php  get_search_result(); ?>
								</ul>
							</div>
						</div>
					</div>	
					<!-- end of main  -->			

				</div> <!--  end row  -->
			</div><!--   end container  -->
		</div>
	</div>
</section>



<!-- Start Partners -->
<section class="partners">
<?php get_template_part( 'templates/concierge', 'partner'); ?>  
</section>  
<!-- End Partners --> 

<?php  

 get_footer();




