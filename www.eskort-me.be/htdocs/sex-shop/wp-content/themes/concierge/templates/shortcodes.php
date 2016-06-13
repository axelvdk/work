<?php  
/**
 * Template Name: Shortcodes
 *
 */
get_header();

?>


<section class="shortcodes">
    <div class="container">

        <div class="mt90"></div>

        <?php echo do_shortcode( the_content() ); ?>

    </div>

</section>






    
<?php get_footer();   ?>    