<?php

$notification_id   = 373;
$notification_type = 'EMAIL_COLLECTOR';
$is_data_supports  = Toto_Notifications::is_data_supports( $notification_type );

$log_args = [
	'nid' => $notification_id
];

$logs_chart = toto_get_chart_data( $log_args );

?>

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
                <div class="summary-number"><?php echo $logs_chart['impression_total']; ?></div>
                <div class="summary-title">Impressions</div>
            </div>
        </div>

        <div class="statistics-summary">
            <div class="summary-icon">
                <img src="http://localhost/toto/wp-content/plugins/notificationx/admin/assets/img/views-icon.png" alt="">
            </div>
            <div class="summary-info">
                <div class="summary-number"><?php echo $logs_chart['hover_total']; ?></div>
                <div class="summary-title">Mouse Hovers</div>
            </div>
        </div>

        <div class="statistics-summary">
			<?php

			if ( $is_data_supports ) { ?>
                <div class="summary-icon">
                    <img src="http://localhost/toto/wp-content/plugins/notificationx/admin/assets/img/views-icon.png" alt="">
                </div>
                <div class="summary-info">
                    <div class="summary-number"><?php echo $logs_chart['submissions_total']; ?></div>
                    <div class="summary-title">Submissions</div>
                </div>
			<?php } else { ?>
                <div class="summary-icon">
                    <img src="http://localhost/toto/wp-content/plugins/notificationx/admin/assets/img/views-icon.png" alt="">
                </div>
                <div class="summary-info">
                    <div class="summary-number"><?php echo $logs_chart['click_total']; ?></div>
                    <div class="summary-title">Clicks</div>
                </div>
			<?php } ?>
        </div>

    </div>

    <!--  Statistics Charts  -->
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

		<?php

		$type_labels = [
			'submissions' => 'Submission',
			'hover'       => 'Mouse Hover',
			'impression'  => 'Impression',
			'click'       => 'Click',
		];


		?>

        <div class="top_pages_header">
            <h3 class="top-pages-title">Top Pages</h3>
            <p class="top-pages-description description">Most active pages on which notifications had most activity.</p>
        </div>

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
			<?php

			$top_pages = toto_get_top_pages( $log_args );

			if ( ! empty( $top_pages ) ) {
				$i = 1;
				foreach ( $top_pages as $item ) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><a href="<?php echo $item->url; ?>" target="_blank"><?php echo $item->url; ?></a></td>
                        <td><?php echo $type_labels[ $item->type ]; ?></td>
                        <td><?php echo $item->total_uniques; ?></td>
                        <td><?php echo $item->total_sessions; ?></td>
                    </tr>
					<?php
					$i ++;
				}
			}
			?>
            </tbody>

        </table>

        <button id="toto_show_more_pages" type="submit" class="toto-btn toto-btn-primary">Show More Pages</button>

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
            labels: <?php echo $logs_chart['labels'] ?>,
            datasets: [{
                data: <?php echo $logs_chart['impression'] ?>,
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
                text: 'Impressions'
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
            labels: <?php echo $logs_chart['labels'] ?>,
            datasets: [{
                data: <?php echo $logs_chart['hover'] ?>,
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


    let submissions_chart = document.getElementById('click_submissions_chart').getContext('2d');

    gradient = submissions_chart.createLinearGradient(0, 0, 0, 250);
    gradient.addColorStop(0, 'rgba(150, 192, 61, 0.4)');
    gradient.addColorStop(1, 'rgba(150, 192, 61, 0.05)');

    new Chart(submissions_chart, {
        type: 'line',
        data: {
            labels: <?php echo $logs_chart['labels'] ?>,
            datasets: [{
                data: <?php echo $logs_chart['submissions'] ?>,
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