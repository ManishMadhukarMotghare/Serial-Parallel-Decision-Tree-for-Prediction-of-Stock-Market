
<?php
require_once 'include.php';
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();
$RGVP->Cookie->getCookieValue("UserID");
$LoginUID = $RGVP->Cookie->getCookieValue("UserID");
?>
<?php
require_once 'include.php';


$Message = '<div class="alert alert-danger">
  <strong>Please Enter Admin User Name in Above Field</strong> 
</div>';
?>
<?php
if (isset($_GET["txt_id"])) {
    $ID = $_GET["txt_id"];
    $Query = "SELECT * FROM Admin_user WHERE userID='$ID' ";
    $RunQueryproduct = $RGVP->DB->Execute_Query($Query, "GET", "SQLObj");
    $Rowproduct = mysqli_fetch_assoc($RunQueryproduct);
}
$Msg = $_GET["Msg"];
if ($Msg == "") {
    $Msg;
    $Message1 = '<div class="alert alert-success">
  <strong>Showing Result For UserName = ' . $Rowproduct["Name"] . '</strong> 
</div>';
} else {
    $Msg1 = '<div class="alert alert-success">
  <strong>' . $Msg . '</strong> 
</div>';

    $Message1 = "";
}
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
            <form action="" method="GET">
                <div class="panel panel-info">
                    <div class="panel-heading">

                        <div class="panel-body" >
                            <div class="col-md-4">
                                Enter User Name:
                            </div>
                            <div class="col-md-4">
                                <?php echo $RGVP->DB->FillSelectQuery('SELECT * FROM Admin_user', 'Name', 'userID', 'add-id', 'txt_id', 'form-control selectpicker show-tick rgvp-selector', 'true') ?>
                            </div>
                            <div class="col-md-4">
                                <input type="submit" name="btnSearch" value="Search">
                            </div>

                        </div>
                    </div>
                </div>
            </form>
            <?php if (isset($_GET["txt_id"])) { ?>
                <?php //echo $Msg;  ?>
                <?php echo $Msg1; ?>
                <?php echo $Message1; ?>
                <form name=form_Admin_user id="edit-Admin_user" action="RGVP-API/Admin_userAPI.php" method="POST">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="edit-modal-label">Edit Admin_user</h4>
                        </div>
                        <div class="modal-body">
                            <div class='row'>
                                <div class="form-group col-sm-3 hidden">
                                    <label for="edit-userID" class=" col-sm-12 control-label">userID</label>
                                    <div class=" col-sm-12">
                                        <input type="text" maxlength="50" class="form-control" id="edit-userID" name="txt_userID" placeholder="Enter userID" required>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="edit-Name" class=" col-sm-12 control-label">Name</label>
                                    <div class=" col-sm-12">
                                        <input type="text" maxlength="50" class="form-control" id="edit-Name" name="txt_Name" placeholder="Enter Name" required>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="edit-Mobile" class=" col-sm-12 control-label">Mobile</label>
                                    <div class=" col-sm-12">
                                        <input type="text" maxlength="10" class="form-control" id="edit-Mobile" name="txt_Mobile" placeholder="Enter Mobile" required>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="edit-Email" class=" col-sm-12 control-label">Email</label>
                                    <div class=" col-sm-12">
                                        <input type="text" maxlength="50" class="form-control" id="edit-Email" name="txt_Email" placeholder="Enter Email" required>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="edit-Dob" class=" col-sm-12 control-label">DOB</label>
                                    <div class=" col-sm-12">
                                        <input type="date" class="form-control" id="edit-Dob" name="date_Dob" placeholder="Enter Dob" >
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="form-group col-sm-3">
                                    <label for="edit-UserType" class=" col-sm-12 control-label">User Type</label>
                                    <div class=" col-sm-12">
                                        <select name="txt_UserType" id="edit-UserType" class="form-control">
                                            <option value="SuperAdmin">SuperAdmin</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Manager">Manager</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="edit-Branch" class=" col-sm-12 control-label">Branch</label>
                                    <div class=" col-sm-12">
                                        <?php echo $RGVP->DB->FillSelectQuery("SELECT Code , concat(BranchName,'(', Code,' )') as BranchName FROM branch " . $BranchWhere . ";", 'BranchName', 'Code', 'edit-Branch', 'txt_Branch', 'form-control  show-tick', 'true') ?>
                                        <!--<input type="text" maxlength="50" class="form-control" id="add-Branch" name="txt_Branch" placeholder="Enter Branch" required>-->
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="edit-Username" class=" col-sm-12 control-label">Username</label>
                                    <div class=" col-sm-12">
                                        <input type="text" maxlength="32" class="form-control" id="edit-Username" name="txt_Username" placeholder="Enter Username" required>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="edit-Password" class=" col-sm-12 control-label">Password</label>
                                    <div class=" col-sm-12">
                                        <input type="text" maxlength="16" class="form-control" id="edit-Password" name="txt_Password" placeholder="Enter Password" required>
                                    </div>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="form-group col-sm-3">
                                    <label for="edit-Status" class=" col-sm-12 control-label">Status</label>
                                    <div class=" col-sm-12">
                                        <select name="txt_Status" id="edit-Status" class="form-control">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
        <!--                                                                <input type="text" maxlength="8" class="form-control" id="add-Status" name="txt_Status" placeholder="Enter Status" required>-->
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="edit-AddedBy" class=" col-sm-12 control-label">AddedBy</label>
                                    <div class=" col-sm-12">
                                        <input type="number"class="form-control" id="edit-AddedBy" name="txt_AddedBy" placeholder="Enter AddedBy"  value="<?php echo $LoginUID ?>" placeholder="Enter AddedBy"  required readonly="">
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="edit-UpdateBy" class=" col-sm-12 control-label">UpdateBy</label>
                                    <div class=" col-sm-12">
                                        <input type="number" class="form-control" id="edit-UpdateBy" name="txt_UpdateBy" placeholder="Enter UpdateBy"  value="<?php echo $LoginUID ?>" placeholder="Enter UpdateBy"  required readonly="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="CommandType" value="UPDATE-SAVE">
                        <input type="hidden" id="edit-user-ID" name="id" value="">
                        <!--                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>-->
                        <button type="button" class="btn btn-danger pull-left"  onclick="javascript:removeRow(id);">Delete</button>
                        <a href="adminuser-print.php?ID=<?php echo $ID; ?>" class="btn btn-warning pull-left">Print</a>
                        <button type="submit" class="btn btn-primary pull-right">Save changes</button>
                    </div>
                </form>
                <?php
            } else {
                echo $Message;
            }
            ?>
        </div>
        <?php include (RGVPAdminThemeFooter); ?>
        <?php include (RGVPAdminThemeFooterSection); ?>
        <script type='text/javascript' language='javascript' class='init'>
       var action_url = '<?php echo RGVPAdminAPIURL ?>' + 'Admin_userAPI.php';
            // Remove row
            function removeRow(id) {
                var id = document.getElementById("edit-userID").value;
                if (confirm("Are you sure, You want to Delete")) {
                    if ('undefined' != typeof id) {
                        $.get(action_url + '?CommandType=DELETE&id=' + id, function () {
                            $('a[data-id="row-' + id + '"]').parent().parent().remove();
                        }).fail(function () {
                            alert('Unable to fetch data, please try again later.')
                        });
                    } else
                        alert('Unknown row id.');
                    document.location.href = 'adminuser-add.php';
                }

            }

        </script>
        <script>
            $('#edit-user-ID').val('<?php echo $Rowproduct['userID']; ?>');
            $('#edit-userID').val('<?php echo $Rowproduct['userID']; ?>');
            $('#edit-Name').val('<?php echo $Rowproduct['Name']; ?>');
            $('#edit-Mobile').val('<?php echo $Rowproduct['Mobile']; ?>');
            $('#edit-Email').val("<?php echo $Rowproduct['Email']; ?>");
            $('#edit-Dob').val('<?php echo $Rowproduct['Dob']; ?>');
            $('#edit-UserType').val('<?php echo $Rowproduct['UserType']; ?>');
            $('#edit-Branch').val('<?php echo $Rowproduct['Branch']; ?>');
            $('#edit-Username').val('<?php echo $Rowproduct['Username']; ?>');
            $('#edit-Password').val("<?php echo $Rowproduct['Password']; ?>");
            $('#edit-Status').val('<?php echo $Rowproduct['Status']; ?>');
            $('#edit-AddedBy').val('<?php echo $Rowproduct['AddedBy']; ?>');
            $('#edit-UpdateBy').val('<?php echo $Rowproduct['UpdateBy']; ?>');

        </script>
    </body>

</html>