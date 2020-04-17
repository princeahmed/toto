;(function ($) {
    const app = {
        init: () => {
            app.initMetaTabs();
            app.initSelect2();
            app.initVolumeSlider();
            app.handlePrevNext();
            app.previewHandler();

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
            $(document).on('click', '.toto-next, .toto-prev', app.handlePrevNext);
            $(document).on('change', '.toto-switch-group input', app.handleToggle);
            $(document).on('change', '#settings_notification_sound', app.playSound);
        },

        playSound: function () {
            const sound = $(this).val();
            $('#toto-sound source').attr('src', `${toto.totoURL}/assets/sounds/${sound}.mp3`);

            const audio = $('#toto-sound');
            audio[0].pause();
            audio[0].load();
            audio[0].oncanplaythrough = audio[0].play();
        },

        handleToggle: function () {
            const target = $(this).parent().data('target');
            $(target).parent().toggleClass('toto-hidden');

        },

        previewHandler: () => {

            if (!$('.toto-notification-type.active input').length) {
                return;
            }

            const type = $('.toto-notification-type.active input').val().toLowerCase().replace('_', '-');

            const colorHandlers = {
                title_color: `toto-${type}-title`,
                description_color: `toto-${type}-description`,
                button_color: `toto-${type}-button`,
                number_color: `toto-${type}-number`,
                content_title_color: `toto-${type}-content-title`,
                content_description_color: `toto-${type}-content-description`,
            };
            for (let [key, target] of Object.entries(colorHandlers)) {


                $(`#settings_${key}`).wpColorPicker({
                    change: (e, ui) => {
                        setTimeout(function () {
                            $(`#notification_preview .${target}`).css("color", e.target.value);
                        }, 100)
                    }
                });
            }

            //Background Color Handlers
            const bgColorHandlers = {
                background_color: `toto-wrapper`,
                button_background_color: `toto-${type}-button`,
                number_background_color: `toto-${type}-number`,
                pulse_background_color: `toto-toast-pulse`,
            };
            for (let [key, target] of Object.entries(bgColorHandlers)) {
                $(`#settings_${key}`).wpColorPicker({
                    change: (e, ui) => {
                        setTimeout(function () {
                            $(`#notification_preview .${target}`).css("background-color", e.target.value);
                        }, 100)
                    }
                });
            }


            const textHandlers = {
                title: `toto-${type}-title`,
                description: `toto-${type}-description`,
                coupon_code: `toto-${type}-coupon-code`,
                button_text: `toto-${type}-button-text`,
                footer_text: `toto-${type}-footer-text`,
                agreement_text: `toto-${type}-agreement-text`,
                conversion_count: `toto-${type}-conversion-count`,
                content_title: `toto-${type}-content-title`,
                content_description: `toto-${type}-content-description`,
            };

            for (let [key, target] of Object.entries(textHandlers)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).text($(this).val());
                });
            }

            // srcHandler
            const srcHandler = {
                image: `toto-${type}-image`,
                video: `toto-${type}-video-iframe`,
            };
            for (let [key, target] of Object.entries(srcHandler)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).attr('src', $(this).val());
                });
            }

            //border radius handler
            const borderRadiusHandler = {border_radius: `toto-wrapper`};
            for (let [key, target] of Object.entries(borderRadiusHandler)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).removeClass("toto-wrapper-round toto-wrapper-rounded  toto-wrapper-straight").addClass(`toto-wrapper-${$(this).val()}`);
                });
            }

            //placeholder handler
            const placeHolderHandler = {
                email_placeholder: `toto-${type}-email-placeholder`,
                input_placeholder: `toto-${type}-input-placeholder`,
            };
            for (let [key, target] of Object.entries(placeHolderHandler)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).attr('placeholder', $(this).val());
                });
            }

            //toggle handler
            const toggleHandler = {
                show_agreement: `toto-agreement-checkbox`,
                display_branding: `toto-site`,
                display_close_button: `toto-close`,
                show_angry: `toto-${type}-angry`,
                show_sad: `toto-${type}-sad`,
                show_neutral: `toto-${type}-neutral`,
                show_happy: `toto-${type}-happy`,
                show_excited: `toto-${type}-excited`,
                share_facebook: `toto-${type}-button-facebook`,
                share_twitter: `toto-${type}-button-twitter`,
                share_linkedin: `toto-${type}-button-linkedin`,
            };

            for (let [key, target] of Object.entries(toggleHandler)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).toggle();
                });
            }

        },

        handlePrevNext: function (e) {
            if (e) {
                e.preventDefault();
            }

            const target = localStorage.getItem('totoActiveTab');
            const prev = $('.toto-prev');
            const next = $('.toto-next');
            const next_prev = $('.toto-next, .toto-prev');

            if (target) {
                if ('notification_type' === target) {
                    prev.addClass('container-disabled');
                    next.removeClass('container-disabled');
                } else if ('sound' === target) {
                    next.addClass('container-disabled');
                    prev.removeClass('container-disabled')
                } else {
                    next_prev.removeClass('container-disabled');
                }
            } else {
                prev.addClass('container-disabled');
                next.removeClass('container-disabled');
            }

            if ($(this).hasClass('toto-next')) {
                $(`.toto-tab-link[data-target="${target}"]`).parent().next().find('.toto-tab-link').trigger('click');
            }

            if ($(this).hasClass('toto-prev')) {
                $(`.toto-tab-link[data-target="${target}"]`).parent().prev().find('.toto-tab-link').trigger('click');
            }

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
                },

                change: function (event, ui) {
                    const audio = $('#toto-sound');

                    audio.prop('volume', ui.value / 100);
                    audio[0].pause();
                    audio[0].load();
                    audio[0].oncanplaythrough = audio[0].play();
                },


            });
        },

        toggleNotificationTab: function (e) {
            e.preventDefault();
            const target = $(this).data('target');

            localStorage.setItem('totoActiveTab', target);
            $('.toto-meta-tabs .toto-tab-link, .toto-tab-content-item').removeClass('active');

            $(this).addClass('active').parent().prevAll('.toto-tab-item').find('.toto-tab-link').addClass('active');
            $(`#${target}`).addClass('active');

            app.handlePrevNext();
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

            app.updateFields(this);

        },

        updateFields: ($this) => {

            wp.ajax.send('toto_update_fields', {
                data: {
                    type: $('input', $this).val(),
                    post_id: $('#post_ID').val(),
                    _wpnonce: toto._wpnonce
                },

                success: res => {
                    $('.toto-tab-content>div:not(#notification_type)').remove();
                    $('#notification_type').after(res.html.content);
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