<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage concierge
 * @since 1.0
 */
?>

<div <?php post_class( 'post row' ); ?> id="post-<?php the_ID(); ?>">


	<?php if(has_post_thumbnail()){ ?>

	    <div class="col-lg-5 col-sm-5 thumb">

			<?php 

		    	$image_id =  get_post_thumbnail_id( get_the_ID() );
				$large_image = wp_get_attachment_image_src( $image_id ,array(295,295)); 				

			?>
			<a href="<?php the_permalink(); ?>"><img class="thumb" src="<?php echo esc_url($large_image[0]); ?>" alt=""></a>
  	
	    </div>

		<div class="col-lg-7 col-sm-7 post-content">

			<header class="post-header">
				<h5><a href=" <?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<span><a href="<?php the_permalink(); ?>"><?php echo esc_attr(get_the_date('j M Y')); ?></a></span>
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
			
						if(! post_password_required() && ( comments_open() || get_comments_number() )){
							comments_popup_link( 'No comment', '1 comment', '% comments', 'article-post-meta' );
						}
					?>						
				</span>

			</div>

			<div class="entry-content">
				<?php 
					the_excerpt();
				?>

			</div>

			
			<a href="<?php the_permalink(); ?>" class="btn dark"><?php _e('Read More','concierge' ); ?></a>
			

		</div>

	<?php }else{ ?>

		<div class="col-lg-12 post-content">

			<header class="post-header">
				<h5><a href=" <?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<span><a href="<?php the_permalink(); ?>"><?php echo esc_attr(get_the_date('j M Y')); ?></a></span>
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
					
					<?php 
			
						if(comments_open() && !post_password_required()){ ?>
							<i class="fa fa-comment"></i>
							<?php
							comments_popup_link( 'No comment', '1 comment', '% comments', 'article-post-meta' );
						}
					?>						
				</span>

			</div>

			<div class="entry-content">
				<?php 
					the_excerpt();
				?>

			</div>

			
			<a href="<?php the_permalink(); ?>" class="btn dark"><?php _e('Read More','concierge' ); ?></a>
		
			
		</div>


	<?php } ?>

</div>




