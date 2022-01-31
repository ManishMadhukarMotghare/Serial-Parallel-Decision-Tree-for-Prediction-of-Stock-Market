<?php

include "include.php"; // VARIABLES
$SelectColumns = array("EmployeeID", "Name", "Phone", "EmailID", "Password", "Address", "City", "State", "Country", "Photo", "Branch", "BloodGroup", "AadharCard", "AadharNo", "EmployeeType", "Designation", "Salary", "Conveyance", "Incentives", "License", "LicenseNo", "LicenseExpiryDate", "StationedAt", "StationedStatus", "Role", "CasualLeaves", "MedicalLeaves", "PANNo", "GSTNo", "PFNO", "PTNo", "AccountNo", "AccountIFSC", "AccountBank", "AccountBranch", "AccountType", "DOJ", "DOB", "DOA", "StatusDate", "Status", "AddedBy", "AddedDate", "UpdateBy", "UpdateDate"); // array("id", "name", "email", "mobile", "start_date");
$InsertColumns = array("Name", "Phone", "EmailID", "Password", "Address", "City", "State", "Country", "Photo", "Branch", "BloodGroup", "AadharCard", "AadharNo", "EmployeeType", "Designation", "Salary", "Conveyance", "Incentives", "License", "LicenseNo", "LicenseExpiryDate", "StationedAt", "StationedStatus", "Role", "CasualLeaves", "MedicalLeaves", "PANNo", "GSTNo", "PFNO", "PTNo", "AccountNo", "AccountIFSC", "AccountBank", "AccountBranch", "AccountType", "DOJ", "DOB", "DOA", "StatusDate", "Status", "AddedBy", "UpdateBy");
$UpdateColumns = array("Name", "Phone", "EmailID", "Password", "Address", "City", "State", "Country", "Photo", "Branch", "BloodGroup", "AadharCard", "AadharNo", "EmployeeType", "Designation", "Salary", "Conveyance", "Incentives", "License", "LicenseNo", "LicenseExpiryDate", "StationedAt", "StationedStatus", "Role", "CasualLeaves", "MedicalLeaves", "PANNo", "GSTNo", "PFNO", "PTNo", "AccountNo", "AccountIFSC", "AccountBank", "AccountBranch", "AccountType", "DOJ", "DOB", "DOA", "StatusDate", "Status", "AddedBy", "UpdateBy");
$InsertColumnsData = array("txt_Name", "txt_Phone", "txt_EmailID", "txt_Password", "txt_Address", "txt_City", "txt_State", "txt_Country", "txt_Photo", "txt_Branch", "ddl_BloodGroup", "txt_AadharCard", "txt_AadharNo", "ddl_EmployeeType", "txt_Designation", "txt_Salary", "txt_Conveyance", "txt_Incentives", "txt_License", "txt_LicenseNo", "date_LicenseExpiryDate", "txt_StationedAt", "txt_StationedStatus", "txt_Role", "txt_CasualLeaves", "txt_MedicalLeaves", "txt_PANNo", "txt_GSTNo", "txt_PFNO", "txt_PTNo", "txt_AccountNo", "txt_AccountIFSC", "txt_AccountBank", "txt_AccountBranch", "ddl_AccountType", "date_DOJ", "date_DOB", "date_DOA", "date_StatusDate", "ddl_Status", "txt_AddedBy", "txt_UpdateBy");
$ColumnAPIUpdateData = array("txt_Name", "txt_Phone", "txt_EmailID", "txt_Password", "txt_Address", "txt_City", "txt_State", "txt_Country", "txt_Photo", "txt_Branch", "ddl_BloodGroup", "txt_AadharCard", "txt_AadharNo", "ddl_EmployeeType", "txt_Designation", "txt_Salary", "txt_Conveyance", "txt_Incentives", "txt_License", "txt_LicenseNo", "date_LicenseExpiryDate", "txt_StationedAt", "txt_StationedStatus", "txt_Role", "txt_CasualLeaves", "txt_MedicalLeaves", "txt_PANNo", "txt_GSTNo", "txt_PFNO", "txt_PTNo", "txt_AccountNo", "txt_AccountIFSC", "txt_AccountBank", "txt_AccountBranch", "ddl_AccountType", "date_DOJ", "date_DOB", "date_DOA", "date_StatusDate", "ddl_Status", "txt_AddedBy", "txt_UpdateBy");
$InsertColDataString = "";
$UpdateColDataString = "";
$sIndexColumn = "EmployeeID";
$sTable = "employee";
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


            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/employee/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus1 = FALSE;
            $image_thumb_name = basename($_FILES["txt_Photo"]["name"]);
            //$photo_location = $photo_name;
            $Extension = pathinfo($image_thumb_name, PATHINFO_EXTENSION);


            $image_thumb_name = "Photo." . $Extension;
            $image_thumb_file_path = $path . $image_thumb_name;

            if (file_exists($image_thumb_file_path))
                unlink($image_thumb_file_path);
            if (move_uploaded_file($_FILES["txt_Photo"]["tmp_name"], $image_thumb_file_path))
                echo $FileUploadStatus1 = TRUE;
            else
                echo $FileUploadStatus1 = FALSE;


            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/employee/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus2 = FALSE;
            $imageaadhar_name = basename($_FILES["txt_AadharCard"]["name"]);
            //$photo_location = $photo_name;
            $Extension = pathinfo($imageaadhar_name, PATHINFO_EXTENSION);


            $imageaadhar_name = "AadharCard." . $Extension;
            $imageaadhar_file_path = $path . $imageaadhar_name;

            if (file_exists($imageaadhar_file_path))
                unlink($imageaadhar_file_path);
            if (move_uploaded_file($_FILES["txt_AadharCard"]["tmp_name"], $imageaadhar_file_path))
                echo $FileUploadStatus2 = TRUE;
            else
                echo $FileUploadStatus2 = FALSE;


            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/employee/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus3 = FALSE;
            $imagemain_name = basename($_FILES["txt_License"]["name"]);
            //$photo_location = $photo_name;
            $Extension = pathinfo($imagemain_name, PATHINFO_EXTENSION);


            $imagemain_name = "Lisence." . $Extension;
            $imagemain_file_path = $path . $imagemain_name;

            if (file_exists($imagemain_file_path))
                unlink($imagemain_file_path);
            if (move_uploaded_file($_FILES["txt_License"]["tmp_name"], $imagemain_file_path)) {
                echo $FileUploadStatus3 = TRUE;
            } else {
                echo $FileUploadStatus3 = FALSE;
            }
            if ($FileUploadStatus1 && $FileUploadStatus2 && $FileUploadStatus3) {
                $Sql_input = "UPDATE employee SET Photo = '" . $image_thumb_name . "'  , AadharCard ='" . $imageaadhar_name . "' , Lisence = '" . $imagemain_name . "'   where EmployeeID = '$id'";
                $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
//                echo $RGVP->DB->Response;
            }
            header("location:../employee-view.php?txt_id=" . $id . "&submit=submit");
//            $Sql_output = $RGVP->DB->Execute_Query("SELECT " . implode(",", $SelectColumns) . " FROM $sTable WHERE $sIndexColumn = " . $id, "GET", "SQLObj");
//            die(json_encode(mysqli_fetch_assoc($Sql_output)));
        }

//        header("location:../Employee.php");

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
            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/employee/" . $id . "/";
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            $FileUploadStatus = FALSE;

            if (file_exists($_FILES["txt_Photo"]["tmp_name"])) {
                $imagethumb_file_upload = basename($_FILES["txt_Photo"]["name"]);
                $Extension = pathinfo($imagethumb_file_upload, PATHINFO_EXTENSION);
                $imagethumb_dir = $path;
                $imagethumb_file = "Photo." . $Extension;
                $imagethumb_file_path = $imagethumb_dir . $imagethumb_file;

                if (move_uploaded_file($_FILES["txt_Photo"]["tmp_name"], $imagethumb_file_path)) {
                    $FileUploadStatus = TRUE;
                    $posted["txt_Photo"] = $imagethumb_file;
                } else {
                    $FileUploadStatus = FALSE;
                    $posted["txt_Photo"] = $posted["txt_Photo-name"];
                    echo "File Logo Upload Error.";
                }
            } else {
                $posted["txt_Photo"] = $posted["txt_Photo-name"];
                echo "File Logo Upload Error..";
            }


            if (file_exists($_FILES["txt_AadharCard"]["tmp_name"])) {
                $imageaadhar_image_upload = basename($_FILES["txt_AadharCard"]["name"]);
                $Extension = pathinfo($imageaadhar_image_upload, PATHINFO_EXTENSION);
                $imageaadhar_image_dir = $path;
                $imageaadhar_image_name = "AadharCard." . $Extension;
                $imageaadhar_image_path = $imageaadhar_image_dir . $imageaadhar_image_name;

                if (move_uploaded_file($_FILES["txt_AadharCard"]["tmp_name"], $imageaadhar_image_path)) {
                    $FileUploadStatus1 = TRUE;
                    $posted["txt_AadharCard"] = $imageaadhar_image_name;
                } else {
                    echo "File Banner Upload Error.";
                    $FileUploadStatus1 = FALSE;
                    $posted["txt_AadharCard"] = $posted["txt_AadharCard-name"];
                }
            } else {
                echo "File Banner Upload Error..";
                $posted["txt_AadharCard"] = $posted["txt_AadharCard-name"];
            }


            if (file_exists($_FILES["txt_Lisence"]["tmp_name"])) {
                $imagemain_image_upload = basename($_FILES["txt_Lisence"]["name"]);
                $Extension = pathinfo($imagemain_image_upload, PATHINFO_EXTENSION);
                $imagemain_image_dir = $path;
                $imagemain_image_name = "Lisence." . $Extension;
                $imagemain_image_path = $imagemain_image_dir . $imagemain_image_name;

                if (move_uploaded_file($_FILES["txt_Lisence"]["tmp_name"], $imagemain_image_path)) {
                    $FileUploadStatus2 = TRUE;
                    $posted["txt_Lisence"] = $imagemain_image_name;
                } else {
                    echo "File Banner Upload Error.";
                    $FileUploadStatus2 = FALSE;
                    $posted["txt_Lisence"] = $posted["txt_Lisence-name"];
                }
            } else {
                echo "File Banner Upload Error..";
                $posted["txt_Lisence"] = $posted["txt_Lisence-name"];
            }


            for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
            $Sql_input = "UPDATE $sTable SET $sTable.$UpdateColDataString WHERE $sIndexColumn = " . intval($posted["id"]);

            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
        }
        header("location:../employee-view.php?txt_id=" . $id . "&submit=submit&msg=Your Data Updated Successfully");
        break;


    case "DELETE":
        // AJAX REMOVE FROM JQUERY
        if (isset($_GET["id"]) && 0 < intval($_GET["id"])) {
            //dbinit($gaSql);
            // REMOVE DATA
            $Sql_input = "update employee set Status='Inactive' WHERE $sIndexColumn = " . intval($_GET["id"]);
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
            $output["data"][] = array_merge(array('<a href="employee-view.php?txt_id=' . $row[0] . '" class="btn btn-warning" ><i class="fa fa-eye"></i></a>&nbsp;'), $row, $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
    default:
        echo "Invalid Command.";
        break;
}