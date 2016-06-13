
        
    	<!-- <div class="clearfix"></div> -->
		
		<li class="fleet-vechicle " dir-paginate="post in posts | itemsPerPage: postsPerPage | filter: QuickSearch | orderBy:postOrder.type:postOrder.order">
         
            <div data-ng-if="postView == 'list' ">

                <div class="thumb fleet-thumb">
                    <div class="overlay">
                        <img  data-ng-src="{{ post.post_thumbnail }}"/>
                        <div class="overlay-shadow">
                            <div class="overlay-content">
                                <a href="{{ post.post_permalink }}" class="btn light"><?php _e('Read More','concierge'); ?></a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                

                <div class="content fleet-vechicle-content">
                    <header class="fleet-vechicle-header">
                        <h5><a href="{{ post.post_permalink }}">{{ post.post_title }}</a></h5>
                       
                        <?php if(class_exists('Woocommerce')): ?>

                            <?php 

                                $currency_pos = get_option( 'woocommerce_currency_pos' );


                                switch ( $currency_pos ) {
                                case 'left' :   
                            ?>
                                    <span>Starting <?php echo esc_attr(get_woocommerce_currency_symbol()); ?>{{post.price}}</span>

                            <?php         break;
                                     case 'right' :
                            ?>         
                                    <span>Starting {{post.price}}<?php echo esc_attr(get_woocommerce_currency_symbol()); ?></span>
                            <?php
                                     break;
                                     case 'left_space' :
                            ?>         
                                    <span>Starting <?php echo esc_attr(get_woocommerce_currency_symbol()); ?>&nbsp;{{post.price}}</span>
                            <?php  
                                     break;
                                     case 'right_space' :
                            ?>         
                                    <span>Starting {{post.price}}&nbsp;<?php echo esc_attr(get_woocommerce_currency_symbol()); ?></span>
                            <?php
                                     break;
                                }

                            ?>


                         <?php endif; ?> 

                    </header>
                    <ul class="custom-list properties fleet-vechicle-properties left-side pull-left">
                        <li data-ng-if="post.vehicle_age"><?php _e('Vehicle Age','concierge'); ?> <strong>{{post.vehicle_age}}</strong></li>
                        <li data-ng-if="post.people_capacity"><?php _e('Capacity (People) ','concierge'); ?><strong>{{post.people_capacity}}+{{post.additional_people}}</strong> </li>
                        <li data-ng-if="post.max_speed"><?php _e('Max Speed ','concierge'); ?><strong>{{post.max_speed}}</strong> </li>
                    </ul>
                    <ul class="custom-list properties fleet-vechicle-properties right-side pull-right">
                        <li data-ng-if="post.fuel_capacity"><?php _e('Fuel Capacity','concierge'); ?><strong>{{post.fuel_capacity}}</strong></li>
                        <li data-ng-if="post.max_weight"><?php _e('Max Weight','concierge'); ?><strong>{{post.max_weight}}</strong></li>
                        <li data-ng-if="post.min_pilots"><?php _e('Pilots (Min.)','concierge'); ?><strong>{{post.min_pilots}}</strong></li>
                        <li ng-repeat="attribute in post.additional_attrs">
                            {{attribute._name}}<strong>{{attribute._value}}</strong>                               
                        </li>
                    </ul>
                </div>

            </div>

            <div data-ng-if="postView == 'grid'" class="col fleet-grid layout-grid col-md-4 ">

                <div>
                    <div class="overlay">
                        <img data-ng-src="{{ post.post_thumbnail }}"/>
                        <div class="overlay-shadow">
                            <div class="overlay-content">
                                <a href="{{ post.post_permalink }}" class="btn light"><?php _e('Read More','concierge'); ?></a>
                            </div>
                        </div>
                    </div>                        
                </div>

                
				<div class="fleet-vechicle-content">
                    <header class="fleet-vechicle-header">
                        <h5><a href="{{ post.post_permalink }}">{{ post.post_title }}</a></h5>
                         
                         <?php if(class_exists('Woocommerce')): ?>

                            <?php 

                                $currency_pos = get_option( 'woocommerce_currency_pos' );                                

                                switch ( $currency_pos ) {
                                case 'left' :   
                            ?>
                                    <span>Starting <?php echo esc_attr(get_woocommerce_currency_symbol()); ?>{{post.price}}</span>

                            <?php         break;
                                     case 'right' :
                            ?>         
                                    <span>Starting {{post.price}}<?php echo esc_attr(get_woocommerce_currency_symbol()); ?></span>
                            <?php
                                     break;
                                     case 'left_space' :
                            ?>         
                                    <span>Starting <?php echo esc_attr(get_woocommerce_currency_symbol()); ?>&nbsp;{{post.price}}</span>
                            <?php  
                                     break;
                                     case 'right_space' :
                            ?>         
                                    <span>Starting {{post.price}}&nbsp;<?php echo esc_attr(get_woocommerce_currency_symbol()); ?></span>
                            <?php
                                     break;
                                }

                            ?>


                         <?php endif; ?>   

                        
                    </header>


                    <ul class="custom-list fleet-vechicle-properties">
                        <li data-ng-if="post.vehicle_age"><?php _e('Vehicle Age','concierge'); ?> <strong>{{post.vehicle_age}}</strong></li>
                        <li data-ng-if="post.people_capacity"><?php _e('Capacity (People) ','concierge'); ?><strong>{{post.people_capacity}}+{{post.additional_people}}</strong> </li>
                        <li data-ng-if="post.max_speed"><?php _e('Max Speed ','concierge'); ?><strong>{{post.max_speed}}</strong> </li>
                        <li data-ng-if="post.fuel_capacity"><?php _e('Fuel Capacity','concierge'); ?><strong>{{post.fuel_capacity}}</strong></li>
                        <li data-ng-if="post.max_weight"><?php _e('Max Weight','concierge'); ?><strong>{{post.max_weight}}</strong></li>
                        <li data-ng-if="post.min_pilots"><?php _e('Pilots (Min.)','concierge'); ?><strong>{{post.min_pilots}}</strong></li>

                        <li ng-repeat="attribute in post.additional_attrs">
                            {{attribute._name}}<strong>{{attribute._value}}</strong>                               
                        </li>


                    </ul>
                </div>
                
            </div>
		</li>

		<div class="loading" data-ng-show="loading"><i></i><i></i><i></i></div>		
		<alert style="margin-top:200px;" type="danger" data-ng-show="( posts | filter:QuickSearch).length==0">
            <?php _e('Sorry No Result Found','concierge'); ?>
		</alert>
		
		<!-- <div class="clearfix"></div> -->
		
		<!-- Start pagination  -->
        <div class="col-lg-12">
            <div class="fleets-listing-footer clearfix">
    		  <dir-pagination-controls boundary-links="true" class="pull-right" on-page-change="pageChangeHandler(newPageNumber)" template-url="<?php  echo UOU_ATMF_URL .'/assets/js/vendor/angular-utils-pagination/dirPagination.tpl.html';  ?>"></dir-pagination-controls>
    		</div>
        </div>
        <!-- End pagination  -->