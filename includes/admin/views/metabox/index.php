<?php

defined( 'ABSPATH' ) || exit;

global $post_id;

$current_type = get_post_meta( $post_id, '_notification_type', true );

if ( ! $current_type ) {
	$current_type = array_key_first(Trust_Plus_Notifications::get_config());
}

include TRUST_PLUS_INCLUDES . '/admin/views/metabox/preview.php';
include TRUST_PLUS_INCLUDES . '/admin/views/metabox/menu.php';
include TRUST_PLUS_INCLUDES . '/admin/views/metabox/tabs.php';

?>
<div class="trust-plus-next-prev">
    <a href="#" class="trust-plus-prev"><i class="fa fa-angle-left"></i> <?php _e( 'Previous', 'social-proof-fomo-notification' ); ?>
    </a> <a href="#" class="trust-plus-next"><?php _e( 'Next', 'social-proof-fomo-notification' ); ?>
        <i class="fa fa-angle-right"></i></a>
</div>
