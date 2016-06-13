<input type="text" placeholder="Quick Search" class="form-control" data-ng-model="QuickSearch">

<form  class="default-form">

	<!-- Start Propities Availability -->
	<div class="fleets-availability box-row">
		<h5 class="filter-title"><?php _e('Available on','concierge'); ?></h5>
		<p class="form-row">
			<span class="hire-input calendar">
				<input type="text" name="hireOn" data-ng-model="dateData.starton_date" placeholder="Hire On" data-dateformat="d-m-20y">
				<i class="fa fa-calendar"></i>
			</span>
		</p>
		<p class="form-row">
			<span class="return-input calendar">
				
				<input type="text" name="RetunOn" data-ng-model="dateData.returnon_date" data-ng-change="grabDate(dateData)" placeholder="Return On" data-dateformat="d-m-20y">
				<i class="fa fa-calendar"></i>
			</span>
		</p>
	</div>
	<!-- End Propities Availability -->

</form>




					

					<script type="text/ng-template" id="items_renderer.html">


						<!-- for taxonomy  -->
						<div ng-if="item.option =='taxonomy' && !item.parent_taxonomy">

								<h5>{{ item.title }}</h5>

								<div data-ng-if="item.taxonomy">

									<div data-ng-show="item.viewType == 'checkbox'">
										<ul class="concierge-checkbox">
											<li data-ng-repeat="(key, value) in item.alloption">
											  <input type="checkbox" data-ng-change="grabResult( this ,formData[item.taxonomy][key], item)"  name="{{value}}" data-ng-model="formData[item.taxonomy][key]"  > {{value}}
											</li>
										</ul>
									</div>

                                    <div data-ng-show="item.viewType == 'select'">
                                        <select class="form-control" data-ng-change="grabResult( this ,formData[item.taxonomy] , item)" data-ng-model="formData[item.taxonomy]">
                                            <option value="">Please select</option>

                                            <option value="{{key}}" data-ng-repeat="(key ,value) in item.alloption">{{value}}</option>
                                        </select>
                                    </div>

								</div>

						</div>





						<!-- for metadata   -->

						<div data-ng-if="item.option == 'metadata' ">
							<h5>{{ item.title }}</h5>	
							<div data-ng-if="item.viewType =='range' ">
     								<div class="range-slider clearfix">
										<div slider min="item.rangeStart"  max="item.rangeEnd" start="item.start" end="item.end" class="cdbl-slider" onend="grabMeta()" onchnage="addTometa(item.metakey ,item.start , item.end)" key="item.metakey" ></div>
										<br/>
										<span> {{item.start}} </span>
     									<span style="float:right;"> {{item.end}} </span>
									</div>
							</div>
							<div data-ng-show="item.viewType == 'checkbox' ">
								<ul data-ng-if="item.metakey">
									<li data-ng-repeat="(key, value) in item.alloption">
									  <input type="checkbox" data-ng-change="grabMeta()" name="{{value}}" data-ng-model="formMeta[item.metakey][value]"> {{value}}
									</li>
								</ul>
							</div>
							<div data-ng-show="item.viewType == 'radio' ">
								<ul data-ng-if="item.metakey">
									<li data-ng-repeat="(key, value) in item.alloption">
									  <input type="radio"   name="{{item.metakey}}" data-ng-model="formMeta[item.metakey]" data-ng-value="{{value}}"  data-ng-change="grabMeta()"> {{value}}
									</li>
								</ul>					
							</div>
							<div data-ng-show="item.viewType == 'select' ">								
                                    <select class="form-control" data-ng-change="grabMeta()" data-ng-model="formMeta[item.metakey]" data-ng-options="o as o for o in item.alloption"> <option value="">All</option></select>
     						</div>

						</div>





						<!--  second stage  , it will show after its parent show  	-->		
						<div data-ng-show="selected_taxonomy.indexOf(item.parent_taxonomy)!=-1">
								<h3>{{ item.title }}</h3>	


                            <div data-ng-if="item.taxonomy">

                                <div data-ng-show="item.viewType == 'checkbox'">
                                    <ul>
                                        <li data-ng-repeat="(key, value) in item.alloption">
                                            <input type="checkbox" data-ng-change="grabResult( this ,formData[item.taxonomy][key], item)"  name="{{value}}" ng-model="formData[item.taxonomy][key]"  > {{value}}
                                        </li>
                                    </ul>
                                </div>

<!--                                <div data-ng-show="item.viewType == 'select'">-->
<!--                                    <select class="form-control" data-ng-change="grabResult( this ,formData[item.taxonomy] , item)" data-ng-model="formData[item.taxonomy]">-->
<!--                                        <option value="">Please select</option>-->
<!--                                        <option value="{{key}}" ng-repeat="(key ,value) in item.alloption">{{value}}</option>-->
<!--                                    </select>-->
<!--                                </div>-->

                            </div>

						</div>	
						<div data-ng-repeat="item in item.items" data-ng-include="'items_renderer.html'"></div>




					</script>


					<div ng-repeat="item in list" ng-include="'items_renderer.html'"></div>	 

					<a data-ng-click="doFilter()" class="btn btn-primary filter-btn filter-btn" href="#"> <?php  _e('Filter','atmf');  ?></a>
					<a data-ng-click="doReset()" class="btn btn-primary filter-btn reset-btn" href="#"> <?php  _e('Reset','atmf');  ?></a>