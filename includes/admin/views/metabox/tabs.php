<div class="toto-tab-content">

	<?php

	//type tab
	include TOTO_INCLUDES . '/admin/views/metabox/type.php';

	$tabs = Toto_Notifications::setting_tabs( $current_type );

	foreach ( $tabs as $key => $fields ) { ?>
        <div class="toto-tab-content-item flex-column" id="<?php echo $key; ?>">
			<?php

			foreach ( $fields as $field ) {
				echo Toto_Notifications::settings_fields( $current_type, $field, $post_id );
			}

			?>
        </div>
	<?php } ?>

</div>