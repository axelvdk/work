
<?php get_header(); ?>


    <!-- Start News -->
    <section class="news">
      <div class="container">
        <div class="row">

          <!-- Start News-Posts -->
          <div class="col-lg-8 col-md-8">

            <div class="news-posts">

              <!-- start single blog post --> 

              <?php if(have_posts()) : while(have_posts()): the_post(); ?>

                <?php get_template_part( 'templates/content', get_post_format()); ?>

                
              <?php endwhile; else : ?>               
                  <h5><?php _e( 'Sorry ! no blog post found ', 'concierge' ); ?></h5>     
              <?php endif; ?>

              <!-- end single blog post --> 

            </div>
            
             <!-- Start News-Posts Pagination -->

            <?php $posts_per_page = get_option( 'posts_per_page' );  ?>
            <?php $total_post = wp_count_posts( 'post');  ?> 

            <?php if($posts_per_page < $total_post->publish) : ?>

            <ul class="news-posts-pagination">

              <?php concierge_pagination($pages = '', $range = 2); ?>              
              
            </ul>

            <?php endif; ?>

            <!-- End News-Posts Pagination -->

          </div>
          <!-- End News-Posts -->

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

<?php get_footer();   ?>
    



    