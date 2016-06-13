<?php 

class Concierge_search extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_search', 'description' => __( "A search form for your site.",'concierge') );
		parent::__construct( 'concierge-search', __( 'Concierge Search', 'concierge' ), $widget_ops );
	}

	public function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo apply_filters( 'before_search_widget',  $args['before_widget'] );
		if ( $title ) {
			echo apply_filters('before_search_title',$args['before_title']). esc_attr($title) . apply_filters('after_search_title',$args['after_title']);
		}

		// Use current theme search form if it exists
		get_search_form();

		echo apply_filters( 'after_search_widget',  $args['after_widget'] );
	}

	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, array( 'title' => '') );
		$title = $instance['title'];
?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:','concierge'); ?> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			</label>
		</p>
		
<?php }

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => ''));
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

}


add_action('widgets_init', 'concierge_search');

function concierge_search(){

    register_widget('Concierge_search');

}