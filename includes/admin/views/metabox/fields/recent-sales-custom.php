<div class="conversion-group">
    <div class="conversion-group-header">
        <span class="conversion-group-header-title">Conversion</span>
        <div class="conversion-group-header-tools">
            <span class="conversion_new fa fa-plus button button-primary" title="Add New Conversion"></span>
            <span class="conversion_edit fa fa-edit button" title="Edit Conversion"></span>
            <span class="conversion_copy fa fa-copy button" title="Duplicate Conversion"></span>
            <span class="conversion_delete fa fa-trash button-link-delete" title="Delete Conversion"></span>
        </div>
    </div>
    <div class="conversion-group-body">
        <div class="notification-plus-form-group">
            <label><?php _e( 'Conversion Who:', 'notification-plus' ) ?></label>
            <input type="text" name="settings[custom][][who]" value="<?php echo $who; ?>"/>
        </div>

        <div class="notification-plus-form-group">
            <label><?php _e( 'Conversion Text:', 'notification-plus' ) ?></label>
            <input type="text" name="settings[custom][][text]" value="<?php echo $text; ?>"/>
        </div>

        <div class="notification-plus-form-group">
            <label><?php _e( 'Image:', 'notification-plus' ) ?></label>

            <img src="<?php echo $image; ?>" alt="<?php _e( 'Notification Image', 'notification-plus' ) ?>" class="notification-plus-image-preview <?php echo empty( $image ) ? 'hidden' : ''; ?>">

            <div class="notification-plus-input-group">
                <input type="text" class="notification-plus-image" name="settings[custom][][image]" value="<?php echo $image; ?>"/>
                <button type="button" class="button button-primary notification-plus-choose-image notification-plus-ml-10 notification-plus-mr-10">
					<?php _e( 'Choose Image', 'notification-plus' ) ?>
                </button>
                <button type="button" class="button button-link-delete notification-plus-remove-image <?php echo empty( $image ) ? 'hidden' : ''; ?>">
					<?php _e( 'Remove Image', 'notification-plus' ) ?>
                </button>
            </div>
            <p class="description"><?php _e( 'Leave empty for no image. Hint: icons8.com has a good library of small icons that you can
            use.', 'notification-plus' ) ?></p>
        </div>

        <div class="notification-plus-form-group">
            <label><?php _e( 'Notification URL:', 'notification-plus' ) ?></label>
            <input type="text" name="settings[custom][][url]" value="<?php echo $url; ?>"/>
            <p class="description"><?php _e( 'The URL you want to user to go to after clicking the notification. Leave empty for no
            link.', 'notification-plus' ) ?></p>
        </div>
    </div>
</div>

<script type="text/html" id="tmpl-load-conversion">
    <div class="conversion-group">
        <div class="conversion-group-header">
            <span class="conversion-group-header-title">Conversion</span>
            <div class="conversion-group-header-tools">
                <span class="conversion_new fa fa-plus button button-primary" title="Add New Conversion"></span>
                <span class="conversion_edit fa fa-edit button" title="Edit Conversion"></span>
                <span class="conversion_copy fa fa-copy button" title="Duplicate Conversion"></span>
                <span class="conversion_delete fa fa-trash button-link-delete" title="Delete Conversion"></span>
            </div>
        </div>
        <div class="conversion-group-body">
            <div class="notification-plus-form-group">
                <label><?php _e( 'Conversion Who:', 'notification-plus' ) ?></label>
                <input type="text" name="settings[custom][][who]" value="<?php echo $who; ?>"/>
            </div>

            <div class="notification-plus-form-group">
                <label><?php _e( 'Conversion Text:', 'notification-plus' ) ?></label>
                <input type="text" name="settings[custom][][text]" value="<?php echo $text; ?>"/>
            </div>

            <div class="notification-plus-form-group">
                <label><?php _e( 'Image:', 'notification-plus' ) ?></label>

                <img src="<?php echo $image; ?>" alt="<?php _e( 'Notification Image', 'notification-plus' ) ?>" class="notification-plus-image-preview <?php echo empty( $image ) ? 'hidden' : ''; ?>">

                <div class="notification-plus-input-group">
                    <input type="text" class="notification-plus-image" name="settings[custom][][image]" value="<?php echo $image; ?>"/>
                    <button type="button" class="button button-primary notification-plus-choose-image notification-plus-ml-10 notification-plus-mr-10">
						<?php _e( 'Choose Image', 'notification-plus' ) ?>
                    </button>
                    <button type="button" class="button button-link-delete notification-plus-remove-image <?php echo empty( $image ) ? 'hidden' : ''; ?>">
						<?php _e( 'Remove Image', 'notification-plus' ) ?>
                    </button>
                </div>
                <p class="description"><?php _e( 'Leave empty for no image. Hint: icons8.com has a good library of small icons that you can
            use.', 'notification-plus' ) ?></p>
            </div>

            <div class="notification-plus-form-group">
                <label><?php _e( 'Notification URL:', 'notification-plus' ) ?></label>
                <input type="text" name="settings[custom][][url]" value="<?php echo $url; ?>"/>
                <p class="description"><?php _e( 'The URL you want to user to go to after clicking the notification. Leave empty for no
            link.', 'notification-plus' ) ?></p>
            </div>
        </div>
    </div>
</script>