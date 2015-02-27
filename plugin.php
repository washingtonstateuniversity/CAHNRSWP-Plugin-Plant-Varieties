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

define( 'CAHNRSWPVARIETYURL' , plugin_dir_url( __FILE__ ) ); // Plugin Base url
		
define( 'CAHNRSWPVARIETYDIR' , plugin_dir_path( __FILE__ ) ); // Plugin Directory Path

require_once CAHNRSWPVARIETYDIR . '/classes/class-ccl-admin-post.php';

require_once CAHNRSWPVARIETYDIR . '/classes/class-ccl-article.php';

require_once CAHNRSWPVARIETYDIR . '/classes/class-ccl-post.php';


class CAHNRSWP_Varieties extends CCL_Admin_Post_Varieties {
	
	public $meta_key = '_variety';
	
	public $content_key = '_primary_content';
	
	public $apple = array(
			'harvest'        => array( 
				'title'  => 'Harvest Time', 
				'tax'    => 'post_tag', 
				'type'   => 'select',
				'values' => array( 
					'early'     => 'Early', 
					'midseason' => 'Mid Season', 
					'late'      => 'Late' 
					),
				),
			'parentage'      => array( 
				'title'  => 'Parentage',
				'type'   => 'text' 
				),
			'origin'         => array( 
				'title'  => 'Origin City or State', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'origin_country' => array( 
				'title'  => 'Origin Country', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'origin_year'    => array( 
				'title'  => 'Origin Year', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'IP'             => array( 
				'title'  => 'IP Status', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'color'          => array( 
				'title'  => 'Color', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'flavor_profile' => array( 
				'title'  => 'Flavor Profile', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'storability'    => array( 
				'title'  => 'Storage Duration', 
				'tax'    => 'post_tag', 
				'type'   => 'select',
				'values' => array(
					'two months'      => '2 Months',
					'three months'    => '3 Months',
					'four months'     => '4 Months',
					'five months'     => '5 Months',
					'six months'      => '6 Months',
					'seven months'    => '7 Months',
					'eight months'    => '8 Months',
					'nine months'     => '9 Months',
					'ten months'      => '10 Months',
					'eleven months'   => '11 Months',
					'twelve months'   => '12 Months',
					'thriteen months' => '13 Months',
					), 
				),
			);
			
		public $pear = array(
			'sub_type'        => array( 
				'title'  => 'Harvest Time', 
				'tax'    => 'post_tag', 
				'type'   => 'select',
				'values' => array( 
					'winter-pear' => 'Winter Pear', 
					'summer-pear' => 'Summer Pear', 
					'asian-pear'  => 'Asian Pear' 
					),
				),
			'harvest'        => array( 
				'title'  => 'Harvest Time', 
				'tax'    => 'post_tag', 
				'type'   => 'select',
				'values' => array( 
					'late-summer' => 'Late Summer', 
					'early-fall'  => 'Early Fall', 
					'fall'        => 'Fall', 
					'late-fall'   => 'Late Fall' 
					),
				),
			'availability'      => array( 
				'title'  => 'Availability',
				'type'   => 'text' 
				),
			'parentage'      => array( 
				'title'  => 'Parentage',
				'type'   => 'text' 
				),
			'origin'         => array( 
				'title'  => 'Origin City or State', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'origin_country' => array( 
				'title'  => 'Origin Country', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'origin_year'    => array( 
				'title'  => 'Origin Year', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'IP'             => array( 
				'title'  => 'IP Status', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'color'          => array( 
				'title'  => 'Appearance', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'flavor_profile' => array( 
				'title'  => 'Flavor Profile', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'storability'    => array( 
				'title'  => 'Storage Duration', 
				'tax'    => 'post_tag', 
				'type'   => 'select',
				'values' => array(
					'two months' => '2 Months',
					'three months' => '3 Months',
					'four months' => '4 Months',
					'five months' => '5 Months',
					'six months' => '6 Months',
					'seven months' => '7 Months',
					'eight months' => '8 Months',
					'nine months' => '9 Months',
					'ten months' => '10 Months',
					'eleven months' => '11 Months',
					'twelve months' => '12 Months',
					'thriteen months' => '13 Months',
					), 
				),
			);
			
		public $cherry = array(
			'sub_type'        => array( 
				'title'  => 'Color Group', 
				'tax'    => 'post_tag', 
				'type'   => 'select',
				'values' => array( 
					'Color group: Dark Red' => 'Dark Red', 
					'Color group: Red' => 'Red', 
					'Color group: Yellow'  => 'Yellow' 
					),
				),
			'developed'      => array( 
				'title'  => 'Developed by',
				'type'   => 'text' 
				),
			'parentage'      => array( 
				'title'  => 'Parentage',
				'type'   => 'text' 
				),
			'pollen_group'      => array( 
				'title'  => 'Pollen Group',
				'type'   => 'text' 
				),
			'origin'         => array( 
				'title'  => 'Origin City or State', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'origin_country' => array( 
				'title'  => 'Origin Country', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'origin_year'    => array( 
				'title'  => 'Origin Year', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'color'          => array( 
				'title'  => 'Appearance', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'flavor_profile' => array( 
				'title'  => 'Flavor Profile', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'bloom' => array( 
				'title'  => 'Bloom Timing', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			'availability' => array( 
				'title'  => 'Ripening Timing', 
				'tax'    => 'post_tag', 
				'type'   => 'text' 
				),
			
			);
	
	public function __construct(){
		
		add_action( 'edit_form_after_title', array( $this , 'variety_editor' ) );
		
		add_action( 'init', array( $this , 'add_post_type' ) );
		
		add_action( 'save_post_variety', array( $this , 'save_post' ) );
		
		add_action( 'admin_enqueue_scripts', array( $this , 'add_admin_scripts' ) );
		
		add_shortcode( 'cwpvariety', array( $this, 'cwpvariety_shortcode' ) );
		
		add_shortcode( 'cwpvarietytab', array( $this, 'cwpvarietytab_shortcode' ) );
		
	} // end constructor
	
	public function cwpvarietytab_shortcode( $atts ){
		
		$defaults = array(
			'field'         => 'sub_type',
			'type'          => '',
			'show_lightbox' => 1,
		);
		
		$atts = shortcode_atts( $defaults , $atts );
		
		$id = 'cwpvarietytab-' . rand( 0 , 10000000 );
		
		$ccl_article = new CCL_Article_Varieties();
		
		$html = '';
		
		if ( ! empty( $atts['field'] ) && ! empty( $atts['type'] ) ){
			
			// Get all posts
		
			$posts = array();
			
			$the_query = new WP_Query( 'post_type=variety&posts_per_page=-1&orderby=title&order=ASC' );
							  
			if ( $the_query->have_posts() ) {
	
				while ( $the_query->have_posts() ) {
					
					$the_query->the_post();
					
					$variety = $this->get_variety_from_post( $the_query->post );
					
					if ( ! empty( $variety['type'] ) && $atts['type'] == $variety['type'] ){
						
						$article = $ccl_article->get_post_article( $the_query->post , $atts );
						
						$posts[] = array( 'article' => $article , 'variety' => $variety );
						
					} // end if
					
				} // end while
				
			} // end if
			
			wp_reset_postdata();
		
			// Get fields
			
			$fields = array();
			
			$object_fields = $this->get_variety_fields( $atts['type'] );
			
			$field_set = $object_fields[ $atts['field'] ];
			
			if ( ! empty( $field_set['values'] ) ){
				
				$html .= '<div id="' . $id . '" class="cwpvarietytab-wrapper" >';
				
				foreach( $field_set['values'] as $field_name => $field_title ){
					
					$html .= '<a href="#" class="cwpvarietytab-tab" style="display: inline-block; vertical-align: bottom; padding: 0.25rem 1rem;">' . $field_title . '</a>';
					
				} // end foreach
				
				$display_style = '';
				
				foreach( $field_set['values'] as $field_name => $field_title ){
					
					$html .= '<div class="cwpvarietytab-content ' . $field_name . '" style="' . $display_style . '"  >';
					
					$html .= '<div class="inner-wrapper">';
					
					foreach( $posts as $post_variety ){
						
						if( $field_name == $post_variety['variety'][ $atts['field'] ] ) {
							
							$article_args = array( 
								'display' => 'gallery', 
								'per_row' => 5,
								'no_text' => 1, 
							);
							
							$html .= $ccl_article->get_article_display( $post_variety['article'] , $article_args );
							
						} // end if
						
					} // end foreach
					
					
					$html .= '</div></div>';
					
					if ( ! $display_style ){
						
						$display_style = 'display:none;';
						
					} // end if
					
				} // end foreach
				
				$html .= '</div>';
				
				$html .='<script>if ( typeof jQuery !== undefined ){ jQuery( "body").on( "click" , "#' . $id . ' > .cwpvarietytab-tab" , function(event){ var c = jQuery( this ); var p = c.parent(); event.preventDefault; c.addClass( "active" ).siblings(".cwpvarietytab-tab").removeClass( "active"); p.find( ".cwpvarietytab-content").eq( c.index() ).show().siblings( ".cwpvarietytab-content" ).hide(); });};</script>';
				
			} // end if 
			
			
		} // end if
		
		return $html;
		
	} // end cwpvariety_shortcode
	
	public function cwpvariety_shortcode( $atts ){
		
		$html = '';
		
		if ( ! empty( $atts['type'] ) ){
			
			$fields = $this->get_variety_fields( $atts['type'] );
			
			$html .= '<div class="cwp-variety-wrapper" style="padding-bottom: 2rem;">';
			
				$html .= '<div class="cwp-variety-image" style="display: inline-block; vertical-align: top; width: 30%; margin-right: 2%;">';
				
				if ( ! empty( $atts['img_src'] ) ){
					
					$html .= '<img src="' . $atts['img_src'] . '" style="width: 100%; heigh: auto; display: block;"/>';
					
				} // end if
				
				$html .= '</div>';
			
			$html .= '<div class="cwp-variety-data" style="display: inline-block; vertical-align: top; width: 65%;">';
			
			$html .= '<table>';
				
			foreach( $fields as $field => $field_data ){
				
				$html .= '<tr style="border-bottom: 1px solid #ddd">';
				
				if ( ! empty( $atts[ $field ] ) ){
					
					if ( 'select' == $field_data[ 'type' ] ){
						
						$atts[ $field ] = $field_data['values'][ $atts[ $field ] ];
						
					} // end if
					
					$html .= '<td width="40%" style="font-weight: bold;">' . $field_data['title'] . ':</td><td>' . $atts[ $field ] . '</td>';
					
				} // end if
				
				$html .= '</tr>';
				
			} // end foreach
			
			$html .= '</table>';
			
			$html .= '</div>';
			
			$html .= '</div>';
				
			
		} // end if
		
		return $html;
		
	} // end cwpvariety_shortcode
	
	public function variety_editor( $post ){
		
		$form = '';
		
		if ( 'variety' == $post->post_type ) {
			
			$variety = $this->get_variety_from_post( $post );
			
			$form .= wp_nonce_field('submit_variety','variety_nonce', true , false );
			
			$form .= '<div id="cwpv-basic" class="cwpv-form-section">';
			
			$form .= '<p><label>Variety Type: </label><select name="_variety[type]">';
			
            	$form .= '<option value="">Select</option>';
			
            	$form .= '<option value="apple" ' . selected( $variety['type'] , 'apple' , false ) . ' >Apple</option>';
			
            	$form .= '<option value="pear" ' . selected( $variety['type'] , 'pear', false  ) . ' >Pear</option>';
			
            	$form .= '<option value="cherry" ' . selected( $variety['type'] , 'cherry', false  ) . ' >Cherry</option>';
			
        	$form .= '</select></p></div>';
			
			
			if ( ! empty( $variety['type'] ) ){
				
				$form .= '<div id="cwpv-apple" class="cwpv-form-section">';
				
				//$form_path = CAHNRSWPVARIETYDIR . 'forms/form-variety-' . $variety['type'] . '.php';
				
				$fields = $this->get_variety_fields( $variety['type'] );
				
				foreach( $fields as $field => $field_data ){
					
					$form .= '<p class="inline-half" >';
					
						$form .= '<label>' . $field_data['title'] . ': </label><br />';
						
						switch ( $field_data['type'] ){
							
							case 'text':
								$form .= $this->get_text_input( $this->meta_key . '[' . $field . ']' , $variety[ $field ] );
								break;
							case 'select':
								$form .= $this->get_select_input( $this->meta_key . '[' . $field . ']' , $field_data['values'] , $variety[$field ]  );
								break;
							
						} // end switch
					
					$form .= '</p>';
					
				} // end foreach
				
				
				$form .= '</div>';
				
				$form .= '<h2>Summary/Excerpt</h2>';
				
				$form .= '<textarea style="width: 100%; height: 100px;" name="excerpt">';
					
					$form .= $post->post_excerpt;
				
				$form .= '</textarea>';
				
				$form .= '<h2>Primary Content</h2>';
				
				ob_start();
				
				wp_editor( $variety['copy'] , $this->content_key );
				
				$form .= ob_get_clean();
				
			} 
			
			echo $form;
			
		} // end if
		
	}
	
	public function get_variety_from_post( $post ){
		
		$ccl_post = new CCL_Post_Varieties();
		
		$variety = array();
		
		$meta = get_post_meta( $post->ID, $this->meta_key , true );
		
		if ( is_array( $meta ) && ! empty( $meta['type'] ) ){
			
			$variety = $meta;			
			
		} // end if
		
		$variety['copy'] = get_post_meta( $post->ID, $this->content_key , true );
		
		$variety['img_src'] = $ccl_post->get_featured_image_url( $post->ID );
		
		return $variety;
		
	}
	
	public function get_variety_fields( $type ){
		
		$fields = array();
		
		switch( $type ){
			
			case 'apple':
				$fields = $this->apple;
				break;
			case 'pear':
				$fields = $this->pear;
				break;
			case 'cherry':
				$fields = $this->cherry;
				break;
			
		}
		
		return $fields;
		
	}
	
	public function get_text_input( $name , $value='' , $args = array() ){
		
		$style = ( ! empty( $args['style'] ) )? ' style="' . $args['style'] . '"' : '';
		
		$class = ( ! empty( $args['class'] ) )? ' class="' . $args['class'] . '"' : '';
		
		return '<input type="text" name="' . $name . '" value="' . $value . '"' . $style . $class . ' />';
		
	}
	
	public function get_select_input( $name , $values = array() , $current_value = "" ,  $args = array() ){
		
		$style = ( ! empty( $args['style'] ) )? ' style="' . $args['style'] . '"' : '';
		
		$class = ( ! empty( $args['class'] ) )? ' class="' . $args['class'] . '"' : '';
		
		$input = '<select type="text" name="' . $name . '"' . $style . $class . '>';
		
		foreach( $values as $key => $label ){
			
			$input .= '<option value="' . $key . '" ' . selected( $current_value , $key , false ) . ' >';
			
			$input .= $label;
			
			$input .= '</option>';
			
		} // end foreach
		
		$input .= '</select>';
		
		return $input;
		
	}
	
	/*
	 * @desc - Saves variety data
	 * @param int $post_id
	*/
	public function save_post( $post_id ){
		
		if ( ! empty( $_POST[ $this->meta_key ]['type'] ) ){
			
			$data = array();
			
			$data['type'] = 'text'; 
			
			$fields = $this->get_variety_fields( $_POST[ $this->meta_key ]['type'] );
			
			foreach( $fields as $field => $field_data ){
				
				$data[ $field ] = $field_data['type'];
				
			} // end foreach
			
			$nonce = array( 'key' => 'variety_nonce' , 'action' => 'submit_variety' );
			
			// Save Meta
		
			$this->save_post_admin( $post_id , $this->meta_key , $data , $nonce );
			
			$this->save_post_admin( $post_id , $this->content_key , 'wp_editor' , $nonce );
			
			// Update Post
			
			$post = get_post( $post_id );
			
			$variety = $this->get_variety_from_post( $post );
			
			$shortcode = $this->to_shortcode( 'cwpvariety' , $variety, null, array( 'copy' ) );
			
			$html = $shortcode . $variety['copy'];
			
			$this->update_post_content( $this, $post->ID , $html , $nonce, array( 'save_post_variety' , 'save_post' ) );
			
		} // end if
		
	}
	
	
	public function add_post_type(){
		
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
			'capability_type'    => 'page',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'taxonomies' => array( 'category' , 'post_tag' ),
			'supports'           => array( 'title', 'thumbnail' )
		); // end $args
	
		register_post_type( 'variety', $args );
		
	} // end add_custom_post_type
	
	
	public function add_admin_scripts(){
		
		wp_enqueue_style( 'varieties-admin-css', plugin_dir_url( __FILE__ ).'/css/admin.css', array(), '0.0.1'  );
		
	} // end add_admin_scripts
	
} // end class CAHNRSWP_varieties

$cahnrscwp_varieties = new CAHNRSWP_Varieties();