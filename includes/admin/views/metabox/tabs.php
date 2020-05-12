<?php defined( 'ABSPATH' ) || exit; ?>

<div class="trust-plus-tab-content">

	<?php

	//type tab
	include TRUST_PLUS_INCLUDES . '/admin/views/metabox/type.php';

	$tabs = Trust_Plus_Notifications::setting_tabs( $current_type );

	foreach ( $tabs as $key => $fields ) { ?>
        <div class="trust-plus-tab-content-item flex-column" id="<?php echo $key; ?>">
			<?php

			foreach ( $fields as $field ) {
				echo Trust_Plus_Notifications::settings_fields( $current_type, $field, $post_id );
			}

			?>
        </div>
	<?php } ?>

</div>