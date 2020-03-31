<?php

defined( 'ABSPATH' ) || die();

/* Create the content for each tab */
$html = [];

/* Extra Javascript needed */
$javascript = '';

$notification_fields = Toto_Notifications::settings_fields( 'EMAIL_COLLECTOR' );

$fields = [];

ob_start();
echo $notification_fields->title;
echo $notification_fields->description;
echo $notification_fields->email_placeholder;
echo $notification_fields->button_text;
echo $notification_fields->show_agreement;
echo $notification_fields->agreement;
$fields['content'] = ob_get_clean();

ob_start();
echo $notification_fields->title_color;
echo $notification_fields->description_color;
echo $notification_fields->background_color;
echo $notification_fields->button_background_color;
echo $notification_fields->button_color;
echo $notification_fields->border_radius;
$fields['customize'] = ob_get_clean();

ob_start();
echo $notification_fields->data_send_is_enabled;
echo $notification_fields->data_send;
$fields['data'] = ob_get_clean();

?>


<?php ob_start() ?>
<script>
    /* Dont show the agreement fields if unchecked */
    let show_agreement_check = () => {
        if ($('#settings_show_agreement').is(':checked')) {
            $('#agreement').show();
        } else {
            $('#agreement').hide();
        }
    };
    show_agreement_check();
    $('#settings_show_agreement').on('change', show_agreement_check);

    /* Cancel the submit button form of the email collector */
    $('#toto-email-collector-form').on('submit', event => event.preventDefault());

    /* Notification Preview Handlers */
    $('#settings_title').on('change paste keyup', event => {
        $('#notification_preview .toto-email-collector-title').text($(event.currentTarget).val());
    });

    $('#settings_description').on('change paste keyup', event => {
        $('#notification_preview .toto-email-collector-description').text($(event.currentTarget).val());
    });

    $('#settings_email_placeholder').on('change paste keyup', event => {
        $('#notification_preview [name="email"]').attr('placeholder', $(event.currentTarget).val());
    });

    $('#settings_submit').on('change paste keyup', event => {
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
        $('#notification_preview .toto-email-collector-title').css('color', hsva.toHEXA().toString());
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
        $('#notification_preview .toto-email-collector-description').css('color', hsva.toHEXA().toString());
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
        $('#notification_preview .toto-wrapper').css('background', hsva.toHEXA().toString());
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

        if ($('#data_send_is_enabled:checked').length > 0) {

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

<?php return (object) [ 'fields' => $fields, 'javascript' => $javascript ] ?>
