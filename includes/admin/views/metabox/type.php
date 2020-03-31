<div class="toto-tab-content-item flex-row toto-notification-types" id="notification_type">
	<?php

	foreach ( Toto_Notifications::get_config() as $type => $config ) {?>
        <div class="toto-notification-type <?php echo $current_type == $type ? 'active' : ''; ?>">

            <h3 class="toto-notification-type-title"><?php echo $config['name']; ?></h3>

            <div class="toto-notification-type-icon">
                <i class="<?php echo $config['icon']; ?>"></i>
            </div>

            <input type="radio" name="notification_type" value="<?php echo $type; ?>" required="required" <?php checked( $current_type, $type ); ?>>

            <div class="preview" style="display: none;">
				<?php

				if ( in_array( $type, [ 'INFORMATIONAL', 'COUPON', 'LIVE_COUNTER', 'EMAIL_COLLECTOR' ] ) ) {
					Toto_Notifications::preview($type, $post_id);
				}

				?>
            </div>

        </div>
	<?php } ?>
</div>