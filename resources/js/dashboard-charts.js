(function () {

    var charts = {
        init: function () {
            charts.ajaxGetPostMonthlyData();
        },

        ajaxGetPostMonthlyData: function () {
            var urlPath = 'http://' + window.location.hostname + ':8000/api/metrics/sales';
            var request = $.ajax({
                method: 'GET',
                url: urlPath
            });

            request.done(function (response) {
                console.log(response);
                charts.createMetricsSalesChart(response);
            });
        },

        createMetricsSalesChart: function (response) {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: response.months,
                    datasets: [{
                        label: '# caixa mensal',
                        data: response.total_amount_data,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.4)',
                            'rgba(255, 99, 132, 0.4)',
                            'rgba(255, 206, 86, 0.4)',
                            'rgba(75, 192, 192, 0.4)',
                            'rgba(153, 102, 255, 0.4)',
                            'rgba(255, 159, 64, 0.4)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 3,
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            time: { unit: 'date' },
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        }
    }

    charts.init();

})();
