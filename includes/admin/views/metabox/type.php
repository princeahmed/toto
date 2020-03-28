<div class="toto-notification-types">
	<?php

	foreach ( Toto_Notifications::notification_types() as $type => $config ) {
		//$notification = Toto_Notifications::get( $type );
		?>
        <div class="toto-notification-type <?php echo $current_type == $type ? 'active' : ''; ?>">

            <h3 class="toto-notification-type-title"><?php echo $config['name']; ?></h3>

            <div class="toto-notification-type-icon">
                <i class="<?php echo $config['icon']; ?>"></i>
            </div>

            <input type="radio" name="toto_notification_type" value="<?php echo $type; ?>"
                   required="required" <?php checked( $current_type, $type ); ?>>

            <div class="preview" style="display: none">
				<?php

				//				preg_replace( [ '/<form/', '/<\/form>/', '/required=\"required\"/' ], [
				//					'<div',
				//					'</div>',
				//					''
				//				], $notification->html );
				//
				?>
            </div>

        </div>
	<?php } ?>
</div>