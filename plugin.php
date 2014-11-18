<?php
/**
* Plugin Name: CAHNRSWP Plant Varieties
* Plugin URI:  http://cahnrs.wsu.edu/communications/
* Description: Adds plant variety functionality to wordpress
* Version:     0.0.1
* Author:      CAHNRS Communications, Danial Bleile
* Author URI:  http://cahnrs.wsu.edu/communications/
* License:     Copyright Washington State University
* License URI: http://copyright.wsu.edu
*/
class init_CAHNRSWP_varieties {
	public $model;
	public $control;
	public $view;
	
	private static $instance = null;
	
	public static function get_instance(){
		
		if( null == self::$instance ) {
			self::$instance = new self;
		}
		
		return self::$instance;
	} // end get_instance
	
	private function __construct(){
		
		$this->model = new CAHNRSWP_varieties_model();
		
		$this->control = new CAHNRSWP_varieties_control( $this->model );
		
		$this->view = new CAHNRSWP_varieties_view( $this->control , $this->model );
		
		add_action( 'plugins_loaded', array( $this ,'load_texdomain' ) );
		
		add_action( 'init', array( $this , 'add_custom_post_type' ) );
		
		add_action( 'add_meta_boxes', array( $this , 'register_meta_box' ) );
		
		add_action( 'save_post', array( $this->control , 'save_variety' ) );
		
		add_action( 'admin_enqueue_scripts', array( $this , 'add_admin_scripts' ) );
		
	} // end constructor
	
	public function load_texdomain(){
		
		load_plugin_textdomain( 'cahnrs-varieties', false, dirname( plugin_basename( __FILE__ ) ) . '/langs' );
		
	} // end load_textdomain
	
	public function add_custom_post_type(){
		
		$labels = array(
			'name'               => _x( 'Varieties', 'post type general name', 'cahnrs-varieties' ),
			'singular_name'      => _x( 'Variety', 'post type singular name', 'cahnrs-varieties' ),
			'menu_name'          => _x( 'Varieties', 'admin menu', 'cahnrs-varieties' ),
			'name_admin_bar'     => _x( 'Variety', 'add new on admin bar', 'cahnrs-varieties' ),
			'add_new'            => _x( 'Add New', 'Variety', 'cahnrs-varieties' ),
			'add_new_item'       => __( 'Add New Variety', 'cahnrs-varieties' ),
			'new_item'           => __( 'New Variety', 'cahnrs-varieties' ),
			'edit_item'          => __( 'Edit Variety', 'cahnrs-varieties' ),
			'view_item'          => __( 'View Variety', 'cahnrs-varieties' ),
			'all_items'          => __( 'All Varieties', 'cahnrs-varieties' ),
			'search_items'       => __( 'Search Varieties', 'cahnrs-varieties' ),
			'parent_item_colon'  => __( 'Parent Varieties:', 'cahnrs-varieties' ),
			'not_found'          => __( 'No varieties found.', 'cahnrs-varieties' ),
			'not_found_in_trash' => __( 'No varieties found in Trash.', 'cahnrs-varieties' )
		); // end $labels
	
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'variety' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'taxonomies' => array( 'category' , 'post_tag' ),
			'supports'           => array( 'title', 'thumbnail', 'excerpt' )
		); // end $args
	
		register_post_type( 'variety', $args );
		
	} // end add_custom_post_type
	
	public function register_meta_box(){
		add_meta_box(
			'variety_settings',
			__( 'Variety Settings', 'cahnrs-varieties' ),
			array( $this, 'add_meta_box'),
			'variety',
			'normal',
			'high'
		);
	} // end register_meta_box
	
	public function add_meta_box( $post ){
		$this->control->set_variety( $post->ID );
		$this->control->set_view( 'metabox');
		$this->view->output_view();
	} // end add_meta_box
	
	public function add_admin_scripts(){
		wp_enqueue_style( 'varieties-css', plugin_dir_url( __FILE__ ).'/css/admin.css', array(), '0.0.1'  );
	}
	
} // end class CAHNRSWP_varieties

class CAHNRSWP_varieties_model {
	
	public $view_type = false;
	public $fields = array();
	public $post_id = false;
	public $variety_type;
	public $sub_type;
	public $meta = array();
	public $harvest_time;
	public $parentage;
	public $origin;
	public $IP;
	public $color;
	public $flavor_profile;
	public $storability;
	
	public function __construct(){
		$this->set_fields();
	}
	
	public function set_variety( $post_id ){
		
		if( $this->post_id != $post_id ){
			$this->post_id = $post_id;
			$this->meta = get_post_meta( $post_id );
			$this->variety_type = $this->check_meta( '_variety_type' , '' ); 
			$this->harvest_time = $this->check_meta( '_harvest_time' , '' );
			$this->parentage = $this->check_meta( '_parentage' , '' );
			$this->origin = $this->check_meta( '_origin' , '' );
			$this->IP = $this->check_meta( '_ip' , '' );
			$this->color = $this->check_meta( '_color' , '' );
			$this->flavor_profile = $this->check_meta( '_flavor_profile' , '' );
			$this->storability = $this->check_meta( '_storability' , '' );
			$this->available = $this->check_meta( '_available' , '' );
			
		} // end if
		
	} // end set_variety
	
	public function set_view( $view_type ){
		$this->view_type = $view_type;
	} // end set_view
	
	public function check_meta( $key , $default = 'na' ){
		if( isset( $this->meta[$key][0] ) ){
			return $this->meta[$key][0];
		} 
		else if( $default != 'na' ) {
			return $default;
		} else {
			return '';
		}
	} // end check_meta
	
	public function set_fields(){
		$this->fields = array(
			'variety_type' => array( 
				'type' => 'select',
				'supports' => array('all'),
				'label' => 'Variety Type', 
				'values' => array( 
					'0' => 'Select Type', 
					'apple' => 'Apple',
					'pear' => 'Pear',
					'cherry' => 'Cherry',
					'stonefruit' => 'Stonefruit',
					),
				), // end _type
			'harvest_time' => array( 
				'type' => 'text',
				'supports' => array('apple','pear'),
				'label' => 'Harvest Time', 
				), // end _harvest_time
			'parentage' => array( 
				'type' => 'text',
				'supports' => array('apple','pear'),
				'label' => 'Parentage', 
				), // end _parentage
			'origin' => array( 
				'type' => 'text',
				'supports' => array('apple','pear'),
				'label' => 'Origin', 
				), // end _origin
			'IP' => array( 
				'type' => 'text',
				'supports' => array('apple','pear'),
				'label' => 'IP Status', 
				), // end _IP
			'color' => array( 
				'type' => 'text',
				'supports' => array('apple','cherry','pear'),
				'label' => 'Color/Appearance', 
				), // end _color
			'flavor_profile' => array( 
				'type' => 'text',
				'supports' => array('apple','cherry','pear'),
				'label' => 'Flavor Profile', 
				), // end _flavor_profile
			'storability' => array( 
				'type' => 'select',
				'supports' => array('apple','pear'),
				'label' => 'Storability', 
				'values' => array( 
					'1' => '1 Months',
					'2' => '2 Months',
					'3' => '3 Months',
					'4' => '4 Months',
					'5' => '5 Months',
					'6' => '6 Months',
					'7' => '7 Months',
					'8' => '8 Months',
					'9' => '9 Months',
					'10' => '10 Months',
					'11' => '11 Months',
					'12' => '12 Months',
					),
				), // end _storability
			'available' => array( 
				'type' => 'text',
				'supports' => array('cherry','pear'),
				'label' => 'Available', 
				), // end _available
		); 
	} // end set_fields
	
	public function save_variety( $post_id ){
		if ( ! isset( $_POST['variety_nonce'] ) ) return;
		if ( ! wp_verify_nonce( $_POST['variety_nonce'], 'submit_variety' ) ) return;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;
		
		foreach( $this->fields as $f_name => $f_data ){
			$f_key = '_'.$f_name;
			if( isset( $_POST[ $f_key ] ) ){
				$instance = \sanitize_text_field( $_POST[ $f_key ] );
				\update_post_meta( $post_id , $f_key , $instance );
			} // end if
		} // end foreach
	} // end save_variety
	
} // end class CAHNRSWP_varieties_model

class CAHNRSWP_varieties_control {
	
	private $model;
	
	public function __construct( $model ){
		
		$this->model = $model;
		
	} // end __construct
	
	public function set_variety( $post_id ){
		
		$this->model->set_variety( $post_id );
		
	} // end set_variety
	
	public function set_view( $view_type ){
		
		$this->model->set_view( $view_type );
		
	} // end set_view
	
	public function save_variety( $post_id ){
		
		$this->model->save_variety( $post_id );
	}
	
} // end class CAHNRSWP_varieties_control

class CAHNRSWP_varieties_view {
	private $control;
	private $model;
	
	public function __construct( $control , $model ){
		
		$this->control = $control;
		$this->model = $model;
		
	} // end __construct
	
	public function output_view(){
		switch( $this->model->view_type ){
			case 'metabox':
				include 'inc/metabox.php';
				break;
		}
	}
	
} // end class CAHNRSWP_varieties_view

$CAHNRSWP_varieties = init_CAHNRSWP_varieties::get_instance();