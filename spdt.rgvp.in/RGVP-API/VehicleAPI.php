<?php

include "include.php"; // VARIABLES
$SelectColumns = array("VehicleID", "Branch", "OwnerVendor", "VendorName", "VehicleNo", "CompanyName", "ChasisNo", "EngineNo", "RegistrationDate", "DateOfAttaching", "Permit", "PermitExpiryDate", "FitnessExpiryDate", "InsuranceExpiryDate", "RC", "PollutionCheck", "PermitFile", "Fitness", "Insurance", "AadharNo", "AadharCard", "PANNo", "PAN", "Track", "StationedAt", "StationedStatus", "Status", "AddedBy", "AddedDate", "UpdateBy", "UpdatedDate","ContractAmt","OtherAmt"); // array("id", "name", "email", "mobile", "start_date");
$InsertColumns = array("Branch", "OwnerVendor", "VendorName", "VehicleNo", "CompanyName", "ChasisNo", "EngineNo", "RegistrationDate", "DateOfAttaching", "Permit", "PermitExpiryDate", "FitnessExpiryDate", "InsuranceExpiryDate", "RC", "PollutionCheck", "PermitFile", "Fitness", "Insurance", "AadharNo", "AadharCard", "PANNo", "PAN", "Track", "StationedAt", "StationedStatus", "Status", "AddedBy", "UpdateBy","ContractAmt","OtherAmt");
$UpdateColumns = array("Branch", "OwnerVendor", "VendorName", "VehicleNo", "CompanyName", "ChasisNo", "EngineNo", "RegistrationDate", "DateOfAttaching", "Permit", "PermitExpiryDate", "FitnessExpiryDate", "InsuranceExpiryDate", "RC", "PollutionCheck", "PermitFile", "Fitness", "Insurance", "AadharNo", "AadharCard", "PANNo", "PAN", "Track", "StationedAt", "StationedStatus", "Status", "AddedBy", "UpdateBy","ContractAmt","OtherAmt");
$InsertColumnsData = array("txt_Branch", "ddl_OwnerVendor", "txt_VendorName", "txt_VehicleNo", "txt_CompanyName", "txt_ChasisNo", "txt_EngineNo", "date_RegistrationDate", "date_DateOfAttaching", "date_Permit", "date_PermitExpiryDate", "date_FitnessExpiryDate", "date_InsuranceExpiryDate", "txt_RC", "txt_PollutionCheck", "txt_PermitFile", "txt_Fitness", "txt_Insurance", "txt_AadharNo", "txt_AadharCard", "txt_PANNo", "txt_PAN", "txt_Track", "txt_StationedAt", "txt_StationedStatus", "txt_Status", "txt_AddedBy", "txt_UpdateBy","txt_ContractAmt","txt_OtherAmt");
$ColumnAPIUpdateData = array("txt_Branch", "ddl_OwnerVendor", "txt_VendorName", "txt_VehicleNo", "txt_CompanyName", "txt_ChasisNo", "txt_EngineNo", "date_RegistrationDate", "date_DateOfAttaching", "date_Permit", "date_PermitExpiryDate", "date_FitnessExpiryDate", "date_InsuranceExpiryDate", "txt_RC", "txt_PollutionCheck", "txt_PermitFile", "txt_Fitness", "txt_Insurance", "txt_AadharNo", "txt_AadharCard", "txt_PANNo", "txt_PAN", "txt_Track", "txt_StationedAt", "txt_StationedStatus", "txt_Status", "txt_AddedBy", "txt_UpdateBy","txt_ContractAmt","txt_OtherAmt");
$InsertColDataString = "";
$UpdateColDataString = "";
$sIndexColumn = "VehicleID";
$sTable = "vehicle";
$RGVP = new \RGVPCore\RGVPCore();
$RGVPDBCon = "";
$RGVPDBCon = $RGVP->DB->GetConnection();
$CommandType = "EMPTY";
if (isset($_REQUEST["CommandType"]))
    $CommandType = $_REQUEST["CommandType"];
$posted = $_REQUEST;
foreach ($posted as &$val)
    if (gettype($val) == "string")
        $val = mysqli_real_escape_string($RGVPDBCon, $val);

switch ($CommandType) {
    case "EMPTY":
        echo "No Command Type Received.";
        break;
    case "INSERT":
        // AJAX ADD FROM JQUERY
        if (isset($_REQUEST)) {
            //dbinit($gaSql);

            foreach ($InsertColumnsData as $FieldData)
                $InsertColDataString .= "'" . $posted[$FieldData] . "',";
            $InsertColDataString = substr($InsertColDataString, 0, strlen($InsertColDataString) - 1);
            $Sql_input = "INSERT INTO $sTable (" . implode(",", $InsertColumns) . ") VALUES ($InsertColDataString)";
            $Sql_input = str_replace(",,", ",'',", $Sql_input);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "INSERT");
            $id = $RGVP->DB->PrimaryKeyID;
//            $Sql_output = $RGVP->DB->Execute_Query("SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . $id, "GET", "SQLObj");
//            die(json_encode(mysqli_fetch_assoc($Sql_output)));
            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/vehicle/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus1 = FALSE;
            $image_thumb_name = basename($_FILES["txt_RC"]["name"]);
            //$photo_location = $photo_name;
            $Extension = pathinfo($image_thumb_name, PATHINFO_EXTENSION);


            $image_thumb_name = "RC." . $Extension;
            $image_thumb_file_path = $path . $image_thumb_name;

            if (file_exists($image_thumb_file_path))
                unlink($image_thumb_file_path);
            if (move_uploaded_file($_FILES["txt_RC"]["tmp_name"], $image_thumb_file_path)) {
                echo $FileUploadStatus1 = TRUE;
            } else {
                
            } echo $FileUploadStatus1 = FALSE;



            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/vehicle/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus2 = FALSE;
            $imagemain_name = basename($_FILES["txt_PollutionCheck"]["name"]);
            //$photo_location = $photo_name;
            $Extension = pathinfo($imagemain_name, PATHINFO_EXTENSION);


            $imagemain_name = "PollutionCheck." . $Extension;
            $imagemain_file_path = $path . $imagemain_name;

            if (file_exists($imagemain_file_path))
                unlink($imagemain_file_path);
            if (move_uploaded_file($_FILES["txt_PollutionCheck"]["tmp_name"], $imagemain_file_path)) {
                echo $FileUploadStatus2 = TRUE;
            } else {
                echo $FileUploadStatus2 = FALSE;
            }

            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/vehicle/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus3 = FALSE;
            $imagemain_name1 = basename($_FILES["txt_PermitFile"]["name"]);
            //$photo_location = $photo_name;
            $Extension1 = pathinfo($imagemain_name1, PATHINFO_EXTENSION);


            $imagemain_name1 = "PermitFile." . $Extension1;
            $imagemain_file_path1 = $path . $imagemain_name1;

            if (file_exists($imagemain_file_path1))
                unlink($imagemain_file_path1);
            if (move_uploaded_file($_FILES["txt_PermitFile"]["tmp_name"], $imagemain_file_path1)) {
                echo $FileUploadStatus3 = TRUE;
            } else {
                echo $FileUploadStatus3 = FALSE;
            }

            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/vehicle/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus4 = FALSE;
            $imagemain_name2 = basename($_FILES["txt_Fitness"]["name"]);
            //$photo_location = $photo_name;
            $Extension2 = pathinfo($imagemain_name2, PATHINFO_EXTENSION);


            $imagemain_name2 = "Fitness." . $Extension2;
            $imagemain_file_path2 = $path . $imagemain_name2;

            if (file_exists($imagemain_file_path2))
                unlink($imagemain_file_path2);
            if (move_uploaded_file($_FILES["txt_Fitness"]["tmp_name"], $imagemain_file_path2)) {
                echo $FileUploadStatus4 = TRUE;
            } else {
                echo $FileUploadStatus4 = FALSE;
            }

            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/vehicle/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus5 = FALSE;
            $imagemain_name3 = basename($_FILES["txt_Insurance"]["name"]);
            //$photo_location = $photo_name;
            $Extension3 = pathinfo($imagemain_name3, PATHINFO_EXTENSION);


            $imagemain_name3 = "Insurance." . $Extension3;
            $imagemain_file_path3 = $path . $imagemain_name3;

            if (file_exists($imagemain_file_path3))
                unlink($imagemain_file_path3);
            if (move_uploaded_file($_FILES["txt_Insurance"]["tmp_name"], $imagemain_file_path3)) {
                echo $FileUploadStatus5 = TRUE;
            } else {
                echo $FileUploadStatus5 = FALSE;
            }

            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/vehicle/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus6 = FALSE;
            $imageaadhar_name = basename($_FILES["txt_AadharCard"]["name"]);
            //$photo_location = $photo_name;
            $Extension4 = pathinfo($imageaadhar_name, PATHINFO_EXTENSION);


            $imageaadhar_name = "AadharCard." . $Extension4;
            $imageaadhar_file_path = $path . $imageaadhar_name;

            if (file_exists($imageaadhar_file_path))
                unlink($imageaadhar_file_path);
            if (move_uploaded_file($_FILES["txt_AadharCard"]["tmp_name"], $imageaadhar_file_path)) {
                echo $FileUploadStatus6 = TRUE;
            } else {
                echo $FileUploadStatus6 = FALSE;
            }

            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/vehicle/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus7 = FALSE;
            $imagepan_name = basename($_FILES["txt_PAN"]["name"]);
            //$photo_location = $photo_name;
            $Extension5 = pathinfo($imagepan_name, PATHINFO_EXTENSION);


            $imagepan_name = "PAN." . $Extension5;
            $imagepan_file_path = $path . $imagepan_name;

            if (file_exists($imagepan_file_path))
                unlink($imagepan_file_path);
            if (move_uploaded_file($_FILES["txt_PAN"]["tmp_name"], $imagepan_file_path)) {
                echo $FileUploadStatus7 = TRUE;
            } else {
                echo $FileUploadStatus7 = FALSE;
            }

//            if ($FileUploadStatus1 && $FileUploadStatus2 && $FileUploadStatus3 && $FileUploadStatus4 && $FileUploadStatus5 && $FileUploadStatus6 && $FileUploadStatus7) {
            $Sql_input = "UPDATE vehicle SET RC = '" . $image_thumb_name . "'  ,  PollutionCheck = '" . $imagemain_name . "',  PermitFile = '" . $imagemain_name1 . "',  Fitness = '" . $imagemain_name2 . "',  Insurance = '" . $imagemain_name3 . "', AadharCard ='" . $imageaadhar_name . "' ,PAN ='" . $imagepan_name . "' where VehicleID = '$id'";
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
//                echo $RGVP->DB->Response;

            header("location:../vehicle-view.php?txt_id=" . $id);
        }

//        header("location:../vehicle.php");

        break;
    case "UPDATE-SAVE":
        // AJAX EDIT FROM JQUERY
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
            // SAVE DATA
            for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
            $Sql_input = " UPDATE $sTable SET $UpdateColDataString WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");

            // GET DATA
            $Sql_input = "SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
            die(json_encode(mysqli_fetch_assoc($Sql_output)));
        }
        break;
    case "UPDATE":
        if (isset($posted["id"]) && 0 < intval($posted["id"])) {
            // SAVE DATA
            $id = $posted["id"];
            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/vehicle/" . $id . "/";
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            $FileUploadStatus = FALSE;

            if (file_exists($_FILES["txt_RC"]["tmp_name"])) {
                $imagethumb_file_upload = basename($_FILES["txt_RC"]["name"]);
                $Extension = pathinfo($imagethumb_file_upload, PATHINFO_EXTENSION);
                $imagethumb_dir = $path;
                $imagethumb_file = "RC." . $Extension;
                $imagethumb_file_path = $imagethumb_dir . $imagethumb_file;

                if (move_uploaded_file($_FILES["txt_RC"]["tmp_name"], $imagethumb_file_path)) {
                    $FileUploadStatus = TRUE;
                    $posted["txt_RC"] = $imagethumb_file;
                } else {
                    $FileUploadStatus = FALSE;
                    $posted["txt_RC"] = $posted["txt_RC-name"];
                    echo "File Logo Upload Error.";
                }
            } else {
                $posted["txt_RC"] = $posted["txt_RC-name"];
                echo "File Logo Upload Error..";
            }
            if (file_exists($_FILES["txt_PollutionCheck"]["tmp_name"])) {
                $imagemain_image_upload = basename($_FILES["txt_PollutionCheck"]["name"]);
                $Extension = pathinfo($imagemain_image_upload, PATHINFO_EXTENSION);
                $imagemain_image_dir = $path;
                $imagemain_image_name = "PollutionCheck." . $Extension;
                $imagemain_image_path = $imagemain_image_dir . $imagemain_image_name;

                if (move_uploaded_file($_FILES["txt_PollutionCheck"]["tmp_name"], $imagemain_image_path)) {
                    $FileUploadStatus1 = TRUE;
                    $posted["txt_PollutionCheck"] = $imagemain_image_name;
                } else {
                    echo "File Banner Upload Error.";
                    $FileUploadStatus1 = FALSE;
                    $posted["txt_PollutionCheck"] = $posted["txt_PollutionCheck-name"];
                }
            } else {
                echo "File Banner Upload Error..";
                $posted["txt_PollutionCheck"] = $posted["txt_PollutionCheck-name"];
            }
            if (file_exists($_FILES["txt_PermitFile"]["tmp_name"])) {
                $imagemain_image_upload1 = basename($_FILES["txt_PermitFile"]["name"]);
                $Extension1 = pathinfo($imagemain_image_upload1, PATHINFO_EXTENSION);
                $imagemain_image_dir1 = $path;
                $imagemain_image_name1 = "PermitFile." . $Extension1;
                $imagemain_image_path1 = $imagemain_image_dir1 . $imagemain_image_name1;

                if (move_uploaded_file($_FILES["txt_PermitFile"]["tmp_name"], $imagemain_image_path1)) {
                    $FileUploadStatus2 = TRUE;
                    $posted["txt_PermitFile"] = $imagemain_image_name1;
                } else {
                    echo "File Banner Upload Error.";
                    $FileUploadStatus2 = FALSE;
                    $posted["txt_PermitFile"] = $posted["txt_PermitFile-name"];
                }
            } else {
                echo "File Banner Upload Error..";
                $posted["txt_PermitFile"] = $posted["txt_PermitFile-name"];
            }
            if (file_exists($_FILES["txt_Fitness"]["tmp_name"])) {
                $imagemain_image_upload2 = basename($_FILES["txt_Fitness"]["name"]);
                $Extension2 = pathinfo($imagemain_image_upload2, PATHINFO_EXTENSION);
                $imagemain_image_dir2 = $path;
                $imagemain_image_name2 = "Fitness." . $Extension2;
                $imagemain_image_path2 = $imagemain_image_dir2 . $imagemain_image_name2;

                if (move_uploaded_file($_FILES["txt_Fitness"]["tmp_name"], $imagemain_image_path2)) {
                    $FileUploadStatus3 = TRUE;
                    $posted["txt_Fitness"] = $imagemain_image_name2;
                } else {
                    echo "File Banner Upload Error.";
                    $FileUploadStatus3 = FALSE;
                    $posted["txt_Fitness"] = $posted["txt_Fitness-name"];
                }
            } else {
                echo "File Banner Upload Error..";
                $posted["txt_Fitness"] = $posted["txt_Fitness-name"];
            }

            if (file_exists($_FILES["txt_Insurance"]["tmp_name"])) {
                $imagemain_image_upload3 = basename($_FILES["txt_Insurance"]["name"]);
                $Extension3 = pathinfo($imagemain_image_upload3, PATHINFO_EXTENSION);
                $imagemain_image_dir3 = $path;
                $imagemain_image_name3 = "Insurance." . $Extension3;
                $imagemain_image_path3 = $imagemain_image_dir3 . $imagemain_image_name3;

                if (move_uploaded_file($_FILES["txt_Insurance"]["tmp_name"], $imagemain_image_path3)) {
                    $FileUploadStatus4 = TRUE;
                    $posted["txt_Insurance"] = $imagemain_image_name3;
                } else {
                    echo "File Banner Upload Error.";
                    $FileUploadStatus4 = FALSE;
                    $posted["txt_Insurance"] = $posted["txt_Insurance-name"];
                }
            } else {
                echo "File Banner Upload Error..";
                $posted["txt_Insurance"] = $posted["txt_Insurance-name"];
            }
            if (file_exists($_FILES["txt_AadharCard"]["tmp_name"])) {
                $imagemain_image_upload3 = basename($_FILES["txt_AadharCard"]["name"]);
                $Extension3 = pathinfo($imagemain_image_upload3, PATHINFO_EXTENSION);
                $imagemain_image_dir3 = $path;
                $imagemain_image_name3 = "AadharCard." . $Extension3;
                $imagemain_image_path3 = $imagemain_image_dir3 . $imagemain_image_name3;

                if (move_uploaded_file($_FILES["txt_AadharCard"]["tmp_name"], $imagemain_image_path3)) {
                    $FileUploadStatus4 = TRUE;
                    $posted["txt_AadharCard"] = $imagemain_image_name3;
                } else {
                    echo "File Banner Upload Error.";
                    $FileUploadStatus4 = FALSE;
                    $posted["txt_AadharCard"] = $posted["txt_AadharCard-name"];
                }
            } else {
                echo "File Banner Upload Error..";
                $posted["txt_AadharCard"] = $posted["txt_AadharCard-name"];
            }
            if (file_exists($_FILES["txt_PAN"]["tmp_name"])) {
                $imagemain_image_upload3 = basename($_FILES["txt_PAN"]["name"]);
                $Extension3 = pathinfo($imagemain_image_upload3, PATHINFO_EXTENSION);
                $imagemain_image_dir3 = $path;
                $imagemain_image_name3 = "PAN." . $Extension3;
                $imagemain_image_path3 = $imagemain_image_dir3 . $imagemain_image_name3;

                if (move_uploaded_file($_FILES["txt_PAN"]["tmp_name"], $imagemain_image_path3)) {
                    $FileUploadStatus4 = TRUE;
                    $posted["txt_PAN"] = $imagemain_image_name3;
                } else {
                    echo "File Banner Upload Error.";
                    $FileUploadStatus4 = FALSE;
                    $posted["txt_PAN"] = $posted["txt_PAN-name"];
                }
            } else {
                echo "File Banner Upload Error..";
                $posted["txt_PAN"] = $posted["txt_PAN-name"];
            }

            for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
            $Sql_input = "UPDATE $sTable SET $sTable.$UpdateColDataString WHERE $sIndexColumn = " . intval($posted["id"]);

            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
        }
        header("location:../vehicle-view.php?txt_id=" . $id . "&Msg=Your Data is Updated Succesfully");
        break;

    case "DELETE":
        // AJAX REMOVE FROM JQUERY
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
            //dbinit($gaSql);
            // REMOVE DATA
//            $Sql_input = " DELETE FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_input = "update vehicle set Status='Inactive' WHERE $sIndexColumn = " . intval($_GET["id"]);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "DELETE");
            if ($RGVP->DB->StatusCode == "501" || $RGVP->DB->StatusCode == "503") {
                echo $RGVP->DB->Exception . $RGVP->DB->Msg;
            }
        }

        break;
    case "SELECT-WITH-ID":
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
            $Sql_input = "SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . intval($_GET["id"]);
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
                    $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVPDBCon, $_GET["sSearch"]) . "%' OR ";
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
                $sWhere .= $SelectColumns[$i] . " LIKE '%" . mysqli_real_escape_string($RGVPDBCon, $_GET["sSearch_" . $i]) . "%' ";
            }
        }
        // FETCH
        $sQueryDisplay = "";
        $sQuery = " SELECT " . implode(",", $SelectColumns) . " FROM $sTable $sWhere $sOrder $sLimit ";
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
            $output["data"][] = array_merge(array('<a href="vehicle-view?txt_id=' . $row[0] . '" class="btn btn-warning" ><i class="fa fa-eye"></i></a>'), $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output, JSON_PARTIAL_OUTPUT_ON_ERROR))); // . $sQueryDisplay);
        //echo "";
        break;
    default:
        echo "Invalid Command.";
        break;
}
