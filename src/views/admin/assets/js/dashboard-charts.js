$(function() {
    $('input[type="radio"]').on('click', function() {
        if($(this).val() == 'all') {
            $('#email-field').hide()
        } else {
            $('#email-field').show()
        }
    })
})


var revenueChart = document.getElementById("revenue").getContext("2d");
var ordersChart = document.getElementById("orders").getContext("2d");

var response
console.log('starting')
$.ajax({
    url: '/admin/stats',
    type: 'get',
    success: function(data){
        response = JSON.parse(data)
        var myChart1 = new Chart(revenueChart, {
            type: 'line',
            data: {
                labels: response[0],
                datasets: [{
                    data: response[2],
                    backgroundColor: "rgba(48, 164, 255, 0.2)",
                    borderColor: "rgba(48, 164, 255, 0.8)",
                    fill: true,
                    borderWidth: 1
                }]
            },
            options: {
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart',
                },
                plugins: {
                    legend: {
                        display: false,
                        position: 'right',
                    },
                    title: {
                        display: true,
                        text: 'Revenue',
                        position: 'left',
                    },
                },
            }
            });
            
            // new
            var myChart2 = new Chart(ordersChart, {
            type: 'bar',
            data: {
                labels: response[0],
                datasets: [{
                        label: 'Orders',
                        data: response[1],
                        backgroundColor: "rgba(76, 175, 80, 0.5)",
                        borderColor: "#6da252",
                        borderWidth: 1,
                }]
            },
            options: {
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart',
                },
                plugins: {
                    legend: {
                        display: false,
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Number of Orders',
                        position: 'left',
                    },
                },
            }
            });
    }
 });


