<?php
require_once 'include.php';
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();
$RGVP->Cookie->getCookieValue("UserID");
$LoginUID = $RGVP->Cookie->getCookieValue("UserID");
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
        <div class="display-message-status"> </div>
        <!-- Breadcomb area End-->

        <div class="data-table-area">
            <div class="data-table-list">
                <div class="">
                    <h2>Admin User</h2>
                </div>
                <div class="container-fluid">
                    <div class="row">

                        <div class="dynamic-content">
                            <!--dynamic content-->
                            <!--<button type="button" style="padding:10px; margin:0 50px 15px 0;" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#add-modal"><b>Add AdminUser</b></button>-->
                            <div class="row">
                                <div class="col-md-12 marginT20">
                                    <div class="table-responsive demo-x content">
                                        <table id="table_Admin_user" class="display-table table-hover table-bordered" cellspacing="0" width="100%">
                                            <thead class="btn-primary">
                                                <tr>
                                                    <th>userID</th><th>Name</th><th>Mobile</th><th>Email</th><th>Dob</th><th>UserType</th><th>Branch</th><th>Username</th><th>Password</th><th>Status</th><th>AddedBy</th><th>AddedDate</th><th>UpdateBy</th><th>UpdatedDate</th>
                                                    <th style="background-image: none">Edit</th>
                                                </tr>
                                            </thead>
                                            <tfoot class="btn-primary">
                                                <tr>
                                                    <th>userID</th><th>Name</th><th>Mobile</th><th>Email</th><th>Dob</th><th>UserType</th><th>Branch</th><th>Username</th><th>Password</th><th>Status</th><th>AddedBy</th><th>AddedDate</th><th>UpdateBy</th><th>UpdatedDate</th>
                                                    <th style="background-image: none">Edit</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!--dynamic content-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Footer area-->
        <?php include (RGVPAdminThemeFooter); ?>
        <?php include (RGVPAdminThemeFooterSection); ?>
        <script type='text/javascript' language='javascript' class='init'>
            var action_url = '<?php echo RGVPAdminAPIURL ?>' + 'Admin_userAPI.php';

            $(document).ready(function () {
                // ATW
                if (top.location.href != location.href)
                    top.location.href = location.href;
                // Initialize datatable
                $('#table_Admin_user').dataTable({
                    'aProcessing': true,
                    'aServerSide': true,
                    'ajax': action_url + '?CommandType=SELECT'
                });
            });
        </script>
        <script>
            $(document).ready(function () {$(".display-message-status").html(RGVPReportMsg("<?php echo $_REQUEST['msg'] ?>", "Warning", "Data Updated!", true));});
        </script>

    </body>

</html>