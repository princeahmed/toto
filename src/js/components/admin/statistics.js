;(function ($) {

    if (typeof Chart !== 'function') {
        return;
    }

    Chart.defaults.global.elements.line.borderWidth = 4;
    Chart.defaults.global.elements.point.radius = 3;
    Chart.defaults.global.elements.point.borderWidth = 7;

    const app = {
        init: () => {

            $(document).on('change', '#toto_n_statistics_filter :input', app.getData);

            app.initChart();

        },

        getData: function () {

            const p = $(this).parents('#toto_n_statistics_filter');
            const ph = $('.summary-ph-wrap, .chart-ph, .statistics-top-pages tfoot');
            const summaryContent = $('.summary-content');
            const chartContent = $('.chart-content');
            const topPagesContent = $('.statistics-top-pages tbody');

            const nid = $('#notification_id', p).val();
            const start_date = $('#start_date', p).val();
            const end_date = $('#end_date', p).val();

            const data = {
                nid,
                start_date,
                end_date,
            };

            ph.removeClass('toto-hidden');
            summaryContent.html('');
            chartContent.html('');
            topPagesContent.html('');

            wp.ajax.send('toto_get_statistics', {
                data,

                success: (res) => {
                    summaryContent.html(res.summary_html);
                    chartContent.html(res.chart_html);
                    topPagesContent.html(res.top_pages_html);

                    app.initChart();
                },

                complete: () => {
                    ph.addClass('toto-hidden');
                },

                error: error => console.log(error)

            });

        },

        initChart: () => {
            const charts = [
                'impression',
                'hover',
                'click',
                'submissions',
            ];

            charts.forEach(key => app.chartConfig(key));
        },

        chartConfig: (key) => {

            const el = $(`#${key}_chart`);

            if (!el.length) {
                return;
            }

            const colors = {
                impression: ['rgba(43, 227, 155, 0.6)', 'rgba(43, 227, 155, 0.05)', '#2BE39B'],
                hover: ['rgba(62, 193, 255, 0.6)', 'rgba(62, 193, 255, 0.05)', '#3ec1ff'],
                click: ['rgba(150, 192, 61, 0.4)', 'rgba(150, 192, 61, 0.05)', '#96c03d'],
                submissions: ['rgba(150, 192, 61, 0.4)', 'rgba(150, 192, 61, 0.05)', '#96c03d'],
            };

            const chart = document.getElementById(`${key}_chart`).getContext('2d');

            let gradient = chart.createLinearGradient(0, 0, 0, 250);
            gradient.addColorStop(0, colors[key][0]);
            gradient.addColorStop(1, colors[key][1]);

            new Chart(chart, {
                type: 'line',
                data: {
                    labels: el.data('labels'),
                    datasets: [{
                        data: el.data('value'),
                        backgroundColor: gradient,
                        borderColor: colors[key][2],
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

                                return app.nr(value);
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: el.data('title'),
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
                                        return app.nr(value);
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
        },

        number_format: (number, decimals, dec_point = '.', thousands_point = ',') => {

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
        },

        nr: (number, decimals = 0) => {

            let decimal_point = $('[name="number_decimal_point"]').val();
            let thousands_separator = $('[name="number_thousands_separator"]').val();

            return app.number_format(number, decimals, decimal_point, thousands_separator);
        }

    };

    $(document).ready(app.init);

})(jQuery);