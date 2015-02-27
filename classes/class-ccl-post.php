<?php
/*
 * version: 0.0.2
*/

class CCL_Post_Varieties {
	
	public function get_featured_image_url( $post_id , $size = 'thumbnail' ){
		
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
		
		$url = ( ! empty( $image[0] ) )? $image[0] : '';
		
		return $url;
		
	}

	
}