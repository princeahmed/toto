<?php

defined( 'ABSPATH' ) || exit();

$title                     = ! empty( $notification['title'] ) ? $notification['title'] : '';
$description               = ! empty( $notification['description'] ) ? $notification['description'] : '';
$image                     = ! empty( $notification['image'] ) ? $notification['image'] : '';
$url                       = ! empty( $notification['url'] ) ? $notification['url'] : '';
$title_color               = ! empty( $notification['title_color'] ) ? $notification['title_color'] : '';
$description_color         = ! empty( $notification['description_color'] ) ? $notification['description_color'] : '';
$background_color          = ! empty( $notification['background_color'] ) ? $notification['background_color'] : '';
$border_radius             = ! empty( $notification['border_radius'] ) ? $notification['border_radius'] : '';
$display_position          = ! empty( $notification['display_position'] ) ? $notification['display_position'] : '';
$display_duration          = ! empty( $notification['display_duration'] ) ? $notification['display_duration'] : '';
$display_close_button      = ! empty( $notification['display_close_button'] ) ? $notification['display_close_button'] : '';
$display_branding          = ! empty( $notification['display_branding'] ) ? $notification['display_branding'] : '';
$trigger_on                = ! empty( $notification['trigger_on'] ) ? $notification['trigger_on'] : '';
$trigger_locations         = ! empty( $notification['trigger_locations'] ) ? $notification['trigger_locations'] : '';
$custom_post_page_ids      = ! empty( $notification['custom_post_page_ids'] ) ? $notification['custom_post_page_ids'] : '';
$triggers                  = ! empty( $notification['triggers'] ) ? $notification['triggers'] : '';
$display_trigger           = ! empty( $notification['display_trigger'] ) ? $notification['display_trigger'] : '';
$display_trigger_value     = ! empty( $notification['display_trigger_value'] ) ? $notification['display_trigger_value'] : '';
$display_once_per_session  = ! empty( $notification['display_once_per_session'] ) ? $notification['display_once_per_session'] : '';
$display_mobile            = ! empty( $notification['display_mobile'] ) ? $notification['display_mobile'] : '';
$email_placeholder         = ! empty( $notification['email_placeholder'] ) ? $notification['email_placeholder'] : '';
$button_text               = ! empty( $notification['button_text'] ) ? $notification['button_text'] : '';
$button_url                = ! empty( $notification['button_url'] ) ? $notification['button_url'] : '';
$last_activity             = ! empty( $notification['last_activity'] ) ? $notification['last_activity'] : '';
$coupon_code               = ! empty( $notification['coupon_code'] ) ? $notification['coupon_code'] : '';
$footer_text               = ! empty( $notification['footer_text'] ) ? $notification['footer_text'] : '';
$show_agreement            = ! empty( $notification['show_agreement'] ) ? $notification['show_agreement'] : '';
$agreement_text            = ! empty( $notification['agreement_text'] ) ? $notification['agreement_text'] : '';
$agreement_url             = ! empty( $notification['agreement_url'] ) ? $notification['agreement_url'] : '';
$button_background_color   = ! empty( $notification['button_background_color'] ) ? $notification['button_background_color'] : '';
$button_color              = ! empty( $notification['button_color'] ) ? $notification['button_color'] : '';
$number_color              = ! empty( $notification['number_color'] ) ? $notification['number_color'] : '';
$number_background_color   = ! empty( $notification['number_background_color'] ) ? $notification['number_background_color'] : '';
$pulse_background_color    = ! empty( $notification['pulse_background_color'] ) ? $notification['pulse_background_color'] : '';
$data_send_is_enabled      = ! empty( $notification['data_send_is_enabled'] ) ? $notification['data_send_is_enabled'] : '';
$data_send_webhook         = ! empty( $notification['data_send_webhook'] ) ? $notification['data_send_webhook'] : '';
$data_send_email           = ! empty( $notification['data_send_email'] ) ? $notification['data_send_email'] : '';
$minimum_activity          = ! empty( $notification['minimum_activity'] ) ? $notification['minimum_activity'] : '';
$enable_sound              = ! empty( $notification['enable_sound'] ) ? $notification['enable_sound'] : '';
$notification_sound        = ! empty( $notification['notification_sound'] ) ? $notification['notification_sound'] : '';
$sound_volume              = ! empty( $notification['sound_volume'] ) ? $notification['sound_volume'] : '';
$show_angry                = ! empty( $notification['show_angry'] ) ? $notification['show_angry'] : '';
$show_sad                  = ! empty( $notification['show_sad'] ) ? $notification['show_sad'] : '';
$show_neutral              = ! empty( $notification['show_neutral'] ) ? $notification['show_neutral'] : '';
$show_happy                = ! empty( $notification['show_happy'] ) ? $notification['show_happy'] : '';
$show_excited              = ! empty( $notification['show_excited'] ) ? $notification['show_excited'] : '';
$conversion_count          = ! empty( $notification['conversion_count'] ) ? $notification['conversion_count'] : '';
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


$fields = new stdClass();

//Field Title
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_title">Title Message</label>
        <input type="text" id="settings_title" name="settings[title]" value="<?php echo $title; ?>"/>
    </div>
<?php

$fields->title = ob_get_clean();

//Field Description
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_description">Description Message</label>
        <input type="text" id="settings_description" name="settings[description]" value="<?php echo $description; ?>"/>
    </div>
<?php

$fields->description = ob_get_clean();

//Field Image
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_image">Image</label>

        <img src="<?php echo $image; ?>" alt="Notification Image" class="toto-image-preview <?php echo empty( $image ) ? 'toto-hidden' : ''; ?>">

        <div class="toto-input-group">
            <input type="text" id="settings_image" name="settings[image]" value="<?php echo $image; ?>"/>
            <button type="button" class="button button-primary toto-choose-image toto-ml-10 toto-mr-10">Choose Image
            </button>
            <button type="button" class="button button-link-delete toto-remove-image <?php echo empty( $image ) ? 'toto-hidden' : ''; ?>">
                Remove Image
            </button>
        </div>
        <p class="description">Leave empty for no image. Hint: icons8.com has a good library of small icons that you can
            use.</p>
    </div>
<?php

$fields->image = ob_get_clean();

//Field URL
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_url">Notification URL</label>
        <input type="text" id="settings_url" name="settings[url]" value="<?php echo $url; ?>"/>
        <p class="description">The URL you want to user to go to after clicking the notification. Leave empty for no
            link.</p>
    </div>
<?php

$fields->url = ob_get_clean();

//Title Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_title_color">Title Color</label>
        <input type="text" id="settings_title_color" class="toto-color-field" name="settings[title_color]" value="<?php echo $title_color; ?>"/>
    </div>
<?php

$fields->title_color = ob_get_clean();

//Description Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_description_color">Description Color</label>
        <input type="text" id="settings_description_color" class="toto-color-field" name="settings[description_color]" value="<?php echo $description_color; ?>"/>
    </div>
<?php

$fields->description_color = ob_get_clean();

//Background Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_background_color">Background Color</label>
        <input type="text" id="settings_background_color" class="toto-color-field" name="settings[background_color]" value="<?php echo $background_color; ?>"/>
    </div>
<?php

$fields->background_color = ob_get_clean();

//Content Title Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_content_title_color">Content Title Color</label>
        <input type="text" id="settings_content_title_color" class="toto-color-field" name="settings[content_title_color]" value="<?php echo $content_title_color; ?>"/>
    </div>
<?php

$fields->content_title_color = ob_get_clean();


//Content Description Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_content_description_color">Content Description Color</label>
        <input type="text" id="settings_content_description_color" class="toto-color-field" name="settings[content_description_color]" value="<?php echo $content_description_color; ?>"/>
    </div>
<?php

$fields->content_description_color = ob_get_clean();

//Border Radius
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_border_radius">Border Radius</label>
        <select id="settings_border_radius" name="settings[border_radius]">
            <option value="straight" <?php selected( 'straight', $border_radius ); ?>>Straight</option>
            <option value="rounded" <?php selected( 'rounded', $border_radius ); ?>>Rounded</option>
            <option value="round" <?php selected( 'round', $border_radius ) ?>>Round</option>
        </select>
        <p class="description">Change the shape of the corners of the notification</p>
    </div>
<?php

$fields->border_radius = ob_get_clean();

//Display Duration
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_display_duration">Display Duration</label>
        <input type="number" min="-1" id="settings_display_duration" name="settings[display_duration]" value="<?php echo $display_duration; ?>" required="required"/>
        <p class="description">How many seconds to display the notification. Set -1 to display forever.</p>
    </div>
<?php
$fields->display_duration = ob_get_clean();

//Minimum activity
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_minimum_activity">Minimum activity</label>
        <input type="number" min="-1" id="settings_minimum_activity" name="settings[minimum_activity]" value="<?php echo $minimum_activity; ?>" required="required"/>
        <p class="description">Minimum data needed to display the notification.</p>
    </div>
<?php
$fields->minimum_activity = ob_get_clean();

//Display Position
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_display_position">Display Position</label>
        <select id="settings_display_position" name="settings[display_position]">
            <option value="top_left" <?php selected( 'top_left', $display_position ) ?>>Top Left</option>
            <option value="top_center" <?php selected( 'top_center', $display_position ) ?>>Top Center
            </option>
            <option value="top_right" <?php selected( 'top_right', $display_position ) ?>>Top Right
            </option>
            <option value="middle_left" <?php selected( 'middle_left', $display_position ) ?>>Middle Left
            </option>
            <option value="middle_center" <?php selected( 'middle_center', $display_position ) ?>>Middle Center
            </option>
            <option value="middle_right" <?php selected( 'middle_right', $display_position ) ?>>Middle Right
            </option>
            <option value="bottom_left" <?php selected( 'bottom_left', $display_position ) ?>>Bottom Left
            </option>
            <option value="bottom_center" <?php selected( 'bottom_center', $display_position ) ?>>Bottom Center
            </option>
            <option value="bottom_right" <?php selected( 'bottom_right', $display_position ) ?>>Bottom Right
            </option>
        </select>
        <p class="description">Position of the notification on the screen. Position doesn't change on the preview.</p>
    </div>
<?php
$fields->display_position = ob_get_clean();

//Display Close Button
ob_start(); ?>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_display_close_button" name="settings[display_close_button]" <?php checked( true, $display_close_button ); ?> />
        <label for="settings_display_close_button">Display Close Button</label>
    </div>
<?php
$fields->display_close_button = ob_get_clean();

//Display Branding
ob_start(); ?>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_display_branding" name="settings[display_branding]" <?php checked( true, $display_branding ) ?> />
        <label for="settings_display_branding">Display Branding</label>
    </div>
<?php
$fields->display_branding = ob_get_clean();

ob_start();
?>
    <div class="toto-form-group flex-row flex-wrap">
        <label for="settings_trigger_on_all" class="toto-mr-20">Trigger on: </label>

        <div class="toto-label-group">
            <input type="radio" id="settings_trigger_on_all" name="settings[trigger_on]" value="all" <?php checked( 'all', $trigger_on ); ?>>
            <label for="settings_trigger_on_all">Everywhere</label>
        </div>

        <div class="toto-label-group">
            <input type="radio" id="settings_trigger_on_selected" name="settings[trigger_on]" value="selected" <?php checked( 'selected', $trigger_on ); ?>>
            <label for="settings_trigger_on_selected">Selected</label>
        </div>

        <div class="toto-label-group">
            <input type="radio" id="settings_trigger_on_shortcode" name="settings[trigger_on]" value="shortcode" <?php checked( 'shortcode', $trigger_on ); ?>>
            <label for="settings_trigger_on_shortcode">Use Only As Shortcode</label>
        </div>

        <div class="toto-break"></div>
        <p class="description">Where should the notification show?</p>
    </div>

    <div class="toto-form-group flex-row align-center <?php echo 'selected' == $trigger_on ? '' : 'toto-hidden'; ?>">
        <label for="settings_trigger_locations" class="toto-mr-20">Select Locations: </label>
        <select name="settings[trigger_locations][]" class="toto-select2" id="settings_trigger_locations" multiple>
			<?php
			foreach ( toto_locations() as $key => $val ) {
				printf( '<option value="%1$s" %3$s>%2$s</option>', $key, $val, ! empty( $trigger_locations ) && in_array( $key, $trigger_locations ) ? 'selected' : '' );
			}
			?>
        </select>
    </div>

    <div class="toto-form-group <?php echo ! empty( $trigger_locations ) && in_array( 'is_custom', $trigger_locations ) ? '' : 'toto-hidden'; ?>">
        <label for="settings_custom_post_page_ids" class="toto-mr-20">Post/ Page IDs: </label>
        <input type="text" name="settings[custom_post_page_ids]" id="settings_custom_post_page_ids" value="<?php echo $custom_post_page_ids; ?>">
        <p class="description">Comma Separated ID of Post, Page or Custom Post Type Posts.</p>
    </div>

<?php
$fields->trigger = ob_get_clean();

//Display Trigger
ob_start(); ?>
    <div class="toto-form-group" id="display_trigger">
        <label for="settings_display_trigger">Display Trigger</label>

        <div class="toto-input-group">
            <select id="settings_display_trigger" name="settings[display_trigger]">
                <option value="delay" data-placeholder="Number of seconds to wait until notification shows up" <?php selected( 'delay', $display_trigger ) ?>>
                    Delay
                </option>
                <option value="exit_intent" <?php selected( 'exit_intent', $display_trigger ) ?>>Exit Intent
                </option>
                <option value="scroll" data-placeholder="Percent of scrolling from the top down." <?php selected( 'scroll', $display_trigger ) ?>>
                    Scroll Percentage
                </option>
            </select>

            <input type="number" min="0" class="<?php echo 'exit_intent' == $display_trigger ? 'toto-hidden' : ''; ?>" name="settings[display_trigger_value]" value="<?php echo $display_trigger_value; ?>"/>

        </div>

        <p class="description">On what event the notification should show up.</p>
    </div>
<?php
$fields->display_trigger = ob_get_clean();

//Trigger Session
ob_start(); ?>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_display_once_per_session" name="settings[display_once_per_session]" <?php checked( true, $display_once_per_session ); ?> >

        <label class="clickable" for="settings_display_once_per_session">Display notification once per session</label>

        <p class="description">A visitor session is cleared once the browser is closed.</p>
    </div>
<?php
$fields->display_once_per_session = ob_get_clean();

//Display Mobile
ob_start(); ?>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_display_mobile" name="settings[display_mobile]" <?php checked( true, $display_mobile ); ?> >

        <label class="clickable" for="settings_display_mobile">Display on Mobile</label>

        <p class="description">Wether or not to display the notification on when pixels available are smaller than
            768px.</p>
    </div>
<?php
$fields->display_mobile = ob_get_clean();

//Email Placeholder
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_email_placeholder">Email Placeholder</label>
        <input type="text" id="settings_email_placeholder" name="settings[email_placeholder]" value="<?php echo $email_placeholder; ?>"/>
    </div>
<?php

$fields->email_placeholder = ob_get_clean();

//Button Text
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_button_text">Button Text</label>
        <input type="text" id="settings_button_text" name="settings[button_text]" value="<?php echo $button_text; ?>"/>
    </div>
<?php

$fields->button_text = ob_get_clean();

//Button URL
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_button_url">Button URL</label>
        <input type="text" id="settings_button_url" name="settings[button_url]" value="<?php echo $button_url; ?>"/>
    </div>
<?php

$fields->button_url = ob_get_clean();

//Last Active
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_last_activity">Count data from last X minutes</label>
        <input type="number" id="settings_last_activity" name="settings[last_activity]" value="<?php echo $last_activity; ?>"/>
    </div>
<?php

$fields->last_activity = ob_get_clean();

//Coupon Code
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_coupon_code">Coupon Code</label>
        <input type="text" id="settings_coupon_code" name="settings[coupon_code]" value="<?php echo $coupon_code; ?>"/>
    </div>
<?php

$fields->coupon_code = ob_get_clean();

//Footer Text
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_footer_text">Footer Text</label>
        <input type="text" id="settings_footer_text" name="settings[footer_text]" value="<?php echo $footer_text; ?>"/>
    </div>
<?php

$fields->footer_text = ob_get_clean();

//Agreement
ob_start(); ?>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_show_agreement" name="settings[show_agreement]" <?php checked( true, $show_agreement ); ?> >

        <label class="clickable" for="settings_show_agreement">Show Agreement</label>

        <p class="description">Require the user to confirm his agreement by ticking a checkbox.</p>
    </div>

    <div id="agreement" class="<?php echo true == $show_agreement ? '' : 'toto-hidden'; ?>">
        <div class="toto-form-group">
            <label for="settings_agreement_text">Agreement Text</label>
            <input type="text" id="settings_agreement_text" name="settings[agreement_text]" value="<?php echo $agreement_text; ?>"/>
        </div>

        <div class="toto-form-group">
            <label for="settings_agreement_url">Agreement URL</label>
            <input type="text" id="settings_agreement_url" name="settings[agreement_url]" value="<?php echo $agreement_url; ?>"/>
        </div>
    </div>
<?php
$fields->agreement = ob_get_clean();

//Button Background Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_button_background_color">Button Background Color</label>
        <input type="text" id="settings_button_background_color" class="toto-color-field" name="settings[button_background_color]" value="<?php echo $button_background_color; ?>"/>
    </div>
<?php

$fields->button_background_color = ob_get_clean();

//Button Background Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_button_background_color">Button Background Color</label>
        <input type="text" id="settings_button_background_color" class="toto-color-field" name="settings[button_background_color]" value="<?php echo $button_background_color; ?>"/>
    </div>
<?php

$fields->button_background_color = ob_get_clean();

//Button Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_button_color">Button Color</label>
        <input type="text" id="settings_button_color" class="toto-color-field" name="settings[button_color]" value="<?php echo $button_color; ?>"/>
    </div>
<?php

$fields->button_color = ob_get_clean();

//Number Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_number_color">Number Color</label>
        <input type="text" id="settings_number_color" class="toto-color-field" name="settings[number_color]" value="<?php echo $number_color; ?>"/>
    </div>
<?php

$fields->number_color = ob_get_clean();

//Time Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_time_color">Time Color</label>
        <input type="text" id="settings_time_color" class="toto-color-field" name="settings[time_color]" value="<?php echo $time_color; ?>"/>
    </div>
<?php

$fields->time_color = ob_get_clean();

//Time Background Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_time_background_color">Time Background Color</label>
        <input type="text" id="settings_time_background_color" class="toto-color-field" name="settings[time_background_color]" value="<?php echo $time_background_color; ?>"/>
    </div>
<?php

$fields->time_background_color = ob_get_clean();

//Number Background Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_number_background_color">Number Background Color</label>
        <input type="text" id="settings_number_background_color" class="toto-color-field" name="settings[number_background_color]" value="<?php echo $number_background_color; ?>"/>
    </div>
<?php

$fields->number_background_color = ob_get_clean();

//Pulse Background Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_pulse_background_color">Pulse Background Color</label>
        <input type="text" id="settings_pulse_background_color" class="toto-color-field" name="settings[pulse_background_color]" value="<?php echo $pulse_background_color; ?>"/>
    </div>
<?php

$fields->pulse_background_color = ob_get_clean();

//Send Caught Data to External
ob_start(); ?>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_data_send_is_enabled" name="settings[data_send_is_enabled]" <?php checked( true, $data_send_is_enabled ); ?> >

        <label class="clickable" for="settings_data_send_is_enabled">Send Caught Data to External</label>
    </div>

    <div id="data_send" class="container-disabled">
        <div class="toto-form-group">
            <label for="settings_data_send_webhook">Webhook</label>
            <input type="text" id="settings_data_send_webhook" name="settings[data_send_webhook]" value="<?php echo $data_send_webhook; ?>" placeholder="Webhook URL"/>
            <p class="description">Leave empty to disable this field.</p>
        </div>

        <div class="toto-form-group">
            <label for="settings_data_send_email">Email</label>
            <input type="text" id="settings_data_send_email" name="settings[data_send_email]" value="<?php echo $data_send_email; ?>" placeholder="Valid email address"/>
            <p class="description">Leave empty to disable this field.></p>
        </div>
    </div>
<?php
$fields->data_send_is_enabled = ob_get_clean();

//Trigger Session
ob_start(); ?>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_enable_sound" name="settings[enable_sound]" <?php checked( true, $enable_sound ); ?> >

        <label class="clickable" for="settings_enable_sound">Enable Notification Sound</label>

        <p class="description">Enable to play a sound when the notification will show.</p>
    </div>

    <div class="toto-form-group">
        <label for="settings_notification_sound">Select Notification Sound</label>
        <select name="settings[notification_sound]" id="settings_notification_sound">
            <option value="to_the_point" <?php selected( 'to_the_point', $notification_sound ); ?>>To The Point</option>
            <option value="sound_two" <?php selected( 'sound_two', $notification_sound ); ?>>Sound Two</option>
        </select>
    </div>
    <div class="toto-form-group">
        <label for="settings_sound_volume">Notification Sound Volume</label>
        <input type="hidden" name="settings[sound_volume]" id="settings_sound_volume" value="<?php echo $sound_volume; ?>"/>

        <div id="toto-volume-slider" class="toto-volume-slider" data-value="<?php echo $sound_volume; ?>">
            <div id="toto-volume-handle" class="toto-volume-handle ui-slider-handle"></div>
        </div>

        <p class="description">Adjust the notification sound volume.</p>

    </div>

<?php
$fields->enable_sound = ob_get_clean();

ob_start(); ?>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_show_angry" name="settings[show_angry]" <?php checked( true, $show_angry ); ?> >

        <label class="clickable" for="settings_show_angry">Enable Notification Sound</label>
    </div>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_show_sad" name="settings[show_sad]" <?php checked( true, $show_sad ); ?> >

        <label class="clickable" for="settings_show_sad">Enable Notification Sound</label>
    </div>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_show_neutral" name="settings[show_neutral]" <?php checked( true, $show_neutral ); ?> >

        <label class="clickable" for="settings_show_neutral">Enable Notification Sound</label>
    </div>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_show_happy" name="settings[show_happy]" <?php checked( true, $show_happy ); ?> >

        <label class="clickable" for="settings_show_happy">Enable Notification Sound</label>
    </div>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_show_excited" name="settings[show_excited]" <?php checked( true, $show_excited ); ?> >

        <label class="clickable" for="settings_show_excited">Enable Notification Sound</label>
    </div>
<?php
$fields->emoji = ob_get_clean();

ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_conversion_count">How many conversions to show?</label>
        <input type="text" id="settings_conversion_count" name="settings[conversion_count]" value="<?php echo $conversion_count ?>"/>
    </div>
<?php
$fields->conversion_count = ob_get_clean();

ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_content_title">Content Title</label>
        <input type="text" id="settings_content_title" name="settings[content_title]" value="<?php echo $content_title ?>"/>
    </div>
<?php
$fields->content_title = ob_get_clean();

ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_content_description">Content Description</label>
        <input type="text" id="settings_content_description" name="settings[content_description]" value="<?php echo $content_description ?>"/>
    </div>
<?php
$fields->content_description = ob_get_clean();

ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_input_placeholder">Input Placeholder</label>
        <input type="text" id="settings_input_placeholder" name="settings[input_placeholder]" value="<?php echo $input_placeholder ?>"/>
    </div>
<?php
$fields->input_placeholder = ob_get_clean();

ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_share_url">Share URL</label>
        <input type="text" id="settings_share_url" name="settings[share_url]" value="<?php echo $share_url ?>"/>
        <p class="description">Leave empty if you want the URL to be dynamic to the current page where the notification
            is shown.</p>
    </div>

    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_share_facebook" name="settings[share_facebook]" <?php checked( true, $share_facebook ); ?> >

        <label class="clickable" for="settings_show_excited"><i class="fab fa-facebook"></i> Facebook Share</label>
    </div>

    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_share_twitter" name="settings[share_twitter]" <?php checked( true, $share_twitter ); ?> >

        <label class="clickable" for="settings_show_excited"><i class="fab fa-twitter"></i> Twitter Share</label>
    </div>

    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_share_linkedin" name="settings[share_linkedin]" <?php checked( true, $share_linkedin ); ?> >

        <label class="clickable" for="settings_show_excited"><i class="fab fa-linkedin"></i> Linkedin Share</label>
    </div>
<?php
$fields->share_url = ob_get_clean();

ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_video">YouTube Video Embed Url</label>
        <input type="text" id="settings_video" name="settings[video]" value="<?php echo $video ?>"/>
        <p class="description">Ex: https://www.youtube.com/embed/3WxQgvuT6ZI</p>
    </div>
<?php
$fields->video = ob_get_clean();

ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_end_date">End Date</label>
        <input type="text" id="settings_end_date" class="toto-date-time-picker" name="settings[end_date]" value="<?php echo $end_date ?>"/>
        <p class="description">Ex: https://www.youtube.com/embed/3WxQgvuT6ZI</p>
    </div>
<?php
$fields->end_date = ob_get_clean();

return $fields;