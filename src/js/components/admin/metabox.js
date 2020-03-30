;(function ($) {
    const app = {
        init: () => {
            $(document).on('click', '.toto-meta-tabs .toto-tab-link', app.toggleNotificationTab);
            $(document).on('click', '.toto-notification-type', app.selectType);
            $(document).on('change', '#settings_trigger_all_pages', app.toggleTriggerContent);
            $(document).on('click', '#trigger_add', app.addTrigger);
            $(document).on('click', '.toto-btn-delete', app.deleteTrigger);
        },

        toggleNotificationTab: function (e) {
            e.preventDefault();

            $('.toto-meta-tabs .toto-tab-link, .toto-tab-content-item').removeClass('active');
            $(this).addClass('active');
            $(this).parent().prevAll('.toto-tab-item').find('.toto-tab-link').addClass('active');
            $(`#${$(this).data('target')}`).addClass('active');
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
                    _wpnonce: toto._wpnonce
                },

                success: res => {

                    $('.toto-meta-tabs').replaceWith(res.html.menu);

                    $('.toto-tab-content-item:not(#notification_type)').remove();
                    $('#notification_type').after(res.html.content);

                },

                error: error => console.log(error)
            })
        },

        toggleTriggerContent: function () {
            $('.btn-trigger-add').toggle();
            $('#triggers_rules').toggleClass('container-disabled');
        },

        addTrigger: () => {
            $('#triggers_rules>.toto-input-group:first-child').clone().appendTo('#triggers_rules');

            if ($('#triggers_rules>.toto-input-group').length < 2) {
                $('.toto-btn-delete').hide();
            }else{
                $('.toto-btn-delete').show();
            }
        },

        deleteTrigger: function () {
            $(this).parent().remove();

            if ($('#triggers_rules>.toto-input-group').length < 2) {
                $('.toto-btn-delete').hide();
            }else{
                $('.toto-btn-delete').show();
            }
        }

    };

    $(document).ready(app.init)

})(jQuery);