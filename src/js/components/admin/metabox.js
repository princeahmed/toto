;(function ($) {
    const app = {
        init: () => {
            app.initMetaTabs();
            app.initSelect2();
            app.initVolumeSlider();
            app.handlePrevNext();
            app.previewHandler();
            app.initDateTimePicker();

            $(document).on('click', '.trust-plus-meta-tabs .trust-plus-tab-link', app.toggleNotificationTab);
            $(document).on('click', '.trust-plus-notification-type', app.selectType);
            $(document).on('change', '#settings_trigger_all_pages', app.toggleTriggerContent);
            $(document).on('change', '#settings_data_send_is_enabled', app.toggleDataSendContent);
            $(document).on('change', '[name="settings[trigger_on]"]', app.toggleLocationsField);
            $(document).on('change', '#settings_display_trigger', app.displayTriggerSelect);
            $(document).on('change', '#settings_trigger_locations', app.toggleCustomIds);
            $(document).on('click', '#trigger_add', app.addTrigger);
            $(document).on('click', '.trust-plus-btn-delete', app.deleteTrigger);
            $(document).on('click', '.trust-plus-choose-image', app.handleMedia);
            $(document).on('click', '.trust-plus-remove-image', app.removeImage);
            $(document).on('click', '.trust-plus-next, .trust-plus-prev', app.handlePrevNext);
            $(document).on('change', '#settings_notification_sound', app.playSound);

            $(document).on('change', '.handle-toggle', app.handleToggle);

        },

        initDateTimePicker: () => {
            $('.trust-plus-date-time-picker').datetimepicker({
                timeFormat: "hh:mm TT",
                dateFormat: "yy-mm-dd",
            });
        },

        playSound: function () {
            const sound = $(this).val();
            $('#trust-plus-sound source').attr('src', `${trustPlus.trust_plus_url}/assets/sounds/${sound}.mp3`);

            const audio = $('#trust-plus-sound');
            audio[0].pause();
            audio[0].load();
            audio[0].oncanplaythrough = audio[0].play();
        },

        handleToggle: function () {
            const target = $(this).parent().data('target');
            $(target).parent().toggleClass('hidden');
        },

        previewHandler: () => {

            if (!$('.trust-plus-notification-type.active input').length) {
                return;
            }

            const type = $('.trust-plus-notification-type.active input').val().toLowerCase().replace('_', '-');

            const colorHandlers = {
                title_color: `trust-plus-${type}-title`,
                description_color: `trust-plus-${type}-description`,
                button_color: `trust-plus-${type}-button`,
                number_color: `trust-plus-${type}-number`,
                content_title_color: `trust-plus-${type}-content-title`,
                content_description_color: `trust-plus-${type}-content-description`,
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
                background_color: `trust-plus-wrapper`,
                button_background_color: `trust-plus-${type}-button`,
                number_background_color: `trust-plus-${type}-number`,
                pulse_background_color: `trust-plus-toast-pulse`,
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

            /* text change handlers */
            const textHandlers = {
                title: `trust-plus-${type}-title`,
                description: `trust-plus-${type}-description`,
                coupon_code: `trust-plus-${type}-coupon-code`,
                button_text: `trust-plus-${type}-button`,
                footer_text: `trust-plus-${type}-footer`,
                agreement_text: `trust-plus-agreement-checkbox-text>a`,
                conversion_count: `trust-plus-${type}-conversion-count`,
                content_title: `trust-plus-${type}-content-title`,
                content_description: `trust-plus-${type}-content-description`,
                link_url_text: `trust-plus-${type}-url>a`,
            };

            for (let [key, target] of Object.entries(textHandlers)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).text($(this).val());
                });
            }

            // srcHandler
            const srcHandler = {
                image: `trust-plus-${type}-image`,
                video: `trust-plus-${type}-video-iframe`,
            };
            for (let [key, target] of Object.entries(srcHandler)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).attr('src', $(this).val());
                });
            }

            //border radius handler
            const borderRadiusHandler = {border_radius: `trust-plus-wrapper`};
            for (let [key, target] of Object.entries(borderRadiusHandler)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).removeClass("trust-plus-wrapper-round trust-plus-wrapper-rounded  trust-plus-wrapper-straight").addClass(`trust-plus-wrapper-${$(this).val()}`);
                });
            }

            //placeholder handler
            const placeHolderHandler = {
                email_placeholder: `trust-plus-${type}-email-placeholder`,
                input_placeholder: `trust-plus-${type}-input-placeholder`,
            };
            for (let [key, target] of Object.entries(placeHolderHandler)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).attr('placeholder', $(this).val());
                });
            }

            //toggle handler
            const toggleHandler = {
                show_agreement: `trust-plus-agreement-checkbox`,
                display_branding: `trust-plus-site`,
                display_close_button: `trust-plus-close`,
                show_angry: `trust-plus-${type}-angry`,
                show_sad: `trust-plus-${type}-sad`,
                show_neutral: `trust-plus-${type}-neutral`,
                show_happy: `trust-plus-${type}-happy`,
                show_excited: `trust-plus-${type}-excited`,
                share_facebook: `trust-plus-${type}-button-facebook`,
                share_twitter: `trust-plus-${type}-button-twitter`,
                share_linkedin: `trust-plus-${type}-button-linkedin`,
            };


            for (let [key, target] of Object.entries(toggleHandler)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).toggleClass('hidden');
                });
            }

        },

        handlePrevNext: function (e) {
            if (e) {
                e.preventDefault();
            }

            const target = localStorage.getItem('trustPlusActiveTab');
            const prev = $('.trust-plus-prev');
            const next = $('.trust-plus-next');
            const next_prev = $('.trust-plus-next, .trust-plus-prev');

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

            if ($(this).hasClass('trust-plus-next')) {
                $(`.trust-plus-tab-link[data-target="${target}"]`).parent().next().find('.trust-plus-tab-link').trigger('click');
            }

            if ($(this).hasClass('trust-plus-prev')) {
                $(`.trust-plus-tab-link[data-target="${target}"]`).parent().prev().find('.trust-plus-tab-link').trigger('click');
            }

        },

        initSelect2: () => {
            $('#settings_trigger_locations').select2({
                placeholder: trustPlus.i18n.select_locations,
            });

            $(document).on('focus', '.trust-plus-form-group :input', function () {
                $(this).attr('autocomplete', 'new-password');
            });
        },

        initMetaTabs: () => {
            if ($('#auto_draft').length) return;

            const target = localStorage.getItem('trustPlusActiveTab');

            if (target) {
                $('.trust-plus-tab-content-item').removeClass('active');
                $(`.trust-plus-meta-tabs .trust-plus-tab-link[data-target=${target}]`).addClass('active').parent().prevAll('.trust-plus-tab-item').find('.trust-plus-tab-link').addClass('active');
                $(`#${target}`).addClass('active');
            }

        },

        initVolumeSlider: () => {
            const handle = $("#trust-plus-volume-handle");

            $("#trust-plus-volume-slider").slider({
                value: $('#trust-plus-volume-slider').data('value'),
                create: function () {
                    handle.text($(this).slider("value"));
                },

                slide: function (event, ui) {
                    handle.text(ui.value);
                    $('#settings_sound_volume').val(ui.value);
                },

                change: function (event, ui) {
                    const audio = $('#trust-plus-sound');

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

            localStorage.setItem('trustPlusActiveTab', target);
            $('.trust-plus-meta-tabs .trust-plus-tab-link, .trust-plus-tab-content-item').removeClass('active');

            $(this).addClass('active').parent().prevAll('.trust-plus-tab-item').find('.trust-plus-tab-link').addClass('active');
            $(`#${target}`).addClass('active');

            app.handlePrevNext();
        },

        toggleLocationsField: function () {
            if ('selected' === $(this).val()) {
                $('#settings_trigger_locations').parent().removeClass('hidden');
            } else {
                $('#settings_trigger_locations').parent().addClass('hidden');
            }
        },

        toggleCustomIds: function () {
            if ($(this).val() && $(this).val().includes('is_custom')) {
                $('#settings_custom_post_page_ids').parent().removeClass('hidden');
            } else {
                $('#settings_custom_post_page_ids').parent().addClass('hidden');
            }
        },

        selectType: function () {

            $('.trust-plus-notification-type').removeClass('active').find('input').prop('checked', false);
            $(this).addClass('active').find('input').prop('checked', true);

            $('.notification-preview-content').html($('.preview', $(this)).html());

            const type = $('input', $(this)).val();
            const post_id = $('#post_ID').val();

            wp.ajax.send('trust_plus_update_fields', {
                data: {
                    type,
                    post_id,
                    _wpnonce: trustPlus._wpnonce
                },

                success: res => {
                    $('.trust-plus-tab-content>div:not(#notification_type)').remove();
                    $('#notification_type').after(res.html);

                    app.initSelect2();
                    app.previewHandler();
                    app.initDateTimePicker();

                },

                error: error => console.log(error)
            });

        },

        toggleTriggerContent: function () {
            $('.btn-trigger-add').toggleClass('hidden');
            $('#triggers_rules').toggleClass('container-disabled');
        },

        toggleDataSendContent: function () {
            $('#data_send').toggleClass('container-disabled');
        },

        addTrigger: () => {
            $('#triggers_rules>.trust-plus-input-group:first-child').clone().appendTo('#triggers_rules');

            if ($('#triggers_rules>.trust-plus-input-group').length < 2) {
                $('.trust-plus-btn-delete').hide();
            } else {
                $('.trust-plus-btn-delete').show();
            }
        },

        deleteTrigger: function () {
            $(this).parent().remove();

            if ($('#triggers_rules>.trust-plus-input-group').length < 2) {
                $('.trust-plus-btn-delete').hide();
            } else {
                $('.trust-plus-btn-delete').show();
            }
        },

        handleMedia: function (e) {
            e.preventDefault();

            const image = wp.media({
                title: trustPlus.i18n.choos_image,
                multiple: false
            }).open()
                .on('select', function () {
                    const uploaded_image = image.state().get('selection').first();
                    const image_url = uploaded_image.toJSON().url;
                    $('.trust-plus-image-preview',).attr('src', image_url).removeClass('hidden');
                    $('#settings_image',).val(image_url).trigger('change');
                    $('.trust-plus-remove-image').removeClass('hidden');
                });
        },

        removeImage: function (e) {
            e.preventDefault();
            $('.trust-plus-image-preview',).attr('src', '').addClass('hidden');
            $('#settings_image',).val('').trigger('change');
            $('.trust-plus-remove-image').addClass('hidden');
        },

        displayTriggerSelect: function () {
            const val = $(this).val();

            if ('exit_intent' === val) {
                $(this).next().addClass('hidden');
            } else {
                $(this).next().removeClass('hidden').val('').attr('placeholder', $(`option[value=${val}]`, $(this)).data('placeholder'));
            }

        }

    };

    $(document).ready(app.init)

})(jQuery);