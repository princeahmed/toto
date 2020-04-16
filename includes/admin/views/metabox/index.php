<?php

global $post_id;

$current_type = get_post_meta( $post_id, '_notification_type', true );

if ( ! $current_type ) {
	$active_modules = toto_get_options( 'active_modules' );
	$current_type   =  $active_modules[0];
}

include TOTO_INCLUDES . '/admin/views/metabox/preview.php';
include TOTO_INCLUDES . '/admin/views/metabox/menu.php';
include TOTO_INCLUDES . '/admin/views/metabox/tabs.php';

?>
<div class="toto-next-prev">
	<a href="#" class="toto-prev"><i class="fa fa-angle-left"></i> Previous</a>
	<a href="#" class="toto-next">Next <i class="fa fa-angle-right"></i></a>
</div>
