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
$trigger_all_pages        = ! empty( $notification['trigger_all_pages'] ) ? $notification['trigger_all_pages'] : '';
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
$data_send_is_enabled     = ! empty( $notification['data_send_is_enabled'] ) ? $notification['data_send_is_enabled'] : '';
$data_send_webhook        = ! empty( $notification['data_send_webhook'] ) ? $notification['data_send_webhook'] : '';
$data_send_email          = ! empty( $notification['data_send_email'] ) ? $notification['data_send_email'] : '';
$minimum_activity         = ! empty( $notification['minimum_activity'] ) ? $notification['minimum_activity'] : '';

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
        <label for="settings_image">Image URL</label>
        <input type="text" id="settings_image" name="settings[image]" value="<?php echo $image; ?>"/>
        <p class="description">Leave empty for no image. Hint: icons8.com has a good library of small icons that you
            can use.</p>
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
        <input type="text" id="settings_title_color" name="settings[title_color]" value="<?php echo $title_color; ?>"/>
    </div>
<?php

$fields->title_color = ob_get_clean();

//Description Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_description_color">Description Color</label>
        <input type="text" id="settings_description_color" name="settings[description_color]" value="<?php echo $description_color; ?>"/>
    </div>
<?php

$fields->description_color = ob_get_clean();

//Background Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_background_color">Background Color</label>
        <input type="text" id="settings_background_color" name="settings[background_color]" value="<?php echo $background_color; ?>"/>
    </div>
<?php

$fields->background_color = ob_get_clean();

//Border Radius
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_border_radius">Border Radius</label>
        <select id="settings_border_radius" name="settings[border_radius]">
            <option value="straight" <?php checked( 'straight', $border_radius ); ?>>Straight</option>
            <option value="rounded" <?php checked( 'rounded', $border_radius ); ?>>Rounded</option>
            <option value="round" <?php checked( 'round', $border_radius ) ?>>Round</option>
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
            <option value="top_left" <?php checked( 'top_left', $display_position ) ?>>Top Left</option>
            <option value="top_center" <?php checked( 'top_center', $display_position ) ?>>Top Center
            </option>
            <option value="top_right" <?php checked( 'top_right', $display_position ) ?>>Top Right
            </option>
            <option value="middle_left" <?php checked( 'middle_left', $display_position ) ?>>Middle
                Left
            </option>
            <option value="middle_center" <?php checked( 'middle_center', $display_position ) ?>>Middle
                Center
            </option>
            <option value="middle_right" <?php checked( 'middle_right', $display_position ) ?>>Middle
                Right
            </option>
            <option value="bottom_left" <?php checked( 'bottom_left', $display_position ) ?>>Bottom
                Left
            </option>
            <option value="bottom_center" <?php checked( 'bottom_center', $display_position ) ?>>Bottom
                Center
            </option>
            <option value="bottom_right" <?php checked( 'bottom_right', $display_position ) ?>>Bottom
                Right
            </option>
        </select>
        <p class="description">Position of the notification on the screen. Position doesn't change on the preview.</p>
    </div>
<?php
$fields->display_position = ob_get_clean();

//Display Close Button
ob_start(); ?>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_display_close_button" name="settings[display_close_button]" <?php checked( 'yes', $display_close_button ) ?> />
        <label for="settings_display_close_button">Display Close Button</label>
    </div>
<?php
$fields->display_close_button = ob_get_clean();

//Display Branding
ob_start(); ?>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="settings_display_branding" name="settings[display_branding]" <?php checked( 'yes', $display_branding ) ?> />
        <label for="settings_display_branding">Display Branding</label>
    </div>
<?php
$fields->display_branding = ob_get_clean();

//Trigger Rules
ob_start(); ?>
    <div class="d-flex align-center">
        <div class="toto-form-group toto-switch-group">
            <input type="checkbox" id="settings_trigger_all_pages" name="settings[trigger_all_pages]" <?php checked( 'yes', $trigger_all_pages ) ?>>
            <label class="clickable" for="settings_trigger_all_pages">Trigger on all pages</label>
            <p class="description">Where should the notification show?</p>
        </div>

        <button type="button" id="trigger_add" class="btn-trigger-add">
            <i class="fas fa-plus-circle"></i> Add new trigger
        </button>
    </div>

    <div id="triggers_rules" class="triggers_rules toto-form-group container-disabled">
		<?php

        if ( ! empty( $triggers ) ) {
			foreach ( $triggers as $trigger ) { ?>
                <div class="toto-input-group">
                    <select name="trigger_type[]">
                        <option value="exact" <? checked( 'exact', $trigger->type ) ?>>Exact</option>
                        <option value="contains" <? checked( 'contains', $trigger->type ) ?>>Contains</option>
                        <option value="starts_with" <? checked( 'starts_with', $trigger->type ) ?>>Starts With</option>
                        <option value="ends_with" <? checked( 'ends_with', $trigger->type ) ?>>Ends With</option>
                        <option value="page_contains" <? checked( 'page_contains', $trigger->type ) ?>>Page Contains
                        </option>
                    </select>

                    <input type="text" name="trigger_value[]" value="<?php echo $trigger->value; ?>" placeholder="Full URL ( ex: https://domain.com )"/>

                    <button type="button" class="trigger-delete"><i class="fa fa-times"></i></button>
                </div>
			<?php }
		}else{ ?>
            <div class="toto-input-group">
                <select name="trigger_type[]">
                    <option value="exact">Exact</option>
                    <option value="contains">Contains</option>
                    <option value="starts_with">Starts With</option>
                    <option value="ends_with">Ends With</option>
                    <option value="page_contains">Page Contains
                    </option>
                </select>

                <input type="text" name="trigger_value[]" placeholder="Full URL ( ex: https://domain.com )"/>

                <button type="button" class="trigger-delete toto-btn-delete" style="display: none;"><i class="fa fa-times"></i></button>
            </div>
        <?php } ?>
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
                <option value="exit_intent" <?php selected( 'exit_intent', $display_trigger ) ?>>Exit
                    Intent
                </option>
                <option value="scroll" data-placeholder="Percent of scrolling from the top down." <?php selected( 'scroll', $display_trigger ) ?>>
                    Scroll Percentage
                </option>
            </select>

            <input type="number" min="0" name="settings[display_trigger_value]" value="<?php echo $display_trigger_value; ?>"/>
        </div>

        <p class="description">On what event the notification should show up.</p>
    </div>
<?php
$fields->display_trigger = ob_get_clean();

//Trigger Session
ob_start(); ?>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="display_once_per_session" name="settings[display_once_per_session]" <?php checked( 'yes', $display_once_per_session ); ?> >

        <label class="clickable" for="display_once_per_session">Display notification once per session</label>

        <p class="description">A visitor session is cleared once the browser is closed.</p>
    </div>
<?php
$fields->display_once_per_session = ob_get_clean();

//Display Mobile
ob_start(); ?>
    <div class="toto-form-group toto-switch-group">
        <input type="checkbox" id="display_mobile" name="settings[display_mobile]" <?php checked( 'yes', $display_mobile ); ?> >

        <label class="clickable" for="display_mobile">Display on Mobile</label>

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

//Show Agreement
ob_start(); ?>
    <div class="toto-form-group">
        <input type="checkbox" id="settings_show_agreement" name="settings[show_agreement]" <?php checked( 'yes', $show_agreement ); ?> >

        <label class="clickable" for="settings_show_agreement">Show Agreement</label>

        <p class="description">Require the user to confirm his agreement by ticking a checkbox.</p>
    </div>
<?php
$fields->show_agreement = ob_get_clean();

//Agreement
ob_start(); ?>
    <div id="agreement">
        <div class="form-group">
            <label for="settings_agreement_text">Agreement Text</label>
            <input type="text" id="settings_agreement_text" name="settings[agreement_text]" value="<?php echo $agreement_text; ?>"/>
        </div>

        <div class="form-group">
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
        <input type="text" id="settings_button_background_color" class="es_color" name="settings[button_background_color]" value="<?php echo $button_background_color; ?>"/>
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
    <div class="toto-form-group">
        <input type="checkbox" id="settings_data_send_is_enabled" name="settings[data_send_is_enabled]" <?php checked( 'yes', $data_send_is_enabled ); ?> >

        <label class="clickable" for="settings_data_send_is_enabled">Send Caught Data to External</label>
    </div>
<?php
$fields->data_send_is_enabled = ob_get_clean();

//Data Send
ob_start(); ?>
    <div id="data_send">
        <div class="form-group">
            <label for="settings_data_send_webhook">Webhook</label>
            <input type="text" id="settings_data_send_webhook" name="settings[data_send_webhook]" value="<?php echo $data_send_webhook; ?>" placeholder="Webhook URL"/>
            <p class="description">Leave empty to disable this field.</p>
        </div>

        <div class="form-group">
            <label for="settings_data_send_email">Email</label>
            <input type="text" id="settings_data_send_email" name="settings[data_send_email]" value="<?php echo $data_send_email; ?>" placeholder="Valid email address"/>
            <p class="description">Leave empty to disable this field.></p>
        </div>
    </div>
<?php
$fields->data_send = ob_get_clean();


return $fields;