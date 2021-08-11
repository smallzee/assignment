/*==== doughutChart =====*/
var ctx = document.getElementById( "doughnut-chart" );
Chart.defaults.global.defaultFontFamily = 'Noto Sans JP';
Chart.defaults.global.defaultFontSize = 14;
Chart.defaults.global.defaultFontStyle = '500';
Chart.defaults.global.defaultFontColor = '#2e3d62';
var chart = new Chart( ctx, {
    type: 'doughnut',
    data: {
        datasets: [ {
            data: [ 40, 32, 15 ],
            backgroundColor: ["#26ae61", "#CC08E9", "#1da1f2"],
            hoverBackgroundColor: ["#40CC6F", "#D50CE9", "#0B9BF2"],
            hoverBorderWidth: 5,
            hoverBorderColor: "#eee",
            borderWidth: 3

        } ],
        labels: [
            "Applied Jobs",
            "Posted Jobs",
            "Active Bids"
        ]
    },
    options: {
        responsive: true,
        tooltips: {
            xPadding: 15,
            yPadding: 15,
            backgroundColor: '#2e3d62'
        },
        legend: {
            display: false
        }
    }
} );