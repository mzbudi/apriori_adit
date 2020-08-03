<?php
error_reporting(0);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
ini_set('max_execution_time', 300);
// error_reporting(E_ALL);
session_start();
$menu = '';
if (isset($_GET['menu'])) {
    $menu = $_GET['menu'];
}

if (!file_exists($menu . ".php")) {
    $menu = 'not_found';
}

if (
    !isset($_SESSION['apriori_toko_id']) &&
    ($menu != '' & $menu != 'home' & $menu != 'tentang' & $menu != 'not_found' & $menu != 'forbidden')
) {
    header("location:login.php");
}
include_once 'fungsi.php';
//include 'koneksi.php';
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <title>PRIMART</title>
    <link href="images/icon/report.png" rel="shortcut icon" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,300italic,300,500,500italic,700,900">
    <!--
        Artcore Template
                http://www.templatemo.com/preview/templatemo_423_artcore
        -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/templatemo-misc.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
    <script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>

    <link rel="stylesheet" href="scripts/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="scripts/toast/jquery.toast.min.css">

    <!-- daterange picker -->
    <link rel="stylesheet" href="import/daterangepicker/daterangepicker-bs3.css">
    <style>
        * {
            box-sizing: border-box;
        }



        .mySlides {
            display: none;
        }

        img {
            vertical-align: middle;
        }

        /* Slideshow container */
        .slideshow-container {
            width: 100%;
            position: relative;
            margin: auto;
        }

        /* Caption text */
        .text {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active-tab {
            background-color: orange;
        }

        /* Fading animation */
        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
            .text {
                font-size: 11px
            }
        }
    </style>
</head>

<body style="background-color: #efefef">
    <!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->


    <!-- <section id="pageloader">
            <div class="loader-item fa fa-spin colored-border"></div>
        </section> /#pageloader -->

    <?php
    include "header.php";

    $menu = ''; //variable untuk menampung menu
    if (isset($_GET['menu'])) {
        $menu = $_GET['menu'];
    }


    if ($menu != '') {
        if (can_access_menu($menu)) {
            if (file_exists($menu . ".php")) {
                include $menu . '.php';
            } else {
                include "not_found.php";
            }
        } else {
            include "forbidden.php";
        }
    } else {
        if (isset($_SESSION['apriori_toko_id'])) {
            include "after_login.php";
            include "home.php";
        } else {
            include "welcome_text.php";
            include "home.php";
        }
    }

    ?>



    <script src="js/vendor/jquery-1.11.0.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')
    </script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <!-- Preloader -->
    <script type="text/javascript">
        //<![CDATA[
        $(window).load(function() { // makes sure the whole site is loaded
            $('.loader-item').fadeOut(); // will first fade out the loading animation
            $('#pageloader').fadeOut('fast'); // will fade out the white DIV that covers the website.
            $('body').css({
                'overflow-y': 'visible'
            });
        })

        var slideIndex = 0;
        showSlides();



        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active-tab", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active-tab";
            setTimeout(showSlides, 5000); // Change image every 2 seconds
        }
        //]]>
    </script>


    <!-- jQuery 2.1.4 -->
    <!-- <script src="import/jQuery/jQuery-2.1.4.min.js"></script> -->
    <!-- date-range-picker -->
    <script src="import/daterangepicker/moment-cloud.min.js"></script>
    <script src="import/daterangepicker/daterangepicker.js"></script>


    <!-- Page script -->
    <script>
        $(function() {
            //Date range picker
            $('#reservation').daterangepicker({
                format: 'DD/MM/YYYY'
            });
            $('#daterange-btn').daterangepicker({
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment()
                },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
            );

        });
    </script>
    
</body>

</html>