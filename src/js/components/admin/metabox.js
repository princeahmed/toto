;(function ($) {
    const app = {
        init: () => {
            app.initMetaTabs();
            app.initSelect2();
            app.initVolumeSlider();
            app.handlePrevNext();
            app.previewHandler();
            app.initDateTimePicker();

            $(document).on('click', '.notification-plus-meta-tabs .notification-plus-tab-link', app.toggleNotificationTab);
            $(document).on('click', '.notification-plus-notification-type', app.selectType);
            $(document).on('change', '#settings_trigger_all_pages', app.toggleTriggerContent);
            $(document).on('change', '#settings_data_send_is_enabled', app.toggleDataSendContent);
            $(document).on('change', '[name="settings[trigger_on]"]', app.toggleLocationsField);
            $(document).on('change', '#settings_display_trigger', app.displayTriggerSelect);
            $(document).on('change', '#settings_trigger_locations', app.toggleCustomIds);
            $(document).on('click', '#trigger_add', app.addTrigger);
            $(document).on('click', '.notification-plus-btn-delete', app.deleteTrigger);
            $(document).on('click', '.notification-plus-choose-image', app.handleMedia);
            $(document).on('click', '.notification-plus-remove-image', app.removeImage);
            $(document).on('click', '.notification-plus-next, .notification-plus-prev', app.handlePrevNext);
            $(document).on('change', '#settings_notification_sound', app.playSound);

            $(document).on('change', '.handle-toggle', app.handleToggle);

        },

        initDateTimePicker: () => {
            $('.notification-plus-date-time-picker').datetimepicker({
                timeFormat: "hh:mm TT",
                dateFormat: "yy-mm-dd",
            });
        },

        playSound: function () {
            const sound = $(this).val();
            $('#notification-plus-sound source').attr('src', `${notificationPlus.notification_plus_url}/assets/sounds/${sound}.mp3`);

            const audio = $('#notification-plus-sound');
            audio[0].pause();
            audio[0].load();
            audio[0].oncanplaythrough = audio[0].play();
        },

        handleToggle: function () {
            const target = $(this).parent().data('target');
            $(target).parent().toggleClass('hidden');
        },

        previewHandler: () => {

            if (!$('.notification-plus-notification-type.active input').length) {
                return;
            }

            const type = $('.notification-plus-notification-type.active input').val().toLowerCase().replace('_', '-');

            //colors handlers
            const colorHandlers = {
                title_color: `notification-plus-${type}-title`,
                description_color: `notification-plus-${type}-description`,
                button_color: `notification-plus-${type}-button`,
                number_color: `notification-plus-${type}-number`,
                content_title_color: `notification-plus-${type}-content-title`,
                content_description_color: `notification-plus-${type}-content-description`,
                time_color: `notification-plus-${type}-time`,
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
                background_color: `notification-plus-wrapper`,
                button_background_color: `notification-plus-${type}-button`,
                number_background_color: `notification-plus-${type}-number`,
                pulse_background_color: `notification-plus-toast-pulse`,
                time_background_color: `notification-plus-${type}-time`,
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
                title: `notification-plus-${type}-title`,
                description: `notification-plus-${type}-description`,
                coupon_code: `notification-plus-${type}-coupon-code`,
                button_text: `notification-plus-${type}-button`,
                footer_text: `notification-plus-${type}-footer`,
                agreement_text: `notification-plus-agreement-checkbox-text>a`,
                conversion_count: `notification-plus-${type}-conversion-count`,
                content_title: `notification-plus-${type}-content-title`,
                content_description: `notification-plus-${type}-content-description`,
                link_url_text: `notification-plus-${type}-url>a`,
                branding_name: `notification-plus-site`,
            };

            for (let [key, target] of Object.entries(textHandlers)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).text($(this).val());
                });
            }

            // srcHandler
            const srcHandler = {
                image: `notification-plus-${type}-image`,
                video: `notification-plus-${type}-video-iframe`,
            };
            for (let [key, target] of Object.entries(srcHandler)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).attr('src', $(this).val());
                });
            }

            //border radius handler
            const borderRadiusHandler = {border_radius: `notification-plus-wrapper`};
            for (let [key, target] of Object.entries(borderRadiusHandler)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).removeClass("notification-plus-wrapper-round notification-plus-wrapper-rounded  notification-plus-wrapper-straight").addClass(`notification-plus-wrapper-${$(this).val()}`);
                });
            }

            //placeholder handler
            const placeHolderHandler = {
                email_placeholder: `notification-plus-${type}-email-placeholder`,
                input_placeholder: `notification-plus-${type}-input-placeholder`,
            };
            for (let [key, target] of Object.entries(placeHolderHandler)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).attr('placeholder', $(this).val());
                });
            }

            //toggle handler
            const toggleHandler = {
                show_agreement: `notification-plus-agreement-checkbox`,
                display_branding: `notification-plus-site`,
                display_close_button: `notification-plus-close`,
                show_angry: `notification-plus-${type}-angry`,
                show_sad: `notification-plus-${type}-sad`,
                show_neutral: `notification-plus-${type}-neutral`,
                show_happy: `notification-plus-${type}-happy`,
                show_excited: `notification-plus-${type}-excited`,
                share_facebook: `notification-plus-${type}-button-facebook`,
                share_twitter: `notification-plus-${type}-button-twitter`,
                share_linkedin: `notification-plus-${type}-button-linkedin`,
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

            const target = localStorage.getItem('notificationPlusActiveTab');
            const prev = $('.notification-plus-prev');
            const next = $('.notification-plus-next');
            const next_prev = $('.notification-plus-next, .notification-plus-prev');

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

            if ($(this).hasClass('notification-plus-next')) {
                $(`.notification-plus-tab-link[data-target="${target}"]`).parent().next().find('.notification-plus-tab-link').trigger('click');
            }

            if ($(this).hasClass('notification-plus-prev')) {
                $(`.notification-plus-tab-link[data-target="${target}"]`).parent().prev().find('.notification-plus-tab-link').trigger('click');
            }

        },

        initSelect2: () => {
            $('#settings_trigger_locations').select2({
                placeholder: notificationPlus.i18n.select_locations,
            });

            $(document).on('focus', '.notification-plus-form-group :input', function () {
                $(this).attr('autocomplete', 'new-password');
            });
        },

        initMetaTabs: () => {
            if ($('#auto_draft').length) return;

            let target = localStorage.getItem('notificationPlusActiveTab');

            if (target) {
                $('.notification-plus-tab-content-item').removeClass('active');
                $(`.notification-plus-meta-tabs .notification-plus-tab-link[data-target=${target}]`).addClass('active').parent().prevAll('.notification-plus-tab-item').find('.notification-plus-tab-link').addClass('active');
                $(`#${target}`).addClass('active');
            }

        },

        initVolumeSlider: () => {
            const handle = $("#notification-plus-volume-handle");

            $("#notification-plus-volume-slider").slider({
                value: $('#notification-plus-volume-slider').data('value'),
                create: function () {
                    handle.text($(this).slider("value"));
                },

                slide: function (event, ui) {
                    handle.text(ui.value);
                    $('#settings_sound_volume').val(ui.value);
                },

                change: function (event, ui) {
                    const audio = $('#notification-plus-sound');

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

            localStorage.setItem('notificationPlusActiveTab', target);
            $('.notification-plus-meta-tabs .notification-plus-tab-link, .notification-plus-tab-content-item').removeClass('active');

            $(this).addClass('active').parent().prevAll('.notification-plus-tab-item').find('.notification-plus-tab-link').addClass('active');
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

            $('#notification_type').addClass('loading');

            $('.notification-plus-notification-type').removeClass('active').find('input').prop('checked', false);
            $(this).addClass('active').find('input').prop('checked', true);

            $('.notification-preview-content').html($('.preview', $(this)).html());

            const type = $('input', $(this)).val();
            const post_id = $('#post_ID').val();

            wp.ajax.send('notification_plus_update_fields', {
                data: {
                    type,
                    post_id,
                    _wpnonce: notificationPlus._wpnonce
                },

                success: res => {
                    $('.notification-plus-tab-content>div:not(#notification_type)').remove();
                    $('#notification_type').after(res.html);

                },

                complete: () => {
                    app.initSelect2();
                    app.previewHandler();
                    app.initDateTimePicker();
                    $('#notification_type').removeClass('loading');
                    $('.notification-plus-tab-link[data-target="content"]').trigger('click');

                    $([document.documentElement, document.body]).animate({
                        scrollTop: $('#notification_plus_type').offset().top
                    }, 400);

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
            $('#triggers_rules>.notification-plus-input-group:first-child').clone().appendTo('#triggers_rules');

            if ($('#triggers_rules>.notification-plus-input-group').length < 2) {
                $('.notification-plus-btn-delete').hide();
            } else {
                $('.notification-plus-btn-delete').show();
            }
        },

        deleteTrigger: function () {
            $(this).parent().remove();

            if ($('#triggers_rules>.notification-plus-input-group').length < 2) {
                $('.notification-plus-btn-delete').hide();
            } else {
                $('.notification-plus-btn-delete').show();
            }
        },

        handleMedia: function (e) {
            e.preventDefault();

            const image = wp.media({
                title: notificationPlus.i18n.choos_image,
                multiple: false
            }).open()
                .on('select', function () {
                    const uploaded_image = image.state().get('selection').first();
                    const image_url = uploaded_image.toJSON().url;
                    $('.notification-plus-image-preview',).attr('src', image_url).removeClass('hidden');
                    $('#settings_image',).val(image_url).trigger('change');
                    $('.notification-plus-remove-image').removeClass('hidden');
                });
        },

        removeImage: function (e) {
            e.preventDefault();
            $('.notification-plus-image-preview',).attr('src', '').addClass('hidden');
            $('#settings_image',).val('').trigger('change');
            $('.notification-plus-remove-image').addClass('hidden');
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