<?php

class Concierge_Widget_Categories extends WP_Widget {

    function __construct() {
        $widget_ops = array( 'classname' => 'concierge_widget_categories', 'description' => __( "Styled list or dropdown of categories.",'concierge'  ) );
        parent::__construct('Concierge_categories', __('concierge Categories','concierge' ), $widget_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );

        $title = apply_filters('widget_title', empty( $instance['title'] ) ? __( 'concierge_Categories','concierge'  ) : $instance['title'], $instance, $this->id_base);
        $c = ! empty( $instance['count'] ) ? '1' : '0';
        $h = ! empty( $instance['hierarchical'] ) ? '1' : '0';
        $d = ! empty( $instance['dropdown'] ) ? '1' : '0';

        ?>
        
           
           
        <?php echo apply_filters( 'before_category_widget',  $args['before_widget'] ); ?>

            <?php if ( $title ) echo apply_filters('category_before_title',$args['before_title']). esc_attr($title) . apply_filters('category_after_title',$args['after_title']); ?>

            <?php

                $cat_args = array(
                    'orderby' => 'name',
                    'show_count' => $c,
                    'hierarchical' => $h,
                    'hide_if_empty' => true,

                );

                if ( $d ) {

                        $cat_args['show_option_none'] = __('Select Category','concierge' );
                        wp_dropdown_categories(apply_filters('widget_categories_dropdown_args', $cat_args));

                    ?>

                    <script type='text/javascript'>
                        /* <![CDATA[ */
                        var dropdown = document.getElementById("cat");
                        function onCatChange() {
                            if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
                                location.href = "<?php echo home_url(); ?>/?cat="+dropdown.options[dropdown.selectedIndex].value;
                            }
                        }
                        dropdown.onchange = onCatChange;
                        /* ]]> */
                    </script>

                <?php } else { ?>

                    <ul class="custom-list list categories-list">

                        <?php

                            $cat_args['title_li'] = '';
                            wp_list_categories(apply_filters('widget_categories_args', $cat_args));

                        ?>

                    </ul>

                <?php } ?>

       <?php echo apply_filters( 'after_category_widget',  $args['after_widget'] ); ?>
      
        <?php
       
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['count'] = !empty($new_instance['count']) ? 1 : 0;
        $instance['hierarchical'] = !empty($new_instance['hierarchical']) ? 1 : 0;
        $instance['dropdown'] = !empty($new_instance['dropdown']) ? 1 : 0;

        return $instance;
    }

    function form( $instance ) {

        //Defaults
        $instance = wp_parse_args( (array) $instance, array( 'title' => '') );
        $title = esc_attr( $instance['title'] );
        $count = isset($instance['count']) ? (bool) $instance['count'] :false;
        $hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
        $dropdown = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;

    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:','concierge' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
            <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('dropdown')); ?>" name="<?php echo esc_attr($this->get_field_name('dropdown')); ?>"<?php checked( $dropdown ); ?> />
            <label for="<?php echo esc_attr($this->get_field_id('dropdown')); ?>"><?php _e( 'Display as dropdown','concierge'  ); ?></label><br />

            <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>"<?php checked( $count ); ?> />
            <label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php _e( 'Show post counts','concierge'  ); ?></label><br />

            <input type="checkbox" class="checkbox" id="<?php echo esc_attr($this->get_field_id('hierarchical')); ?>" name="<?php echo esc_attr($this->get_field_name('hierarchical')); ?>"<?php checked( $hierarchical ); ?> />
            <label for="<?php echo esc_attr($this->get_field_id('hierarchical')); ?>"><?php _e( 'Show hierarchy','concierge'  ); ?></label>
        </p>
        
    <?php
    }

}

add_action('widgets_init', 'concierge_categories');

function concierge_categories(){
    register_widget('Concierge_Widget_Categories');
}