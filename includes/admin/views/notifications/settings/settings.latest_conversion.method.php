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
        <label for="settings_title"><?= $this->language->notification->settings->conversion_who ?></label>
        <input type="text" id="settings_title" name="title" class="form-control" value="<?= $data->notification->settings->title ?>" required="required" />
        <small><?= $this->language->notification->settings->conversion_who_help ?></small>
    </div>

    <div class="form-group">
        <label for="settings_description"><?= $this->language->notification->settings->conversion_text ?></label>
        <input type="text" id="settings_description" name="description" class="form-control" value="<?= $data->notification->settings->description ?>" required="required" />
    </div>

    <div class="form-group">
        <label for="settings_image"><?= $this->language->notification->settings->image ?></label>
        <input type="text" id="settings_image" name="image" class="form-control" value="<?= $data->notification->settings->image ?>" />
        <small class="text-muted"><?= $this->language->notification->settings->image_help ?></small>
    </div>

    <div class="form-group">
        <label for="settings_url"><?= $this->language->notification->settings->url ?></label>
        <input type="text" id="settings_url" name="url" class="form-control" value="<?= $data->notification->settings->url ?>" />
        <small class="text-muted"><?= $this->language->notification->settings->url_help ?></small>
    </div>

    <div class="form-group">
        <label for="settings_url"><?= $this->language->notification->settings->conversions_count ?></label>
        <input type="text" id="settings_conversions_count" name="conversions_count" class="form-control" value="<?= $data->notification->settings->conversions_count ?>" />
        <small class="text-muted"><?= $this->language->notification->settings->conversions_count_help ?></small>
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
        <label for="settings_background_color"><?= $this->language->notification->settings->background_color ?></label>
        <input type="hidden" id="settings_background_color" name="background_color" class="form-control" value="<?= $data->notification->settings->background_color ?>" required="required" />
        <div id="settings_background_color_pickr"></div>
    </div>

    <div class="form-group">
        <label for="settings_border_radius"><?= $this->language->notification->settings->border_radius ?></label>
        <select class="custom-select" name="border_radius">
            <option value="straight" <?= $data->notification->settings->border_radius == 'straight' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->border_radius_straight ?></option>
            <option value="rounded" <?= $data->notification->settings->border_radius == 'rounded' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->border_radius_rounded ?></option>
            <option value="round" <?= $data->notification->settings->border_radius == 'round' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->border_radius_round ?></option>
        </select>
        <small class="text-muted"><?= $this->language->notification->settings->border_radius_help ?></small>
    </div>
<?php $html['customize'] = ob_get_clean() ?>


<?php /* Data Tab */ ?>
<?php ob_start() ?>
<div class="form-group">
    <label for="settings_data_trigger_input_webhook"><?= $this->language->notification->settings->data_trigger_webhook ?></label>

    <div class="input-group input-group-sm mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1"><?= $this->language->notification->settings->data_trigger_type_webhook ?></span>
        </div>

        <input type="text" id="settings_data_trigger_input_webhook" name="data_trigger_input_webhook" class="form-control" value="<?= url('pixel-webhook/' . $data->notification->notification_key) ?>" placeholder="<?= $this->language->notification->settings->data_trigger_input_webhook ?>" aria-label="<?= $this->language->notification->settings->data_trigger_input_webhook ?>" disabled="disabled">
    </div>

    <small class="text-muted"><?= $this->language->notification->settings->data_trigger_webhook_help ?></small>


    <div class="mt-3 d-flex justify-content-between">
        <div class="custom-control custom-switch mr-3 mb-3">
            <input
                    type="checkbox"
                    class="custom-control-input"
                    id="data_trigger_auto"
                    name="data_trigger_auto"
                <?= $data->notification->settings->data_trigger_auto ? 'checked="true"' : null ?>
            >
            <label class="custom-control-label clickable" for="data_trigger_auto"><?= $this->language->notification->settings->data_trigger_auto ?></label>

            <div><small class="text-muted"><?= $this->language->notification->settings->data_trigger_auto_help ?></small></div>
        </div>

        <div class="col-auto">
            <button type="button" id="data_trigger_auto_add" class="btn btn-success btn-sm rounded-pill"><i class="fas fa-plus-circle"></i> <?= $this->language->notification->settings->data_trigger_auto_add ?></button>
        </div>
    </div>

    <div id="data_triggers_auto" class="container-disabled">
        <?php if(count($data->notification->settings->data_triggers_auto)): ?>
            <?php foreach($data->notification->settings->data_triggers_auto as $trigger): ?>
                <div class="input-group input-group-sm mb-3">
                    <select class="custom-select trigger-type-select" name="data_trigger_auto_type[]">
                        <option value="exact" <?= $trigger->type == 'exact' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->trigger_type_exact ?></option>
                        <option value="contains" <?= $trigger->type == 'contains' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->trigger_type_contains ?></option>
                        <option value="starts_with" <?= $trigger->type == 'starts_with' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->trigger_type_starts_with ?></option>
                        <option value="ends_with" <?= $trigger->type == 'ends_with' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->trigger_type_ends_with ?></option>
                        <option value="page_contains" <?= $trigger->type == 'page_contains' ? 'selected="selected"' : null ?>><?= $this->language->notification->settings->trigger_type_page_contains ?></option>
                    </select>

                    <input type="text" name="data_trigger_auto_value[]" class="form-control" value="<?= $trigger->value ?>" placeholder="<?= $this->language->notification->settings->trigger_input_exact ?>" aria-label="<?= $this->language->notification->settings->trigger_input_exact ?>">

                    <button type="button" class="data-trigger-auto-delete ml-3 btn btn-danger btn-sm" aria-label="<?= $this->language->global->delete ?>"><i class="fa fa-times"></i></button>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>
<?php $html['data'] = ob_get_clean() ?>


<?php ob_start() ?>
<script>
    /* Notification Preview Handlers */
    $('#settings_title').on('change paste keyup', event => {
        $('#notification_preview .altumcode-latest-conversion-title').text($(event.currentTarget).val());
    });

    $('#settings_description').on('change paste keyup', event => {
        $('#notification_preview .altumcode-latest-conversion-description').text($(event.currentTarget).val());
    });

    $('#settings_image').on('change paste keyup', event => {
        $('#notification_preview .altumcode-latest-conversion-image').attr('src', $(event.currentTarget).val());
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
        $('#notification_preview .altumcode-latest-conversion-title').css('color', hsva.toHEXA().toString());
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
        $('#notification_preview .altumcode-latest-conversion-description').css('color', hsva.toHEXA().toString());
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


    /* Data Triggers Auto Handler */
    let data_trigger_auto_status_handler = () => {

        if(!$('#data_trigger_auto:checked').length) {

            /* Disable the container visually */
            $('#data_triggers_auto').addClass('container-disabled');

            /* Remove the new trigger add button */
            $('#data_trigger_auto_add').hide();

        } else {

            /* Remove disabled container if depending on the status of the trigger checkbox */
            $('#data_triggers_auto').removeClass('container-disabled');

            /* Bring back the new trigger add button */
            $('#data_trigger_auto_add').show();

        }
    };

    /* Trigger on status change live of the checkbox */
    $('#data_trigger_auto').on('change', data_trigger_auto_status_handler);

    /* Delete trigger handler */
    let data_triggers_auto_delete_handler = () => {

        /* Delete button handler */
        $('.data-trigger-auto-delete').off().on('click', event => {

            let element = $(event.currentTarget).closest('.input-group');

            element.remove();

            data_triggers_auto_count_handler();

        });

    };

    let data_trigger_auto_add_sample = () => {
        let rule_sample = $('#data_trigger_auto_rule_sample').html();

        $('#data_triggers_auto').append(rule_sample);
    };

    let data_triggers_auto_count_handler = () => {

        let total_triggers = $('#data_triggers_auto > .input-group').length;

        /* Make sure we at least have two input groups to show the delete button */
        if(total_triggers > 1) {
            $('#data_triggers_auto .data-trigger-auto-delete').show();

            /* Make sure to set a limit to these triggers */
            if(total_triggers > 10) {
                $('#data_trigger_auto_add').hide();
            } else {
                $('#data_trigger_auto_add').show();
            }

        } else {

            if(total_triggers == 0) {
                data_trigger_auto_add_sample();
            }

            $('#data_triggers_auto .data-trigger-auto-delete').hide();
        }
    };

    /* Add new trigger rule handler */
    $('#data_trigger_auto_add').on('click', () => {
        data_trigger_auto_add_sample();
        data_triggers_auto_delete_handler();
        data_triggers_auto_count_handler();
    });

    /* Trigger functions for the first initial load */
    data_trigger_auto_status_handler();
    data_triggers_auto_delete_handler();
    data_triggers_auto_count_handler();
</script>
<?php $javascript = ob_get_clean() ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
