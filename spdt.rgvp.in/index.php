<?php
require_once 'include.php';
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();
//$RGVP->Cookie->getCookieValue("UserID");
$UserType = $RGVP->Cookie->getCookieValue("UserType");
$LoginUID = $RGVP->Cookie->getCookieValue("UserID");

?>
<!doctype html>
<html class="no-js" lang="">

    <head>
        <?php include (RGVPAdminThemeHeaderSection); ?>
        <style>
            .collapse{height:300px;}
            .collapse p{ text-align: center;  color:white;  font-size:16px;  font-weight: bold;}
        </style>
    </head>
    <body>
        <!--[if lt IE 8]>
                <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
            <![endif]-->
        <?php include (RGVPAdminThemeHeader); ?>
        <!-- Mobile Menu start -->
        <?php include (RGVPAdminThemeFolder . "mobile-navbar.php"); ?>
        <!-- Mobile Menu end -->
        <!-- Main Menu area start-->
        <?php include (RGVPAdminThemeFolder . "navbar.php"); ?>
        <!-- Main Menu area End-->
        <!-- Breadcomb area Start-->
        <div class="breadcomb-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="">
                        <div class="breadcomb-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="breadcomb-wp">
                                        <div class="breadcomb-icon">
                                            <i class="notika-icon notika-windows"></i>
                                        </div>
                                        <div class="breadcomb-ctn">
                                            <h2>Module Random Forest for Prediction</h2>
                                            <!--<p>Welcome to Online Examination Management System <span class="bread-ntd">Admin Template</span></p>-->
                                            <p>We are going to predict the stock market by Random Forest strategies using following Parameters:
                                                1. National Stock Exchange Data<br>
                                                2. Twitter Sentiments Regarding Market Trend<br>
                                                3. Global News<br>
                                                4. Dow Jones Data<br>
                                                5. Hang Sang Data<br>
                                                6. National News Data Regarding Stock Market<br>
                                                7. Crude Oil Historical Data<br>
                                                8. Russell 2000 Historical Data<br>
                                                9. S & P 100 Historical Data<br>
                                                10. Nasdaq Historical Data<br>
                                                11. Nikkei 225 Historical Data
                                            </p>
                                            <img class="img-responsive" src="images/Algorithms.jpeg" alt=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                                    <div class="breadcomb-report">
                                        <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcomb area End-->


        <!-- End Footer area-->
        <div >
            <?php include (RGVPAdminThemeFooter); ?>
            <?php include (RGVPAdminThemeFooterSection); ?>
        </div>
    </body>

</html>