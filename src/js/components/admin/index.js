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
            const ph = $('.ph-item', modal);

            modal.removeClass('toto-hidden');
            ph.removeClass('toto-hidden');

            wp.ajax.send('toto_notification_preview', {
                data: {
                    post_id: postId,
                },

                success: res => {

                    const header = `Type: ${res.type}`;

                    $('.toto-modal-header h2', modal).html(header);
                    $('.modal-body-content', modal).html(res.html);

                },

                complete: () => ph.addClass('toto-hidden'),

                error: error => console.log(error)
            })
            ;

        });

        //hide notification preview on .close click
        $(document).on('click', '.toto-modal-close', function () {
            const modal = $(this).parents('.toto-modal');
            modal.addClass('toto-hidden');
            $('.modal-body-content', modal).html('');
            $('.toto-modal-header h2', modal).html('');
            $('.ph-item', modal).removeClass('toto-hidden')
        });

        //hide notification preview on out click
        $('.toto-modal').not('.toto-modal-content').on('click', function (e) {
            if (e.target !== this) {
                return;
            }

            const modal = $(this);
            modal.addClass('toto-hidden');
            $('.modal-body-content', modal).html('');
            $('.toto-modal-header h2', modal).html('');
            $('.ph-item', modal).removeClass('toto-hidden')
        });

    });
})(jQuery);