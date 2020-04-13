;(function ($) {
    $(document).ready(function () {

        //Change notification status
        $('.column-status .toto-switcher').on('click', function () {
            const input = $('input', $(this));
            const checked = input.is(':checked');

            wp.ajax.send('toto_n_status', {
                data: {
                    post_id: input.val(),
                    status: checked ? 'draft' : 'publish',
                },

                error: error => console.log(error)
            })

        });

        //Modal Preview open
        $('.toto-n-preview').on('click', function (e) {
            e.preventDefault();

            const postId = $(this).data('post_id');
            const modal = $('#toto_modal');

            modal.removeClass('toto-hidden');

            wp.ajax.send('toto_notification_preview', {
                data: {
                    post_id: postId,
                },

                success: res => {

                    const header = `<h2>Type: ${res.type}</h2><span class="toto-modal-close">&times;</span>`;

                    $('.toto-modal-header', modal).html(header);
                    $('.toto-modal-body', modal).html(res.html);

                },

                error: error => console.log(error)
            });

        });

        $(document).on('click', '.toto-modal-close', function () {
            $(this).parents('.toto-modal').addClass('toto-hidden');
        });

        $('.toto-modal').not('.toto-modal-content').on('click', function (e) {
            if (e.target !== this) {
                return;
            }
            $('.toto-modal').addClass('toto-hidden');
        });

    });
})(jQuery);