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
	
	public $availabiltiy;
	
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
			
			$this->availabiltiy = ( isset( $variety_meta['availabiltiy'] ) ) ? $variety_meta['availabiltiy'] : '';
	
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
			'origin_country' => 'text',
			'origin_year' => 'text', 
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
		
		$this->cwp_set_tags( $post_id );
		
		
		
		//if( isset( $this->harvest ) ){
			
			//$terms = explode( ',' , $this->harvest );
			
			//$term_slugs = array();
			
			//foreach( $terms as $term ){
				
				//$term_data = get_term_by( 'name' , $term , 'post_tag' ); 
				
				//wp_set_object_terms( $post_id, $term_data->slug , 'post_tag', true );
				
				
				/*$term_data = get_term_by( 'name' , $term , 'post_tag'); 
				
				if ( $term_data ){
					
					$term_slugs 
					
				} else {
				}*/
				
				
				
				//$term_data = term_exists( $term , 'post_tag' );
				
				//if( $term_data ) {
					
					//$term_ids[] = $term_data['term_id'];
					
				//} else {
				
					//$term_data = wp_insert_term( $term , 'post_tag' );
					
					//$term_ids[] = $term_data['term_id'];
				
				//}
				 
			//}; // end foreach
			
			//if ( ! empty( $term_ids ) ){
				
				//wp_set_object_terms( $post_id, $term_ids, 'post_tag', true );
				
			//}; // end if
			
		//}; // end if
		
		
	} // end method cwp_save_variety
	
	/*
	 * @desc - Sets tags from data
	 * @param int $post_id
	*/
	private function cwp_set_tags( $post_id ){
		
		$tag_fields = array(
						'harvest',
						'flavor_profile',
						'IP',
						'origin_country',
						'origin',
						'storability',
					);
					
		$term_slugs = array();
					
		foreach( $tag_fields as $tag_field ){
			
			if ( isset( $this->$tag_field ) && $this->$tag_field ){
				
				$terms = explode( ',' , $this->$tag_field );
				
				foreach( $terms as $term ){
					
					if( $term ){
					
						$term_data = get_term_by( 'name' , trim( $term ) , 'post_tag' ); 
						
						//var_dump( $term_data->term_id ); 
						
						//var_dump( $term );
						
						if ( ! $term_data ){
							
							$term_data = wp_insert_term( $term, 'post_tag' );
							
							if ( ! empty( $term_data['term_id'] ) ) {
								
								$term_slugs[] = $term_data['term_id'];
								
							}; // end if
							
						} else {
							
							$term_slugs[] = $term_data->term_id;
							
						}; // end if
						
					}; // end if
					 
				}; // end foreach
				
			}; // end if
			
		}; // end foreach
		
		//var_dump( $term_slugs );
				
		wp_set_object_terms( $post_id, $term_slugs , 'post_tag', true );
		
	} // end method cwp_set_tags
	
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