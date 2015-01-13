<div class="varieties-container tab-container">
    <nav>
        <a class="active-tab" href="#">Early</a><a href="#">Midsummer</a><a href="#">Late</a>
    </nav>
    <div class="tab-content">
        <ul class="active-tab">
        	<?php $variety = array( 
				'Gala' => array(
					'img' => 'Gala_bestapple.jpg',
					'par' => 'Kidd\'s Orange Red x Golden Delicious',
					'or' => 'New Zealand',
					'ip' => 'open globally',
					'col' => '75% pinkish-orange stripes over yellow background',
					'flav' => 'sweet, mild balance, moderately dry, crisp textured',
					'stor' => '10 months'
					),
				'Honeycrisp' => array(
					'img' => 'Honeycrisp_bestapples.jpg',
					'par' => 'unknown',
					'or' => 'MN., USA, 1960\'s',
					'ip' => 'open globally',
					'col' => '10 - 80% bright red blush over yellow-gold background',
					'flav' => 'sweet balance, crisp texture',
					'stor' => '6 months'
					),
				'Golden Delicious' => array(
					'img' => 'Golden-Delicious_bestapples.jpg',
					'par' => 'chance seedling (possibly  Grimes Golden x Golden Reinette)',
					'or' => 'W.Va., USA, 1890\'s',
					'ip' => 'open globally',
					'col' => 'yellow',
					'flav' => 'aromatic, balanced, slightly juicy, crisp texture',
					'stor' => '11 months'
					),
				'Jonagold' => array(
					'img' => 'Gala_bestapple.jpg',
					'par' => 'Golden Delicious x Jonathan',
					'or' => 'Geneva, NY, USA, 1943',
					'ip' => 'open globally',
					'col' => '90% orange-red over yellow background',
					'flav' => 'balanced, juicy',
					'stor' => '8 months'
					),
				'Aurora' => array(
					'img' => 'Gala_bestapple.jpg',
					'par' => 'Gala x Splendour',
					'or' => 'Summerland, BC, Canada',
					'ip' => 'club patent Washington state only',
					'col' => 'yellow',
					'flav' => 'sweet balance, \'breaking\' texture',
					'stor' => '6 months'
					),
				'Minnieska' => array(
					'img' => 'Gala_bestapple.jpg',
					'par' => 'Honeycrisp x Zestar',
					'or' => 'MN.,USA, 2005',
					'ip' => 'club patent United States only',
					'col' => '75% red to deep red over yellow background',
					'flav' => 'sweet, balanced, juicy',
					'stor' => '4 months'
					),
				'Ginger Gold' => array(
					'img' => 'Gala_bestapple.jpg',
					'par' => 'unknown (possibly Golden Delicious x Albemerle Pippin)',
					'or' => 'VA, USA, 1960\'s',
					'ip' => 'open United States only',
					'col' => 'yellow',
					'flav' => 'balanced, firm-dry texture',
					'stor' => '2 months'
					),
				'WA5' => array(
					'img' => 'Gala_bestapple.jpg',
					'par' => 'Splendour x Coop 15',
					'or' => 'WSU-TFREC, WA, USA, 1994',
					'ip' => 'restricted patent Washington state only',
					'col' => '60% orange-red stripe over yellow background',
					'flav' => 'balanced sweet/acid, firm, crisp texture',
					'stor' => '3 months'
					),
			);?>
            <?php foreach( $variety as $name => $data ){
				include 'promo.php';
			};?>
        </ul>
        <ul>
            <?php $variety = array( 
				'Red Delicious' => array(
					'img' => 'Gala_bestapple.jpg',
					'par' => 'sport of Delicious',
					'or' => 'Ohio, USA',
					'ip' => 'open globally',
					'col' => '90% bright red to dark red; sometimes striped',
					'flav' => 'sweet, juicy',
					'stor' => '12 months'
					),
			);?>
            <?php foreach( $variety as $name => $data ){
				include 'promo.php';
			};?>
        </ul>
        <ul>
            <?php $variety = array( 
				'Fuji' => array(
					'img' => 'Gala_bestapple.jpg',
					'par' => 'Red Delicious x Ralls Janet',
					'or' => 'Japan, 1960\'s',
					'ip' => 'open globally',
					'col' => '20-90% red-bicolored, striped reddish-pink over yellow',
					'flav' => 'sweet, juicy, medium firm',
					'stor' => '12 months'
					),
			);?>
            <?php foreach( $variety as $name => $data ){
				include 'promo.php';
			};?>
        </ul>
    </div>
</div>
<script type="text/javascript" >
if (window.jQuery) {
	var c_index = ( c_index === 'undefined' || isNaN( c_index )  ) ? 0 : c_index++ ;  
	jQuery('document').ready( function( $ ) {
		var init_tabs = function( c ){
			this.wrap = $( '.tab-container' ).eq( c );
			this.tabs = this.wrap.find( 'nav > a' );
			this.tab_content = this.wrap.find( '.tab-content > ul' );
			this.items = this.tab_content.children('li');
			var s = this;
			
			s.tabs.click( function( e ){
				e.preventDefault();
				s.show_tab( $( this ).index() );
				$( this ).addClass( 'active-tab' ).siblings().removeClass( 'active-tab' );
			});
			
			s.items.on( 'click' , 'a' , function( e ) {
				if ( $( this ).hasClass('lightbox-action') ){
					e.preventDefault();
					var c_item = $( this ).parents('.tab-content-wrapper');
					s.show_lightbox( c_item.find('.lightbox-content') );
					c_item.addClass('active-item').siblings().removeClass('active-item'); 
				}
			});
			
			$('body').on( 'click' , '#lightbox-background , #lightbox-wrapper .close-action' , function( e ){
				if( $( this ).is( 'a' ) ) e.preventDefault();
				s.hide_lightbox();
			});
			
			s.show_tab = function( index ){
				s.tab_content.eq( index ).addClass( 'active-tab' ).siblings().removeClass( 'active-tab' );
			}
			
			$('body').on('click', '#lightbox-frame .lightbox-nav' , function( e ) {
				e.preventDefault();
				var c_active = $('.tab-content-wrapper.active-item'); 
				if( $( this ).hasClass( 'next' ) ){
					var content = c_active.next('.tab-content-wrapper');
					if( content.length <= 0 ) content =  c_active.parent().find('.tab-content-wrapper').first();
				} else {
					var content = c_active.prev('.tab-content-wrapper');
					if( content.length <= 0 ) content =  c_active.parent().find('.tab-content-wrapper').last();
				}
				content.addClass('active-item').siblings().removeClass('active-item');
				s.load_content( content.find('.lightbox-content') );
			});
			
			s.show_lightbox = function( content ) {
				if( $( '#lightbox-wrapper' ).length <= 0 ) s.add_lightbox();
				var scr = $( document ).scrollTop() + 100;
				$( '#lightbox-wrapper' ).css('top', scr+'px'); 
				$( '#lightbox-background, #lightbox-wrapper' ).fadeIn( 'fast' );
				s.load_content( content );
			}
			
			s.load_content = function( content_source ){
				var type = content_source.data('type');
				
				switch ( type ){
					
					case 'html-content':
					default:
						$( '#lightbox-content' ).html( content_source.html() );
						break;
				}
			}
			
			s.hide_lightbox = function(){
				$( '#lightbox-background, #lightbox-wrapper' ).fadeOut( 'fast' );
				$( '#lightbox-content' ).html( '' );
			}
			
			s.add_lightbox = function(){
				var frame = '<div id="lightbox-background" style="display: none"></div>';
				var frame = frame + '<div id="lightbox-wrapper" style="display: none">';
				var frame = frame + '<div id="lightbox-frame">';
				var frame = frame + '<a href="#" class="lightbox-nav next"></a>';
				var frame = frame + '<a href="#" class="lightbox-nav prev"></a>';
				var frame = frame + '<header id="lightbox-header"><a href="#" class="close-action" >Close X</a></header>';
				var frame = frame + '<div id="lightbox-content"></div>';
				var frame = frame + '</div></div>';
				$( 'body' ).append( frame );
			}
			
			
		} // end init_tabs
		window[ 'container-' + c_index ] = new init_tabs( c_index );
	}); // end document ready  
} 
</script>