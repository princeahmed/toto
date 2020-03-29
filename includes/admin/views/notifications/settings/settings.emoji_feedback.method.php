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
        <label for="settings_title"><?= $this->language->notification->settings->title ?></label>
        <input type="text" id="settings_title" name="title" class="form-control" value="<?= $data->notification->settings->title ?>" required="required" />
    </div>

    <div class="custom-control custom-switch mr-3 mb-3">
        <input
                type="checkbox"
                class="custom-control-input"
                id="show_angry"
                name="show_angry"
            <?= $data->notification->settings->show_angry ? 'checked="true"' : null ?>
        >
        <label class="custom-control-label clickable" for="show_angry"><?= $this->language->notification->settings->show_angry ?></label>
    </div>

    <div class="custom-control custom-switch mr-3 mb-3">
        <input
                type="checkbox"
                class="custom-control-input"
                id="show_sad"
                name="show_sad"
            <?= $data->notification->settings->show_sad ? 'checked="true"' : null ?>
        >
        <label class="custom-control-label clickable" for="show_sad"><?= $this->language->notification->settings->show_sad ?></label>
    </div>

    <div class="custom-control custom-switch mr-3 mb-3">
        <input
                type="checkbox"
                class="custom-control-input"
                id="show_neutral"
                name="show_neutral"
            <?= $data->notification->settings->show_neutral ? 'checked="true"' : null ?>
        >
        <label class="custom-control-label clickable" for="show_neutral"><?= $this->language->notification->settings->show_neutral ?></label>
    </div>

    <div class="custom-control custom-switch mr-3 mb-3">
        <input
                type="checkbox"
                class="custom-control-input"
                id="show_happy"
                name="show_happy"
            <?= $data->notification->settings->show_happy ? 'checked="true"' : null ?>
        >
        <label class="custom-control-label clickable" for="show_happy"><?= $this->language->notification->settings->show_happy ?></label>
    </div>

    <div class="custom-control custom-switch mr-3 mb-3">
        <input
                type="checkbox"
                class="custom-control-input"
                id="show_excited"
                name="show_excited"
            <?= $data->notification->settings->show_excited ? 'checked="true"' : null ?>
        >
        <label class="custom-control-label clickable" for="show_excited"><?= $this->language->notification->settings->show_excited ?></label>
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
        $('#notification_preview .altumcode-emoji-feedback-title').text($(event.currentTarget).val());
    });

    $('#settings_description').on('change paste keyup', event => {
        $('#notification_preview .altumcode-emoji-feedback-description').text($(event.currentTarget).val());
    });

    /* Hide and show preview of the share buttons */
    $('[id*="share_"]').on('change', event => {
        let share_type = $(event.currentTarget).attr('id').replace('share_', '');

        if($(event.currentTarget).is(':checked')) {
            $(`#notification_preview .altumcode-emoji-feedback-button-${share_type}`).show();
        } else {
            $(`#notification_preview .altumcode-emoji-feedback-button-${share_type}`).hide();
        }
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
        $('#notification_preview .altumcode-emoji-feedback-title').css('color', hsva.toHEXA().toString());
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

</script>
<?php $javascript = ob_get_clean() ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
