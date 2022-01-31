<?php include "include.php";// VARIABLES
                        $SelectColumns = array("MsgID","MsgName","MsgTitle","MsgAlias","Designation","Image","Video","MsgCategpry","Department","MsgType","MsgDisplay","MsgIntro","OrderBy","Status","UpdateBy","UpdateDate","AddedBy","AddedDate"); // array("id", "name", "email", "mobile", "start_date");
                        $InsertColumns = array("MsgName","MsgTitle","MsgAlias","Designation","Image","Video","MsgCategpry","Department","MsgType","MsgDisplay","MsgIntro","OrderBy","Status","UpdateBy","AddedBy");
                        $UpdateColumns = array("MsgName","MsgTitle","MsgAlias","Designation","Image","Video","MsgCategpry","Department","MsgType","MsgDisplay","MsgIntro","OrderBy","Status","UpdateBy","AddedBy");
                        $InsertColumnsData = array("txt_MsgName","txt_MsgTitle","txt_MsgAlias","txt_Designation","txt_Image","txt_Video","txt_MsgCategpry","txt_Department","ddl_MsgType","txt_MsgDisplay","txt_MsgIntro","txt_OrderBy","ddl_Status","txt_UpdateBy","txt_AddedBy");
                        $ColumnAPIUpdateData = array("txt_MsgName","txt_MsgTitle","txt_MsgAlias","txt_Designation","txt_Image","txt_Video","txt_MsgCategpry","txt_Department","ddl_MsgType","txt_MsgDisplay","txt_MsgIntro","txt_OrderBy","ddl_Status","txt_UpdateBy","txt_AddedBy");
                        $InsertColDataString = "";
                        $UpdateColDataString = "";
                        $sIndexColumn = "MsgID";
                        $sTable = "ecel_message";
                        $RGVP = new \RGVPCore\RGVPCore();
                        $RGVPDBCon = "";
                        $RGVPDBCon = $RGVP->DB->GetConnection();
                        $CommandType = "EMPTY";
                        if (isset($_REQUEST["CommandType"]))
                        $CommandType = $_REQUEST["CommandType"];
                        $posted = $_REQUEST;
                        foreach ($posted as &$val)
                        if(gettype($val) == "string")
                            $val = mysqli_real_escape_string($RGVPDBCon, $val);

                        switch ($CommandType) {
                            case "EMPTY":
                                echo "No Command Type Received.";
                                break;
                            case "INSERT":
                            if (isset($_REQUEST)) {
                                    //dbinit($gaSql);
                                    foreach ($InsertColumnsData as $FieldData)
                                        $InsertColDataString .= "'".$posted[$FieldData]."',";
                                    $InsertColDataString = substr($InsertColDataString, 0, strlen($InsertColDataString)-1);
                                  $Sql_input = "INSERT INTO $sTable (".implode(",", $InsertColumns).") VALUES ($InsertColDataString)";
                                    $Sql_input = str_replace(",,", ",'',", $Sql_input);
                                    $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "INSERT"); 
                                    $id = $RGVP->DB->PrimaryKeyID;     
//            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/messages/";
//            if (!is_dir($path)) {
//                mkdir($path, 0777, true);
//            }
//
//            $FileUploadStatus = "";
//            $photo_dir = $path;
//         echo   $photo_name = basename($_FILES["txt_Image"]["name"]);
//          echo  $extension = pathinfo($photo_name, PATHINFO_EXTENSION);
//        echo    $photo_name = $photo_name . "." . $extension;
//         echo   $photo_file_path = $photo_dir . $photo_name;
//            $photo_location = $photo_dir . $photo_name;
//
//            if (move_uploaded_file($_FILES["txt_Image"]["tmp_name"], $photo_file_path)) {
//                echo $FileUploadStatus = TRUE;
//            } else {
//                echo $FileUploadStatus = FALSE;
//            }
   $path = $_SERVER['DOCUMENT_ROOT'] . "/images/messages/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus3 = FALSE;
            $image_name = basename($_FILES["txt_Image"]["name"]);
            //$photo_location = $photo_name;
            $Extension = pathinfo($image_name, PATHINFO_EXTENSION);


            $imagebanner_name = $image_name;
            $imagebanner_file_path = $path . $imagebanner_name;

            if (file_exists($imagebanner_file_path))
                unlink($imagebanner_file_path);
            if (move_uploaded_file($_FILES["txt_Image"]["tmp_name"], $imagebanner_file_path)){
              echo $FileUploadStatus3 = TRUE;
                } else {
           echo   $FileUploadStatus3 = FALSE;
                }  
           
//                           for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
//                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
//            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
//      echo   $Sql_input = "UPDATE $sTable SET $sTable.$UpdateColDataString WHERE $sIndexColumn = " . intval($posted["id"]);
//
//            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
                if ($FileUploadStatus3) {
                      $Sql_input = "UPDATE ecel_message SET Image = '" . $imagebanner_name . "'  where MsgID = '$id'";
                $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");  
                }
                                // AJAX ADD FROM JQUERY
                               
//                                    $Sql_output = $RGVP->DB->Execute_Query("SELECT ".implode(",",$SelectColumns)." FROM $sTable WHERE $sIndexColumn = " . $id, "GET", "SQLObj");
//                                    die(json_encode(mysqli_fetch_assoc($Sql_output)));
                                }
                                 header("location:../ecel_message.php");
                                break;
                            case "UPDATE-SAVE":
                            // AJAX EDIT FROM JQUERY
                                if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
                                // SAVE DATA
                                    for ($j=0;$j<count($ColumnAPIUpdateData);$j++)
                                    
                                        $UpdateColDataString .=  $UpdateColumns[$j]." = '".$posted[$ColumnAPIUpdateData[$j]]."',";
                                    $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString)-1);
                                    $Sql_input = " UPDATE $sTable SET $UpdateColDataString WHERE $sIndexColumn = " . intval($_GET["id"]);
                                        $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");

                                // GET DATA
                                    $Sql_input = "SELECT ".implode(",",$SelectColumns)." FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
                                    $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
                                    die(json_encode(mysqli_fetch_assoc($Sql_output,JSON_PARTIAL_OUTPUT_ON_ERROR)));
                                }
                                break;
                                
                                
   case "UPDATE":
 if (isset($posted["txt_MsgID"]) && 0 < intval($posted["txt_MsgID"])) {
            // SAVE DATA
           $id = $posted["txt_MsgID"];
            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/messages/" . $id . "/";
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            
            $FileUploadStatus = FALSE;

            if (file_exists($_FILES["txt_Image"]["tmp_name"])) {
                $Logo_file_upload = basename($_FILES["txt_Image"]["name"]);
                $Extension = pathinfo($Logo_file_upload, PATHINFO_EXTENSION);
                $Logo_dir = $path;
              $Logo_file =$Logo_file_upload;
                $Logo_file_path = $Logo_dir . $Logo_file;

                if (move_uploaded_file($_FILES["txt_Image"]["tmp_name"], $Logo_file_path)) {
                    $FileUploadStatus = TRUE;
                    $posted["txt_Image"] = $Logo_file;
                } else {
                    $FileUploadStatus = FALSE;
                    $posted["txt_Image"] = $posted["txt_Image-name"];
                    echo "File Logo Upload Error.";
                }
            } else {
                $posted["txt_Image"] = $posted["txt_Image-name"];
                echo "File Logo Upload Error..";
            }
            
            for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
   $Sql_input = "UPDATE $sTable SET $UpdateColDataString WHERE MsgID='".$posted['txt_MsgID']."'";

            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
        }
      header("location:../ecel_message.php");
        break;
                                
                                
                                
                                
                            case "DELETE":
                        // AJAX REMOVE FROM JQUERY
                                if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
                                    //dbinit($gaSql);
                                    // REMOVE DATA
                                    $Sql_input = " DELETE FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
                                    $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "DELETE");
                                    if ($RGVP->DB->StatusCode == "501" || $RGVP->DB->StatusCode == "503") {
                                        echo $RGVP->DB->Exception . $RGVP->DB->Msg;
                                    }
                                }
                                break;
                            case "SELECT-WITH-ID":
                                if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
                                    $Sql_input = "SELECT ".implode(",",$SelectColumns)." FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
                                    $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
                                    die(json_encode(mysqli_fetch_assoc($Sql_output)));
                                }
                                break; 
                            case "SELECT":
                            // QUERY LIMIT
                                $sLimit = "";
                                if (isset($_GET["iDisplayStart"]) && $_GET["iDisplayLength"] != "-1") {
                                    $sLimit = "LIMIT " . intval($_GET["iDisplayStart"]) . ", " . intval($_GET["iDisplayLength"]);
                                }
                                // QUERY ORDER
                                $sOrder = "";
                                if (isset($_GET["iSortCol_0"])) {
                                    $sOrder = "ORDER BY ";
                                    for ($i = 0; $i < intval($_GET["iSortingCols"]); $i++) {
                                        if ($_GET["bSortable_" . intval($_GET["iSortCol_" . $i])] == "true") {
                                            $sOrder .= $SelectColumns[intval($_GET["iSortCol_" . $i])] . " " . ( $_GET["sSortDir_" . $i] === "asc" ? "asc" : "desc" ) . ", ";
                                        }
                                    }
                                    $sOrder = substr_replace($sOrder, "", -2);
                                    if ($sOrder == "ORDER BY")
                                        $sOrder = "";
                                }
                                // QUERY SEARCH
                                $sWhere = "";
                                if (isset($_GET["sSearch"]) && $_GET["sSearch"] != "") {
                                    $sWhere = "WHERE (";
                                    for ($i = 0; $i < count($SelectColumns); $i++) {
                                        if (isset($_GET["bSearchable_" . $i]) && $_GET["bSearchable_" . $i] == "true") {
                                            $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVPDBCon,$_GET["sSearch"]) . "%' OR ";
                                        }
                                    }
                                    $sWhere = substr_replace($sWhere, "", -3);
                                    $sWhere .= ")";
                                }
                                // BUILD QUERY
                                for ($i = 0; $i < count($SelectColumns); $i++) {
                                    if (isset($_GET["bSearchable_" . $i]) && $_GET["bSearchable_" . $i] == "true" && $_GET["sSearch_" . $i] != "") {
                                        if ($sWhere == "")
                                            $sWhere = "WHERE ";
                                        else
                                            $sWhere .= " AND ";
                                        $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVPDBCon,$_GET["sSearch_" . $i]) . "%' ";
                                    }
                                }
                                // FETCH
                                $sQueryDisplay = "";
                                $sQuery = " SELECT ".implode(",",$SelectColumns)." FROM $sTable $sWhere $sOrder $sLimit ";
                                $sQueryDisplay .= $sQuery . "\n";
                                $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
                                $sQuery = " SELECT COUNT(" . $sIndexColumn . ") FROM $sTable ";
                                $sQueryDisplay .= $sQuery . "\n";
                                $rResultTotal = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj"); 
                                $aResultTotal = mysqli_fetch_array($rResultTotal);
                                $iTotal = $aResultTotal[0];
                                $output = array();
                                while ($aRow = mysqli_fetch_array($rResult)) {
                                    $row = array();
                                    for ($i = 0; $i < count($SelectColumns); $i++) {
                                        if ($SelectColumns[$i] == "version")
                                            $row[] = ( $aRow[$SelectColumns[$i]] == "0" ) ? "-" : $aRow[$SelectColumns[$i]];
                                        else if ($SelectColumns[$i] != " ")
                                            $row[] = $aRow[$SelectColumns[$i]];
                                    }
                                    $output["data"][] = array_merge( array('<a href="view-message.php?ID=' . $row[0] . '" class="btn btn-warning" ><i class="fa fa-eye"></i></a>&nbsp;<a href="javascript:removeRow(' . $row[0] . ');" class="btn btn-danger" ><i class="fa fa-close"></i></a>'),$row,$row);
                                }
                                // RETURN IN JSON
                                die(trim(json_encode($output,JSON_PARTIAL_OUTPUT_ON_ERROR))); // . $sQueryDisplay);
                                //echo "";
                                break;
                        default:
                                echo "Invalid Command.";
                                break;
                        }