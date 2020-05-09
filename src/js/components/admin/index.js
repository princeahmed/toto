;(function ($) {
    $(document).ready(function () {

        //Change notification status
        $('.column-status .toto-switcher').on('click', function () {
            const input = $('input', $(this));
            const checked = input.is(':checked');
            const status = checked ? 'draft' : 'publish'

            wp.ajax.send('toto_n_status', {
                data: {
                    post_id: input.val(),
                    status,
                },

                success: () => {
                    const text = checked ? 'Disabled' : 'Enabled';

                    Swal.fire({
                        icon: 'success',
                        title: 'Notification ' + text,
                        timer: 2000,
                        showConfirmButton: false,
                    });
                },

                error: error => console.log(error)
            })

        });

        //Modal Preview open
        $('.toto-n-preview').on('click', function (e) {
            e.preventDefault();

            const postId = $(this).data('post_id');

            wp.ajax.send('toto_notification_preview', {
                data: {
                    post_id: postId,
                },

                success: res => {

                    const header = `Type: ${res.type}`;

                    Swal.fire({
                        //title: res.type,
                        html: res.html,
                        showCloseButton: true,
                        showConfirmButton: false,
                    });

                },

                error: error => console.log(error)
            })
            ;

        });


        //Copy to clipboard
        $(document).on('click', '.toto-n-shortcode .fa-copy', function (e) {
            e.preventDefault();

            const text = $(this).next().text();

            const $temp = $("<input>");
            $("body").append($temp);
            $temp.val(text).select();
            document.execCommand("copy");
            $temp.remove();

            Swal.fire({
                icon: 'success',
                title: 'Copied to Clipboard.',
                text,
                timer: 2000,
                showConfirmButton: false,
            });

        });


    });
})(jQuery);