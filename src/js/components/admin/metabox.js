;(function ($) {
    const app = {
        init: () => {
            $(document).on('click', '.toto-notification-type', app.toggleNotificationTab)
        },

        toggleNotificationTab: function () {
            $('.toto-notification-type').removeClass('active').find('input').prop('checked', false);
            $(this).addClass('active').find('input').prop('checked', true);

            app.updateMenu(this);

        },

        updateMenu: ($this) => {

            wp.ajax.send('update_menu', {
                data: {
                    type: $('input', $this).val(),
                    _wpnonce: toto._wpnonce
                },

                success: res => {
                    $('.toto-meta-tabs').replaceWith(res.html)
                },

                error: error => console.log(error)
            })
        }

    };

    $(document).ready(app.init)

})(jQuery);