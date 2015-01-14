<?php
class CAHNRSWP_Varieties_Variety_Model {
	
	public $post_id = false;
	
	public $type;
	
	public $sub_type;
	
	public $harvest;
	
	public $parentage;
	
	public $origin;
	
	public $origin_country;
	
	public $origin_year;
	
	public $IP;
	
	public $color;
	
	public $flavor_profile;
	
	public $storability;
	
	public $summary;
	
	public $copy;
	
	private $fields = array(
			'type'           => 'text',
			'sub_type'       => 'text',
			'harvest'        => 'text',
			'parentage'      => 'text',
			'origin'         => 'text',
			'origin_country' => 'text',
			'origin_year'    => 'text',
			'IP'             => 'text',
			'color'          => 'text',
			'flavor_profile' => 'text',
			'storability'    => 'text',
			);
	
	/*
	 * @desc - Retrieves post meta and sets class properties
	 * @param object $post - WP Post object
	 * @param array $post_meta
	*/
	public function cwp_set_properties_from_meta( $post , $variety_meta ){ 
		
		if ( $variety_meta ) {
			
			$this->type = ( isset( $variety_meta['type'] ) ) ? $variety_meta['type'] : '';
	
			$this->sub_type = ( isset( $variety_meta['sub_type'] ) ) ? $variety_meta['sub_type'] : '';
	
			$this->harvest = ( isset( $variety_meta['harvest'] ) ) ? $variety_meta['harvest'] : '';
	
			$this->parentage = ( isset( $variety_meta['parentage'] ) ) ? $variety_meta['parentage'] : '';
	
			$this->origin = ( isset( $variety_meta['origin'] ) ) ? $variety_meta['origin'] : '';
			
			$this->origin_country = ( isset( $variety_meta['origin_country'] ) ) ? $variety_meta['origin_country'] : '';
			
			$this->origin_year = ( isset( $variety_meta['origin_year'] ) ) ? $variety_meta['origin_year'] : '';
	
			$this->IP = ( isset( $variety_meta['IP'] ) ) ? $variety_meta['IP'] : '';
	
			$this->color = ( isset( $variety_meta['color'] ) ) ? $variety_meta['color'] : '';
	
			$this->flavor_profile = ( isset( $variety_meta['flavor_profile'] ) ) ? $variety_meta['flavor_profile'] : '';
	
			$this->storability = ( isset( $variety_meta['storability'] ) ) ? $variety_meta['storability'] : '';
			
		}; // end if
		
		$this->summary = $post->post_excerpt;
		
		$this->copy = get_post_meta( $post->ID ,'_variety_copy' , true ); 
		
	} // end method cwp_set_properties_from_meta
	
	/*
	 * @desc - Sets class properties
	 * @param object $key - $_POST key to look for
	*/
	public function cwp_set_properties_from_post( $key ){
		
		$fields = array(
			'type' => 'text',
			'sub_type' => 'text',
			'harvest' => 'text',
			'parentage' => 'text',
			'origin' => 'text',
			'IP' => 'text',
			'color' => 'text',
			'flavor_profile' => 'text',
			'storability' => 'text',
			);
		
		if ( isset( $_POST[ $key ] ) ) {
		
			foreach ( $fields as $fkey => $san ) {
				
				if ( isset( $_POST[ $key ][ $fkey ] ) ) {
					
					switch ( $san ) {
						
						case 'text':
						
							$this->$fkey = sanitize_text_field( $_POST[ $key ][ $fkey ] );
						
							break;
						
					}; // end switch
					
				}; // end if
			
			}; // end foreach
		
		}; // end if
		
		$this->summary = sanitize_text_field( $_POST[ 'post_excerpt' ] );
		
		if ( isset( $_POST[ '_variety_copy' ] ) ) {
			
			$this->copy = wp_kses_post( $_POST[ '_variety_copy' ] );
			
		}; // end if
		
	} // end method cwp_set_properties_from_meta
	
	/*
	 * @desc - Saves variety data
	 * @param int $post_id
	*/
	public function cwp_save_variety( $post_id ){
		
		if ( ! isset( $_POST['variety_nonce'] ) ) return;
		
		if ( ! wp_verify_nonce( $_POST['variety_nonce'], 'submit_variety' ) ) return;
		
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		
		if ( ! current_user_can( 'edit_post', $post_id ) ) return;
		
		$varieties = $this->cwp_clean_post( '_variety' );
		
		update_post_meta( $post_id , '_variety' , $varieties );
		
		
	} // end method cwp_save_variety
	
	/*
	 * @desc - Cleans post values based on $fields
	 * @return array - Cleaned data
	*/
	
	private function cwp_clean_post( $key ){
		
		$clean_fields = array();
		
		if ( isset( $_POST[ $key ] ) ) {
		
			foreach ( $this->fields as $fkey => $san ) {
				
				if ( isset( $_POST[ $key ][ $fkey ] ) ) {
					
					switch ( $san ) {
						
						case 'text':
						
							$clean_fields[ $fkey ] = sanitize_text_field( $_POST[ $key ][ $fkey ] );
						
							break;
						
					}; // end switch
					
				}; // end if
			
			}; // end foreach
		
		}; // end if
		
		return $clean_fields;
		
	} // end method cwp_clean_post
	
	
} // end CAHNRSWP_Varieties_Variety