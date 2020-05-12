;(function ($) {
    $(document).ready(function () {
        $(document).on('click', '.trust-plus-switcher', function () {

            const checkbox = $(this).find('input[type=checkbox]');

            if ($(this).hasClass('module-is-pro')) {
                // Swal.fire({
                //     title: flexi.i18n.goPro,
                //     text: flexi.i18n.proMsg,
                //     type: 'info',
                //     timer: 5000,
                //     showConfirmButton: false,
                //     showCancelButton: true,
                //     cancelButtonColor: '#dc3545',
                // });
            }
            else {
                checkbox.attr('checked', !checkbox.attr('checked'))
            }

        });
    });
})(jQuery);