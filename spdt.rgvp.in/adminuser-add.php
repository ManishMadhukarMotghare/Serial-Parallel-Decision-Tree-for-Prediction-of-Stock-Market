<?php
require_once 'include.php';
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();
$RGVP->Cookie->getCookieValue("UserID");
$LoginUID = $RGVP->Cookie->getCookieValue("UserID");
$UserBranch = $RGVP->Cookie->getCookieValue("UserBranchCode");
$BranchWhere = "";
if ($RGVP->Cookie->exists("UserBranchCode")) {
    $BranchWhere = "Where Code = '$UserBranch'";
}
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

        <div class="container-fluid" role="document">

            <form name=form_Admin_user id="add-Admin_user" method="POST" action="RGVP-API/Admin_userAPI.php" >
                <div class="panel panel-primary">
                    <div class="panel-heading">
<!--     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                        <h4 class="modal-title" id="add-modal-label">Add AdminUser</h4>
                    </div>
                    <div class="modal-body">
                        <div class='row'>
                            <div class="form-group col-sm-3">
                                <label for="add-Name" class=" col-sm-12 control-label">Name</label>
                                <div class=" col-sm-12">
                                    <input type="text" maxlength="50" class="form-control" id="add-Name" name="txt_Name" placeholder="Enter Name" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="add-Mobile" class=" col-sm-12 control-label">Mobile</label>
                                <div class=" col-sm-12">
                                    <input type="text" maxlength="10" class="form-control" id="add-Mobile" name="txt_Mobile" placeholder="Enter Mobile" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="add-Email" class=" col-sm-12 control-label">Email</label>
                                <div class=" col-sm-12">
                                    <input type="text" maxlength="50" class="form-control" id="add-Email" name="txt_Email" placeholder="Enter Email" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="add-Dob" class=" col-sm-12 control-label">DOB</label>
                                <div class=" col-sm-12">
                                    <input type="date" class="form-control" id="add-Dob" name="date_Dob" placeholder="Enter Dob" required>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class="form-group col-sm-3">
                                <label for="add-UserType" class=" col-sm-12 control-label">User Type</label>
                                <div class=" col-sm-12">
                                    <select name="txt_UserType" id="add-UserType" class="form-control">
                                        <option value="SuperAdmin">SuperAdmin</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Manager">Manager</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="add-Branch" class=" col-sm-12 control-label">Branch</label>
                                <div class=" col-sm-12">
                                    <?php echo $RGVP->DB->FillSelectQuery("SELECT Code , concat(BranchName,'(', Code,' )') as BranchName FROM branch " . $BranchWhere . ";", 'BranchName', 'Code', 'add-Branch', 'txt_Branch', 'form-control  show-tick', 'true') ?>
                                    <!--<input type="text" maxlength="50" class="form-control" id="add-Branch" name="txt_Branch" placeholder="Enter Branch" required>-->
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="add-Username" class=" col-sm-12 control-label">Username</label>
                                <div class=" col-sm-12">
                                    <input type="text" maxlength="32" class="form-control" id="add-Username" name="txt_Username" placeholder="Enter Username" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="add-Password" class=" col-sm-12 control-label">Password</label>
                                <div class=" col-sm-12">
                                    <input type="text" maxlength="16" class="form-control" id="add-Password" name="txt_Password" placeholder="Enter Password" required>
                                </div>
                            </div>
                        </div>
                        <div class='row'>
                            <div class="form-group col-sm-3">
                                <label for="add-Status" class=" col-sm-12 control-label">Status</label>
                                <div class=" col-sm-12">
                                    <select name="ddl_Status" id="add-Status" class="form-control">
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
<!--                                                                <input type="text" maxlength="8" class="form-control" id="add-Status" name="txt_Status" placeholder="Enter Status" required>-->
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="add-AddedBy" class=" col-sm-12 control-label">AddedBy</label>
                                <div class=" col-sm-12">
                                    <input type="number"class="form-control" id="add-AddedBy" name="txt_AddedBy" placeholder="Enter AddedBy"  value="<?php echo $LoginUID ?>" placeholder="Enter AddedBy"  required readonly="">
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="add-UpdateBy" class=" col-sm-12 control-label">UpdateBy</label>
                                <div class=" col-sm-12">
                                    <input type="number" class="form-control" id="add-UpdateBy" name="txt_UpdateBy" placeholder="Enter UpdateBy"  value="<?php echo $LoginUID ?>" placeholder="Enter UpdateBy"  required readonly="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="CommandType" value="INSERT" />
                    <!--                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>-->
                    <button type="submit" class="btn btn-primary pull-left">Save changes</button>
                    <button type="button" class="btn btn-default pull-left" onclick="$('#add-Admin_user')[0].reset();">Reset</button>
                </div>
            </form>
        </div>
        <?php include (RGVPAdminThemeFooter); ?>
        <?php include (RGVPAdminThemeFooterSection); ?>

    </body>

</html>