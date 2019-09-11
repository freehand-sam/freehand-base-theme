<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/*

```
Plugin name: WPCF7 Floating Labels
Author: Richard Keller
URI: http://richardkeller.net
Description: Adds floating lables to all text inputs
```
*/
function append_style_and_js( ){


?>
<script type="text/javascript">
	(function($) {	
		$(document).ready(function(){
			$(document).on('focus', 'input[type=text], input[type=email], input[type=tel], textarea', function(e){
				var ph = $(this).attr('placeholder');
				if( ph ){
					$(this).attr('ph', $(this).attr('placeholder') );
					$(this).attr('placeholder', '');
					$(this).parent().append('<div class="floating-label">' + ph + '</div>');
					$(this).parent().find('.floating-label').fadeIn();
				}
			});
		});
	})(jQuery);
</script>
<style type="text/css">

	.wpcf7-form-control-wrap {
	display: block;
	}
	.form-group {
		margin-bottom:0;
	}
	.wpcf7-form-control-wrap .floating-label {
		display: none;
		position: absolute;
		top: -20px;
		z-index: 9;
		left: 12px;
		font-size: 12px;
	}

</style>

<?php

}

add_action('wp_footer', 'append_style_and_js');