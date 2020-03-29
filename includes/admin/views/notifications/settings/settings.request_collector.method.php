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
        <label for="settings_content_title"><?= $this->language->notification->settings->content_title ?></label>
        <input type="text" id="settings_content_title" name="content_title" class="form-control" value="<?= $data->notification->settings->content_title ?>" required="required" />
    </div>

    <div class="form-group">
        <label for="settings_content_description"><?= $this->language->notification->settings->content_description ?></label>
        <input type="text" id="settings_content_description" name="content_description" class="form-control" value="<?= $data->notification->settings->content_description ?>" required="required" />
    </div>

    <div class="form-group">
        <label for="settings_input_placeholder"><?= $this->language->notification->settings->input_placeholder ?></label>
        <input type="text" id="settings_input_placeholder" name="input_placeholder" class="form-control" value="<?= $data->notification->settings->input_placeholder ?>" required="required" />
    </div>

    <div class="form-group">
        <label for="settings_button_text"><?= $this->language->notification->settings->button_text ?></label>
        <input type="text" id="settings_button_text" name="button_text" class="form-control" value="<?= $data->notification->settings->button_text ?>" required="required" />
    </div>

    <div class="custom-control custom-switch">
        <input id="settings_show_agreement" name="show_agreement" type="checkbox" class="custom-control-input" <?= $data->notification->settings->show_agreement ? 'checked="true"' : null ?>>
        <label class="custom-control-label" for="settings_show_agreement"><?= $this->language->notification->settings->show_agreement ?></label>
        <div><small class="text-muted"><?= $this->language->notification->settings->show_agreement_help ?></small></div>
    </div>

    <div id="agreement">
        <div class="form-group">
            <label for="settings_agreement_text"><?= $this->language->notification->settings->agreement_text ?></label>
            <input type="text" id="settings_agreement_text" name="agreement_text" class="form-control" value="<?= $data->notification->settings->agreement_text ?>" />
        </div>

        <div class="form-group">
            <label for="settings_agreement_url"><?= $this->language->notification->settings->agreement_url ?></label>
            <input type="text" id="settings_agreement_url" name="agreement_url" class="form-control" value="<?= $data->notification->settings->agreement_url ?>" />
        </div>
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
        <label for="settings_description_color"><?= $this->language->notification->settings->description_color ?></label>
        <input type="hidden" id="settings_description_color" name="description_color" class="form-control" value="<?= $data->notification->settings->description_color ?>" required="required" />
        <div id="settings_description_color_pickr"></div>
    </div>

    <div class="form-group">
        <label for="settings_content_title_color"><?= $this->language->notification->settings->content_title_color ?></label>
        <input type="hidden" id="settings_content_title_color" name="content_title_color" class="form-control" value="<?= $data->notification->settings->content_title_color ?>" required="required" />
        <div id="settings_content_title_color_pickr"></div>
    </div>

    <div class="form-group">
        <label for="settings_content_description_color"><?= $this->language->notification->settings->content_description_color ?></label>
        <input type="hidden" id="settings_content_description_color" name="content_description_color" class="form-control" value="<?= $data->notification->settings->content_description_color ?>" required="required" />
        <div id="settings_content_description_color_pickr"></div>
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


<?php /* Data Tab */ ?>
<?php ob_start() ?>
    <div class="custom-control custom-switch mr-3 mb-3">
        <input
                type="checkbox"
                class="custom-control-input"
                id="data_send_is_enabled"
                name="data_send_is_enabled"
            <?= $data->notification->settings->data_send_is_enabled ? 'checked="true"' : null ?>
        >
        <label class="custom-control-label clickable" for="data_send_is_enabled"><?= $this->language->notification->settings->data_send_is_enabled ?></label>
    </div>

    <div id="data_send" class="container-disabled">
        <div class="form-group">
            <label for="settings_data_send_webhook"><?= $this->language->notification->settings->data_send_webhook ?></label>
            <input type="text" id="settings_data_send_webhook" name="data_send_webhook" class="form-control" value="<?= $data->notification->settings->data_send_webhook ?>" placeholder="<?= $this->language->notification->settings->data_send_webhook_placeholder ?>" aria-label="<?= $this->language->notification->settings->data_send_webhook_placeholder ?>" />
            <small class="text-muted"><?= $this->language->notification->settings->data_send_webhook_help ?></small>
        </div>

        <div class="form-group">
            <label for="settings_data_send_email"><?= $this->language->notification->settings->data_send_email ?></label>
            <input type="text" id="settings_data_send_email" name="data_send_email" class="form-control" value="<?= $data->notification->settings->data_send_email ?>" placeholder="<?= $this->language->notification->settings->data_send_email_placeholder ?>" aria-label="<?= $this->language->notification->settings->data_send_email_placeholder ?>" />
            <small class="text-muted"><?= $this->language->notification->settings->data_send_email_help ?></small>
        </div>
    </div>

<?php $html['data'] = ob_get_clean() ?>


<?php ob_start() ?>
    <script>
        /* Dont show the agreement fields if unchecked */
        let show_agreement_check = () => {
            if($('#settings_show_agreement').is(':checked')) {
                $('#agreement').show();
            } else {
                $('#agreement').hide();
            }
        };
        show_agreement_check();
        $('#settings_show_agreement').on('change', show_agreement_check);

        /* Cancel the submit button form of the email collector */
        $('#altumcode-request-collector-form').on('submit', event => event.preventDefault());

        /* Notification Preview Handlers */
        $('#settings_title').on('change paste keyup', event => {
            $('#notification_preview .altumcode-request-collector-title').text($(event.currentTarget).val());
        });

        $('#settings_description').on('change paste keyup', event => {
            $('#notification_preview .altumcode-request-collector-description').text($(event.currentTarget).val());
        });

        $('#settings_image').on('change paste keyup', event => {
            $('#notification_preview .altumcode-request-collector-image').attr('src', $(event.currentTarget).val());
        });

        $('#settings_content_title').on('change paste keyup', event => {
            $('#notification_preview .altumcode-request-collector-content-title').text($(event.currentTarget).val());
        });

        $('#settings_content_description').on('change paste keyup', event => {
            $('#notification_preview .altumcode-request-collector-content-description').text($(event.currentTarget).val());
        });

        $('#settings_input_placeholder').on('change paste keyup', event => {
            $('#notification_preview [name="input"]').attr('placeholder', $(event.currentTarget).val());
        });

        $('#settings_button_text').on('change paste keyup', event => {
            $('#notification_preview [name="button"]').text($(event.currentTarget).val());
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
            $('#notification_preview .altumcode-request-collector-title').css('color', hsva.toHEXA().toString());
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
            $('#notification_preview .altumcode-request-collector-description').css('color', hsva.toHEXA().toString());
        });

        /* Content Title Color Handler */
        let settings_content_title_color_pickr = Pickr.create({
            el: '#settings_content_title_color_pickr',
            default: $('#settings_content_title_color').val(),
            ...pickr_options
        });

        settings_content_title_color_pickr.on('change', hsva => {
            $('#settings_content_title_color').val(hsva.toHEXA().toString());

            /* Notification Preview Handler */
            $('#notification_preview .altumcode-request-collector-content-title').css('color', hsva.toHEXA().toString());
        });


        /* Content Description Color Handler */
        let settings_content_description_color_pickr = Pickr.create({
            el: '#settings_content_description_color_pickr',
            default: $('#settings_content_description_color').val(),
            ...pickr_options
        });

        settings_content_description_color_pickr.on('change', hsva => {
            $('#settings_content_description_color').val(hsva.toHEXA().toString());

            /* Notification Preview Handler */
            $('#notification_preview .altumcode-request-collector-content-description').css('color', hsva.toHEXA().toString());
        });

        /* Background Color Handler */
        let settings_background_color_pickr = Pickr.create({
            el: '#settings_background_color_pickr',
            default: $('#settings_background_color').val(),
            ...pickr_options
        });

        settings_background_color_pickr.on('change', hsva => {
            $('#settings_background_color').val(hsva.toHEXA().toString());

            console.log('event', hsva.toHEXA().toString());

            /* Notification Preview Handler */
            $('#notification_preview .altumcode-wrapper').css('background', hsva.toHEXA().toString());
        });

        /* Submit Background Color Handler */
        let settings_button_background_color_pickr = Pickr.create({
            el: '#settings_button_background_color_pickr',
            default: $('#settings_button_background_color').val(),
            ...pickr_options
        });

        settings_button_background_color_pickr.on('change', hsva => {
            $('#settings_button_background_color').val(hsva.toHEXA().toString());

            /* Notification Preview Handler */
            $('#notification_preview [name="button"]').css('background', hsva.toHEXA().toString());
        });

        /* Submit Background Color Handler */
        let settings_button_color_pickr = Pickr.create({
            el: '#settings_button_color_pickr',
            default: $('#settings_button_color').val(),
            ...pickr_options
        });

        settings_button_color_pickr.on('change', hsva => {
            $('#settings_button_color').val(hsva.toHEXA().toString());

            /* Notification Preview Handler */
            $('#notification_preview [name="button"]').css('color', hsva.toHEXA().toString());
        });

        /* Data Send Handler */
        let data_send_status_handler = () => {

            if($('#data_send_is_enabled:checked').length > 0) {

                /* Remove disabled container if depending on the status of the trigger checkbox */
                $('#data_send').removeClass('container-disabled');

            } else {

                /* Disable the container visually */
                $('#data_send').addClass('container-disabled');

            }
        };

        /* Trigger it for the first initial load */
        data_send_status_handler();

        /* Trigger on status change live of the checkbox */
        $('#data_send_is_enabled').on('change', data_send_status_handler);
    </script>
<?php $javascript = ob_get_clean() ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
