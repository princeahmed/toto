<div class="toto-tab-content-item toto-notification-types" id="notification_type">
	<?php

	$default        = array_keys( Toto_Notifications::get_config() );
	$active_modules = toto_get_options( 'active_modules', $default );

	foreach ( Toto_Notifications::get_config() as $type => $config ) {

//		if ( ! in_array( $type, $active_modules ) ) {
//			continue;
//		}

		?>
        <div class="toto-notification-type <?php echo $current_type == $type ? 'active' : ''; ?>">

            <h3 class="toto-notification-type-title"><?php echo $config['name']; ?></h3>

            <div class="toto-notification-type-icon">
                <i class="<?php echo $config['icon']; ?>"></i>
            </div>

            <input type="radio" name="notification_type" value="<?php echo $type; ?>" required="required" <?php checked( $current_type, $type ); ?>>

            <div class="preview" style="display: none;">
				<?php Toto_Notifications::preview( $type, $post_id ); ?>
            </div>

        </div>
	<?php } ?>
</div>