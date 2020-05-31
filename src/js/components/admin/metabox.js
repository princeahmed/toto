;(function ($) {
    const app = {
        init: () => {
            app.initMetaTabs();
            app.initSelect2();
            app.initVolumeSlider();
            app.handlePrevNext();
            app.previewHandler();
            app.initDateTimePicker();
            app.handleConversion();

            $(document).on('click', '.notification-plus-meta-tabs .notification-plus-tab-link', app.toggleNotificationTab);
            $(document).on('click', '.notification-plus-notification-type', app.selectType);
            $(document).on('click', '.notification-plus-notification-source', app.selectSource);
            $(document).on('click', '#trigger_add', app.addTrigger);
            $(document).on('click', '.notification-plus-btn-delete', app.deleteTrigger);
            $(document).on('click', '.notification-plus-choose-image', app.handleMedia);
            $(document).on('click', '.notification-plus-remove-image', app.removeImage);
            $(document).on('click', '.notification-plus-next, .notification-plus-prev', app.handlePrevNext);

            $(document).on('change', '#settings_trigger_all_pages', app.toggleTriggerContent);
            $(document).on('change', '#settings_data_send_is_enabled', app.toggleDataSendContent);
            $(document).on('change', '[name="settings[trigger_on]"]', app.toggleLocationsField);
            $(document).on('change', '#settings_display_trigger', app.displayTriggerSelect);
            $(document).on('change', '#settings_notification_sound', app.playSound);
            $(document).on('change', '#settings_trigger_locations', app.toggleCustomIds);
            $(document).on('change', '.handle-toggle', app.handleToggle);
            $(document).on('change', '.settings_image_type', app.toggleRecentSalesImage);
            $(document).on('change', '.settings_url_type', app.toggleRecentSalesUrl);
            $(document).on('change', '.settings_product_type', app.toggleRecentSalesProduct);
            $(document).on('click', ".notification-plus-notification-source", app.handleSource);

        },

        handleSource: function () {
            const val = $('input', $(this)).val();

            if ('custom' === val) {
                $('.content_custom').removeClass('hidden');
                $('.content_woocommerce').addClass('hidden');
                $('.content_edd').addClass('hidden');
            } else if ('woocommerce' === val) {
                $('.content_woocommerce').removeClass('hidden');
                $('.content_custom').addClass('hidden');
                $('.content_edd').addClass('hidden');
            } else if ('edd' === val) {
                $('.content_edd').removeClass('hidden');
                $('.content_woocommerce').addClass('hidden');
                $('.content_custom').addClass('hidden');
            }
        },

        handleConversion: () => {

            //new conversion
            $(document).on('click', '.conversion_new', function (e) {
                e.stopPropagation();
                e.stopImmediatePropagation();

                $('.conversion-group-body').addClass('hidden');

                const p = $(this).parents('.conversion-group');
                const elem = p.nextAll('.conversion-group');
                increaseIndex(elem);

                const count = parseInt($('.conversion-count', p).text());

                const data = {
                    index: count,
                    count: (count + 1),
                };
                const conversion = wp.template('load-conversion');
                $(this).parents('.conversion-group').after(conversion(data));

                app.initDateTimePicker();
                hideDelete();
            });

            //duplicate conversion
            $(document).on('click', '.conversion_copy', function (e) {
                e.stopPropagation();
                e.stopImmediatePropagation();

                const p = $(this).parents('.conversion-group');
                const conversion = p.clone();

                $('.conversion-group-body').addClass('hidden');

                const count = parseInt($('.conversion-count', p).text());

                $('input', $(conversion)).each(function () {
                    const prev_name = $(this).attr('name');
                    const new_name = prev_name.replace(/\[(\d+)\]/, `[${count}]`);

                    $(this).attr('name', new_name);
                });

                $('.conversion-count', $(conversion)).html(count + 1);

                const elem = p.nextAll('.conversion-group');
                increaseIndex(elem);

                $('.notification-plus-date-time-picker', $(conversion)).removeClass('hasDatepicker').removeAttr('id');

                p.after(conversion);
                hideDelete();
                app.initDateTimePicker();

            });

            //toggle
            $(document).on('click', '.conversion-group-header, .conversion_edit', function (e) {
                e.stopPropagation();
                e.stopImmediatePropagation();

                $('.conversion-group-body', $(this).parents('.conversion-group')).toggleClass('hidden');
            });

            //remove
            $(document).on('click', '.conversion_delete', function (e) {
                e.stopPropagation();
                e.stopImmediatePropagation();

                const p = $(this).parents('.conversion-group');
                const elem = p.nextAll('.conversion-group');
                decreaseIndex(elem);


                $(this).parents('.conversion-group').remove();
                hideDelete();

            });


            function increaseIndex(elem) {

                elem.each(function () {
                    const count = parseInt($('.conversion-count', $(this)).text());

                    $('input', $(this)).each(function () {
                        const prev_name = $(this).attr('name');
                        const new_name = prev_name.replace(/\[(\d+)\]/, `[${count}]`);

                        $(this).attr('name', new_name);
                    });

                    $('.conversion-count', $(this)).html(count + 1);
                });
            }

            function decreaseIndex(elem) {

                elem.each(function () {
                    const count = parseInt($('.conversion-count', $(this)).text());

                    $('input', $(this)).each(function () {
                        const prev_name = $(this).attr('name');
                        const new_name = prev_name.replace(/\[(\d+)\]/, `[${(count - 1)}]`);

                        $(this).attr('name', new_name);
                    });

                    $('.conversion-count', $(this)).html(count - 1);
                });
            }

            function hideDelete() {
                $('.conversion-group:first-child .conversion_delete').addClass('hidden');
                $('.conversion-group:not(:first-child) .conversion_delete').removeClass('hidden');
            }

        },

        toggleRecentSalesImage: function () {
            if ('custom' === $(this).val()) {
                $(this).parent().next().removeClass('hidden');
            } else {
                $(this).parent().next().addClass('hidden');
            }
        },

        toggleRecentSalesUrl: function () {
            if ('custom' === $(this).val()) {
                $(this).parent().next().removeClass('hidden');
            } else {
                $(this).parent().next().addClass('hidden');
            }
        },

        toggleRecentSalesProduct: function () {
            $('.settings_product, .settings_category').parent().addClass('hidden');

            if ('product' === $(this).val()) {
                $('.settings_product').parent().removeClass('hidden');
            } else if ('category' === $(this).val()) {
                $('.settings_category').parent().removeClass('hidden');
            }
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
                recent_sales_who: `notification-plus-${type}-title`,
                recent_sales_text: `notification-plus-${type}-description`,
            };

            for (let [key, target] of Object.entries(textHandlers)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).text($(this).val());
                });
            }

            // srcHandler
            const srcHandler = {
                image: `notification-plus-${type}-image`,
                recent_sales_image: `notification-plus-${type}-image`,
                video: `notification-plus-${type}-video-iframe`,
            };
            for (let [key, target] of Object.entries(srcHandler)) {
                $(`#settings_${key}`).on('change paste keyup', function () {
                    $(`#notification_preview .${target}`).removeClass('hidden').attr('src', $(this).val());
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

            //add loading class
            $('#notification_plus_type').addClass('loading');

            //scroll to top
            $([document.documentElement, document.body]).animate({
                scrollTop: $('#notification_plus_type').offset().top - 50
            }, 400);

            //set preview html
            $('.notification-preview-content').html($('.preview', $(this)).html());

            //set preview title
            const title = $('.notification-plus-notification-type-title', $(this)).text();
            $('.notification-preview-title-type').text(title);

            //check if accessing pro item from free
            if ($(this).hasClass('item-is-pro')) {
                Swal.fire({
                    title: notificationPlus.i18n.pro_msg,
                    //text: notificationPlus.i18n.proMsg,
                    icon: 'info',
                    timer: 5000,
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#dc3545',
                    customClass: {
                        container: 'notification-plus-swal',
                    },
                    onClose: () => {
                        $('.notification-plus-tab-item:not(:first-child)').addClass('container-disabled');

                        $('#notification_type').removeClass('loading');

                        $([document.documentElement, document.body]).animate({
                            scrollTop: $('#notification_plus_type').offset().top
                        }, 400);
                    },
                });

                return;
            }

            $('.notification-plus-tab-item:not(:first-child)').removeClass('container-disabled');

            // checked the clicked type
            $('.notification-plus-notification-type').removeClass('active').find('input').prop('checked', false);
            $(this).addClass('active').find('input').prop('checked', true);

            const type = $('input', $(this)).val();
            const post_id = $('#post_ID').val();

            wp.ajax.send('notification_plus_update_fields', {
                data: {
                    type,
                    post_id,
                    _wpnonce: notificationPlus._wpnonce
                },

                success: res => {
                    $('.notification-plus-meta-tabs').replaceWith(res.menu);

                    $('.notification-plus-tab-content>div:not(#notification_type)').remove();
                    $('#notification_type').after(res.content);

                },

                complete: () => {
                    app.initSelect2();
                    app.previewHandler();
                    app.initDateTimePicker();
                    app.initVolumeSlider();

                    $('.notification-plus-tab-item:nth-child(2) .notification-plus-tab-link').trigger('click');
                    $('#notification_plus_type').removeClass('loading');

                },

                error: error => console.log(error)
            });

        },

        selectSource: function () {

            const message = $(this).data('message');

            //check if source is setup or not
            if ($(this).hasClass('need_setup')) {
                Swal.fire({
                    //title: message,
                    text: message,
                    icon: 'info',
                    showConfirmButton: false,
                    showCancelButton: true,
                    cancelButtonColor: '#dc3545',
                    customClass: {
                        container: 'notification-plus-swal',
                    },
                });

                return;
            }

            $('#notification_plus_type').addClass('loading');

            // checked the clicked type
            $('.notification-plus-notification-source').removeClass('active').find('input').prop('checked', false);
            $(this).addClass('active').find('input').prop('checked', true);

            setTimeout(function () {
                $('.notification-plus-tab-item:nth-child(3) .notification-plus-tab-link').trigger('click');
                $('#notification_plus_type').removeClass('loading');
            }, 500);
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

            const p = $(this).parents('.conversion-group');

            const image = wp.media({
                title: notificationPlus.i18n.choos_image,
                multiple: false
            }).open()
                .on('select', function () {
                    const uploaded_image = image.state().get('selection').first();
                    const image_url = uploaded_image.toJSON().url;
                    $('.notification-plus-image-preview', p).attr('src', image_url).removeClass('hidden');
                    $('.notification-plus-image', p).val(image_url).trigger('change');
                    $('.notification-plus-remove-image', p).removeClass('hidden');
                });
        },

        removeImage: function (e) {
            e.preventDefault();
            const p = $(this).parents('.conversion-group');

            $('.notification-plus-image-preview', p).attr('src', '').addClass('hidden');
            $('#settings_image', p).val('').trigger('change');
            $('.notification-plus-remove-image', p).addClass('hidden');
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