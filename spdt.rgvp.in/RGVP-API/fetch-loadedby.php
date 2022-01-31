<?php

include 'include.php';


if (isset($_REQUEST["loadedby"])) {
  $ccid = $_REQUEST['loadedby'];
 $Sql_input = "Select * From route where RouteID = '" . $ccid . "'";
 $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
 $row = mysqli_fetch_assoc($sql_output);
 
    $Sql_input1 = "Select Name,EmployeeID From employee where Branch = '" . $ccid . "'";

    $sql_output1 = $RGVP->DB->Execute_Query($Sql_input1, "GET", "SQLObj");
    $s = "";
    $s;
    while ($row = mysqli_fetch_assoc($sql_output1)) {
        $s .= "<option value='" . $row["EmployeeID"] . "'>" . $row["Name"] . "</option>";
    }

    echo '<option value="">------- Select --------</option>' . $s;
//    header("location:RGVP-DivisionAdmin/Actions");
}
?> 
