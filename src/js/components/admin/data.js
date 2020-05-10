;(function ($) {
    $(document).ready(function () {
        $(document).on('click', '.data-details', tooglePanelBody);
        $(document).on('click', '.panel-body-collapse', tooglePanelBody);

        $(document).on('change', '#toto_n_data_filter :input', getData);



        function tooglePanelBody(e) {
            e.preventDefault();

            const parent = $(this).parents('.toto-panel');

            $('.toto-panel-body', parent).toggleClass('hidden');
            $('.panel-body-collapse i', parent).toggleClass('dashicons-arrow-down-alt2 dashicons-arrow-up-alt2');
            $('.data-details i', parent).toggleClass('dashicons-plus-alt dashicons-minus');
        }

        function getData() {
            const p = $(this).parents('#toto_n_data_filter');

            const ph = $('.toto_n_data_ph');

            const nid = $('#notification_id', p).val();
            const start_date = $('#start_date', p).val();
            const end_date = $('#end_date', p).val();
            const per_page = $('#per_page', p).val();
            const page = $('.toto-pagination a.active').data('page');

            const data = {
                nid,
                start_date,
                end_date,
                per_page,
                page
            };

            ph.removeClass('hidden');
            $('.toto_n_data').html('');

            wp.ajax.send('toto_get_data', {
                data,

                success: (res) => {
                    $('.toto_n_data').html(res.html);
                },

                complete: () => {
                    ph.addClass('hidden');
                },

                error: error => console.log(error)

            });

        }


    });
})(jQuery);