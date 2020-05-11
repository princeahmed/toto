<?php defined( 'ABSPATH' ) || exit; ?>

<div id="notification_preview" class="notification-preview d-flex">

    <h3 class="notification-preview-title"><i class="fa fa-eye mr-2"></i> <?php _e('Preview', 'toto') ?></h3>

    <div class="notification-preview-content">
		<?php
		global $post_id;
		Toto_Notifications::preview( $current_type, $post_id );
		?>
    </div>
</div>