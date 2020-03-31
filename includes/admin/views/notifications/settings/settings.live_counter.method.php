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
        <label for="settings_last_activity"><?= sprintf($this->language->notification->settings->last_activity, $this->language->global->date->minutes) ?></label>
        <input type="number" id="settings_last_activity" name="last_activity" class="form-control" value="<?= $data->notification->settings->last_activity ?>" required="required" />
    </div>

    <div class="form-group">
        <label for="settings_url"><?= $this->language->notification->settings->url ?></label>
        <input type="text" id="settings_url" name="url" class="form-control" value="<?= $data->notification->settings->url ?>" />
        <small class="text-muted"><?= $this->language->notification->settings->url_help ?></small>
    </div>
<?php $html['basic'] = ob_get_clean() ?>


<?php /* Triggers Tab Extra */ ?>
<?php ob_start() ?>

<div class="form-group">
    <label for="settings_display_minimum_activity"><?= $this->language->notification->settings->display_minimum_activity ?></label>
    <input type="number" min="0" id="settings_display_minimum_activity" name="display_minimum_activity" class="form-control" value="<?= $data->notification->settings->display_minimum_activity ?>" />
    <small class="text-muted"><?= $this->language->notification->settings->display_minimum_activity_help ?></small>
</div>

<?php $html['triggers'] = ob_get_clean() ?>


<?php /* Customize Tab */ ?>
<?php ob_start() ?>
    <div class="form-group">
        <label for="settings_number_color"><?= $this->language->notification->settings->number_color ?></label>
        <input type="hidden" id="settings_number_color" name="number_color" class="form-control" value="<?= $data->notification->settings->number_color ?>" required="required" />
        <div id="settings_number_color_pickr"></div>
    </div>

    <div class="form-group">
        <label for="settings_number_background_color"><?= $this->language->notification->settings->number_background_color ?></label>
        <input type="hidden" id="settings_number_background_color" name="number_background_color" class="form-control" value="<?= $data->notification->settings->number_background_color ?>" required="required" />
        <div id="settings_number_background_color_pickr"></div>
    </div>

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
        <label for="settings_pulse_background_color"><?= $this->language->notification->settings->pulse_background_color ?></label>
        <input type="hidden" id="settings_pulse_background_color" name="pulse_background_color" class="form-control" value="<?= $data->notification->settings->pulse_background_color ?>" required="required" />
        <div id="settings_pulse_background_color_pickr"></div>
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
    $('#settings_title').on('change paste keyup', event => {
        $('#notification_preview .toto-live-counter-title').text($(event.currentTarget).val());
    });

    $('#settings_description').on('change paste keyup', event => {
        $('#notification_preview .toto-live-counter-description').text($(event.currentTarget).val());
    });

    $('#settings_image').on('change paste keyup', event => {
        $('#notification_preview .toto-live-counter-image').attr('src', $(event.currentTarget).val());
    });

    /* Number Color Handler */
    let settings_number_color_pickr = Pickr.create({
        el: '#settings_number_color_pickr',
        default: $('#settings_number_color').val(),
        ...pickr_options
    });

    settings_number_color_pickr.on('change', hsva => {
        $('#settings_number_color').val(hsva.toHEXA().toString());

        /* Notification Preview Handler */
        $('#notification_preview .toto-live-counter-number').css('color', hsva.toHEXA().toString());
    });

    /* Number Background Color Handler */
    let settings_number_background_color_pickr = Pickr.create({
        el: '#settings_number_background_color_pickr',
        default: $('#settings_number_background_color').val(),
        ...pickr_options
    });

    settings_number_background_color_pickr.on('change', hsva => {
        $('#settings_number_background_color').val(hsva.toHEXA().toString());

        /* Notification Preview Handler */
        $('#notification_preview .toto-live-counter-number').css('background', hsva.toHEXA().toString());
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
        $('#notification_preview .toto-live-counter-description').css('color', hsva.toHEXA().toString());
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

    /* Pulse Background Color Handler */
    let settings_pulse_background_color_pickr = Pickr.create({
        el: '#settings_pulse_background_color_pickr',
        default: $('#settings_pulse_background_color').val(),
        ...pickr_options
    });

    settings_pulse_background_color_pickr.on('change', hsva => {
        $('#settings_pulse_background_color').val(hsva.toHEXA().toString());

        /* Notification Preview Handler */
        $('#notification_preview .toto-toast-pulse').css('background', hsva.toHEXA().toString());
    });
</script>
<?php $javascript = ob_get_clean() ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
