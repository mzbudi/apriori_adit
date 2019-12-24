<?php
session_start();

if ( isset($_SESSION['apriori_toko_id']) ) {
    header("location:index.php");
}

$login = 0;
if (isset($_GET['login'])) {
    $login = $_GET['login'];
}

if ($login == 1) {
    $komen = "Silahkan Login Ulang, Cek username dan Password Anda!!";
}

include_once "fungsi.php";
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <title>Login - Apriori toko</title>
        <link href="images/icon/login.gif" rel="shortcut icon" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,300italic,300,500,500italic,700,900">
        <!--
        Artcore Template
		http://www.templatemo.com/preview/templatemo_423_artcore
        -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="scripts/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/templatemo-misc.css">
        <link rel="stylesheet" href="css/templatemo-style.css">
        <link rel="stylesheet" href="scripts/ionicons/css/ionicons.min.css">
        <link rel="stylesheet" href="scripts/toast/jquery.toast.min.css">
        <style>
            .login-box{
                width: 350px;
	            background: white;
	            /*meletakkan form ke tengah*/
	            margin: 0 auto;
	            padding: 30px 20px;
            }

            .login-img{
                display: block;
                margin-left: auto;
                margin-right: auto;
            }

            .form-login{
	            /*membuat lebar form penuh*/
                box-sizing : border-box;
                width: 100%;
                padding: 10px;
                font-size: 11pt;
                margin-bottom: 20px;
            }

            .image-down{
                margin-top: 120px;
            }
        </style>
        <script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>

    </head>
    <body>
            <?php
             if (isset($komen)) {
                display_error("Login gagal");
            }
            ?>
            <div class="image-down">
                <img class="login-img" src="images/lock.png" height="70" width="70">
            </div>
            <div class="login-box">
            <!-- <img src="images/lock.png" height="70" width="70"> -->
                <form method="post" action="cek-login.php" >
                    <p>
                        <label for="username">Username:</label>
                        <input class="form-login" name="username" type="text" id="username">
                    </p>
                    <p>
                        <label for="password">Password:</label>
                        <input class="form-login" name="password" type="password" id="password">   
                    </p>
                    <center><input type="submit" class="mainBtn" id="submit" value="Login" /></center>
                </form> 
            </div>
        <script src="js/vendor/jquery-1.11.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"></script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        
        
        
        <!-- Preloader -->
        <script type="text/javascript">
            //<![CDATA[
            $(window).load(function() { // makes sure the whole site is loaded
                $('.loader-item').fadeOut(); // will first fade out the loading animation
                    $('#pageloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
                $('body').delay(350).css({'overflow-y':'visible'});
            })
            //]]>
        </script>

    </body>
</html>
