<!-- Argon Scripts -->
    <!-- Core -->
    <script src="<?php echo base_url('assets/js/bootstrap.bundle.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/js.cookie.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/jquery.scroll/dist/jquery.scrollbar.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/jquery.scroll/dist/jquery-scrollLock.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/lavalamp/js/jquery.lavalamp.min.js');?>"></script>
    <!-- Optional JS -->
    <script src="<?php echo base_url('assets/lib/chart.js/js/Chart.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/chart.js/js/Chart.extension.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/jvectormap/jquery-jvectormap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/jvectormap/jquery-jvectormap-world-mill.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/dataTables.bootstrap4.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/dataTables.buttons.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/buttons.bootstrap4.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/buttons.html5.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/buttons.flash.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/buttons.print.min.js');?>"></script>
    <script src="<?php echo base_url('assets/lib/datatables/js/dataTables.select.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/argon.min.js?v=1.0.0');?>"></script>
    <script src="<?php echo base_url('assets/js/demo.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-notify.min.js');?>"></script>
    <script>
        // Facebook Pixel Code Don't Delete
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window,
            document, 'script', '//connect.facebook.net/en_US/fbevents.js');

        try {
            fbq('init', '111649226022273');
            fbq('track', "PageView");

        } catch (err) {
            console.log('Facebook Track Error:', err);
        }
    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
    </noscript>
</body>

</html>