<?php
class CAHNRSWP_Varieties_Variety_View {
	
	private $controller;
	
	private $model;
	
	public function __construct( $controller , $model ) {
		
		$this->controller = $controller;
		
		$this->model = $model;
		
		
	} // end __construct
	
	public function cwp_output_editor(){
		
		include CAHNRSWPVARIETYDIR . '/inc/inc-form-view-variety-basic.php';
		
	} // end method output_editor
	
	public function cwp_get_save_content_view(){
		
		ob_start();
		
		include CAHNRSWPVARIETYDIR . '/inc/inc-display-variety-basic.php';
		
		return ob_get_clean();
		
	}
	
	
} // end CAHNRSWP_Varieties_Variety