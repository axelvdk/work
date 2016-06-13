<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage concierge
 * @since 1.0
 */

 get_header();

?>




<!-- Start News section -->
<section class="news">
  	<div class="container">
    	<div class="row">

	      	<!-- Start Single-Posts -->
	      	<div class="col-lg-8 col-md-8">
	        	<div class="single-post">
	          		<div class="post row">
			            <div class="col-lg-12 post-content">


							

							<?php if ( has_post_thumbnail() ) { ?>

								<div class="blog-post-img">

									<?php 

										$image_id =  get_post_thumbnail_id( get_the_ID() );
										$large_image = wp_get_attachment_image_src( $image_id ,'large');  										

									?>
									<img src="<?php echo esc_url($large_image[0]); ?>" alt="" class="main-photo">
								
								</div>

							<?php } ?>
								
							
							<header class="post-header">
								<h5><?php the_title(); ?></h5>
								<span><?php echo esc_attr(get_the_date('j M Y')); ?></span>
							</header>

							<div class="post-meta">

								<?php if(has_category()): ?>
									<span class="category">
										<i class="fa fa-tags"></i>
										<?php the_category('&nbsp;,&nbsp;'); ?>
									</span>
								<?php endif; ?>

								<span class="author">
									<i class="fa fa-user"></i>
									<?php the_author_posts_link(); ?>
								</span>

								<span class="comments">
									<i class="fa fa-comment"></i>
									<?php 
							
										if(comments_open() && !post_password_required()){
											comments_popup_link( 'No comment', '1 comment', '% comments', 'article-post-meta' );
										}
									?>						
								</span>

							</div>	

							<div class="entry-content">

								<?php 

									the_content();
									wp_link_pages( array(
										'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span>',
										'link_after'  => '</span>',
									) ); 
									
								?>
								
							</div> 



							<!-- Start Tags-List -->

							<?php if(has_tag()) : ?>

								<?php the_tags('<ul class="custom-list tags-list"><li>','</li><li>','</li></ul>'); ?>
							
							<?php endif; ?>
							<!-- End Tags-List -->



							<!-- Start Post-Share -->
							<?php if(isset($concierge_option_data['concierge-share-button']) && $concierge_option_data['concierge-share-button'] == 1) : ?>

							<div class="post-share">
								<p class="pull-left"><?php _e('Share this story','concierge'); ?></p>
								<ul class="custom-list social pull-right">
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
							</div>
							
							<?php endif ?>
							<!-- End Post-Share -->




							<!-- Start Post-Comments -->
							<div class="post-comments">
								<?php comments_template('', true); ?>
							</div>
							<!-- End Post-Comments -->


			            </div> <!-- end post-content -->


	        		</div> <!-- end post row -->
	        	</div>  <!-- end single-post div -->


	      	</div> <!-- end col-md-8 -->

		    <!-- Start Sidebar -->
		    <div class="col-lg-4 col-md-4">
		       
		       <?php get_sidebar(); ?>
		       
		    </div>
		    <!-- End Sidebar -->
    	</div>
  	</div>
</section>
<!-- End News -->


<!-- Start Partners -->
<section class="partners">
<?php get_template_part( 'templates/concierge', 'partner'); ?>  
</section>  
<!-- End Partners --> 



<?php get_footer(); ?>





