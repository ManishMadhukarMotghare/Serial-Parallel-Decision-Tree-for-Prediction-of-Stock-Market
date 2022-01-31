<?php include 'include.php' ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>RG-VP Form Builder Dashboard | by RG-VP WEB SOLUTIONS</title>

        <?php include ($GLOBALS["RGVPWS_AdminThemePath"] . "RGVP-Head-Section.php"); ?>
    </head>
    <body>
        <!-- Customized Code For Various HTML Add-ons At Beginning : Place Here-->
        <div class="wthree_agile_admin_info">
            <?php include ($GLOBALS["RGVPWS_AdminThemePath"] . "RGVP-Header.php"); ?>
            <!-- Customized Code For Various HTML Pages - Page Content : Place Here-->

            <div class="clearfix"></div>
            <!-- /inner_content-->
            <div class="inner_content">
                <!-- /inner_content_w3_agile_info-->
                <div class="inner_content_w3_agile_info">
                    <h3>Form Builder</h3>
                    <div>
                        <?php
                        $dbsql = "SHOW DATABASES;";
                        $dbhost = $GLOBALS["RGVPDB_host"];
                        $dbuser = $GLOBALS["RGVPDB_user"];
                        $dbpass = $GLOBALS["RGVPDB_pass"];
                        // $dbhost = "kpfinserve.com:3306";
                        // $dbuser = "rgvpws_alldb";
                        // $dbpass = "dbserver_RGVP1@";
                        // $RGVPFormBuild = new RGVP_FormBuilder();
                        $RGVPDB = new RGVPDB($dbhost, $dbuser, $dbpass, NULL);
                        $result = "";
                        if (!isset($_REQUEST['database'])) {
                            $result = $RGVPDB->Execute_Query("SHOW DATABASES;", "GET", "SQLObj");
                            echo $RGVPDB->Msg;
                            echo $RGVPDB->DBConStatus;
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
                            echo $select;
                        } elseif (isset($_REQUEST['database']) && !isset($_REQUEST['table'])) {
                            //SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA LIKE 'your_database';
                            $RGVPDB = new RGVPDB($dbhost, $dbuser, $dbpass, $_REQUEST['database']);
                            $result = $RGVPDB->Execute_Query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA LIKE '" . $_REQUEST['database'] . "';", "GET", "SQLObj");
                            echo $RGVPDB->Msg;
                            echo $RGVPDB->DBConStatus;
                            $select = "<form id='selecttableform' method='get'>
                            <label>Select Tables:</label><select id='table' name='table' >";
                            $options = "";
                            while ($row = mysqli_fetch_assoc($result)) {
                                $options .= "<option value='" . $row["TABLE_NAME"] . "'>" . $row["TABLE_NAME"] . "</option>";
                            }
                            $select .= $options . "</select>
                            <input type='hidden' name='database' value='" . $_REQUEST['database'] . "' /> 
                            <input type='submit' value='View Table' /></form>";
                            echo $select;
                        } elseif (isset($_REQUEST['table']) && isset($_REQUEST['database']) && isset($_REQUEST["GenForm"])) {
                            $insertskip = $_REQUEST["InsertSkipFields"];
                            $updateskip = $_REQUEST["UpdateSkipFields"];
                            $selectskip = $_REQUEST["SelectSkipFields"];
                            echo $insertskip.$updateskip.$selectskip;
                            $database = $_REQUEST['database'];
                            $table = $_REQUEST['table'];
                            $RGVPDB = new RGVPDB($dbhost, $dbuser, $dbpass, $database);
                            $RGVPFormBuild = new RGVP_FormBuilder();
                            $row = $RGVPFormBuild->RGVP_BuildForm($RGVPDB->Execute_Query("Select * From `$database`.`$table` LIMIT 0,1;", "GET", "SQLObj"), $RGVPDB, "form-control", TRUE, $insertskip, $updateskip, $selectskip);
                            echo $RGVPDB->Msg;
                            echo $RGVPDB->DBConStatus;
                            //$mf->printForm("$table", $table . ".php", '0');

                            echo "<div class = 'row'>";
                            echo "<div class='col-md-6'>";
                            echo "<label>Insert & Edit Forms</label>";
                            echo "<textarea class='form-control' rows='10'>" . htmlspecialchars($row["AddForm"]). htmlspecialchars($row["EditForm"]) . "</textarea>";
                            echo "</div>";
                            echo "<div class='col-md-6'>";
                            echo "<label>Script JS Code</label>";
                            echo "<textarea class='form-control' rows='10'>" . htmlspecialchars($row["ScriptJS"]) . "</textarea>";
                            echo "</div>";
                            echo "</div>";
                            echo "<div class = 'row'>";
                            echo "<div class='col-md-6' >";
                            echo "<label>HTML Page Code</label>";
                            echo "<textarea class='form-control'  rows='10'>" . htmlspecialchars($row["DisplayHTML"]) . "</textarea>";
                            echo "</div>";
                            echo "<div class='col-md-6' >";
                            echo "<label>API File</label>";
                            echo "<textarea class='col-md-6' rows='10'>" . htmlspecialchars($row["API"]) . "</textarea>";
                            echo "</div>";
                            echo "</div>";
                        } elseif (isset($_REQUEST['table']) && isset($_REQUEST['database']) && !isset($_REQUEST["GenForm"])) {
                            $database = $_REQUEST['database'];
                            $table = $_REQUEST['table'];

                            $RGVPDB = new RGVPDB($dbhost, $dbuser, $dbpass, $database);
                            $result = $RGVPDB->Execute_Query("Select * From `$database`.`$table` LIMIT 0,1;", "GET", "SQLObj");
                            echo $RGVPDB->Msg;
                            echo $RGVPDB->DBConStatus;
                            if ($RGVPDB->StatusCode == "502") {
                                $select = "<form id='selecttableformdata' method='get'>
                                                <label>Table Columns:</label>" . $RGVPDB->Execute_Structure($result, "HTML-Table", 'Table_' . $table) . "  <br>
                                                    <div class='row'>
                                                        <div class='col-md-4'> <label>Skip Insert Columns:</label>" . $RGVPDB->Execute_Structure($result, "HTML-Select-Multiple", 'InsertSkipFields_raw') . "<br><input type='text' id='InsertSkipFields' name='InsertSkipFields' class='form-control' /></div>
                                                        <div class='col-md-4'> <label>Skip Update Columns:</label>" . $RGVPDB->Execute_Structure($result, "HTML-Select-Multiple", 'UpdateSkipFields_raw') . "<br><input type='text' id='UpdateSkipFields' name='UpdateSkipFields' class='form-control' /></div>
                                                        <div class='col-md-4'> <label>Skip Select Columns:</label>" . $RGVPDB->Execute_Structure($result, "HTML-Select-Multiple", 'SelectSkipFields_raw') . "<br><input type='text' id='SelectSkipFields' name='SelectSkipFields' class='form-control' /></div>
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
                                echo $select;
                            } else {
                                echo $RGVPDB->Exception;
                                echo $RGVPDB->RGVPQuery;
                            }
                        }
                        ?>
                    </div>
                </div>
                <!-- //inner_content_w3_agile_info-->
            </div>
            <!-- //inner_content-->
        </div>
        <?php include ($GLOBALS["RGVPWS_AdminThemePath"] . "/RGVP-Footer.php"); ?>
        <!-- Customized Code For Various HTML Add-ons : Place Here-->
        <?php include ($GLOBALS["RGVPWS_AdminThemePath"] . "/RGVP-Footer-Section.php"); ?>
        <!-- Customized Code For Various Java Script Modules Add-ons : Place Here-->
        <!-- Chart code -->
        <script>
            new gnMenu(document.getElementById('gn-menu'));
        </script>
        <!-- script-for-menu -->
        <!-- //js -->
        <script>
            $(function () {
                $('#supported').text('Supported/allowed: ' + !!screenfull.enabled);
                if (!screenfull.enabled) {
                    return false;
                }
                $('#toggle').click(function () {
                    screenfull.toggle($('#container')[0]);
                });
            });
        </script>
    </body>
</html>
