;(function ($) {
    const app = {
        init: () => {
            app.initMetaTabs();
            app.initSelect2();
            app.initVolumeSlider();

            $(document).on('click', '.toto-meta-tabs .toto-tab-link', app.toggleNotificationTab);
            $(document).on('click', '.toto-notification-type', app.selectType);
            $(document).on('change', '#settings_trigger_all_pages', app.toggleTriggerContent);
            $(document).on('change', '#settings_data_send_is_enabled', app.toggleDataSendContent);
            $(document).on('change', '[name="settings[trigger_on]"]', app.toggleLocationsField);
            $(document).on('change', '#settings_display_trigger', app.displayTriggerSelect);
            $(document).on('change', '#settings_trigger_locations', app.toggleCustomIds);
            $(document).on('click', '#trigger_add', app.addTrigger);
            $(document).on('click', '.toto-btn-delete', app.deleteTrigger);
            $(document).on('click', '#settings_show_agreement', app.toggleAgreement);
            $(document).on('click', '.toto-choose-image', app.handleMedia);
            $(document).on('click', '.toto-remove-image', app.removeImage);
        },

        initSelect2: () => {
            $('#settings_trigger_locations').select2({
                placeholder: 'Select Locations',
            });

            $(document).on('focus', '.toto-form-group :input', function () {
                $(this).attr('autocomplete', 'new-password');
            });
        },

        initMetaTabs: () => {
            const target = localStorage.getItem('totoActiveTab');

            if (target) {
                $(`.toto-meta-tabs .toto-tab-link[data-target=${target}]`).addClass('active').parent().prevAll('.toto-tab-item').find('.toto-tab-link').addClass('active');
                $(`#${target}`).addClass('active');
            }

        },

        initVolumeSlider: () => {
            const handle = $("#toto-volume-handle");
            $("#toto-volume-slider").slider({
                value: $('#toto-volume-slider').data('value'),
                create: function () {
                    handle.text($(this).slider("value"));
                },

                slide: function (event, ui) {
                    handle.text(ui.value);
                    $('#settings_sound_volume').val(ui.value);
                }
            });
        },

        toggleNotificationTab: function (e) {
            e.preventDefault();
            const target = $(this).data('target');

            localStorage.setItem('totoActiveTab', target);

            $('.toto-meta-tabs .toto-tab-link, .toto-tab-content-item').removeClass('active');
            $(this).addClass('active').parent().prevAll('.toto-tab-item').find('.toto-tab-link').addClass('active');
            $(`#${target}`).addClass('active');
        },

        toggleLocationsField: function () {
            if ('selected' === $(this).val()) {
                $('#settings_trigger_locations').parent().removeClass('toto-hidden');
            } else {
                $('#settings_trigger_locations').parent().addClass('toto-hidden');
            }
        },

        toggleCustomIds: function () {
            if ($(this).val() && $(this).val().includes('is_custom')) {
                $('#settings_custom_post_page_ids').parent().removeClass('toto-hidden');
            } else {
                $('#settings_custom_post_page_ids').parent().addClass('toto-hidden');
            }
        },

        selectType: function () {
            $('.toto-notification-type').removeClass('active').find('input').prop('checked', false);
            $(this).addClass('active').find('input').prop('checked', true);

            $('.notification-preview-content').html($('.preview', $(this)).html());

            app.updateMenu(this);

        },

        updateMenu: ($this) => {

            wp.ajax.send('update_menu', {
                data: {
                    type: $('input', $this).val(),
                    post_id: $('#post_ID').val(),
                    _wpnonce: toto._wpnonce
                },

                success: res => {

                    $('.toto-meta-tabs').replaceWith(res.html.menu);

                    $('.toto-tab-content-item:not(#notification_type)').remove();
                    $('#notification_type').after(res.html.content);
                    $('#preview_handler').replaceWith(res.html.scripts);

                    app.init();

                },

                error: error => console.log(error)
            })
        },

        toggleTriggerContent: function () {
            $('.btn-trigger-add').toggleClass('toto-hidden');
            $('#triggers_rules').toggleClass('container-disabled');
        },

        toggleDataSendContent: function () {
            $('#data_send').toggleClass('container-disabled');
        },

        addTrigger: () => {
            $('#triggers_rules>.toto-input-group:first-child').clone().appendTo('#triggers_rules');

            if ($('#triggers_rules>.toto-input-group').length < 2) {
                $('.toto-btn-delete').hide();
            } else {
                $('.toto-btn-delete').show();
            }
        },

        deleteTrigger: function () {
            $(this).parent().remove();

            if ($('#triggers_rules>.toto-input-group').length < 2) {
                $('.toto-btn-delete').hide();
            } else {
                $('.toto-btn-delete').show();
            }
        },

        toggleAgreement: function () {
            $('#agreement').toggleClass('toto-hidden');
        },

        handleMedia: function (e) {
            e.preventDefault();

            const image = wp.media({
                title: 'Choose Image',
                multiple: false
            }).open()
                .on('select', function () {
                    const uploaded_image = image.state().get('selection').first();
                    const image_url = uploaded_image.toJSON().url;
                    $('.toto-image-preview',).attr('src', image_url).removeClass('toto-hidden');
                    $('#settings_image',).val(image_url).trigger('change');
                    $('.toto-remove-image').removeClass('toto-hidden');
                });
        },

        removeImage: function (e) {
            e.preventDefault();
            $('.toto-image-preview',).attr('src', '').addClass('toto-hidden');
            $('#settings_image',).val('').trigger('change');
            $('.toto-remove-image').addClass('toto-hidden');
        },

        displayTriggerSelect: function () {
            const val = $(this).val();

            if ('exit_intent' === val) {
                $(this).next().addClass('toto-hidden');
            } else {
                $(this).next().removeClass('toto-hidden').val('').attr('placeholder', $(`option[value=${val}]`, $(this)).data('placeholder'));
            }

        }

    };

    $(document).ready(app.init)

})(jQuery);