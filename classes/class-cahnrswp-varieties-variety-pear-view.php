<?php
class CAHNRSWP_Varieties_Variety_Pear_View extends CAHNRSWP_Varieties_Variety_View {
	
	public function __construct( $controller , $model ) {
		
		parent::__construct( $controller , $model );
		
		$this->controller = $controller;
		
		$this->model = $model;
		
		
	} // end __construct
	
	public function cwp_output_editor(){
		
		parent::cwp_output_editor();
		
		include CAHNRSWPVARIETYDIR . '/inc/inc-form-view-variety-pear.php';
		
	} // end method output_editor
	
	
} // end CAHNRSWP_Varieties_Variety