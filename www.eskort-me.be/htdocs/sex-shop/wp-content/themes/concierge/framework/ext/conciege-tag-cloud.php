<?php 


/**
 * Tag cloud widget class
 *
 * @since 1.0.0
 */
class Concierge_Tag_Cloud extends WP_Widget {

	public function __construct() {
		$widget_ops = array( 'description' => __( "A cloud of your most used tags.",'concierge') );
		parent::__construct('tag_cloud', __('Concierge Tag Cloud','concierge'), $widget_ops);
	}

	public function widget( $args, $instance ) {

		$current_taxonomy = $this->_get_current_taxonomy($instance);

		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'post_tag' == $current_taxonomy ) {
				$title = __('Tags','concierge');
			} else {
				$tax = get_taxonomy($current_taxonomy);
				$title = $tax->labels->name;
			}
		}

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo apply_filters( 'before_tag_widget',  $args['before_widget'] );
		
		if ( $title ) {
			echo apply_filters('before_tag_title',$args['before_title']). esc_attr($title) . apply_filters('after_tag_title',$args['after_title']);
		}

		
		echo '<ul class="custom-list tags-list">';

		/**
		 * Filter the taxonomy used in the Tag Cloud widget.
		 *
		 * @since 2.8.0
		 * @since 3.0.0 Added taxonomy drop-down.
		 *
		 * @see wp_tag_cloud()
		 *
		 * @param array $current_taxonomy The taxonomy to use in the tag cloud. Default 'tags'.
		 */

		$terms = get_terms( $current_taxonomy);


		foreach ($terms as $term) {

			$term_link = get_term_link( $term );

			if ( is_wp_error( $term_link ) ) {
		        continue;
		    }
		    
		    echo '<li><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a></li>';

		}


		echo "</ul>\n";
		echo apply_filters( 'after_tag_widget',  $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ) {

		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['taxonomy'] = stripslashes($new_instance['taxonomy']);
		return $instance;

	}

	public function form( $instance ) {

		$current_taxonomy = $this->_get_current_taxonomy($instance);
?>
	<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:','concierge') ?></label>
	<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
	<p><label for="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>"><?php _e('Taxonomy:','concierge') ?></label>
	<select class="widefat" id="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>" name="<?php echo esc_attr($this->get_field_name('taxonomy')); ?>">
	
	<?php 

		foreach ( get_taxonomies() as $taxonomy ) :
			$tax = get_taxonomy($taxonomy);
			if ( !$tax->show_tagcloud || empty($tax->labels->name) )
				continue;
	?>
	<option value="<?php echo esc_attr($taxonomy) ?>" <?php selected($taxonomy, $current_taxonomy) ?>><?php echo esc_attr($tax->labels->name); ?></option>
	<?php endforeach; ?>
	</select></p><?php
	}

	public function _get_current_taxonomy($instance) {
		if ( !empty($instance['taxonomy']) && taxonomy_exists($instance['taxonomy']) )
			return $instance['taxonomy'];

		return 'post_tag';
	}
}



add_action('widgets_init', 'concierge_tag_cloud');

function concierge_tag_cloud(){

    register_widget('Concierge_Tag_Cloud');

}