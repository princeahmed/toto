import Notification from "./class-notification";

;(function ($) {
    $.toto = {
        init: () => {
            $('.toto').each((i, el) => {
                const config = $(el).data('config');

                let callbacks = {};
                if (config.notification_type in $.toto.callbacks()) {
                    callbacks = $.toto.callbacks()[config.notification_type];

                }

                new $.toto.notification({
                    ...config
                }).initiate(callbacks);

            });
        },

        get_location: () => {

            /* Return the ip from session store if any */
            const savedLocation = localStorage.getItem('user_location');
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
                    localStorage.setItem('user_location', user_location);

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
                },

                error: (error) => console.log(error)

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

        callbacks: () => ({
            COUPON: {
                displayed: main_element => {

                    /* On click the footer remove element */
                    main_element.querySelector('.toto-coupon-footer').addEventListener('click', event => {

                        $.toto.notification.remove_notification(main_element);

                        event.preventDefault();

                    });

                    /* On click event to the button */
                    main_element.querySelector('.toto-coupon-button').addEventListener('click', event => {

                        let notification_id = main_element.getAttribute('data-notification-id');

                        $.toto.send_statistics_data({
                            ...$.toto.user(),
                            notification_id: notification_id,
                            type: 'click',
                        });

                    });

                }
            },

            EMAIL_COLLECTOR: {
                displayed: main_element => {

                    /* Form submission */
                    main_element.querySelector('#toto-email-collector-form').addEventListener('submit', event => {

                        let email = event.currentTarget.querySelector('[name="email"]').value;
                        let notification_id = main_element.getAttribute('data-notification-id');

                        if (email.trim() !== '') {

                            /* Data collection from the form */
                            $.toto.send_statistics_data({
                                ...$.toto.user(),
                                notification_id,
                                type: 'submissions',
                                data: email
                            });

                            $.toto.notification.remove_notification(main_element);

                            /* Make sure to let the browser know of the conversion so that it is not shown again */
                            localStorage.setItem(`notification_${notification_id}_converted`, true);

                        }

                        event.preventDefault();
                    });

                }
            },

            VIDEO: {
                displayed: main_element => {

                    /* On click event to the button */
                    main_element.querySelector('.toto-video-button').addEventListener('click', event => {

                        let notification_id = main_element.getAttribute('data-notification-id');

                        $.toto.send_statistics_data({
                            ...$.toto.user(),
                            notification_id,
                            type: 'click',
                        });

                    });

                }
            },

            SOCIAL_SHARE: {
                displayed: main_element => {

                    /* On click event to the button */
                    main_element.querySelector('.toto-social-share-button').addEventListener('click', event => {

                        let notification_id = main_element.getAttribute('data-notification-id');

                        $.toto.send_statistics_data({
                            ...$.toto.user(),
                            notification_id,
                            type: 'click',
                        });

                    });

                }
            },

            EMOJI_FEEDBACK: {
                displayed: main_element => {

                    /* On click event to the button */
                    let emojis = main_element.querySelectorAll('.toto-emoji-feedback-emoji');

                    for (let emoji of emojis) {
                        emoji.addEventListener('click', event => {

                            /* Trigger the animation */
                            emoji.className += ' toto-emoji-feedback-emoji-clicked';

                            /* Get all the other emojis and remove them */
                            let other_emojis = main_element.querySelectorAll('.toto-emoji-feedback-emoji:not(.toto-emoji-feedback-emoji-clicked)');
                            for (let other_emoji of other_emojis) {
                                other_emoji.remove();
                            }

                            let notification_id = main_element.getAttribute('data-notification-id');
                            let feedback = emoji.getAttribute('data-type');

                            $.toto.send_statistics_data({
                                ...$.toto.user(),
                                notification_id,
                                type: `feedback_emoji_${feedback}`,
                            });

                            /* Make sure to let the browser know of the conversion so that it is not shown again */
                            localStorage.setItem(`notification_${notification_id}_converted`, true);

                            setTimeout(() => {
                                $.toto.notification.remove_notification(main_element);
                            }, 950);

                        });
                    }


                }
            },

            COOKIE_NOTIFICATION: {
                displayed: main_element => {

                    /* On click the footer remove element */
                    main_element.querySelector('.toto-cookie-notification-button').addEventListener('click', event => {

                        const notification_id = main_element.getAttribute('data-notification-id');
                        $.toto.remove_notification(main_element);

                        /* Make sure to let the browser know of the conversion so that it is not shown again */
                        localStorage.setItem(`notification_${notification_id}_converted`, true);

                        event.preventDefault();

                    });

                }
            },

            SCORE_FEEDBACK: {
                displayed: main_element => {

                    /* On click event to the button */
                    let scores = main_element.querySelectorAll('.toto-score-feedback-button');

                    for (let score of scores) {
                        score.addEventListener('click', event => {

                            /* Trigger the animation */
                            score.className += ' toto-score-feedback-button-clicked';

                            /* Get all the other emojis and remove them */
                            let other_scores = main_element.querySelectorAll('.toto-score-feedback-button:not(.toto-score-feedback-button-clicked)');
                            for (let other_score of other_scores) {
                                other_score.remove();
                            }

                            const notification_id = main_element.getAttribute('data-notification-id');
                            const feedback = score.getAttribute('data-score');

                            $.toto.send_statistics_data({
                                ...$.toto.user(),
                                notification_id,
                                type: `feedback_score_${feedback}`,
                            });

                            /* Make sure to let the browser know of the conversion so that it is not shown again */
                            localStorage.setItem(`notification_${notification_id}_converted`, true);

                            setTimeout(() => {
                                $.toto.remove_notification(main_element);
                            }, 950);

                        });
                    }


                }
            },

            REQUEST_COLLECTOR: {
                displayed: main_element => {

                    /* Form submission */
                    main_element.querySelector('#toto-request-collector-form').addEventListener('submit', event => {

                        let input = event.currentTarget.querySelector('[name="input"]').value;
                        let notification_id = main_element.getAttribute('data-notification-id');


                        if (input.trim() !== '') {

                            /* Data collection from the form */
                            $.toto.send_statistics_data({
                                ...$.toto.user(),
                                notification_id,
                                type: 'collector',
                                data: input
                            });

                            $.toto.remove_notification(main_element);

                            /* Make sure to let the browser know of the conversion so that it is not shown again */
                            localStorage.setItem(`notification_${notification_id}_converted`, true);

                        }

                        event.preventDefault();
                    });

                }
            },

            COUNTDOWN_COLLECTOR: {
                displayed: main_element => {

                    /* Countdown */
                    const end_date = new Date(main_element.querySelector('[name="end_date"]').value);

                    const countdown = () => {
                        let days_element = main_element.querySelector('[data-type="days"]');
                        let hours_element = main_element.querySelector('[data-type="hours"]');
                        let minutes_element = main_element.querySelector('[data-type="minutes"]');
                        let seconds_element = main_element.querySelector('[data-type="seconds"]');

                        let days = parseInt(days_element.innerText);
                        let hours = parseInt(hours_element.innerText);
                        let minutes = parseInt(minutes_element.innerText);
                        let seconds = parseInt(seconds_element.innerText);

                        let new_days = days;
                        let new_hours = hours;
                        let new_minutes = minutes;
                        let new_seconds = seconds - 1;

                        if (new_seconds < 0 && new_minutes > 0) {
                            new_seconds = 60;
                            new_minutes--;

                            if (new_minutes < 0 && new_hours > 0) {
                                new_minutes = 60;
                                new_hours--;

                                if (new_hours < 0 && new_days > 0) {
                                    new_hours = 60;
                                    new_days--;

                                    if (new_days < 0) {
                                        new_days = 0;
                                    }
                                }
                            }
                        }

                        /* Check if the timer is up */
                        if (days === 0 && hours === 0 && minutes === 0 && seconds === 0) {
                            clearInterval(countdown_interval);

                            $.toto.remove_notification(main_element);
                        }

                        /* Set the new values */
                        days_element.innerText = new_days;
                        hours_element.innerText = new_hours;
                        minutes_element.innerText = new_minutes;
                        seconds_element.innerText = new_seconds;
                    };

                    const countdown_interval = setInterval(countdown, 1000);

                    /* Form submission */
                    main_element.querySelector('#toto-countdown-collector-form').addEventListener('submit', event => {

                        let input = event.currentTarget.querySelector('[name="input"]').value;
                        let notification_id = main_element.getAttribute('data-notification-id');


                        if (input.trim() !== '') {

                            /* Data collection from the form */
                            $.toto.send_statistics_data({
                                ...$.toto.user(),
                                notification_id: notification_id,
                                type: 'collector',
                                data: input
                            });

                            $.toto.remove_notification(main_element);

                            /* Make sure to let the browser know of the conversion so that it is not shown again */
                            localStorage.setItem(`notification_${notification_id}_converted`, true);

                        }

                        event.preventDefault();
                    });

                }
            }

        }),

    };

    $(document).ready($.toto.init);
})(jQuery);