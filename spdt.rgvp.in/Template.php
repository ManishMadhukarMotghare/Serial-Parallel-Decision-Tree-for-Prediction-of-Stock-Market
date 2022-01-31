<?php
require_once 'include.php';
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <?php include (RGVPAdminThemeHeaderSection); ?>
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcomb-list">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="breadcomb-wp">
                                        <div class="breadcomb-icon">
                                            <i class="notika-icon notika-windows"></i>
                                        </div>
                                        <div class="breadcomb-ctn">
                                            <h2>NAME</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Breadcomb area End-->
        <?php
        if (isset($_REQUEST['msg'])) {
            echo '<br><div class="alert" style="text-align: center; color: #ffffff; background-color: #e53238; border-color: #ffffff;">' . $_REQUEST['msg'] . '<a href="index.php"  style="padding: 5px; background-color: #fff; float:right;">&times;</a></div>';
        }
        ?>
        <div class="data-table-area">
            <div class="data-table-list">
                <div class="">
                    <h2>Name Management</h2>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="dynamic-content">
                            <!--dynamic content-->

                            <!--dynamic content-->
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- End Footer area-->
        <?php include (RGVPAdminThemeFooter); ?>
        <?php include (RGVPAdminThemeFooterSection); ?>

    </body>

</html>