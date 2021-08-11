
/*==== result-chart =====*/
var ctx = document.getElementById('line-chart');
Chart.defaults.global.defaultFontFamily = 'Noto Sans JP';
Chart.defaults.global.defaultFontSize = 14;
Chart.defaults.global.defaultFontStyle = '500';
Chart.defaults.global.defaultFontColor = '#2e3d62';
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ["Jan", "Feb", "Mar", "April", "May"],
        datasets: [{
            label: "Views",
            data: [40, 90, 210, 160, 230],
            backgroundColor: 'rgba(6,181,144,0.1)',
            borderColor: '#06b590',
            pointBorderColor: '#ffffff',
            pointBackgroundColor: '#06b590',
            pointBorderWidth: 2,
            pointRadius: 4

        }]
    },

    // Configuration options go here
    options: {
        tooltips: {
            xPadding: 12,
            yPadding: 12,
            backgroundColor: '#2e3d62'
        },
        legend: {
            display: false,
            tooltips: {
                displayColors:false,
            }
        },
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    color: '#eee',
                }
            }],
            yAxes: [{
                display: true,
                gridLines: {
                    color: '#eee',
                },
                ticks: {
                    fontSize: 14,
                }
            }]

        }
    }
});