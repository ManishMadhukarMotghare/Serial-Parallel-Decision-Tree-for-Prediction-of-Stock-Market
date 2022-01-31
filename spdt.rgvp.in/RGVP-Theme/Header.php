<!-- Start Header Top Area -->
<?php
//$sqlCompanyIn = "SELECT * FROM company where CompanyID =$CompanyID AND Status='Active'";
//$sqlCompanyIn = "SELECT * FROM company where Status='Active'";
//$sqlCompanyOut = $RGVP->DB->Execute_Query($sqlCompanyIn, "GET", "SQLObj");
//$rowcompany = mysqli_fetch_assoc($sqlCompanyOut);
//$LoginUID = $RGVP->Cookie->getCookieValue("UserID");
//$LoginUIDemp = $RGVP->Cookie->getCookieValue("UserID");
//$Name = $RGVP->Cookie->getCookieValue("Name");
//$UserBranch = $RGVP->Cookie->getCookieValue("UserBranchCode");
?>
<div class="header-top-area hidden-xs">
    <div class="container-fluid">
        <div class="row">
<!--            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-6 logo-area">
                <a href="<?php echo RGVPAdminURL ?>"><img class="img-responsive" src="images/logo.png"></a>
            </div>-->
            <div class="col-lg-6 col-md-6 col-sm-3 col-xs-12 logo-area">
                <h1><?php echo RGVPWS_Org; ?></h1>
                <h4 class="employee-name-cls" style="">Project Code: Random Forest</h4>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 pull-right">
                <div class="header-top-menu">
                    <ul class="nav navbar-nav notika-top-nav">
                        <li class="second logo"></li>
                        <li class="nav-item">
                            <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span>
                                    <i class="fa fa-user-secret"></i></span></a>
                            <div role="menu" class="dropdown-menu message-dd task-dd animated zoomIn">
                                <div class="hd-message-info">
                                    <a href="#" id="btn-logout">
                                        <div class="hd-message-sn">
                                            <div class="hd-mg-ctn">
                                                  <h3>Help Line No:9518752753</h3>
                                                  <br>
                                                <h3><i class="fa fa-sign-out"></i> Logout</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Header Top Area -->

