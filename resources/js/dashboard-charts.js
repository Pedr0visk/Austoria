(function () {
    // comment
    var charts = {
        init: function () {
            charts.ajaxGetSaleMonthlyData();
            charts.ajaxGetSaledItemsData();
        },

        ajaxGetSaleMonthlyData: function () {
            var date = new Date();
            var year = date.getFullYear();

            var urlPath = window.location.origin + '/api/metrics/sales/' + year;
            var request = $.ajax({
                method: 'GET',
                url: urlPath
            });

            request.done(function (response) {
                charts.createMetricsSalesChart(response);
            });
        },

        ajaxGetSaledItemsData: function () {
            var date = new Date();
            var year = date.getFullYear();

            var urlPath = window.location.origin + '/api/metrics/sale-items';
            var request = $.ajax({
                method: 'GET',
                url: urlPath
            });

            request.done(function (response) {
                console.log(response);
                charts.createProductSaledChart(response);
            });
        },

        createProductSaledChart: function (response) {
            var ctx = document.getElementById('productsSaledChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: response.names,
                    datasets: [{
                        label: '# ',
                        data: response.items_saled_quantity,
                        backgroundColor: [
                            'rgba(255, 206, 86, 0.4)',
                            'rgba(75, 192, 192, 0.4)',
                        ],
                        borderColor: [
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
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
                            'rgba(255, 159, 64, 0.4)',
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
                            'rgba(255, 159, 64, 1)',
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
