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
	
	public $view;
	
	private static $instance = null;
	
	public static function get_instance(){
		
		if ( null == self::$instance ) {
			
			self::$instance = new self;
			
		};
		
		return self::$instance;
		
	} // end get_instance
	
	private function __construct(){
		
		define( 'CAHNRSWPVARIETYURL' , plugin_dir_url( __FILE__ ) ); // Plugin Base url
		
		define( 'CAHNRSWPVARIETYDIR' , plugin_dir_path( __FILE__ ) ); // Plugin Directory Path
		
		$this->model = new CAHNRSWP_varieties_model();
		
		$this->view = new CAHNRSWP_varieties_view( $this->control , $this->model );
		
		add_action( 'init', array( $this , 'add_custom_post_type' ) );
		
		add_action( 'widgets_init', array( $this , 'add_widgets' ) );
		
		add_action( 'edit_form_after_title', array( $this , 'cwp_edit_form_after_title' ) );
		
		//add_action( 'add_meta_boxes', array( $this , 'register_meta_box' ) );
		
		add_action( 'save_post', array( $this , 'cwp_save_post' ) );
		
		add_action( 'admin_enqueue_scripts', array( $this , 'add_admin_scripts' ) );
		
		add_action( 'wp_enqueue_scripts', array( $this , 'cahnrswp_wp_enqueue_scripts' ) );
		
	} // end constructor
	
	/*
	 * @desc - Adds edit form for selected variety type
	 * @param object $post - WP Post object
	*/
	public function cwp_edit_form_after_title( $post ) {
		
			if( 'variety' == $post->post_type ) {
			
			require_once CAHNRSWPVARIETYDIR . '/classes/class-cahnrswp-varieties-variety.php';
			
			$variety = new CAHNRSWP_Varieties_Variety();
			
			$variety->cwp_set_variety_from_meta( $post );
			
			$variety->cwp_output_editor();
		
		}
		
	} // end method cwp_edit_form_after_title
	
	/*
	 * @desc - Saves variety data
	 * @param int $post_id
	*/
	public function cwp_save_post( $post_id ){
		
		require_once CAHNRSWPVARIETYDIR . '/classes/class-cahnrswp-varieties-variety.php';
		
		$variety = new CAHNRSWP_Varieties_Variety();
		
		$variety->cwp_save_variety( $post_id );
		
	}
	
	
	
	
	
	
	
	
	
	
	public function add_widgets(){
		
		require_once 'widget/cahnrswp-widget-plant-varieties.php';
		
		
	} // end add_widgets
	
	public function add_custom_post_type(){
		
		$labels = array(
			'name'               => 'Varieties',
			'singular_name'      => 'Variety',
			'menu_name'          => 'Varieties',
			'name_admin_bar'     => 'Variety',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Variety',
			'new_item'           => 'New Variety',
			'edit_item'          => 'Edit Variety',
			'view_item'          => 'View Variety',
			'all_items'          => 'All Varieties',
			'search_items'       => 'Search Varieties',
			'parent_item_colon'  => 'Parent Varieties:',
			'not_found'          => 'No varieties found.',
			'not_found_in_trash' => 'No varieties found in Trash.',
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
	
	public function add_admin_scripts(){
		
		wp_enqueue_style( 'varieties-admin-css', plugin_dir_url( __FILE__ ).'/css/admin.css', array(), '0.0.1'  );
		
	} // end add_admin_scripts
	
	public function cahnrswp_wp_enqueue_scripts(){
		
		wp_enqueue_style( 'varieties-css', plugin_dir_url( __FILE__ ).'/css/public.css', array(), '0.0.1'  );
		
	} // end cahnrswp_wp_enqueue_scripts
	
	public function set_variety( $post_id ){
		
		$this->model->set_variety( $post_id );
		
	} // end set_variety
	
	public function set_view( $view_type ){
		
		$this->model->set_view( $view_type );
		
	} // end set_view
	
	
	
	public function set_taxonomy(){
		
		$this->model->set_taxonomy();
		
	} // end set_taxonomy
	
} // end class CAHNRSWP_varieties

class CAHNRSWP_varieties_model {
	
	public $view_type = false;
	public $fields = array();
	public $taxonomy = array();
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
		
		if ( $this->post_id != $post_id ){
			
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
	
	public function set_taxonomy(){
		
		$tax = @file_get_contents( plugin_dir_path( __FILE__ ).'taxonomy.json'  );
		
		if ( $tax ) {
			
			$tax = json_decode( $tax , true );
		}
		var_dump( $tax );
		
	}
	
	public function check_meta( $key , $default = 'na' ){
		
		if ( isset( $this->meta[$key][0] ) ){
			
			return $this->meta[$key][0];
			
		} 
		else if ( $default != 'na' ) {
			
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
			
			if ( isset( $_POST[ $f_key ] ) ){
				
				$instance = sanitize_text_field( $_POST[ $f_key ] );
				
				update_post_meta( $post_id , $f_key , $instance );
				
			} // end if
			
		} // end foreach
		
	} // end save_variety
	
} // end class CAHNRSWP_varieties_model


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
		
	} // end output_view
	
} // end class CAHNRSWP_varieties_view

$CAHNRSWP_varieties = init_CAHNRSWP_varieties::get_instance();