<?php
include 'include.php';
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();
 $DocketNo = $_GET['Docket'];
 $sQuery = "SELECT DocketNumber FROM docket WHERE DocketNumber = '$DocketNo' AND Status != 'Cancelled' ;";
$rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
if($RGVP->DB->Status == "502"){
    

//echo $sQuery;
if(mysqli_num_rows($rResult) > 0){
    $Row = mysqli_fetch_assoc($rResult);
    echo $Row['DocketNumber'];
  
} else {
    echo "false";
}
}else{
     echo "false";
}
?>
