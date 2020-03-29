<?php

defined( 'ABSPATH' ) || exit();

$fields = new stdClass();

//Field Title
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_title">Title Message</label>
        <input type="text" id="settings_title" name="settings[title]" value="<?php echo $notification['title'] ?>"/>
    </div>
<?php

$fields->title = ob_get_clean();

//Field Description
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_description">Description Message</label>
        <input type="text" id="settings_description" name="settings[description]"
               value="<?php echo $notification['description'] ?>"/>
    </div>
<?php

$fields->description = ob_get_clean();

//Field Image
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_image">Image URL</label>
        <input type="text" id="settings_image" name="settings[image]" value="<?php echo $notification['image'] ?>"/>
        <p class="description">Leave empty for no image. Hint: icons8.com has a good library of small icons that you
            can use.</p>
    </div>
<?php

$fields->image = ob_get_clean();

//Field URL
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_url">Notification URL</label>
        <input type="text" id="settings_url" name="settings[url]" value="<?php echo $notification['url'] ?>"/>
        <p class="description">The URL you want to user to go to after clicking the notification. Leave empty for no
            link.</p>
    </div>
<?php

$fields->url = ob_get_clean();

//Title Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_title_color">Title Color</label>
        <input type="text" id="settings_title_color" name="settings[title_color]"
               value="<?php echo $notification['title_color'] ?>"/>
    </div>
<?php

$fields->title_color = ob_get_clean();

//Description Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_description_color">Description Color</label>
        <input type="text" id="settings_description_color" name="settings[description_color]"
               value="<?php echo $notification['description_color'] ?>"/>
    </div>
<?php

$fields->description_color = ob_get_clean();

//Background Color
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_background_color">Background Color</label>
        <input type="text" id="settings_background_color" name="settings[background_color]"
               value="<?php echo $notification['background_color'] ?>"/>
    </div>
<?php

$fields->background_color = ob_get_clean();

//Border Radius
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_border_radius">Border Radius</label>
        <select id="settings_border_radius" name="settings[border_radius]">
            <option value="straight" <?php checked( 'straight', $notification['border_radius'] ); ?>>Straight</option>
            <option value="rounded" <?php checked( 'rounded', $notification['border_radius'] ); ?>>Rounded</option>
            <option value="round" <?php checked( 'round', $notification['border_radius'] ) ?>>Round</option>
        </select>
        <p class="description">Change the shape of the corners of the notification</p>
    </div>
<?php

$fields->border_radius = ob_get_clean();

//Display Duration
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_display_duration">Display Duration</label>
        <input type="number" min="-1" id="settings_display_duration" name="settings[display_duration]"
               value="<?php echo $notification['display_duration'] ?>" required="required"/>
        <p class="description">How many seconds to display the notification. Set -1 to display forever.</p>
    </div>
<?php
$fields->display_duration = ob_get_clean();

//Display Position
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_display_position">Display Position</label>
        <select id="settings_display_position" name="settings[display_position]">
            <option value="top_left" <?php checked( 'top_left', $notification['display_position'] ) ?>>Top Left</option>
            <option value="top_center" <?php checked( 'top_center', $notification['display_position'] ) ?>>Top Center
            </option>
            <option value="top_right" <?php checked( 'top_right', $notification['display_position'] ) ?>>Top Right
            </option>
            <option value="middle_left" <?php checked( 'middle_left', $notification['display_position'] ) ?>>Middle
                Left
            </option>
            <option value="middle_center" <?php checked( 'middle_center', $notification['display_position'] ) ?>>Middle
                Center
            </option>
            <option value="middle_right" <?php checked( 'middle_right', $notification['display_position'] ) ?>>Middle
                Right
            </option>
            <option value="bottom_left" <?php checked( 'bottom_left', $notification['display_position'] ) ?>>Bottom
                Left
            </option>
            <option value="bottom_center" <?php checked( 'bottom_center', $notification['display_position'] ) ?>>Bottom
                Center
            </option>
            <option value="bottom_right" <?php checked( 'bottom_right', $notification['display_position'] ) ?>>Bottom
                Right
            </option>
        </select>
        <p class="description">Position of the notification on the screen. Position doesn't change on the preview.</p>
    </div>
<?php
$fields->display_position = ob_get_clean();

//Display Close Button
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_display_close_button">Display Close Button</label>
        <input type="checkbox" id="settings_display_close_button"
               name="settings[display_close_button]" <?php checked( 'yes', $notification['display_close_button'] ) ?> />
    </div>
<?php
$fields->display_close_button = ob_get_clean();

//Display Branding
ob_start(); ?>
    <div class="toto-form-group">
        <label for="settings_display_branding">Display Branding</label>
        <input type="checkbox" id="settings_display_branding"
               name="settings[display_branding]" <?php checked( 'yes', $notification['display_branding'] ) ?> />
    </div>
<?php
$fields->display_branding = ob_get_clean();

//Trigger Rules
ob_start(); ?>
    <div class="d-flex justify-content-between">
        <div class="toto-form-group">
            <input type="checkbox" id="trigger_all_pages"
                   name="settings[trigger_all_pages]" <?php checked( 'yes', $notification['trigger_all_pages'] ) ?>>
            <label class="clickable" for="trigger_all_pages">Trigger on all pages</label>
            <p class="description">Where should the notification show?</p>
        </div>

        <div>
            <button type="button" id="trigger_add" class="btn btn-success btn-sm rounded-pill"><i
                        class="fas fa-plus-circle"></i> Add new trigger
            </button>
        </div>
    </div>

    <div id="triggers_rules" class="toto-form-group">
		<?php if ( count( $notification['triggers'] ) ) { ?>
			<?php foreach ( $notification['triggers'] as $trigger ) { ?>
                <div class="toto-input-group">
                    <select name="trigger_type[]">
                        <option value="exact" <? checked( 'exact', $trigger->type ) ?>>Exact</option>
                        <option value="contains" <? checked( 'contains', $trigger->type ) ?>>Contains</option>
                        <option value="starts_with" <? checked( 'starts_with', $trigger->type ) ?>>Starts With</option>
                        <option value="ends_with" <? checked( 'ends_with', $trigger->type ) ?>>Ends With</option>
                        <option value="page_contains" <? checked( 'page_contains', $trigger->type ) ?>>Page Contains
                        </option>
                    </select>

                    <input type="text" name="trigger_value[]" value="<?php echo $trigger->value; ?>"
                           placeholder="Full URL ( ex: https://domain.com )"/>

                    <button type="button" class="trigger-delete"><i class="fa fa-times"></i></button>
                </div>
			<?php } ?>
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
                <option value="delay"
                        data-placeholder="Number of seconds to wait until notification shows up" <?php selected( 'delay', $notification['display_trigger'] ) ?>>
                    Delay
                </option>
                <option value="exit_intent" <?php selected( 'exit_intent', $notification['display_trigger'] ) ?>>Exit
                    Intent
                </option>
                <option value="scroll"
                        data-placeholder="Percent of scrolling from the top down." <?php selected( 'scroll', $notification['display_trigger'] ) ?>>
                    Scroll Percentage
                </option>
            </select>

            <input type="number" min="0" name="settings[display_trigger_value]"
                   value="<?php echo $notification['display_trigger_value']; ?>"/>
        </div>

        <p class="description">On what event the notification should show up.</p>
    </div>
<?php
$fields->display_trigger = ob_get_clean();

//Trigger Session
ob_start(); ?>
    <div class="toto-form-group">
        <input type="checkbox" id="display_once_per_session"
               name="settings[display_once_per_session]" <?php checked( 'yes', $notification['display_once_per_session'] ); ?> >

        <label class="clickable" for="display_once_per_session">Display notification once per session</label>

        <p class="description">A visitor session is cleared once the browser is closed.</p>
    </div>
<?php
$fields->display_once_per_session = ob_get_clean();

//Display Mobile
ob_start(); ?>
    <div class="toto-form-group">
        <input type="checkbox" id="display_mobile"
               name="settings[display_mobile]" <?php checked( 'yes', $notification['display_mobile'] ); ?> >

        <label class="clickable" for="display_mobile">Display on Mobile</label>

        <p class="description">Wether or not to display the notification on when pixels available are smaller than
            768px.</p>
    </div>
<?php
$fields->display_mobile = ob_get_clean();

return $fields;