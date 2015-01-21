<?php
class CAHNRSWP_Varieties_Variety {
	
	private $post;
	
	private $post_meta;
	
	private $meta_key = '_variety';
	
	private $model;
	
	private $view;

	/*
	 * @desc - Sets model properties from post meta
	 * @param object $post - WP Post object
	*/
	public function cwp_set_variety_from_meta( $post ){
		
		$this->post = $post;
		
		$variety_meta = get_post_meta( $this->post->ID ,'_variety' , true ); 
		
		if ( $variety_meta && isset( $variety_meta['type'] ) && $variety_meta['type'] ) {
			
			$variety = $variety_meta['type'];
			
		} else {
			
			$variety = false;
			
		}; // end if
		
		$this->cwp_set_model( $variety );
		
		$this->model->cwp_set_properties_from_meta( $this->post , $variety_meta );
		
		$this->cwp_set_view( $variety , $this->model );
		
	} // end method cwp_set_properties_from_meta
	
	/*
	 * @desc - Gets the model for a given variety
	 * @param string $variety - Variety to look for. A value of false will return
	 * default model.
	 * @return object - Model for variety or default model.
	*/
	public function cwp_set_model( $variety ){
		
		require_once CAHNRSWPVARIETYDIR . '/classes/class-cahnrswp-varieties-variety-model.php';
		
		$model_class = 'CAHNRSWP_Varieties_Variety_Model';
		
		if ( $variety ) {
		
			$variety_model_path =  CAHNRSWPVARIETYDIR . '/classes/class-cahnrswp-varieties-variety-' . $variety . '-model.php';
			
			if ( file_exists( $variety_model_path ) ){
				
				require_once $model_path;
				
				$model_class = 'CAHNRSWP_Varieties_Variety_' . ucfirst( $variety ) .'_Model';
				
			}; // end if
		
		}; // end if
		
		$this->model = new $model_class();
		
	} // end method cwp_get_model
	
	/*
	 * @desc - Gets the view for a given variety
	 * @param string $variety - Variety to look for. A value of false will return
	 * default view.
	 * @return object - View for variety or default view.
	*/
	public function cwp_set_view( $variety , $model ){
		
		require_once CAHNRSWPVARIETYDIR . '/classes/class-cahnrswp-varieties-variety-view.php';
		
		$view_class = 'CAHNRSWP_Varieties_Variety_View';
				
		if ( $variety ) {
		
			
			$variety_view_path =  CAHNRSWPVARIETYDIR . '/classes/class-cahnrswp-varieties-variety-' . $variety . '-view.php';
			
			if ( file_exists( $variety_view_path ) ){
				
				require_once $variety_view_path;
				
				$view_class = 'CAHNRSWP_Varieties_Variety_' . ucfirst( $variety ) .'_View';
				
			}; // end if
		
		}; // end if
		
		$this->view = new $view_class( $this , $model );
		
	} // end method cwp_get_view
	
	/*
	 * @desc - Sets model properties from post meta
	*/
	public function cwp_output_editor(){
		
		$this->view->cwp_output_editor();
		
	} // end method cwp_set_properties_from_meta
	
	/*
	 * @desc - Saves variety meta data
	*/
	public function cwp_save_variety( $post_id ){
		
		if ( isset( $_POST[ $this->meta_key ]['type'] ) ) {
			
			$variety = sanitize_text_field( $_POST[ $this->meta_key ]['type'] );
			
		} else {
			
			$variety = false;
			
		}; // end if
		
		$this->cwp_set_model( $variety );
		
		$this->cwp_set_view( $variety , $this->model );
		
		$this->model->cwp_set_properties_from_post( $this->meta_key );
		
		$this->model->cwp_save_variety( $post_id );
		
		$updated_content = $this->view->cwp_get_save_content_view();
				
		$post_data = array(
			'ID' 		   => $post_id,
			'post_content' => $updated_content,	
			);
			
		wp_update_post( $post_data );
		
	} //end method cwp_save_variety
	
} // end CAHNRSWP_Varieties_Variety