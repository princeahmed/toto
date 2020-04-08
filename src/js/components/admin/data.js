;(function ($) {
    $(document).ready(function () {
        $(document).on('click', '.data-details', function (e) {
            e.preventDefault();

            const parent = $(this).parents('.toto-panel');

            $('.toto-panel-body', parent).toggleClass('toto-hidden');
        });
    });
})(jQuery);