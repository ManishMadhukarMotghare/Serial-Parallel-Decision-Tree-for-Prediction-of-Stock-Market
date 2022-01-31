<?php
include 'include.php';
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();
$Manifests = $_GET['Manifest'];
$THCArray = explode("|",$Manifests);
             $ManifestLikeStr ="";
            for($i=0;$i < sizeof($THCArray);$i++)
            {
                $THCArray[$i] = "Manifests Like '%".$THCArray[$i]."%'";
            }
            $ManifestLikeStr = implode(" or ",$THCArray);
            $Manifests1 = str_replace("|", " or Manifests Like '%",$Manifests);
            $Sql_input_Manifest1 = "SELECT * FROM thc where Status !='Cancelled' AND ( Manifests Like ($ManifestLikeStr) )";
            $Sql_output_Manifest1 = $RGVP->DB->Execute_Query($Sql_input_Manifest1, "GET", "SQLObj");
if($RGVP->DB->Status == "502"){
    

//echo $sQuery;
if(mysqli_num_rows($Sql_output_Manifest1) > 0){
   while($Row = mysqli_fetch_assoc($Sql_output_Manifest1)){
    echo $Row['THCNumber'];   
   }
      
} else {
    echo "false";
}
}else{
     echo "false";
}
?>
