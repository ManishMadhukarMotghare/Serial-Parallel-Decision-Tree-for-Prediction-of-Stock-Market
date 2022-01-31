<?php

include 'include.php';
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();
$Dockets = $getvars['Dockets'];
$DocketArray = explode("|", $Dockets);
$DocketLikeStr = "";
for ($i = 0; $i < sizeof($DocketArray); $i++) {
    $DocketArray[$i] = "Dockets Like '%" . $DocketArray[$i] . "%'";
}
$DocketLikeStr = implode(" or ", $DocketArray);
$Sql_input_Manifest = "SELECT ManifestNumber FROM manifest where Status !='Cancelled' AND ($DocketLikeStr)";
$Sql_output_Manifest = $RGVP->DB->Execute_Query($Sql_input_Manifest, "GET", "SQLObj");
if ($RGVP->DB->Status == "502") {
    if (mysqli_num_rows($Sql_output_Manifest) > 0) {

        while ($Manifestrow = mysqli_fetch_assoc($Sql_output_Manifest)) {

            echo $Manifestrow['ManifestNumber'] ." <br /> ";
        }
    } else {
        echo "false";
    }
} else {
    echo "false";
}
?>
