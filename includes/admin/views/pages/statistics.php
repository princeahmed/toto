<div class="wrap">
    <h1 class="wp-heading-inline">Notification Statistics</h1>

	<?php
	include TOTO_INCLUDES . '/admin/views/pages/filter-bar.php';
	?>

    <div class="statistics-summary-wrap">

        <div class="statistics-summary">
            <div class="summary-icon">
                <img src="http://localhost/toto/wp-content/plugins/notificationx/admin/assets/img/views-icon.png" alt="">
            </div>
            <div class="summary-info">
                <span class="summary-number">15</span> <span class="summary-title">Impressions</span>
            </div>
        </div>

        <div class="statistics-summary">
            <div class="summary-icon">
                <img src="http://localhost/toto/wp-content/plugins/notificationx/admin/assets/img/views-icon.png" alt="">
            </div>
            <div class="summary-info">
                <span class="summary-number">15</span> <span class="summary-title">Impressions</span>
            </div>
        </div>

        <div class="statistics-summary">
			<?php
			$notification_type = 'INFORMATIONAL';
			$is_data_supports  = Toto_Notifications::is_data_supports( $notification_type );

			if ( $is_data_supports ) { ?>
                <div class="summary-icon">
                    <img src="http://localhost/toto/wp-content/plugins/notificationx/admin/assets/img/views-icon.png" alt="">
                </div>
                <div class="summary-info">
                    <span class="summary-number">15</span> <span class="summary-title">Submissions</span>
                </div>
			<?php } else { ?>
                <div class="summary-icon">
                    <img src="http://localhost/toto/wp-content/plugins/notificationx/admin/assets/img/views-icon.png" alt="">
                </div>
                <div class="summary-info">
                    <span class="summary-number">15</span> <span class="summary-title">Clicks</span>
                </div>
			<?php } ?>
        </div>

    </div>

    <div class="toto-notification-statistics">
        <div class="chart-container">
            <canvas id="impressions_chart"></canvas>
        </div>

        <div class="chart-container">
            <canvas id="hovers_chart"></canvas>
        </div>


        <div class="chart-container">
            <canvas id="click_submissions_chart"></canvas>
        </div>

    </div>

    <div class="statistics-top-pages">
        <h3 class="top-pages-title">Top Pages</h3>
        <p class="top-pages-description description">Most active pages on which notifications had most activity.</p>

        <table class="widefat" id="top-pages-table">
            <thead>
            <tr>
                <th>#</th>
                <th>URL</th>
                <th>Type</th>
                <th>Uniques</th>
                <th>Sessions</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>1</td>
                <td>https://localhost</td>
                <td>Click</td>
                <td>1</td>
                <td>7</td>
            </tr>
            <tr>
                <td>1</td>
                <td>https://google.com</td>
                <td>Click</td>
                <td>1</td>
                <td>7</td>
            </tr>
            </tbody>

        </table>

        <button id="toto_show_more_pages" type="submit" class="toto-btn toto-btn-primary">Show More</button>

    </div>

</div>

<script>

    const $ = jQuery;

    const number_format = (number, decimals, dec_point = '.', thousands_point = ',') => {

        if (number == null || !isFinite(number)) {
            throw new TypeError('number is not valid');
        }

        if (!decimals) {
            let len = number.toString().split('.').length;
            decimals = len > 1 ? len : 0;
        }

        number = parseFloat(number).toFixed(decimals);

        number = number.replace('.', dec_point);

        let splitNum = number.split(dec_point);
        splitNum[0] = splitNum[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_point);
        number = splitNum.join(dec_point);

        return number;
    };

    const nr = (number, decimals = 0) => {

        let decimal_point = $('[name="number_decimal_point"]').val();
        let thousands_separator = $('[name="number_thousands_separator"]').val();

        return number_format(number, decimals, decimal_point, thousands_separator);
    };

    /* Charts */
    Chart.defaults.global.elements.line.borderWidth = 4;
    Chart.defaults.global.elements.point.radius = 3;
    Chart.defaults.global.elements.point.borderWidth = 7;

    let impressions_chart = document.getElementById('impressions_chart').getContext('2d');

    let gradient = impressions_chart.createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(43, 227, 155, 0.6)');
    gradient.addColorStop(1, 'rgba(43, 227, 155, 0.05)');

    new Chart(impressions_chart, {
        type: 'line',
        data: {
            labels: ["2020-04-04", "2020-04-05", "2020-04-06", "2020-04-07", "2020-04-08"], //todo change labels
            datasets: [{
                data: ["1", "2", "43", "32", "5"],
                backgroundColor: gradient,
                borderColor: '#2BE39B',
                fill: true
            }]
        },
        options: {
            tooltips: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: (tooltipItem, data) => {
                        let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

                        return nr(value);
                    }
                }
            },
            title: {
                display: true,
                text: 'Title' //todo change title
            },
            legend: {
                display: false
            },
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        userCallback: (value, index, values) => {
                            if (Math.floor(value) === value) {
                                return nr(value);
                            }
                        }
                    },
                    min: 0
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        }
    });


    let hovers_chart = document.getElementById('hovers_chart').getContext('2d');

    gradient = hovers_chart.createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(62, 193, 255, 0.6)');
    gradient.addColorStop(1, 'rgba(62, 193, 255, 0.05)');

    new Chart(hovers_chart, {
        type: 'line',
        data: {
            labels: ["2020-04-04", "2020-04-05"],
            datasets: [{
                data: ["1", "1"],
                backgroundColor: gradient,
                borderColor: '#3ec1ff',
                fill: true
            }]
        },
        options: {
            tooltips: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: (tooltipItem, data) => {
                        let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

                        return nr(value);
                    }
                }
            },
            title: {
                display: true,
                text: 'Hovers'
            },
            legend: {
                display: false
            },
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        userCallback: (value, index, values) => {
                            if (Math.floor(value) === value) {
                                return nr(value);
                            }
                        }
                    },
                    min: 0
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        }
    });


    let form_submissions_chart = document.getElementById('click_submissions_chart').getContext('2d');

    gradient = form_submissions_chart.createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(150, 192, 61, 0.4)');
    gradient.addColorStop(1, 'rgba(150, 192, 61, 0.05)');

    new Chart(form_submissions_chart, {
        type: 'line',
        data: {
            labels: ['hello', 'world', 'quite'], //todo
            datasets: [{
                data: ['1', '2', '3'],
                backgroundColor: gradient,
                borderColor: '#96c03d',
                fill: true
            }]
        },
        options: {
            tooltips: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: (tooltipItem, data) => {
                        let value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

                        return nr(value);
                    }
                }
            },
            title: {
                display: true,
                text: 'Click/ Submission',
            },
            legend: {
                display: false
            },
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        userCallback: (value, index, values) => {
                            if (Math.floor(value) === value) {
                                return nr(value);
                            }
                        }
                    },
                    min: 0
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        }
    });

</script>