<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"> 

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="/resources/plugins/images/favicon1.png">

    <title>Gestion concours et notes</title>

    <!-- =========================================
    CSS PLUGINS
    ===========================================-->

    <!-- Bootstrap Core CSS -->
    <link href="/resources/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="/resources/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">

    <!-- DataTables -->
    <link href="/resources/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

    <!-- Menu CSS -->
    <link href="/resources/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">

    <!-- animation CSS -->
    <link href="/resources/css/animate.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/resources/css/style.css" rel="stylesheet">

    <!-- Popup CSS -->
    <link href="/resources/plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">

    <!-- color CSS -->
    <link href="/resources/css/colors/megna.css" id="theme" rel="stylesheet">

    <link href="/resources/plugins/bower_components/datatables/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <!-- Date picker plugins css -->
    <link href="/resources/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

    <!-- Daterange picker plugins css -->
    <link href="/resources/plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">

    <!-- Cropper css Plugins -->
    <link href="/resources/css/croppie.css" rel="stylesheet">
    

    <!-- =========================================
    JAVASCRIPT PLUGINS
    ===========================================-->

    <!-- jQuery -->
    <script src="/resources/plugins/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/resources/bootstrap/dist/js/tether.min.js"></script>

    <script src="/resources/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="/resources/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>

    <!-- Menu Plugin JavaScript -->
    <script src="/resources/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>

    <!--slimscroll JavaScript -->
    <script src="/resources/js/jquery.slimscroll.js"></script>

    <!--Wave Effects -->
    <script src="/resources/js/waves.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/resources/js/custom.min.js"></script>

    <!--Style Switcher -->
    <script src="/resources/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

    <!-- DataTables -->
    <!-- <script src="/resources/plugins/bower_components/datatables/jquery.dataTables.min.js"></script> -->
    <script src="/resources/js/datatables-1.10.min.js"></script>

    <!-- start - This is for export functionality only -->
    <script src="/resources/plugins/bower_components/datatables/dataTables.buttons.min.js"></script>
    <script src="/resources/plugins/bower_components/datatables/buttons.flash.min.js"></script>
    <script src="/resources/plugins/bower_components/datatables/jszip.min.js"></script>
    <script src="/resources/plugins/bower_components/datatables/pdfmake.min.js"></script>
    <script src="/resources/plugins/bower_components/datatables/vfs_fonts.js"></script>
    <script src="/resources/plugins/bower_components/datatables/buttons.html5.min.js"></script>
    <script src="/resources/plugins/bower_components/datatables/buttons.print.min.js"></script>

    <!-- jquery-ui -->
    <script src="/resources/js/jquery-ui.min.js"></script>

    <!-- Plugin momentjs -->
    <script src="/resources/plugins/bower_components/moment/moment.js"></script>

    <!-- Date Picker Plugin JavaScript -->
    <script src="/resources/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    
    <!-- Date range Plugin JavaScript -->
    <script src="/resources/plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="/resources/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    
    <!-- Sweet-Alert  -->
    <script src="/resources/plugins/sweetalert2/sweetalert2.all.js"></script>

    <!-- jQuery file upload -->
    <script src="/resources/plugins/bower_components/dropify/dist/js/dropify.min.js"></script>

    <!-- Magnific popup JavaScript -->
    <script src="/resources/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js"></script>
    <script src="/resources/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup-init.js"></script>

     <!-- Cropper Js Plugins -->
     <script src="/resources/plugins/cropperjs/croppie.js"></script>
    
</head>

<body class="fix-sidebar">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <!-- End Preloader -->

        <?php

            echo '<div id="wrapper">';

                /*==============================
                TOP MENU
                ==============================*/
                include 'partials/topnavbar.php';

                /*==============================
                LEFT SIDEBAR MENU
                ==============================*/
                include 'partials/leftsidebar.php';

                /*==============================
                CONTENT HERE
                ==============================*/
                
?>