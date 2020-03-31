;(function ($) {
    const app = {
        init: () => {
            app.initMetaTabs();

            $(document).on('click', '.toto-meta-tabs .toto-tab-link', app.toggleNotificationTab);
            $(document).on('click', '.toto-notification-type', app.selectType);
            $(document).on('change', '#settings_trigger_all_pages', app.toggleTriggerContent);
            $(document).on('change', '#settings_data_send_is_enabled', app.toggleDataSendContent);
            $(document).on('click', '#trigger_add', app.addTrigger);
            $(document).on('click', '.toto-btn-delete', app.deleteTrigger);
            $(document).on('click', '#settings_show_agreement', app.toggleAgreement);
        },

        initMetaTabs: () => {
            const target = localStorage.getItem('totoActiveTab');

            if (target) {
                $(`.toto-meta-tabs .toto-tab-link[data-target=${target}]`).addClass('active').parent().prevAll('.toto-tab-item').find('.toto-tab-link').addClass('active');
                $(`#${target}`).addClass('active');
            }

        },

        toggleNotificationTab: function (e) {
            e.preventDefault();
            const target = $(this).data('target');

            localStorage.setItem('totoActiveTab', target);

            $('.toto-meta-tabs .toto-tab-link, .toto-tab-content-item').removeClass('active');
            $(this).addClass('active').parent().prevAll('.toto-tab-item').find('.toto-tab-link').addClass('active');
            $(`#${target}`).addClass('active');
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
            $('#agreement').toggle();
        }

    };

    $(document).ready(app.init)

})(jQuery);