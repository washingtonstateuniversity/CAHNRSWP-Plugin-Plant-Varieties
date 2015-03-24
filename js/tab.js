if ( typeof jQuery !== undefined ){ 
	jQuery( "body").on( "click" , "#' . $id . ' > .cwpvarietytab-tab" , function(event){ 
		var c = jQuery( this ); var p = c.parent(); 
		event.preventDefault(); 
		c.addClass( "active" ).siblings(".cwpvarietytab-tab").removeClass( "active"); 
		p.find( ".cwpvarietytab-content").eq( c.index() ).show().siblings( ".cwpvarietytab-content" ).hide(); 
	});
};