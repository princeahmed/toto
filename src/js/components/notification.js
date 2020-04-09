import Notification from "./class-notification";

;(function ($) {
    $.toto = {
        init: () => {

        },

        get_location: () => {

            /* Return the ip from session store if any */
            const savedLocation = sessionStorage.getItem('user_location');
            if (savedLocation && savedLocation !== '') {
                return savedLocation;
            } else {
                let xmlHttp = new XMLHttpRequest();
                xmlHttp.open('GET', `https://www.iplocate.io/api/lookup/${toto.userIp}`, false);
                xmlHttp.send(null);

                /* Try and get details from the response */
                try {
                    let response = JSON.parse(xmlHttp.responseText);

                    let user_location = JSON.stringify({
                        city: response.city,
                        country: response.country,
                        country_code: response.country_code
                    });

                    /* Set it to the session storage to avoid multiple requests to this website */
                    sessionStorage.setItem('user_location', user_location);

                    return user_location;

                } catch (error) {
                    return false;
                }

            }

        },

        send_submission_data: params => {

            wp.ajax.send('toto_save_data', {
                data: {data: params},

                success: (res) => {
                    console.log(res);
                },

                error: (error) => {
                    console.log(error);
                }

            });

        },

        send_statistics_data: params => {

            wp.ajax.send('toto_save_statistics', {
                data: {data: params},

                success: (res) => {
                    console.log(res);
                },

                error: (error) => {
                    console.log(error);
                }

            });

        },

        user: () => {
            return {
                /* Get user IP */
                ip: toto.userIp,

                /* Location data */
                location: $.toto.get_location(),

                /* Current accessed page */
                current_page: encodeURIComponent(window.location.href)
            }
        },

        get_scroll_percentage: () => {
            let h = document.documentElement;
            let b = document.body;
            let st = 'scrollTop';
            let sh = 'scrollHeight';

            return (h[st] || b[st]) / ((h[sh] || b[sh]) - h.clientHeight) * 100;
        },

        notification: Notification,

    };

    $(document).ready($.toto.init);
})(jQuery);