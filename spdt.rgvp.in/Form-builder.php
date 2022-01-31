<?php require 'include.php'; ?>
<?php
$DisplayTitle = "Step 0: Select Server | Form Builder Wizard";
$DisplayBody = "";
$DisplayLogs = "";
$dbsql = "SHOW DATABASES;";
$result = "";
$result = "";

///<Select data-live-search='true' class='selectpicker show-tick' >
//if (!isset($_REQUEST['dbserver'])) {
//    $DisplayTitle = "Step 0: Select Server | Form Builder Wizard";
//    $dbsql = "select * From servers;";
//    $result = $RGVP->DB->Execute_Query($dbsql, "GET", "SQLObj");
//    $DisplayLogs.= $RGVP->DB->Msg;
//    $DisplayLogs.= $RGVP->DB->DBConStatus;
//    $select = "<form id='selectdbform' method='get'><label>Select DB:</label><select id='database' name='database' >";
//    $options = "";
//    while ($row = mysqli_fetch_row($result)) {
//        if (($row[0] != "information_schema") && ($row[0] != "mysql")) {
//            $options .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
//        }
//    }
//    $select .= $options . "</select>
//                            <input type='submit' value='Select Database' />
//                        </form>";
//    $DisplayBody = $select;
//}else
if (!isset($_REQUEST['database'])) { //&& isset($_REQUEST['dbserver'])
    $DisplayTitle = "Step 1: Select Database | Form Builder Wizard";
    $dbsql = "SHOW DATABASES;";
    $result = $RGVP->DB->Execute_Query($dbsql, "GET", "SQLObj");
    $DisplayLogs .= $RGVP->DB->Msg;
    $DisplayLogs .= $RGVP->DB->DBConStatus;
    $select = "<form id='selectdbform' method='get'><label>Select DB:</label><select id='database' name='database' >";
    $options = "";
    while ($row = mysqli_fetch_row($result)) {
        if (($row[0] != "information_schema") && ($row[0] != "mysql")) {
            $options .= "<option value='" . $row[0] . "'>" . $row[0] . "</option>";
        }
    }
    $select .= $options . "</select>
                            <input type='submit' value='Select Database' />
                        </form>";
    $DisplayBody = $select;
} elseif (isset($_REQUEST['database']) && !isset($_REQUEST['table'])) {
    $DisplayTitle = "Step 2: Select Table | Form Builder Wizard";
    //SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA LIKE 'your_database';
    $result = $RGVP->DB->Execute_Query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA LIKE '" . $_REQUEST['database'] . "';", "GET", "SQLObj");
    $DisplayLogs .= $RGVP->DB->Msg;
    $DisplayLogs .= $RGVP->DB->DBConStatus;
    $select = "<form id='selecttableform' method='get'>
                    <label>Select Tables:</label><select id='table'  name='table' >";
    $options = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= "<option value='" . $row["TABLE_NAME"] . "'>" . $row["TABLE_NAME"] . "</option>";
    }
    $select .= $options . "</select>
                            <input type='hidden' name='database' value='" . $_REQUEST['database'] . "' /> 
                            <input type='submit' value='View Table' /></form>";
    $DisplayBody = $select;
} elseif (isset($_REQUEST['table']) && isset($_REQUEST['database']) && isset($_REQUEST["GenForm"])) {
    $DisplayTitle = "Step 4: Forms Generated Copy and Use Carefully. | Form Builder Wizard";
    $insertskip = $_REQUEST["InsertSkipFields"];
    $updateskip = $_REQUEST["UpdateSkipFields"];
    $selectskip = $_REQUEST["SelectSkipFields"];
    $DisplayLogs .= "Skipped Insert Fields: " . $insertskip . "<br />Skipped Update Fields: " . $updateskip . "<br />Skipped Select Fields: " . $selectskip;
    $database = $_REQUEST['database'];
    $table = $_REQUEST['table'];
    //$RGVPDB = new RGVPDB($dbhost, $dbuser, $dbpass, $database);
    $RGVPFormBuild = new RGVP_FormBuilder();
    $row = $RGVPFormBuild->RGVP_BuildForm($RGVP->DB->Execute_Query("Select * From `$database`.`$table` LIMIT 0,1;", "GET", "SQLObj"), $RGVP->DB, "form-control", TRUE, $insertskip, $updateskip, $selectskip);
    $DisplayLogs .= $RGVP->DB->Msg;
    $DisplayLogs .= $RGVP->DB->DBConStatus;
    //$mf->printForm("$table", $table . ".php", '0');
    $DisplayBody = "<div class = 'row'>";
    $DisplayBody .= "<div class='col-md-6'>";
    $DisplayBody .= "<label>Insert & Edit Forms</label>";
    $DisplayBody .= "<textarea class='form-control' rows='10'>" . htmlspecialchars($row["AddForm"]) . htmlspecialchars($row["EditForm"]) . "</textarea>";
    $DisplayBody .= "</div>";
    $DisplayBody .= "<div class='col-md-6'>";
    $DisplayBody .= "<label>Script JS Code</label>";
    $DisplayBody .= "<textarea class='form-control' rows='10'>" . htmlspecialchars($row["ScriptJS"]) . "</textarea>";
    $DisplayBody .= "</div>";
    $DisplayBody .= "</div>";
    $DisplayBody .= "<div class = 'row'>";
    $DisplayBody .= "<div class='col-md-6' >";
    $DisplayBody .= "<label>HTML Page Code</label>";
    $DisplayBody .= "<textarea class='form-control'  rows='10'>" . htmlspecialchars($row["DisplayHTML"]) . "</textarea>";
    $DisplayBody .= "</div>";
    $DisplayBody .= "<div class='col-md-6' >";
    $DisplayBody .= "<label>API File</label>";
    $DisplayBody .= "<textarea class='col-md-6' rows='10'>" . htmlspecialchars($row["API"]) . "</textarea>";
    $DisplayBody .= "</div>";
    $DisplayBody .= "</div>";
} elseif (isset($_REQUEST['table']) && isset($_REQUEST['database']) && !isset($_REQUEST["GenForm"])) {
    $database = $_REQUEST['database'];
    $table = $_REQUEST['table'];
    //$RGVPDB = new RGVPDB($dbhost, $dbuser, $dbpass, $database);
    $result = $RGVP->DB->Execute_Query("Select * From `$database`.`$table` LIMIT 0,1;", "GET", "SQLObj");
    $DisplayLogs .= $RGVP->DB->Msg;
    $DisplayLogs .= $RGVP->DB->DBConStatus;
    if ($RGVP->DB->StatusCode == "502") {
        $select = "<form id='selecttableformdata' method='get'>
                                                <label>Table Columns:</label>" . $RGVP->DB->Execute_Structure($result, "HTML-Table", 'Table_' . $table) . "  <br>
                                                    <div class='row'>
                                                        <div class='col-md-4'> <label>Skip Insert Columns:</label>" . $RGVP->DB->Execute_Structure($result, "HTML-Select-Multiple", 'InsertSkipFields_raw') . "<br><input type='text' id='InsertSkipFields' name='InsertSkipFields' class='form-control' /></div>
                                                        <div class='col-md-4'> <label>Skip Update Columns:</label>" . $RGVP->DB->Execute_Structure($result, "HTML-Select-Multiple", 'UpdateSkipFields_raw') . "<br><input type='text' id='UpdateSkipFields' name='UpdateSkipFields' class='form-control' /></div>
                                                        <div class='col-md-4'> <label>Skip Select Columns:</label>" . $RGVP->DB->Execute_Structure($result, "HTML-Select-Multiple", 'SelectSkipFields_raw') . "<br><input type='text' id='SelectSkipFields' name='SelectSkipFields' class='form-control' /></div>
                                                    </div><div class='clearfix'>&nbsp;</div>
                                                <input type='hidden' name='database' value='" . $database . "' /> 
                                                <input type='hidden' name='table' value='" . $table . "' /> 
                                                <input type='hidden' name='GenForm' value = 'Yes' /> 
                                                <input type='submit' value='Generate Forms' />
                                                <script>
                                                    $('#InsertSkipFields_raw').on('change', function () { $('#InsertSkipFields').val(''); $('#InsertSkipFields_raw :selected').each(function (i, item) { $('#InsertSkipFields').val($('#InsertSkipFields').val()+item.value + ','); }); });
                                                    $('#UpdateSkipFields_raw').on('change', function () { $('#UpdateSkipFields').val(''); $('#UpdateSkipFields_raw :selected').each(function (i, item) { $('#UpdateSkipFields').val($('#UpdateSkipFields').val()+item.value + ','); }); });
                                                    $('#SelectSkipFields_raw').on('change', function () { $('#SelectSkipFields').val(''); $('#SelectSkipFields_raw :selected').each(function (i, item) { $('#SelectSkipFields').val($('#SelectSkipFields').val()+item.value + ','); }); });
                                                </script>
                                            </form>";
        $DisplayBody = $select;
    } else {
        $DisplayLogs .= $RGVP->DB->Exception;
        $DisplayLogs .= $RGVP->DB->RGVPQuery;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <?php include(RGVPAdminThemeHeaderSection); ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
            <?php include(RGVPAdminThemeHeader); ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
               
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $DisplayTitle ?></h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <?php echo $DisplayBody ?>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <strong>Logs:</strong><br />
                            <?php echo $DisplayLogs ?>
                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php include( RGVPAdminThemeFooter) ?>
        </div>
        <!-- ./wrapper -->
        <?php include( RGVPAdminThemeFooterSection) ?>
    </body>
</html>
