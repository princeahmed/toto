<?php defined( 'ABSPATH' ) || exit; ?>

<div class="trust-plus-tab-content-item trust-plus-notification-types active" id="notification_type">
	<?php

	foreach ( Trust_Plus_Notifications::get_config() as $type => $config ) { ?>
        <div class="trust-plus-notification-type <?php echo $current_type == $type ? 'active' : ''; ?>">

            <h3 class="trust-plus-notification-type-title"><?php echo $config['name']; ?></h3>

            <div class="trust-plus-notification-type-icon">
                <i class="<?php echo $config['icon']; ?>"></i>
            </div>

            <input type="radio" name="notification_type" value="<?php echo $type; ?>" required="required" <?php checked( $current_type, $type ); ?>>

            <div class="preview" style="display: none;">
				<?php Trust_Plus_Notifications::preview( $type, $post_id ); ?>
            </div>

        </div>
	<?php } ?>
</div>