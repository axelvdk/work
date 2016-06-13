<div class="header-nav">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">

			<!-- Start Nav -->
			<nav role="navigation">


				<?php 

					$defaults = array(
						'theme_location'  => 'primary_navigation_left',
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'menu-left',
						'menu_id'         => '',
						'echo'            => true,						
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>',
						'depth'           => 4,
						'fallback_cb'     => 'concierge_nav_walker_left::fallback',
						'walker'          => new concierge_nav_walker_left()
					);

						
					wp_nav_menu( $defaults );

				?>




				<?php 

					$defaults = array(
						'theme_location'  => 'primary_navigation_right',
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'menu-right',
						'menu_id'         => '',
						'echo'            => true,						
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="nav navbar-nav navbar-right %2$s">%3$s</ul>',
						'depth'           => 4,
						'fallback_cb'     => 'concierge_nav_walker_left::fallback',
						'walker'          => new concierge_nav_walker_left()
					);

					wp_nav_menu( $defaults );

				?>
				
			</nav>
			<!-- End Nav -->

			</div>
		</div>
	</div>
</div>