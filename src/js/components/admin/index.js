;(function ($) {
    $(document).ready(function () {


        //Change notification status
        $('.column-status .notification-plus-switcher').on('click', function (e) {
            e.preventDefault();
            const ajaxLoader = $('.notification-plus-ajax-loader', $(this).parents('td'));
            ajaxLoader.toggle();

            const input = $('input', $(this));
            const checked = input.is(':checked');
            const status = checked ? 'draft' : 'publish';

            wp.ajax.send('notification_plus_n_status', {
                data: {
                    post_id: input.val(),
                    status,
                },

                success: () => {

                    if (!$('.post-state', $(this).parents('tr')).length) {
                        $('.row-title', $(this).parents('tr')).after(` — <span class="post-state"><span style="color: #a00;">${notificationPlus.i18n.disabled}</span></span>`)
                    }

                    if (checked) {
                        $('.post-state', $(this).parents('tr')).removeClass('hidden');
                    } else {
                        $('.post-state', $(this).parents('tr')).addClass('hidden');
                    }

                    const text = checked ? notificationPlus.i18n.disabled : notificationPlus.i18n.enabled;

                    Swal.fire({
                        icon: 'success',
                        title: notificationPlus.i18n.notification + ' ' + text,
                        timer: 2000,
                        showConfirmButton: false,
                    });
                },

                complete: () => {
                    ajaxLoader.toggle();
                },

                error: error => console.log(error)
            })

        });

        //Modal Preview open
        $('.notification-plus-n-preview').on('click', function (e) {
            e.preventDefault();

            const ajaxLoader = $('.notification-plus-ajax-loader', $(this).parents('td'));
            ajaxLoader.toggle();

            const postId = $(this).data('post_id');

            wp.ajax.send('notification_plus_preview', {
                data: {
                    post_id: postId,
                },

                success: res => {


                    const header = `Type: ${res.type}`;

                    Swal.fire({
                        html: res.html,
                        showCloseButton: true,
                        showConfirmButton: false,
                    });

                },

                complete: () => ajaxLoader.toggle(),

                error: error => console.log(error)
            })
            ;

        });


        //Copy to clipboard
        $(document).on('click', '.notification-plus-n-shortcode .fa-copy', function (e) {
            e.preventDefault();

            const text = $(this).next().text();

            const $temp = $("<input>");
            $("body").append($temp);
            $temp.val(text).select();
            document.execCommand("copy");
            $temp.remove();

            Swal.fire({
                icon: 'success',
                title: notificationPlus.i18n.copied,
                text,
                timer: 2000,
                showConfirmButton: false,
            });

        });


    });
})(jQuery);