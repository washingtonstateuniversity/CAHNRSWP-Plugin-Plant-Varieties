<?php wp_nonce_field('submit_variety','variety_nonce'); ?>
<?php foreach( $this->model->fields as $name => $data ){ 
	if( 'all' == $data['supports'][0] || in_array( $this->model->variety_type , $data['supports'] ) ) {
		echo '<div id="variety_'.$name.'_setting" class="variety-setting-field"><div class="variety-inner">';
		$value = ( isset( $this->model->$name ) )? $this->model->$name : '';
		$label = '<label for="variety_'.$name.'">'.$data['label'].': </label>';
		if( 'select' == $data['type'] ){
			echo $label;
			echo '<select name="_'.$name.'" id="variety_'.$name.'">';
			foreach( $data['values'] as $val_key => $val_name ){
				echo '<option value="'.$val_key.'" '.selected( $value  , $val_key , false ).'>'.$val_name.'</option>';
			}
			echo '</select>';
		} else {
			if( 'checkbox' != $data['type'] ) echo $label;
			echo '<input type="'.$data['type'].'" name="_'.$name.'" id="variety_'.$name.'" value="'.$value.'"/>';
			if( 'checkbox' == $data['type'] ) echo $label;
		}
		echo '</div></div>'; 
	} // end if
};?>