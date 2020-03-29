<?php

defined( 'ABSPATH' ) || die();

/* Create the content for each tab */
$html = [];

/* Extra Javascript needed */
$javascript = '';

$notification_fields = Toto_Notifications::settings_fields('INFORMATIONAL');

$fields = [];

ob_start();
echo $notification_fields->title;
echo $notification_fields->description;
echo $notification_fields->image;
echo $notification_fields->url;
$fields['content'] = ob_get_clean();

ob_start();
echo $notification_fields->trigger;
echo $notification_fields->display_trigger;
echo $notification_fields->display_once_per_session;
echo $notification_fields->display_mobile;

$fields['triggers'] = ob_get_clean();

ob_start();
echo $notification_fields->display_duration;
echo $notification_fields->display_position;
echo $notification_fields->display_close_button;
echo $notification_fields->display_branding;
$fields['display'] = ob_get_clean();

ob_start();
echo $notification_fields->title_color;
echo $notification_fields->description_color;
echo $notification_fields->background_color;
echo $notification_fields->border_radius;
$fields['customize'] = ob_get_clean();


?>


<?php ob_start() ?>
<script>
    /* Notification Preview Handlers */
    $('#settings_title').on('change paste keyup', event => {
        $('#notification_preview .altumcode-informational-title').text($(event.currentTarget).val());
    });

    $('#settings_description').on('change paste keyup', event => {
        $('#notification_preview .altumcode-informational-description').text($(event.currentTarget).val());
    });

    $('#settings_image').on('change paste keyup', event => {
        $('#notification_preview .altumcode-informational-image').attr('src', $(event.currentTarget).val());
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
        $('#notification_preview .altumcode-informational-title').css('color', hsva.toHEXA().toString());
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
        $('#notification_preview .altumcode-informational-description').css('color', hsva.toHEXA().toString());
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

<?php return (object) [ 'fields' => $fields, 'javascript' => $javascript ] ?>
