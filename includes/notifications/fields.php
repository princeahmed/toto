<?php

defined( 'ABSPATH' ) || exit();

$title                    = ! empty( $notification['title'] ) ? $notification['title'] : '';
$description              = ! empty( $notification['description'] ) ? $notification['description'] : '';
$image                    = ! empty( $notification['image'] ) ? $notification['image'] : '';
$url                      = ! empty( $notification['url'] ) ? $notification['url'] : '';
$title_color              = ! empty( $notification['title_color'] ) ? $notification['title_color'] : '';
$description_color        = ! empty( $notification['description_color'] ) ? $notification['description_color'] : '';
$background_color         = ! empty( $notification['background_color'] ) ? $notification['background_color'] : '';
$border_radius            = ! empty( $notification['border_radius'] ) ? $notification['border_radius'] : '';
$display_position         = ! empty( $notification['display_position'] ) ? $notification['display_position'] : '';
$display_duration         = ! empty( $notification['display_duration'] ) ? $notification['display_duration'] : '';
$display_close_button     = ! empty( $notification['display_close_button'] ) ? $notification['display_close_button'] : '';
$display_branding         = ! empty( $notification['display_branding'] ) ? $notification['display_branding'] : '';
$trigger_on               = ! empty( $notification['trigger_on'] ) ? $notification['trigger_on'] : '';
$trigger_locations        = ! empty( $notification['trigger_locations'] ) ? $notification['trigger_locations'] : '';
$display_for              = ! empty( $notification['display_for'] ) ? $notification['display_for'] : '';
$custom_post_page_ids     = ! empty( $notification['custom_post_page_ids'] ) ? $notification['custom_post_page_ids'] : '';
$triggers                 = ! empty( $notification['triggers'] ) ? $notification['triggers'] : '';
$display_trigger          = ! empty( $notification['display_trigger'] ) ? $notification['display_trigger'] : '';
$display_trigger_value    = ! empty( $notification['display_trigger_value'] ) ? $notification['display_trigger_value'] : '';
$display_once_per_session = ! empty( $notification['display_once_per_session'] ) ? $notification['display_once_per_session'] : '';
$display_mobile           = ! empty( $notification['display_mobile'] ) ? $notification['display_mobile'] : '';
$email_placeholder        = ! empty( $notification['email_placeholder'] ) ? $notification['email_placeholder'] : '';
$button_text              = ! empty( $notification['button_text'] ) ? $notification['button_text'] : '';
$button_url               = ! empty( $notification['button_url'] ) ? $notification['button_url'] : '';
$last_activity            = ! empty( $notification['last_activity'] ) ? $notification['last_activity'] : '';
$coupon_code              = ! empty( $notification['coupon_code'] ) ? $notification['coupon_code'] : '';
$footer_text              = ! empty( $notification['footer_text'] ) ? $notification['footer_text'] : '';
$show_agreement           = ! empty( $notification['show_agreement'] ) ? $notification['show_agreement'] : '';
$agreement_text           = ! empty( $notification['agreement_text'] ) ? $notification['agreement_text'] : '';
$agreement_url            = ! empty( $notification['agreement_url'] ) ? $notification['agreement_url'] : '';
$button_background_color  = ! empty( $notification['button_background_color'] ) ? $notification['button_background_color'] : '';
$button_color             = ! empty( $notification['button_color'] ) ? $notification['button_color'] : '';
$number_color             = ! empty( $notification['number_color'] ) ? $notification['number_color'] : '';
$number_background_color  = ! empty( $notification['number_background_color'] ) ? $notification['number_background_color'] : '';
$pulse_background_color   = ! empty( $notification['pulse_background_color'] ) ? $notification['pulse_background_color'] : '';
$minimum_activity         = ! empty( $notification['minimum_activity'] ) ? $notification['minimum_activity'] : '';
$enable_sound             = ! empty( $notification['enable_sound'] ) ? $notification['enable_sound'] : '';
$notification_sound       = ! empty( $notification['notification_sound'] ) ? $notification['notification_sound'] : '';
$sound_volume             = ! empty( $notification['sound_volume'] ) ? $notification['sound_volume'] : '';
$show_angry               = ! empty( $notification['show_angry'] ) ? $notification['show_angry'] : '';
$show_sad                 = ! empty( $notification['show_sad'] ) ? $notification['show_sad'] : '';
$show_neutral             = ! empty( $notification['show_neutral'] ) ? $notification['show_neutral'] : '';
$show_happy               = ! empty( $notification['show_happy'] ) ? $notification['show_happy'] : '';
$show_excited             = ! empty( $notification['show_excited'] ) ? $notification['show_excited'] : '';

$conversions_count         = ! empty( $notification['conversions_count'] ) ? $notification['conversions_count'] : '';
$content_title             = ! empty( $notification['content_title'] ) ? $notification['content_title'] : '';
$content_description       = ! empty( $notification['content_description'] ) ? $notification['content_description'] : '';
$content_title_color       = ! empty( $notification['content_title_color'] ) ? $notification['content_title_color'] : '';
$content_description_color = ! empty( $notification['content_description_color'] ) ? $notification['content_description_color'] : '';
$input_placeholder         = ! empty( $notification['input_placeholder'] ) ? $notification['input_placeholder'] : '';
$share_url                 = ! empty( $notification['share_url'] ) ? $notification['share_url'] : '';
$share_facebook            = ! empty( $notification['share_facebook'] ) ? $notification['share_facebook'] : '';
$share_twitter             = ! empty( $notification['share_twitter'] ) ? $notification['share_twitter'] : '';
$share_linkedin            = ! empty( $notification['share_linkedin'] ) ? $notification['share_linkedin'] : '';
$video                     = ! empty( $notification['video'] ) ? $notification['video'] : '';
$time_color                = ! empty( $notification['time_color'] ) ? $notification['time_color'] : '';
$time_background_color     = ! empty( $notification['time_background_color'] ) ? $notification['time_background_color'] : '';
$end_date                  = ! empty( $notification['end_date'] ) ? $notification['end_date'] : '';
$link_url                  = ! empty( $notification['link_url'] ) ? $notification['link_url'] : '';
$link_url_text             = ! empty( $notification['link_url_text'] ) ? $notification['link_url_text'] : '';


$fields = new stdClass();

//Field Title
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_title"><?php _e( 'Title Message', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_title" name="settings[title]" value="<?php echo $title; ?>"/>
    </div>
<?php

$fields->title = ob_get_clean();

//Field Description
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_description"><?php _e( 'Description Message', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_description" name="settings[description]" value="<?php echo $description; ?>"/>
    </div>
<?php

$fields->description = ob_get_clean();

//Field Image
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_image"><?php _e( 'Image', 'social-proof-fomo-notification' ) ?></label>

        <img src="<?php echo $image; ?>" alt="<?php _e( 'Notification Image', 'social-proof-fomo-notification' ) ?>" class="trust-plus-image-preview <?php echo empty( $image ) ? 'hidden' : ''; ?>">

        <div class="trust-plus-input-group">
            <input type="text" id="settings_image" name="settings[image]" value="<?php echo $image; ?>"/>
            <button type="button" class="button button-primary trust-plus-choose-image trust-plus-ml-10 trust-plus-mr-10">
				<?php _e( 'Choose Image', 'social-proof-fomo-notification' ) ?>
            </button>
            <button type="button" class="button button-link-delete trust-plus-remove-image <?php echo empty( $image ) ? 'hidden' : ''; ?>">
				<?php _e( 'Remove Image', 'social-proof-fomo-notification' ) ?>
            </button>
        </div>
        <p class="description"><?php _e( 'Leave empty for no image. Hint: icons8.com has a good library of small icons that you can
            use.', 'social-proof-fomo-notification' ) ?></p>
    </div>
<?php

$fields->image = ob_get_clean();

//Field URL
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_url"><?php _e( 'Notification URL', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_url" name="settings[url]" value="<?php echo $url; ?>"/>
        <p class="description"><?php _e( 'The URL you want to user to go to after clicking the notification. Leave empty for no
            link.', 'social-proof-fomo-notification' ) ?></p>
    </div>
<?php

$fields->url = ob_get_clean();

//Title Color
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_title_color"><?php _e( 'Title Color', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_title_color" class="trust-plus-color-field" name="settings[title_color]" value="<?php echo $title_color; ?>"/>
    </div>
<?php

$fields->title_color = ob_get_clean();

//Description Color
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_description_color"><?php _e( 'Description Color', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_description_color" class="trust-plus-color-field" name="settings[description_color]" value="<?php echo $description_color; ?>"/>
    </div>
<?php

$fields->description_color = ob_get_clean();

//Background Color
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_background_color"><?php _e( 'Background Color', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_background_color" class="trust-plus-color-field" name="settings[background_color]" value="<?php echo $background_color; ?>"/>
    </div>
<?php

$fields->background_color = ob_get_clean();

//Content Title Color
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_content_title_color"><?php _e( 'Content Title Color', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_content_title_color" class="trust-plus-color-field" name="settings[content_title_color]" value="<?php echo $content_title_color; ?>"/>
    </div>
<?php

$fields->content_title_color = ob_get_clean();


//Content Description Color
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_content_description_color"><?php _e( 'Content Description Color', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_content_description_color" class="trust-plus-color-field" name="settings[content_description_color]" value="<?php echo $content_description_color; ?>"/>
    </div>
<?php

$fields->content_description_color = ob_get_clean();

//Border Radius
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_border_radius"><?php _e( 'Border Radius', 'social-proof-fomo-notification' ) ?></label>
        <select id="settings_border_radius" name="settings[border_radius]">
            <option value="straight" <?php selected( 'straight', $border_radius ); ?>><?php _e( 'Straight', 'social-proof-fomo-notification' ) ?></option>
            <option value="rounded" <?php selected( 'rounded', $border_radius ); ?>><?php _e( 'Rounded', 'social-proof-fomo-notification' ) ?></option>
            <option value="round" <?php selected( 'round', $border_radius ) ?>><?php _e( 'Round', 'social-proof-fomo-notification' ) ?></option>
        </select>
        <p class="description"><?php _e( 'Change the shape of the corners of the notification', 'social-proof-fomo-notification' ) ?></p>
    </div>
<?php

$fields->border_radius = ob_get_clean();

//Display Duration
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_display_duration"><?php _e( 'Display Duration', 'social-proof-fomo-notification' ) ?></label>
        <input type="number" min="-1" id="settings_display_duration" name="settings[display_duration]" value="<?php echo $display_duration; ?>" required="required"/>
        <p class="description"><?php _e( 'How many seconds to display the notification. Set -1 to display forever.', 'social-proof-fomo-notification' ) ?></p>
    </div>
<?php
$fields->display_duration = ob_get_clean();

//Minimum activity
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_minimum_activity"><?php _e( 'Minimum activity', 'social-proof-fomo-notification' ) ?></label>
        <input type="number" min="-1" id="settings_minimum_activity" name="settings[minimum_activity]" value="<?php echo $minimum_activity; ?>" required="required"/>
        <p class="description"><?php _e( 'Minimum data needed to display the notification.', 'social-proof-fomo-notification' ) ?></p>
    </div>
<?php
$fields->minimum_activity = ob_get_clean();

//Display Position
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_display_position"><?php _e( 'Display Position', 'social-proof-fomo-notification' ) ?></label>
        <select id="settings_display_position" name="settings[display_position]">
            <option value="top_left" <?php selected( 'top_left', $display_position ) ?>>
				<?php _e( 'Top Left', 'social-proof-fomo-notification' ) ?>
            </option>
            <option value="top_center" <?php selected( 'top_center', $display_position ) ?>>
				<?php _e( 'Top Center', 'social-proof-fomo-notification' ) ?>
            </option>
            <option value="top_right" <?php selected( 'top_right', $display_position ) ?>>
				<?php _e( 'Top Right', 'social-proof-fomo-notification' ) ?>
            </option>
            <option value="middle_left" <?php selected( 'middle_left', $display_position ) ?>>
				<?php _e( 'Middle Left', 'social-proof-fomo-notification' ) ?>
            </option>
            <option value="middle_center" <?php selected( 'middle_center', $display_position ) ?>>
				<?php _e( 'Middle Center', 'social-proof-fomo-notification' ) ?>
            </option>
            <option value="middle_right" <?php selected( 'middle_right', $display_position ) ?>>
				<?php _e( 'Middle Right', 'social-proof-fomo-notification' ) ?>
            </option>
            <option value="bottom_left" <?php selected( 'bottom_left', $display_position ) ?>>
				<?php _e( 'Bottom Left', 'social-proof-fomo-notification' ) ?>
            </option>
            <option value="bottom_center" <?php selected( 'bottom_center', $display_position ) ?>>
				<?php _e( 'Bottom Center', 'social-proof-fomo-notification' ) ?>
            </option>
            <option value="bottom_right" <?php selected( 'bottom_right', $display_position ) ?>>
				<?php _e( 'Bottom Right', 'social-proof-fomo-notification' ) ?>
            </option>
        </select>
        <p class="description"><?php _e( 'Position of the notification on the screen. Position doesn\'t change on the preview.', 'social-proof-fomo-notification' ) ?></p>
    </div>
<?php
$fields->display_position = ob_get_clean();

//Display Close Button
ob_start(); ?>
    <div class="trust-plus-form-group trust-plus-switch-group">
        <input type="checkbox" id="settings_display_close_button" name="settings[display_close_button]" <?php checked( true, $display_close_button ); ?> />
        <label for="settings_display_close_button"><?php _e( 'Display Close Button', 'social-proof-fomo-notification' ) ?></label>
    </div>
<?php
$fields->display_close_button = ob_get_clean();

//Display Branding
ob_start(); ?>
    <div class="trust-plus-form-group trust-plus-switch-group">
        <input type="checkbox" id="settings_display_branding" name="settings[display_branding]" <?php checked( true, $display_branding ) ?> />
        <label for="settings_display_branding"><?php _e( 'Display Branding', 'social-proof-fomo-notification' ) ?></label>
    </div>
<?php
$fields->display_branding = ob_get_clean();

ob_start();
?>
    <div class="trust-plus-form-group flex-row flex-wrap">
        <label for="settings_trigger_on_all" class="trust-plus-mr-20"><?php _e( 'Trigger on:', 'social-proof-fomo-notification' ) ?></label>

        <div class="trust-plus-label-group">
            <input type="radio" id="settings_trigger_on_all" name="settings[trigger_on]" value="all" <?php checked( 'all', $trigger_on ); ?>>
            <label for="settings_trigger_on_all"><?php _e( 'Everywhere', 'social-proof-fomo-notification' ) ?></label>
        </div>

        <div class="trust-plus-label-group">
            <input type="radio" id="settings_trigger_on_selected" name="settings[trigger_on]" value="selected" <?php checked( 'selected', $trigger_on ); ?>>
            <label for="settings_trigger_on_selected"><?php _e( 'Selected Pages', 'social-proof-fomo-notification' ) ?></label>
        </div>

        <div class="trust-plus-label-group">
            <input type="radio" id="settings_trigger_on_shortcode" name="settings[trigger_on]" value="shortcode" <?php checked( 'shortcode', $trigger_on ); ?>>
            <label for="settings_trigger_on_shortcode"><?php _e( 'Use Only As Shortcode', 'social-proof-fomo-notification' ) ?></label>
        </div>

        <div class="trust-plus-break"></div>
        <p class="description"><?php _e( 'Where should the notification show?', 'social-proof-fomo-notification' ) ?></p>
    </div>

    <div class="trust-plus-form-group <?php echo 'selected' == $trigger_on ? '' : 'hidden'; ?>">
        <label for="settings_trigger_locations" class="trust-plus-mr-20"><?php _e( 'Select Locations:', 'social-proof-fomo-notification' ) ?></label>
        <select name="settings[trigger_locations][]" class="trust-plus-select2" id="settings_trigger_locations" multiple>
			<?php
			foreach ( trust_plus_locations() as $key => $val ) {
				printf( '<option value="%1$s" %3$s>%2$s</option>', $key, $val, ! empty( $trigger_locations ) && in_array( $key, $trigger_locations ) ? 'selected' : '' );
			}
			?>
        </select>
        <p class="description"><?php _e( 'You can select multiple locations.', 'social-proof-fomo-notification' ) ?></p>
    </div>

    <div class="trust-plus-form-group <?php echo ! empty( $trigger_locations ) && in_array( 'is_custom', $trigger_locations ) ? '' : 'hidden'; ?>">
        <label for="settings_custom_post_page_ids" class="trust-plus-mr-20"><?php _e( 'Post/ Page IDs:', 'social-proof-fomo-notification' ) ?> </label>
        <input type="text" name="settings[custom_post_page_ids]" id="settings_custom_post_page_ids" value="<?php echo $custom_post_page_ids; ?>">
        <p class="description"><?php _e( 'Comma Separated ID of Post, Page or Custom Post Type Posts.', 'social-proof-fomo-notification' ) ?></p>
    </div>

<?php
$fields->trigger = ob_get_clean();

ob_start();
?>
    <div class="trust-plus-form-group flex-row flex-wrap">
        <label for="settings_display_for_all" class="trust-plus-mr-20"><?php _e( 'Display For:', 'social-proof-fomo-notification' ) ?> </label>

        <div class="trust-plus-label-group">
            <input type="radio" id="settings_display_for_all" name="settings[display_for]" value="all" <?php checked( 'all', $display_for ); ?>>
            <label for="settings_display_for_all"><?php _e( 'Everyone', 'social-proof-fomo-notification' ) ?></label>
        </div>

        <div class="trust-plus-label-group">
            <input type="radio" id="settings_display_for_logged_in" name="settings[display_for]" value="logged_in" <?php checked( 'logged_in', $display_for ); ?>>
            <label for="settings_display_for_logged_in"><?php _e( 'Logged In Users', 'social-proof-fomo-notification' ) ?></label>
        </div>

        <div class="trust-plus-label-group">
            <input type="radio" id="settings_display_for_logged_out" name="settings[display_for]" value="logged_out" <?php checked( 'logged_out', $display_for ); ?>>
            <label for="settings_display_for_logged_out"><?php _e( 'Logged Out Users', 'social-proof-fomo-notification' ) ?></label>
        </div>

        <div class="trust-plus-break"></div>
        <p class="description"><?php _e( 'Who should see the notification?', 'social-proof-fomo-notification' ) ?></p>
    </div>

<?php
$fields->display_for = ob_get_clean();

//Display Trigger
ob_start(); ?>
    <div class="trust-plus-form-group" id="display_trigger">
        <label for="settings_display_trigger"><?php _e( 'Display Trigger', 'social-proof-fomo-notification' ) ?></label>

        <div class="trust-plus-input-group">
            <select id="settings_display_trigger" name="settings[display_trigger]">
                <option value="delay" data-placeholder="Number of seconds to wait until notification shows up" <?php selected( 'delay', $display_trigger ) ?>>
					<?php _e( 'Delay', 'social-proof-fomo-notification' ) ?>
                </option>
                <option value="exit_intent" <?php selected( 'exit_intent', $display_trigger ) ?>>
					<?php _e( 'Exit Intent', 'social-proof-fomo-notification' ) ?>
                </option>
                <option value="scroll" data-placeholder="Percent of scrolling from the top down." <?php selected( 'scroll', $display_trigger ) ?>>
					<?php _e( 'Scroll Percentage', 'social-proof-fomo-notification' ) ?>
                </option>
            </select>

            <input type="number" min="0" class="<?php echo 'exit_intent' == $display_trigger ? 'hidden' : ''; ?>" name="settings[display_trigger_value]" value="<?php echo $display_trigger_value; ?>"/>

        </div>

        <p class="description"><?php _e( 'On what event the notification should show up.', 'social-proof-fomo-notification' ) ?></p>
    </div>
<?php
$fields->display_trigger = ob_get_clean();

//Trigger Session
ob_start(); ?>
    <div class="trust-plus-form-group trust-plus-switch-group">
        <input type="checkbox" id="settings_display_once_per_session" name="settings[display_once_per_session]" <?php checked( true, $display_once_per_session ); ?> >

        <label class="clickable" for="settings_display_once_per_session"><?php _e( 'Display notification once per session', 'social-proof-fomo-notification' ) ?></label>

        <p class="description"><?php _e( 'A visitor session is cleared once the browser is closed.', 'social-proof-fomo-notification' ) ?></p>
    </div>
<?php
$fields->display_once_per_session = ob_get_clean();

//Display Mobile
ob_start(); ?>
    <div class="trust-plus-form-group trust-plus-switch-group">
        <input type="checkbox" id="settings_display_mobile" name="settings[display_mobile]" <?php checked( true, $display_mobile ); ?> >

        <label class="clickable" for="settings_display_mobile"><?php _e( 'Display on Mobile', 'social-proof-fomo-notification' ) ?></label>

        <p class="description"><?php _e( 'Whether or not to display the notification on when pixels available are smaller than
            768px.', 'social-proof-fomo-notification' ) ?></p>
    </div>
<?php
$fields->display_mobile = ob_get_clean();

//Email Placeholder
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_email_placeholder"><?php _e( 'Email Placeholder', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_email_placeholder" name="settings[email_placeholder]" value="<?php echo $email_placeholder; ?>"/>
    </div>
<?php

$fields->email_placeholder = ob_get_clean();

//Button Text
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_button_text"><?php _e( 'Button Text', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_button_text" name="settings[button_text]" value="<?php echo $button_text; ?>"/>
    </div>
<?php

$fields->button_text = ob_get_clean();

//Button URL
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_button_url"><?php _e( 'Button URL', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_button_url" name="settings[button_url]" value="<?php echo $button_url; ?>"/>
    </div>
<?php

$fields->button_url = ob_get_clean();

//Last Active
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_last_activity"><?php _e( 'Count data from last X minutes', 'social-proof-fomo-notification' ) ?></label>
        <input type="number" id="settings_last_activity" name="settings[last_activity]" value="<?php echo $last_activity; ?>"/>
    </div>
<?php

$fields->last_activity = ob_get_clean();

//Coupon Code
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_coupon_code"><?php _e( 'Coupon Code', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_coupon_code" name="settings[coupon_code]" value="<?php echo $coupon_code; ?>"/>
    </div>
<?php

$fields->coupon_code = ob_get_clean();

//Footer Text
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_footer_text"><?php _e( 'Footer Text', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_footer_text" name="settings[footer_text]" value="<?php echo $footer_text; ?>"/>
    </div>
<?php

$fields->footer_text = ob_get_clean();

//Agreement
ob_start(); ?>
    <div class="trust-plus-form-group trust-plus-switch-group" data-target="#settings_agreement_text,#settings_agreement_url">
        <input type="checkbox" class="handle-toggle" id="settings_show_agreement" name="settings[show_agreement]" <?php checked( true, $show_agreement ); ?> >

        <label class="clickable" for="settings_show_agreement"><?php _e( 'Show Agreement', 'social-proof-fomo-notification' ) ?></label>

        <p class="description"><?php _e( 'Require the user to confirm his agreement by ticking a checkbox.', 'social-proof-fomo-notification' ) ?></p>
    </div>

    <div id="agreement">
        <div class="trust-plus-form-group <?php echo $show_agreement ? '' : 'hidden'; ?>">
            <label for="settings_agreement_text"><?php _e( 'Agreement Text', 'social-proof-fomo-notification' ) ?></label>
            <input type="text" id="settings_agreement_text" name="settings[agreement_text]" value="<?php echo $agreement_text; ?>"/>
        </div>

        <div class="trust-plus-form-group <?php echo $show_agreement ? '' : 'hidden'; ?>">
            <label for="settings_agreement_url"><?php _e( 'Agreement URL', 'social-proof-fomo-notification' ) ?></label>
            <input type="text" id="settings_agreement_url" name="settings[agreement_url]" value="<?php echo $agreement_url; ?>"/>
        </div>
    </div>
<?php
$fields->agreement = ob_get_clean();

//Button Background Color
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_button_background_color"><?php _e( 'Button Background Color', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_button_background_color" class="trust-plus-color-field" name="settings[button_background_color]" value="<?php echo $button_background_color; ?>"/>
    </div>
<?php

$fields->button_background_color = ob_get_clean();

//Button Background Color
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_button_background_color"><?php _e( 'Button Background Color', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_button_background_color" class="trust-plus-color-field" name="settings[button_background_color]" value="<?php echo $button_background_color; ?>"/>
    </div>
<?php

$fields->button_background_color = ob_get_clean();

//Button Color
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_button_color"><?php _e( 'Button Color', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_button_color" class="trust-plus-color-field" name="settings[button_color]" value="<?php echo $button_color; ?>"/>
    </div>
<?php

$fields->button_color = ob_get_clean();

//Number Color
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_number_color"><?php _e( 'Number Color', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_number_color" class="trust-plus-color-field" name="settings[number_color]" value="<?php echo $number_color; ?>"/>
    </div>
<?php

$fields->number_color = ob_get_clean();

//Time Color
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_time_color"><?php _e( 'Time Color', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_time_color" class="trust-plus-color-field" name="settings[time_color]" value="<?php echo $time_color; ?>"/>
    </div>
<?php

$fields->time_color = ob_get_clean();

//Time Background Color
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_time_background_color"><?php _e( 'Time Background Color', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_time_background_color" class="trust-plus-color-field" name="settings[time_background_color]" value="<?php echo $time_background_color; ?>"/>
    </div>
<?php

$fields->time_background_color = ob_get_clean();

//Number Background Color
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_number_background_color"><?php _e( 'Number Background Color', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_number_background_color" class="trust-plus-color-field" name="settings[number_background_color]" value="<?php echo $number_background_color; ?>"/>
    </div>
<?php

$fields->number_background_color = ob_get_clean();

//Pulse Background Color
ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_pulse_background_color"><?php _e( 'Pulse Background Color', 'social-proof-fomo-notification' ) ?></label>
        <input type="text" id="settings_pulse_background_color" class="trust-plus-color-field" name="settings[pulse_background_color]" value="<?php echo $pulse_background_color; ?>"/>
    </div>
<?php

$fields->pulse_background_color = ob_get_clean();

//Trigger Session
ob_start(); ?>
    <div class="trust-plus-form-group trust-plus-switch-group" data-target="#settings_notification_sound,#settings_sound_volume">
        <input type="checkbox" class="handle-toggle" id="settings_enable_sound" name="settings[enable_sound]" <?php checked( true, $enable_sound ); ?> >

        <label class="clickable" for="settings_enable_sound"><?php _e( 'Enable Notification Sound', 'social-proof-fomo-notification' ) ?></label>

        <p class="description"><?php _e( 'Enable to play a sound when the notification will show.', 'social-proof-fomo-notification' ) ?></p>
    </div>

    <div class="trust-plus-form-group <?php echo $enable_sound ? '' : 'hidden'; ?>">
        <label for="settings_notification_sound"><?php _e( 'Select Notification Sound', 'social-proof-fomo-notification' ) ?></label>
		<?php
		$sounds = [
			'to-the-point'     => __( 'To The Point', 'social-proof-fomo-notification' ),
			'subscription-two' => __( 'Subscription Two', 'social-proof-fomo-notification' ),
			'subscription-one' => __( 'Subscription One', 'social-proof-fomo-notification' ),
			'intuition'        => __( 'Intuition', 'social-proof-fomo-notification' ),
			'review-one'       => __( 'Review One', 'social-proof-fomo-notification' ),
			'review-two'       => __( 'Review Two', 'social-proof-fomo-notification' ),
			'sales-one'        => __( 'Sales One', 'social-proof-fomo-notification' ),
			'sales-two'        => __( 'Sales Two', 'social-proof-fomo-notification' ),
			'stats-one'        => __( 'Stats One', 'social-proof-fomo-notification' ),
			'stats-two'        => __( 'Stats Two', 'social-proof-fomo-notification' ),
		];

		?>
        <select name="settings[notification_sound]" id="settings_notification_sound">
            <option value=""><?php _e( 'Select Sound', 'social-proof-fomo-notification' ) ?></option>
			<?php

			foreach ( $sounds as $key => $title ) {
				printf( '<option value="%1$s" %3$s>%2$s</option>', $key, $title, selected( $key, $notification_sound ) );
			}

			?>
        </select>

        <div class="play-sound hidden">
            <audio id="trust-plus-sound">
                <source src="<?php echo ! empty( $notification_sound ) ? TRUST_PLUS_ASSETS . '/sounds/' . $notification_sound . '.mp3' : ''; ?>" type="audio/mpeg">
				<?php _e( 'Your browser does not support the audio element.', 'social-proof-fomo-notification' ) ?>
            </audio>
        </div>

    </div>
    <div class="trust-plus-form-group <?php echo $enable_sound ? '' : 'hidden'; ?>">
        <label for="settings_sound_volume"><?php _e( 'Notification Sound Volume', 'social-proof-fomo-notification' ) ?></label>
        <input type="hidden" name="settings[sound_volume]" id="settings_sound_volume" value="<?php echo $sound_volume; ?>"/>

        <div id="trust-plus-volume-slider" class="trust-plus-volume-slider" data-value="<?php echo $sound_volume; ?>">
            <div id="trust-plus-volume-handle" class="trust-plus-volume-handle ui-slider-handle"></div>
        </div>

        <p class="description"><?php _e( 'Adjust the notification sound volume.', 'social-proof-fomo-notification' ) ?></p>

    </div>

<?php
$fields->enable_sound = ob_get_clean();

ob_start(); ?>
    <div class="trust-plus-form-group trust-plus-switch-group">
        <input type="checkbox" id="settings_show_angry" name="settings[show_angry]" <?php checked( true, $show_angry ); ?> >

        <label class="clickable" for="settings_show_angry"><?php _e( 'Show Angry', 'social-proof-fomo-notification' ) ?></label>
    </div>
    <div class="trust-plus-form-group trust-plus-switch-group">
        <input type="checkbox" id="settings_show_sad" name="settings[show_sad]" <?php checked( true, $show_sad ); ?> >

        <label class="clickable" for="settings_show_sad"><?php _e( 'Show Sad', 'social-proof-fomo-notification' ) ?></label>
    </div>
    <div class="trust-plus-form-group trust-plus-switch-group">
        <input type="checkbox" id="settings_show_neutral" name="settings[show_neutral]" <?php checked( true, $show_neutral ); ?> >

        <label class="clickable" for="settings_show_neutral"><?php _e( 'Show Neutral', 'social-proof-fomo-notification' ) ?></label>
    </div>
    <div class="trust-plus-form-group trust-plus-switch-group">
        <input type="checkbox" id="settings_show_happy" name="settings[show_happy]" <?php checked( true, $show_happy ); ?> >

        <label class="clickable" for="settings_show_happy"><?php _e( 'Show Happy', 'social-proof-fomo-notification' ) ?></label>
    </div>
    <div class="trust-plus-form-group trust-plus-switch-group">
        <input type="checkbox" id="settings_show_excited" name="settings[show_excited]" <?php checked( true, $show_excited ); ?> >

        <label class="clickable" for="settings_show_excited"><?php _e( 'Show Excited', 'social-proof-fomo-notification' ) ?></label>
    </div>
<?php
$fields->emoji = ob_get_clean();

ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_conversions_count"><?php _e('How many conversions to show?', 'social-proof-fomo-notification') ?></label>
        <input type="text" id="settings_conversions_count" name="settings[conversions_count]" value="<?php echo $conversions_count ?>"/>
    </div>
<?php
$fields->conversions_count = ob_get_clean();

ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_content_title"><?php _e('Content Title', 'social-proof-fomo-notification') ?></label>
        <input type="text" id="settings_content_title" name="settings[content_title]" value="<?php echo $content_title ?>"/>
    </div>
<?php
$fields->content_title = ob_get_clean();

ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_content_description"><?php _e('Content Description', 'social-proof-fomo-notification') ?></label>
        <input type="text" id="settings_content_description" name="settings[content_description]" value="<?php echo $content_description ?>"/>
    </div>
<?php
$fields->content_description = ob_get_clean();

ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_input_placeholder"><?php _e('Input Placeholder', 'social-proof-fomo-notification') ?></label>
        <input type="text" id="settings_input_placeholder" name="settings[input_placeholder]" value="<?php echo $input_placeholder ?>"/>
    </div>
<?php
$fields->input_placeholder = ob_get_clean();

ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_share_url"><?php _e('Share URL', 'social-proof-fomo-notification') ?></label>
        <input type="text" id="settings_share_url" name="settings[share_url]" value="<?php echo $share_url ?>"/>
        <p class="description"><?php _e('Leave empty if you want the URL to be dynamic to the current page where the notification
            is shown.', 'social-proof-fomo-notification') ?></p>
    </div>

    <div class="trust-plus-form-group trust-plus-switch-group">
        <input type="checkbox" id="settings_share_facebook" name="settings[share_facebook]" <?php checked( true, $share_facebook ); ?> >

        <label class="clickable" for="settings_share_facebook"><i class="fab fa-facebook"></i> <?php _e('Facebook Share', 'social-proof-fomo-notification') ?></label>
    </div>

    <div class="trust-plus-form-group trust-plus-switch-group">
        <input type="checkbox" id="settings_share_twitter" name="settings[share_twitter]" <?php checked( true, $share_twitter ); ?> >

        <label class="clickable" for="settings_share_twitter"><i class="fab fa-twitter"></i> <?php _e('Twitter Share', 'social-proof-fomo-notification') ?></label>
    </div>

    <div class="trust-plus-form-group trust-plus-switch-group">
        <input type="checkbox" id="settings_share_linkedin" name="settings[share_linkedin]" <?php checked( true, $share_linkedin ); ?> >

        <label class="clickable" for="settings_share_linkedin"><i class="fab fa-linkedin"></i> <?php _e('Linkedin Share', 'social-proof-fomo-notification') ?></label>
    </div>
<?php
$fields->share_url = ob_get_clean();

ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_video"><?php _e('YouTube Video Url', 'social-proof-fomo-notification') ?></label>
        <input type="text" id="settings_video" name="settings[video]" value="<?php echo $video ?>"/>
        <p class="description"><?php _e('Ex: https://www.youtube.com/watch?v=3WxQgvuT6ZI', 'social-proof-fomo-notification') ?></p>
    </div>
<?php
$fields->video = ob_get_clean();

ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_end_date"><?php _e('End Date', 'social-proof-fomo-notification') ?></label>
        <input type="text" id="settings_end_date" class="trust-plus-date-time-picker" name="settings[end_date]" value="<?php echo $end_date ?>"/>
        <p class="description"><?php _e('Ex: https://www.youtube.com/embed/3WxQgvuT6ZI', 'social-proof-fomo-notification') ?></p>
    </div>
<?php
$fields->end_date = ob_get_clean();

ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_link_url"><?php _e('Link URL', 'social-proof-fomo-notification') ?></label>
        <input type="text" id="settings_link_url" class="trust-plus-date-time-picker" name="settings[link_url]" value="<?php echo $link_url ?>"/>
    </div>
<?php
$fields->link_url = ob_get_clean();

ob_start(); ?>
    <div class="trust-plus-form-group">
        <label for="settings_link_url_text"><?php _e('Link URL Text', 'social-proof-fomo-notification') ?></label>
        <input type="text" id="settings_link_url_text" class="trust-plus-date-time-picker" name="settings[link_url_text]" value="<?php echo $link_url_text ?>"/>
    </div>
<?php
$fields->link_url_text = ob_get_clean();

return $fields;