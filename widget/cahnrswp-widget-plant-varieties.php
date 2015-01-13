<?php
class CAHNRSWP_Widget_Plant_Varieties extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct(
			'cahnrs-plant-varieties', // Base ID
			__( 'Varieties', 'text_domain' ), // Name
			array( 'description' => __( 'Display lists of varieties', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		
		include 'inc/demo-tabs.php';
		
		
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}

register_widget( 'CAHNRSWP_Widget_Plant_Varieties' );
