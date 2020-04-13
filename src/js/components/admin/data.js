;(function ($) {
    $(document).ready(function () {
        $(document).on('click', '.data-details', tooglePanelBody);
        $(document).on('click', '.panel-body-collapse', tooglePanelBody);

        $('.toto_date_field').datepicker();

        function tooglePanelBody(e) {
            e.preventDefault();

            const parent = $(this).parents('.toto-panel');

            $('.toto-panel-body', parent).toggleClass('toto-hidden');
            $('.panel-body-collapse i', parent).toggleClass('dashicons-arrow-down-alt2 dashicons-arrow-up-alt2');
            $('.data-details i', parent).toggleClass('dashicons-plus-alt dashicons-minus');
        }


    });
})(jQuery);