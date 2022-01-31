<?php

include 'include.php';
$returnstring = "";
if (isset($_REQUEST["routeid"])) {
    $column=$_REQUEST["column"];
    $Sql_input = "Select ".$column." from route  where RouteID= '" . $_REQUEST['routeid'] . "'";
    $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
    if ($RGVP->DB->StatusCode == "502") {
        $num = mysqli_num_rows($sql_output);
        if ($num > 0) {
            $row = mysqli_fetch_assoc($sql_output);
            $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents FromBranch", $row[$column]);
            //    echo "{Status:success,data:{FromBranch:".$s."},Msg:Data Succesfully Send}";
        } else {
            $returnstring = $RGVP::GetStatus("607", FALSE);
        }
    } else {
        $returnstring = $RGVP::GetStatus("503", FALSE, "", $Sql_input);
    }
} else {
    $returnstring = $RGVP::GetStatus("605", FALSE);
}
echo $returnstring;