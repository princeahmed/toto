<div class="notification-plus-form-group">
    <label for="settings_woo_who"><?php _e( 'Conversion Who:', 'notification-plus' ) ?></label>
    <input type="text" id="settings_woo_who" name="settings[woo_who]" value="<?php echo $who; ?>"/>
    <p class="description">You can insert dynamic variables from your Order Data. Available Variables:
        <code>{full_name}</code>, <code>{first_name}</code>, <code>{last_name}</code>, <code>{product_name}</code>
    </p>
</div>

<div class="notification-plus-form-group">
    <label for="settings_woo_text"><?php _e( 'Conversion Text:', 'notification-plus' ) ?></label>
    <input type="text" id="settings_woo_text" name="settings[woo_text]" value="<?php echo $text; ?>"/>
    <p class="description">You can insert dynamic variables from your Order Data. Available Variables:
        <code>{full_name}</code>, <code>{first_name}</code>, <code>{last_name}</code>, <code>{product_name}</code>
    </p>
</div>

<div class="notification-plus-form-group flex-row align-center">
    <label for="settings_image_type" class="notification-plus-mr-10"><?php _e( 'Image Type:', 'notification-plus' ) ?></label>
    <select name="settings[image_type]" id="settings_image_type">
        <option value="none" <?php selected( 'none', $image_type ) ?>>None</option>
        <option value="featured" <?php selected( 'featured', $image_type ) ?>>Featured</option>
        <option value="custom" <?php selected( 'custom', $image_type ) ?>>Custom</option>
    </select>
</div>

<div class="notification-plus-form-group <?php echo 'custom' != $image_type ? 'hidden' : ''; ?>">
    <label for="settings_image"><?php _e( 'Image', 'notification-plus' ) ?></label>

    <img src="<?php echo $image; ?>" alt="<?php _e( 'Notification Image', 'notification-plus' ) ?>" class="notification-plus-image-preview <?php echo empty( $image ) ? 'hidden' : ''; ?>">

    <div class="notification-plus-input-group">
        <input type="text" class="notification-plus-image" id="settings_image" name="settings[image]" value="<?php echo $image; ?>"/>
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

<div class="notification-plus-form-group flex-row align-center">
    <label for="settings_url_type" class="notification-plus-mr-10"><?php _e( 'Notification URL Type:', 'notification-plus' ) ?></label>
    <select name="settings[url_type]" id="settings_url_type">
        <option value="none" <?php selected( 'none', $url_type ) ?>>None</option>
        <option value="product_page" <?php selected( 'product_page', $url_type ) ?>>Product Page
        </option>
        <option value="custom" <?php selected( 'custom', $url_type ) ?>>Custom</option>
    </select>
</div>

<div class="notification-plus-form-group <?php echo 'custom' != $url_type ? 'hidden' : ''; ?>">
    <label for="settings_url"><?php _e( 'Notification URL', 'notification-plus' ) ?></label>
    <input type="text" id="settings_url" name="settings[url]" value="<?php echo $url; ?>"/>
    <p class="description"><?php _e( 'The URL you want to user to go to after clicking the notification. Leave empty for no
            link.', 'notification-plus' ) ?></p>
</div>

<div class="notification-plus-form-group flex-row align-center">
    <label for="settings_product_type" class="notification-plus-mr-10"><?php _e( 'Show Notification of:', 'notification-plus' ) ?></label>
    <select name="settings[product_type]" id="settings_product_type">
        <option value="all" <?php selected( 'all', $product_type ) ?>>All Products</option>
        <option value="category" <?php selected( 'category', $product_type ) ?>>Specific Category(s)
        </option>
        <option value="product" <?php selected( 'product', $product_type ) ?>>Specific Product(s)
        </option>
    </select>
</div>

<div class="notification-plus-form-group <?php echo 'product' != $product_type ? 'hidden' : ''; ?>">
    <label for="settings_product"><?php _e( 'Select Product(s):', 'notification-plus' ) ?></label>
    <input type="text" id="settings_product" name="settings[product]" value="<?php echo $product; ?>"/>
    <p class="description"><?php _e( 'Select the specific product.', 'notification-plus' ) ?></p>
</div>

<div class="notification-plus-form-group <?php echo 'category' != $product_type ? 'hidden' : ''; ?>">
    <label for="settings_category"><?php _e( 'Select Category(s):', 'notification-plus' ) ?></label>
    <input type="text" id="settings_category" name="settings[category]" value="<?php echo $category; ?>"/>
    <p class="description"><?php _e( 'Select the specific product category.', 'notification-plus' ) ?></p>
</div>