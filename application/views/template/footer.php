</div>
  </main>
  
    <script src="<?php echo base_url('assets/js/core/popper.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/core/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/perfect-scrollbar.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/smooth-scrollbar.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/plugins/chartjs.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/dataTables.bootstrap4.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/dataTables.buttons.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/buttons.bootstrap4.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/buttons.html5.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/buttons.flash.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/buttons.print.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/dataTables.select.min.js');?>"></script>
    <script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
        type: "line",
        data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#5e72e4",
            backgroundColor: gradientStroke1,
            borderWidth: 3,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

        }],
        },
        options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
            display: false,
            }
        },
        interaction: {
            intersect: false,
            mode: 'index',
        },
        scales: {
            y: {
            grid: {
                drawBorder: false,
                display: true,
                drawOnChartArea: true,
                drawTicks: false,
                borderDash: [5, 5]
            },
            ticks: {
                display: true,
                padding: 10,
                color: '#fbfbfb',
                font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
                },
            }
            },
            x: {
            grid: {
                drawBorder: false,
                display: false,
                drawOnChartArea: false,
                drawTicks: false,
                borderDash: [5, 5]
            },
            ticks: {
                display: true,
                color: '#ccc',
                padding: 20,
                font: {
                size: 11,
                family: "Open Sans",
                style: 'normal',
                lineHeight: 2
                },
            }
            },
        },
        },
    });
    </script>
    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
        damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="<?php echo base_url('assets/js/argon-dashboard.min.js?v=2.0.4');?>"></script>
</body>

</html>
