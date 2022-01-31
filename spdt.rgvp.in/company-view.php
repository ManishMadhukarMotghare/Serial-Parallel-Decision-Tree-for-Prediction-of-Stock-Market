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

$Query = "SELECT * FROM company WHERE CompanyID='1' ";
$RunQueryCompany = $RGVP->DB->Execute_Query($Query, "GET", "SQLObj");
$Rowcompany = mysqli_fetch_assoc($RunQueryCompany);
?>
<!doctype html>
<html class = "no-js" lang = "">
    <head>
        <?php include (RGVPAdminThemeHeaderSection);
        ?>
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

        <!-- Breadcomb area End-->
        <?php
        if (isset($_REQUEST['msg'])) {
            echo '<br><div class="alert" style="text-align: center; color: #ffffff; background-color: #e53238; border-color: #ffffff;">' . $_REQUEST['msg'] . '<a href="company-view.php"  style="padding: 5px; background-color: #fff; float:right;">&times;</a></div>';
        }
        ?>
        <div class="data-table-area">
            <div class="data-table-list">
                <div class="">
                    <h2>Company Management</h2>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="dynamic-content">
                            <!--dynamic content-->
                            <form action="RGVP-API/CompanyAPI.php" method="post">
                                <div class="panel panel-primary" >
                                    <div class="panel-heading">View Company
                                    </div>
                                    <div class="panel-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div class="panel panel-primary" >
                                                        <div class="panel-heading">
                                                            Company Details
                                                        </div>
                                                        <div class='row'>
                                                            <div class="form-group col-sm-3">
                                                                <label for="edit-CompanyID" class=" col-sm-12 control-label">CompanyID</label>
                                                                <div class=" col-sm-12">
                                                                    <input type="number" maxlength="500" class="form-control" id="edit-CompanyID" name="txt_CompanyID" placeholder="Enter CompanyID" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3">
                                                                <label for="edit-CompanyName" class=" col-sm-12 control-label">CompanyName</label>
                                                                <div class=" col-sm-12">
                                                                    <textarea maxlength="500" class="form-control" id="edit-CompanyName" name="txt_CompanyName" placeholder="Enter CompanyName" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3">
                                                                <label for="edit-CompanyDetails" class=" col-sm-12 control-label">CompanyDetails</label>
                                                                <div class=" col-sm-12">
                                                                    <textarea maxlength="1000" class="form-control" id="edit-CompanyDetails" name="txt_CompanyDetails" placeholder="Enter CompanyDetails" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3">
                                                                <label for="edit-CompanyCode" class=" col-sm-12 control-label">CompanyCode</label>
                                                                <div class=" col-sm-12">
                                                                    <input type="text" maxlength="100" class="form-control" id="edit-CompanyCode" name="txt_CompanyCode" placeholder="Enter CompanyCode" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3">
                                                                <label for="edit-CompanyBillingAddress" class=" col-sm-12 control-label">CompanyBillingAddress</label>
                                                                <div class=" col-sm-12">
                                                                    <textarea maxlength="200" class="form-control" id="edit-CompanyBillingAddress" name="txt_CompanyBillingAddress" placeholder="Enter CompanyBillingAddress" required></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='row'>
                                                            <div class="form-group col-sm-3">
                                                                <label for="edit-BillingPincode" class=" col-sm-12 control-label">BillingPincode</label>
                                                                <div class=" col-sm-12">
                                                                    <input type="number" min="0.00"  step="1" maxlength="7" class="form-control" id="edit-BillingPincode" name="txt_BillingPincode" placeholder="Enter BillingPincode"  required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3">
                                                                <label for="add-BillingCity" class=" col-sm-12 control-label">BillingCity</label>
                                                                <div class=" col-sm-12">
                                                                    <input type="text" maxlength="100" class="form-control" id="edit-BillingCity" name="txt_BillingCity" placeholder="Enter BillingCity" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3">
                                                                <label for="edit-BillingState" class=" col-sm-12 control-label">BillingState</label>
                                                                <div class=" col-sm-12">
                                                                    <input type="text" maxlength="100" class="form-control" id="edit-BillingState" name="txt_BillingState" placeholder="Enter BillingState" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3">
                                                                <label for="edit-BillingCountry" class=" col-sm-12 control-label">BillingCountry</label
                                                                <div class=" col-sm-12">
                                                                    <input type="text" maxlength="100" class="form-control" id="edit-BillingCountry" name="txt_BillingCountry" placeholder="Enter BillingCountry" required>
                                                                </div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class="form-group col-sm-3">
                                                                    <label for="edit-CompanyShippingAddress" class=" col-sm-12 control-label">CompanyShippingAddress</label>
                                                                    <div class=" col-sm-12">
                                                                        <textarea maxlength="200" class="form-control" id="edit-CompanyShippingAddress" name="txt_CompanyShippingAddress" placeholder="Enter CompanyShippingAddress" required></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-3">
                                                                    <label for="edit-ShippingPincode" class=" col-sm-12 control-label">ShippingPincode</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="number" min="0.00" step="1" maxlength="4" class="form-control" id="edit-ShippingPincode" name="txt_ShippingPincode" placeholder="Enter ShippingPincode"  required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-3">
                                                                    <label for="edit-ShippingCity" class=" col-sm-12 control-label">ShippingCity</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="text" maxlength="100" class="form-control" id="edit-ShippingCity" name="txt_ShippingCity" placeholder="Enter ShippingCity" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-3">
                                                                    <label for="edit-ShippingState" class=" col-sm-12 control-label">ShippingState</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="text" maxlength="100" class="form-control" id="edit-ShippingState" name="txt_ShippingState" placeholder="Enter ShippingState" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class="form-group col-sm-3">
                                                                    <label for="edit-ShippingCountry" class=" col-sm-12 control-label">ShippingCountry</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="text" maxlength="100" class="form-control" id="edit-ShippingCountry" name="txt_ShippingCountry" placeholder="Enter ShippingCountry" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-3">
                                                                    <label for="edit-CompanyEmail" class=" col-sm-12 control-label">CompanyEmail</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="text" maxlength="50" class="form-control" id="edit-CompanyEmail" name="txt_CompanyEmail" placeholder="Enter CompanyEmail" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-3">
                                                                    <label for="edit-CompanyWebsite" class=" col-sm-12 control-label">CompanyWebsite</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="text" maxlength="100" class="form-control" id="edit-CompanyWebsite" name="txt_CompanyWebsite" placeholder="Enter CompanyWebsite" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-3">
                                                                    <label for="edit-CompanyPhone" class=" col-sm-12 control-label">CompanyPhone</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="number" min="0.00"  step="1" maxlength="11" class="form-control" id="edit-CompanyPhone" name="txt_CompanyPhone" placeholder="Enter CompanyPhone"  required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class='row'>
                                                                <div class="form-group col-sm-3">
                                                                    <label for="edit-CompanyMobile" class=" col-sm-12 control-label">CompanyMobile</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="number" min="0.00"  step="1" maxlength="11" class="form-control" id="edit-CompanyMobile" name="txt_CompanyMobile" placeholder="Enter CompanyMobile"  required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-3">
                                                                    <label for="edit-CompanyGSTINNO" class=" col-sm-12 control-label">CompanyGSTINNO</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="text" maxlength="15" class="form-control" id="edit-CompanyGSTINNO" name="txt_CompanyGSTINNO" placeholder="Enter CompanyGSTINNO" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-3">
                                                                    <label for="edit-CompanyPAN" class=" col-sm-12 control-label">CompanyPAN</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="text" maxlength="10" class="form-control" id="edit-CompanyPAN" name="txt_CompanyPAN" placeholder="Enter CompanyPAN" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-3">
                                                                    <label for="edit-PlaceOfSupply" class=" col-sm-12 control-label">PlaceOfSupply</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="number"  maxlength="11" class="form-control" id="editf-PlaceOfSupply" name="txt_PlaceOfSupply" placeholder="Enter PlaceOfSupply"  >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="panel panel-primary" >
                                                            <div class="panel-heading"> Company Account Details
                                                            </div>
                                                            <div class='row'>
                                                                <div class="form-group col-sm-12">
                                                                    <label for="edit-AccountType" class=" col-sm-12 control-label">AccountType</label>
                                                                    <div class=" col-sm-12">
                                                                        <select name="ddl_AccountType" id="edit-AccountType" class="form-control">
                                                                            <option value="Saving">Saving</option>
                                                                            <option value="Current">Current</option>
                                                                            <option value=" OverDraft"> OverDraft</option>
                                                                            <option value="CC">CC</option>
                                                                            <option value=""></option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-12">
                                                                    <label for="edit-BankName" class=" col-sm-12 control-label">BankName</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="text" maxlength="100" class="form-control" id="edit-BankName" name="txt_BankName" placeholder="Enter BankName" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-12">
                                                                    <label for="edit-BranchName" class=" col-sm-12 control-label">BranchName</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="text" maxlength="50" class="form-control" id="edit-BranchName" name="txt_BranchName" placeholder="Enter BranchName" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-12">
                                                                    <label for="edit-IFSCCode" class=" col-sm-12 control-label">IFSCCode</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="text" maxlength="11" class="form-control" id="edit-IFSCCode" name="txt_IFSCCode" placeholder="Enter IFSCCode" required>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-12">
                                                                    <label for="edit-BankAccountNo" class=" col-sm-12 control-label">BankAccountNo</label>
                                                                    <div class=" col-sm-12">
                                                                        <input type="text" maxlength="50" class="form-control" id="edit-BankAccountNo" name="txt_BankAccountNo" placeholder="Enter BankAccountNo" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="panel panel-primary" >
                                                        <div class="panel-heading"> Company Billing Details
                                                        </div>
                                                        <div class='row'>
                                                            <div class="form-group col-sm-3">
                                                                <label for="edit-CompanyFootNote1" class=" col-sm-12 control-label">CompanyFootNote1</label>
                                                                <div class=" col-sm-12">
                                                                    <textarea maxlength="1001" class="form-control" id="edit-CompanyFootNote1" name="txt_CompanyFootNote1" placeholder="Enter CompanyFootNote1" ></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3">
                                                                <label for="edit-CompanyFootNote2" class=" col-sm-12 control-label">CompanyFootNote2</label>
                                                                <div class=" col-sm-12">
                                                                    <textarea maxlength="300" class="form-control" id="edit-CompanyFootNote2" name="txt_CompanyFootNote2" placeholder="Enter CompanyFootNote2" ></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3">
                                                                <label for="edit-CompanyValidity" class=" col-sm-12 control-label">CompanyValidity</label>
                                                                <div class=" col-sm-12">
                                                                    <input type="date" class="form-control" id="edit-CompanyValidity" name="date_CompanyValidity" placeholder="Enter CompanyValidity" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3">
                                                                <label for="edit-Status" class=" col-sm-12 control-label">Status</label>
                                                                <div class=" col-sm-12">
                                                                    <select name="ddl_Status" id="edit-Status" class="form-control">
                                                                        <option value="Active">Active</option>
                                                                        <option value="Inactive">Inactive</option>
                                                                        <option value=""></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class='row'>
                                                            <div class="form-group col-sm-3">
                                                                <label for="edit-AddedBy" class=" col-sm-12 control-label">AddedBy</label>
                                                                <div class=" col-sm-12">
                                                                    <input type="number"  maxlength="11" class="form-control" id="edit-AddedBy" name="txt_AddedBy" value="<?php echo $LoginUID; ?>" placeholder="Enter AddedBy"  required readonly="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3">
                                                                <label for="edit-UpadtedBy" class=" col-sm-12 control-label">UpadtedBy</label>
                                                                <div class=" col-sm-12">
                                                                    <input type="number" maxlength="11" class="form-control" id="edit-UpadtedBy" name="txt_UpadtedBy" value="<?php echo $LoginUID; ?>" placeholder="Enter UpadtedBy"  required readonly="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <input type="hidden" id="CommandType" name="CommandType" value="UPDATE">
<!--                                            <input type="hidden" id="edit-Company-ID" name="id" value="">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>-->
                                            <button type="submit" class="btn btn-primary pull-right">Save changes</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--dynamic content-->
            </div>
        </div>



        <!-- End Footer area-->
        <?php include (RGVPAdminThemeFooter); ?>
        <?php include (RGVPAdminThemeFooterSection); ?>
        <script>
            $('#edit-CompanyID').val('<?php echo $Rowcompany['CompanyID']; ?>');
            $('#edit-CompanyName').val('<?php echo $Rowcompany['CompanyName']; ?>');
            $('#edit-CompanyID').val('<?php echo $Rowcompany['CompanyID']; ?>');
            $('#edit-CompanyDetails').val('<?php echo $Rowcompany['CompanyDetails']; ?>');
            $('#edit-CompanyCode').val('<?php echo $Rowcompany['CompanyCode']; ?>');
            $('#edit-CompanyBillingAddress').val('<?php echo $Rowcompany['CompanyBillingAddress']; ?>');
            $('#edit-BillingPincode').val('<?php echo $Rowcompany['BillingPincode']; ?>');
            $('#edit-BillingCity').val('<?php echo $Rowcompany['BillingCity']; ?>');
            $('#edit-BillingState').val('<?php echo $Rowcompany['BillingState']; ?>');
            $('#edit-BillingCountry').val('<?php echo $Rowcompany['BillingCountry']; ?>');
            $('#edit-CompanyShippingAddress').val('<?php echo $Rowcompany['CompanyShippingAddress']; ?>');
            $('#edit-ShippingPincode').val('<?php echo $Rowcompany['ShippingPincode']; ?>');
            $('#edit-ShippingCity').val('<?php echo $Rowcompany['ShippingCity']; ?>');
            $('#edit-ShippingState').val('<?php echo $Rowcompany['ShippingState']; ?>');
            $('#edit-ShippingCountry').val('<?php echo $Rowcompany['ShippingCountry']; ?>');
            $('#edit-CompanyEmail').val('<?php echo $Rowcompany['CompanyEmail']; ?>');
            $('#edit-CompanyWebsite').val('<?php echo $Rowcompany['CompanyWebsite']; ?>');
            $('#edit-CompanyPhone').val('<?php echo $Rowcompany['CompanyPhone']; ?>');
            $('#edit-CompanyMobile').val('<?php echo $Rowcompany['CompanyMobile']; ?>');
            $('#edit-CompanyGSTINNO').val('<?php echo $Rowcompany['CompanyGSTINNO']; ?>');
            $('#edit-CompanyPAN').val('<?php echo $Rowcompany['CompanyPAN']; ?>');
            $('#edit-PlaceOfSupply').val('<?php echo $Rowcompany['PlaceOfSupply']; ?>');
            $('#edit-AccountType').val('<?php echo $Rowcompany['AccountType']; ?>');
            $('#edit-BankName').val('<?php echo $Rowcompany['BankName']; ?>');
            $('#edit-BranchName').val('<?php echo $Rowcompany['BranchName']; ?>');
            $('#edit-IFSCCode').val('<?php echo $Rowcompany['IFSCCode']; ?>');
            $('#edit-BankAccountNo').val('<?php echo $Rowcompany['BankAccountNo']; ?>');
            $('#edit-CompanyFootNote1').val('<?php echo $Rowcompany['CompanyFootNote1']; ?>');
            $('#edit-BankAccountNo').val('<?php echo $Rowcompany['BankAccountNo']; ?>');
            $('#edit-CompanyFootNote1').val('<?php echo $Rowcompany['CompanyFootNote1']; ?>');
            $('#edit-CompanyFootNote2').val('<?php echo $Rowcompany['CompanyFootNote2']; ?>');
            $('#edit-CompanyFootNote1').val('<?php echo $Rowcompany['CompanyFootNote1']; ?>');
            $('#edit-CompanyValidity').val('<?php echo $Rowcompany['CompanyValidity']; ?>');
            $('#edit-Status').val('<?php echo $Rowcompany['Status']; ?>');
            $('#edit-AddedBy').val('<?php echo $Rowcompany['AddedBy']; ?>');
            $('#edit-UpadtedBy').val('<?php echo $Rowcompany['UpadtedBy']; ?>');
        </script>
    </body>

</html>