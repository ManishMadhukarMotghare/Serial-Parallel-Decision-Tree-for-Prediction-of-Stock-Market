<?php

include 'include.php';
//$RGVP->DB = new RGVPDB();
$RGVP->Cookie->getCookieValue("UserID");
$LoginUID = $RGVP->Cookie->getCookieValue("UserID");
if (isset($_REQUEST["table"])) {
     $Table = $_REQUEST['table'];

   echo $Sql_input = "Select * From  $Table where Status= 'Active' ;";

    $sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
    $s = "";
    $s;
    while ($row = mysqli_fetch_array($sql_output)) {
        $s .= "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
    }

    echo '<option value="">------- Select --------</option>' . $s;
}
?>