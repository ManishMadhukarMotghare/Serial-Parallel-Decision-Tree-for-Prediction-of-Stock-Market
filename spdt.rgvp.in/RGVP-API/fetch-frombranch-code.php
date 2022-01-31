<?php

include 'include.php';
session_start();
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();


$CommandType = "EMPTY";
if (isset($_REQUEST["ManifestType"]))
    $CommandType = $_REQUEST["ManifestType"];

switch ($CommandType) {
    case "EMPTY":
        echo "No Command Type Received.";
        break;
    case "H to H":

        $Sql_input ="select * from branch where BranchType='HUB' ";
        $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
        $s = "";
        $s;
        while ($row = mysqli_fetch_assoc($sql_output)) {
            $s .= "<option value='" . $row["Code"] . "'>" . $row["BranchName"] . "</option>";
        }

        echo '<option value="">------- Select --------</option>' . $s;

        if ($RGVP->DB->StatusCode == "502") {
            $num = mysqli_num_rows($sql_output);
            if ($num > 0) {
                $row = mysqli_fetch_assoc($sql_output);
                $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents Customers", $row[$column]);
                //    echo "{Status:success,data:{FromBranch:".$s."},Msg:Data Succesfully Send}";
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }


        break;
    case "B to B":

        $Sql_input ="select * from branch";
        $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
        $s = "";
        $s;
        while ($row = mysqli_fetch_assoc($sql_output)) {
            $s .= "<option value='" . $row["Code"] . "'>" . $row["BranchName"] . "</option>";
        }

        echo '<option value="">------- Select --------</option>' . $s;
        if ($RGVP->DB->StatusCode == "502") {
            $num = mysqli_num_rows($sql_output);
            if ($num > 0) {
                $row = mysqli_fetch_assoc($sql_output);
                $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents Customers", $row[$column]);
                //    echo "{Status:success,data:{FromBranch:".$s."},Msg:Data Succesfully Send}";
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }


        break;
    case "H to B":

        $Sql_input ="select * from branch where BranchType='HUB'";
        $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
        $s = "";
        $s;
        while ($row = mysqli_fetch_assoc($sql_output)) {
            $s .= "<option value='" . $row["Code"] . "'>" . $row["BranchName"] . "</option>";
        }

        echo '<option value="">------- Select --------</option>' . $s;

        if ($RGVP->DB->StatusCode == "502") {
            $num = mysqli_num_rows($sql_output);
            if ($num > 0) {
                $row = mysqli_fetch_assoc($sql_output);
                $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents Customers", $row[$column]);
                //    echo "{Status:success,data:{FromBranch:".$s."},Msg:Data Succesfully Send}";
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
    case "B To H":

        $Sql_input ="select * from branch";
        $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
        $s = "";
        $s;
        while ($row = mysqli_fetch_assoc($sql_output)) {
            $s .= "<option value='" . $row["Code"] . "'>" . $row["BranchName"] . "</option>";
        }

        echo '<option value="">------- Select --------</option>' . $s;

        if ($RGVP->DB->StatusCode == "502") {
            $num = mysqli_num_rows($sql_output);
            if ($num > 0) {
                $row = mysqli_fetch_assoc($sql_output);
                $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents Customers", $row[$column]);
                //    echo "{Status:success,data:{FromBranch:".$s."},Msg:Data Succesfully Send}";
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
        }
        echo $returnstring;
}
?>








