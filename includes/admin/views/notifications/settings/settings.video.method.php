<?php
defined('ALTUMCODE') || die();

/* Create the content for each tab */
$html = [];

/* Extra Javascript needed */
$javascript = '';
?>

<?php /* Basic Tab */ ?>
<?php ob_start() ?>
    <div class="form-group">
        <label for="settings_title"><?= $this->language->notification->settings->title ?></label>
        <input type="text" id="settings_title" name="title" class="form-control" value="<?= $data->notification->settings->title ?>" required="required" />
    </div>

    <div class="form-group">
        <label for="settings_video"><?= $this->language->notification->settings->video ?></label>
        <input type="text" id="settings_video" name="video" class="form-control" value="<?= $data->notification->settings->video ?>" />
        <small class="text-muted"><?= $this->language->notification->settings->video_help ?></small>
    </div>

    <div class="form-group">
        <label for="settings_button_url"><?= $this->language->notification->settings->button_url ?></label>
        <input type="text" id="settings_button_url" name="button_url" class="form-control" value="<?= $data->notification->settings->button_url ?>" />
    </div>

    <div class="form-group">
        <label for="settings_button_text"><?= $this->language->notification->settings->button_text ?></label>
        <input type="text" id="settings_button_text" name="button_text" class="form-control" value="<?= $data->notification->settings->button_text ?>" />
    </div>

<?php $html['basic'] = ob_get_clean() ?>


<?php /* Customize Tab */ ?>
<?php ob_start() ?>
    <div class="form-group">
        <label for="settings_title_color"><?= $this->language->notification->settings->title_color ?></label>
        <input type="hidden" id="settings_title_color" name="title_color" class="form-control" value="<?= $data->notification->settings->title_color ?>" required="required" />
        <div id="settings_title_color_pickr"></div>
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
    $('#settings_title').on('change paste keyup', event => {
        $('#notification_preview .altumcode-video-title').text($(event.currentTarget).val());
    });

    $('#settings_video').on('change paste keyup', event => {
        $('#notification_preview .altumcode-video-video-iframe').attr('src', $(event.currentTarget).val());
    });

    $('#settings_button_text').on('change paste keyup', event => {
        $('#notification_preview .altumcode-video-button').text($(event.currentTarget).val());
    });


    /* Title Color Handler */
    let settings_title_color_pickr = Pickr.create({
        el: '#settings_title_color_pickr',
        default: $('#settings_title_color').val(),
        ...pickr_options
    });

    settings_title_color_pickr.on('change', hsva => {
        $('#settings_title_color').val(hsva.toHEXA().toString());

        /* Notification Preview Handler */
        $('#notification_preview .altumcode-video-title').css('color', hsva.toHEXA().toString());
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
        $('#notification_preview .altumcode-wrapper').css('background', hsva.toHEXA().toString());
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
        $('#notification_preview .altumcode-video-button').css('background', hsva.toHEXA().toString());
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
        $('#notification_preview .altumcode-video-button').css('color', hsva.toHEXA().toString());
    });
</script>
<?php $javascript = ob_get_clean() ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
