<?php include_once( dirname(__FILE__).'/include_js.php' ); ?>

	</div><!-- / bootstrap-wpadmin -->
</div><!-- / wrap -->

<script type="text/javascript">
	/*
	function triggerColor( inoEl ) {
		var $ = jQuery;

		var $oThis = $( inoEl );
		var aParts = $oThis.attr( 'id' ).split( '_' );

		var $oColorInput = $( '#<?php echo $icwp_var_prefix; ?>less_'+ aParts[3] );

		if ( $oThis.is( ':checked' ) ) {
			$oColorInput.miniColors( 'destroy' );
			$oColorInput.css( 'width', '130px' );
		}
		else {
			$oColorInput.miniColors();
			$oColorInput.css( 'width', '100px' );
		}
	}

	jQuery( document ).ready(
		function() {
			var $ = jQuery;

			$( 'input[name^=hlt_toggle_less]' ).on( 'click',
				function() {
					triggerColor( this );
				}
			);

			$( 'input[name^=hlt_toggle_less]' ).each(
				function( index, el ) {
					triggerColor( this );
				}
			);

		}
	);
	*/
	</script>