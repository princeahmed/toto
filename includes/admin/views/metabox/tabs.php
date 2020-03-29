<div class="toto-tab-content">

	<?php

	//type tab
	include TOTO_INCLUDES . '/admin/views/metabox/type.php';

	$settings = require TOTO_INCLUDES . '/admin/views/notifications/settings/settings.' . strtolower( $current_type ) . '.method.php';

	foreach ( $settings->fields as $key => $content ) { ?>
        <div class="toto-tab-content-item flex-column" id="<?php echo $key; ?>">
			<?php echo $content; ?>
        </div>
	<?php } ?>

</div>