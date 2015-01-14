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
	
	
} // end CAHNRSWP_Varieties_Variety