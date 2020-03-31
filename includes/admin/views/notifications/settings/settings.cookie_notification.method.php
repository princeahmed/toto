<?php
defined('ABSPATH') || die();

/* Create the content for each tab */
$html = [];

/* Extra Javascript needed */
$javascript = '';
?>

<?php /* Basic Tab */ ?>
<?php ob_start() ?>
    <div class="form-group">
        <label for="settings_description"><?= $this->language->notification->settings->description ?></label>
        <input type="text" id="settings_description" name="description" class="form-control" value="<?= $data->notification->settings->description ?>" required="required" />
    </div>

    <div class="form-group">
        <label for="settings_image"><?= $this->language->notification->settings->image ?></label>
        <input type="text" id="settings_image" name="image" class="form-control" value="<?= $data->notification->settings->image ?>" />
        <small class="text-muted"><?= $this->language->notification->settings->image_help ?></small>
    </div>

    <div class="form-group">
        <label for="settings_url_text"><?= $this->language->notification->settings->url_link_text ?></label>
        <input type="text" id="settings_url_text" name="url_text" class="form-control" value="<?= $data->notification->settings->url_text ?>" />
    </div>

    <div class="form-group">
        <label for="settings_url"><?= $this->language->notification->settings->url_link ?></label>
        <input type="text" id="settings_url" name="url" class="form-control" value="<?= $data->notification->settings->url ?>" />
    </div>

    <div class="form-group">
        <label for="settings_button_text"><?= $this->language->notification->settings->button_text ?></label>
        <input type="text" id="settings_button_text" name="button_text" class="form-control" value="<?= $data->notification->settings->button_text ?>" />
    </div>
<?php $html['basic'] = ob_get_clean() ?>


<?php /* Customize Tab */ ?>
<?php ob_start() ?>
    <div class="form-group">
        <label for="settings_description_color"><?= $this->language->notification->settings->description_color ?></label>
        <input type="hidden" id="settings_description_color" name="description_color" class="form-control" value="<?= $data->notification->settings->description_color ?>" required="required" />
        <div id="settings_description_color_pickr"></div>
    </div>

    <div class="form-group">
        <label for="settings_background_color"><?= $this->language->notification->settings->background_color ?></label>
        <input type="hidden" id="settings_background_color" name="background_color" class="form-control" value="<?= $data->notification->settings->background_color ?>" required="required" />
        <div id="settings_background_color_pickr"></div>
    </div>

    <div class="form-group">
        <label for="settings_button_background_color"><?= $this->language->notification->settings->button_background_color ?></label>
        <input type="hidden" id="settings_button_background_color" name="button_background_color" class="form-control" value="<?= $data->notification->settings->button_background_color ?>" required="required" />
        <div id="settings_button_background_color_pickr"></div>
    </div>

    <div class="form-group">
        <label for="settings_button_color"><?= $this->language->notification->settings->button_color ?></label>
        <input type="hidden" id="settings_button_color" name="button_color" class="form-control" value="<?= $data->notification->settings->button_color ?>" required="required" />
        <div id="settings_button_color_pickr"></div>
    </div>

    <div class="form-group">
        <label for="settings_border_radius"><?= $this->language->notification->settings->border_radius ?></label>
        <select class="custom-select" name="border_radius">
            <option value="straight" <?= $data->notification->settings->border_radius == 'straight' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->border_radius_straight ?></option>
            <option value="rounded" <?= $data->notification->settings->border_radius == 'rounded' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->border_radius_rounded ?></option>
        </select>
        <small class="text-muted"><?= $this->language->notification->settings->border_radius_help ?></small>
    </div>
<?php $html['customize'] = ob_get_clean() ?>


<?php ob_start() ?>
<script>
    /* Notification Preview Handlers */
    $('#settings_description').on('change paste keyup', event => {
        $('#notification_preview .toto-cookie-notification-description').text($(event.currentTarget).val());
    });

    $('#settings_image').on('change paste keyup', event => {
        $('#notification_preview .toto-cookie-notification-image').attr('src', $(event.currentTarget).val());
    });

    $('#settings_url_text').on('change paste keyup', event => {
        $('#notification_preview .toto-cookie-notification-url').text($(event.currentTarget).val());
    });

    $('#settings_button_text').on('change paste keyup', event => {
        $('#notification_preview .toto-cookie-notification-button').text($(event.currentTarget).val());
    });

    /* Description Color Handler */
    let settings_description_color_pickr = Pickr.create({
        el: '#settings_description_color_pickr',
        default: $('#settings_description_color').val(),
        ...pickr_options
    });

    settings_description_color_pickr.on('change', hsva => {
        $('#settings_description_color').val(hsva.toHEXA().toString());

        /* Notification Preview Handler */
        $('#notification_preview .toto-cookie-notification-description').css('color', hsva.toHEXA().toString());
    });


    /* Background Color Handler */
    let settings_background_color_pickr = Pickr.create({
        el: '#settings_background_color_pickr',
        default: $('#settings_background_color').val(),
        ...pickr_options
    });

    settings_background_color_pickr.on('change', hsva => {
        $('#settings_background_color').val(hsva.toHEXA().toString());

        /* Notification Preview Handler */
        $('#notification_preview .toto-wrapper').css('background', hsva.toHEXA().toString());
    });

    /* Button Background Color Handler */
    let settings_button_background_color_pickr = Pickr.create({
        el: '#settings_button_background_color_pickr',
        default: $('#settings_button_background_color').val(),
        ...pickr_options
    });

    settings_button_background_color_pickr.on('change', hsva => {
        $('#settings_button_background_color').val(hsva.toHEXA().toString());

        /* Notification Preview Handler */
        $('#notification_preview .toto-cookie-notification-button').css('background', hsva.toHEXA().toString());
    });

    /* Button Color Handler */
    let settings_button_color_pickr = Pickr.create({
        el: '#settings_button_color_pickr',
        default: $('#settings_button_color').val(),
        ...pickr_options
    });

    settings_button_color_pickr.on('change', hsva => {
        $('#settings_button_color').val(hsva.toHEXA().toString());

        /* Notification Preview Handler */
        $('#notification_preview .toto-cookie-notification-button').css('color', hsva.toHEXA().toString());
    });
</script>
<?php $javascript = ob_get_clean() ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
