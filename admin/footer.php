<div id="footer">Powered By <a href="http://rangelworks.com" target="_blank">Rangelworks</a></div>
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/js/bootstrap-fileupload.js"></script>
<script src="assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<!-- ie8 fixes -->
<!--[if lt IE 9]>
<script src="js/excanvas.js"></script>
<script src="js/respond.js"></script>
<![endif]-->
<script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js" type="text/javascript"></script>
<script src="js/jquery.sparkline.js" type="text/javascript"></script>
<script src="js/apprise-1.5.full.js" type="text/javascript"></script>
<script src="assets/chart-master/Chart.js"></script>
<script src="assets/nestable/jquery.nestable.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/common-scripts.js"></script>
<script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
<script src="js/dynamic-table.js"></script>
<script>
  jQuery(document).ready(function() {
        function slideout() {
            setTimeout(function() {
                $("#response").slideUp("slow", function() {});
            }, 2000);
        }
        if (!jQuery().sortable) {
            return;
        }
        $("#draggable_portlets").sortable({
            connectWith: ".widget",
            cursor: 'move',
            items: ".widget",
            opacity: 0.8,
            coneHelperSize: true,
            placeholder: 'sortable-box-placeholder round-all',
            forcePlaceholderSize: true,
            tolerance: "pointer",
            update: function() {
                var table = $('#tablename').val();
                var order = $(this).sortable("serialize") + '&update=' + table;
                $.post("updateList.php", order, function(theResponse) {
                    $("#response").html(theResponse);
                    $("#response").slideDown('slow');
                    slideout();
                });
            }
        });
        $(".column").disableSelection();
    });
</script>
</body>
</html>
