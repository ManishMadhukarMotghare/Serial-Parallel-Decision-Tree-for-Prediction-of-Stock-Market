<?php

include "include.php"; // VARIABLES
$SelectColumns = array("PODID", "DrsNo", "DrsID", "DocketNo", "DocketID", "ReceiverName", "ReceiverPhone", "POD", "DeliveryDate", "Status", "AddedBy", "UpdateBy"); // array("id", "name", "email", "mobile", "start_date");
$InsertColumns = array("DrsNo", "DrsID", "DocketNo", "DocketID", "ReceiverName", "ReceiverPhone", "POD", "DeliveryDate", "Status", "AddedBy", "UpdateBy");
$InsertColumnsDelivered = array("DrsNo", "DrsID", "DocketNo", "DocketID", "ReceiverName", "ReceiverPhone", "POD", "DeliveryDate", "Status", "AddedBy", "UpdateBy");
$InsertColumnsNotDelivered = array("DrsNo", "DrsID", "DocketNo", "DocketID", "ReceiverName", "ReceiverPhone", "POD", "DeliveryDate", "Status", "AddedBy", "UpdateBy");
$InsertColumnsDataNotDelivered = array("txt_DrsNo", "txt_DrsID", "txt_DocketNo", "txt_DocketID", "txt_ReceiverName1", "txt_ReceiverPhone", "txt_uploadfile", "txt_ClosingTime", "txt_Status", "txt_AddedBy", "txt_UpdateBy");
$UpdateColumns = array("DrsNo", "DrsID", "DocketNo", "DocketID", "ReceiverName", "ReceiverPhone", "POD", "DeliveryDate", "Status", "AddedBy", "UpdateBy");
$UpdateColumnsDelivered = array("DrsNo", "DrsID", "DocketNo", "DocketID", "ReceiverName", "ReceiverPhone", "POD", "DeliveryDate", "Status");
$UpdateColumnsNotDelivered = array("DrsNo", "DrsID", "DocketNo", "DocketID", "ReceiverName", "ReceiverPhone", "POD", "DeliveryDate", "Status");
$UpdateColumnsDataDeliverd = array("txt_DrsNo", "txt_DrsID", "txt_DocketNo", "txt_DocketID", "txt_ReceiverName", "txt_ReceiverPhone", "txt_uploadfile", "txt_ClosingTime", "txt_Status", "txt_AddedBy", "txt_UpdateBy");
$UpdateColumnsDataNotDeliverd = array("txt_DrsNo", "txt_DrsID", "txt_DocketNo", "txt_DocketID", "txt_ReceiverName", "txt_ReceiverPhone", "txt_uploadfile", "txt_ClosingTime", "txt_Status", "txt_AddedBy", "txt_UpdateBy");
$InsertColumnsData = array("txt_DrsNo", "txt_DrsID", "txt_DocketNo", "txt_DocketID", "txt_ReceiverName", "txt_ReceiverPhone", "txt_uploadfile", "txt_ClosingTime", "txt_Status", "txt_AddedBy", "txt_UpdateBy");
$InsertColumnsDataDelivered = array("txt_DrsNo", "txt_DrsID", "txt_DocketNo", "txt_DocketID", "txt_ReceiverName", "txt_ReceiverPhone", "txt_uploadfile", "txt_ClosingTime", "txt_Status", "txt_AddedBy", "txt_UpdateBy");
$ColumnAPIUpdateData = array("txt_DrsNo", "txt_DrsID", "txt_DocketNo", "txt_DocketID","txt_ReceiverName", "txt_ReceiverPhone", "txt_uploadfile", "txt_ClosingTime", "txt_Status", "txt_AddedBy", "txt_UpdateBy");
$ColumnAPIUpdateDataNotDelivered = array("txt_DrsNo", "txt_DrsID", "txt_DocketNo", "txt_DocketID","txt_ReceiverName1", "txt_ReceiverPhone", "txt_uploadfile", "txt_ClosingTime", "txt_Status", "txt_AddedBy", "txt_UpdateBy");
$InsertColDataString = "";
$UpdateColDataString = "";
$sIndexColumn = "PODID";
$sTable = "pod";
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
            $DrsID = $posted['txt_DrsID'];
            $DocketID = $posted['txt_DocketID'];
            $DocketStatus = $posted['txt_Status'];
            $DocketClosingTime = $posted['txt_ClosingTime'];

            if ($posted['txt_Status'] == "Delivered") {
                foreach ($InsertColumnsDataDelivered as $FieldData)
                    $InsertColDataString .= "'" . $posted[$FieldData] . "',";
                $InsertColDataString = substr($InsertColDataString, 0, strlen($InsertColDataString) - 1);
                $Sql_input = "INSERT INTO $sTable (" . implode(",", $InsertColumnsDelivered) . ") VALUES ($InsertColDataString)";
                //  $Sql_input = 'INSERT INTO pod ("DrsNo","DrsID","DocketNo","DocketID","ReceiverName","ReceiverPhone","POD","DeliveryDate","Status","AddedBy","UpdateBy") VALUES ("txt_DrsNo","txt_DrsID","txt_DocketNo","txt_DocketID","txt_ReceiverName","txt_ReceiverPhone","txt_uploadfile","txt_ClosingTime","txt_Status","txt_AddedBy","txt_UpdateBy")';
            } else if ($posted['txt_Status'] == "Not Delivered") {
                $posted['txt_ReceiverName'] = " ";
                $posted['txt_ReceiverPhone'] = " ";
                $posted['txt_uploadfile'] = " ";
                foreach ($InsertColumnsDataNotDelivered as $FieldData)
                    $InsertColDataString .= "'" . $posted[$FieldData] . "',";
                $InsertColDataString = substr($InsertColDataString, 0, strlen($InsertColDataString) - 1);
                $Sql_input = "INSERT INTO $sTable (" . implode(",", $InsertColumnsNotDelivered) . ") VALUES ($InsertColDataString)";
                //  $Sql_input = 'INSERT INTO pod ("DrsNo","DrsID","DocketNo","DocketID","ReceiverName","ReceiverPhone","POD","DeliveryDate","Status","AddedBy","UpdateBy") VALUES ("txt_DrsNo","txt_DrsID","txt_DocketNo","txt_DocketID","txt_ReceiverName1","txt_ReceiverPhone","txt_uploadfile","txt_ClosingTime","txt_Status","txt_AddedBy","txt_UpdateBy")'; 
            }
//                                    $Sql_input = "INSERT INTO $sTable (".implode(",", $InsertColumns).") VALUES ($InsertColDataString)";
            $Sql_input = str_replace(",,", ",'',", $Sql_input);
            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "INSERT");
            $id = $RGVP->DB->PrimaryKeyID;
            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/pod/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus1 = FALSE;
            $image_thumb_name = basename($_FILES["txt_uploadfile"]["name"]);
            //$photo_location = $photo_name;
            $Extension = pathinfo($image_thumb_name, PATHINFO_EXTENSION);


            $image_thumb_name = $DocketID . "." . $Extension;
            $image_thumb_file_path = $path . $image_thumb_name;

            if (file_exists($image_thumb_file_path))
                unlink($image_thumb_file_path);
            if (move_uploaded_file($_FILES["txt_uploadfile"]["tmp_name"], $image_thumb_file_path))
                echo $FileUploadStatus1 = TRUE;
            else
                echo $FileUploadStatus1 = FALSE;
            if ($FileUploadStatus1) {
                $Sql_input2 = "UPDATE pod SET POD = '" . $image_thumb_name . "'  where PODID = '$id'";
                $Sql_output2 = $RGVP->DB->Execute_Query($Sql_input2, "SET", "UPDATE");
                $Sql_input3 = "UPDATE docket SET POD = '" . $image_thumb_name . "'  where DocketID = '$DocketID'";
                $Sql_output3 = $RGVP->DB->Execute_Query($Sql_input3, "SET", "UPDATE");
            }

            $Query = "UPDATE docket SET Status ='$DocketStatus',DeliveredDate='$DocketClosingTime' WHERE DocketID=$DocketID";
            $Sql_output1 = $RGVP->DB->Execute_Query($Query, "SET", "UPDATE");
            header("location:../Closed-drs.php?txt_id=$DrsID");
        }
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
    case "UPDATE":
        if (isset($posted["id"]) && 0 < intval($posted["id"])) {
            $id = $posted["id"];
            $DrsID = $posted['txt_DrsID'];
            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/pod/";
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            $FileUploadStatus = FALSE;

            if (file_exists($_FILES["txt_uploadfile"]["tmp_name"])) {
                $imagethumb_file_upload = basename($_FILES["txt_uploadfile"]["name"]);
                $Extension = pathinfo($imagethumb_file_upload, PATHINFO_EXTENSION);
                $imagethumb_dir = $path;
                $imagethumb_file = $id . "." . $Extension;
                $imagethumb_file_path = $imagethumb_dir . $imagethumb_file;

                if (move_uploaded_file($_FILES["txt_uploadfile"]["tmp_name"], $imagethumb_file_path)) {
                    $FileUploadStatus = TRUE;
                    $posted["txt_uploadfile"] = $imagethumb_file;
                } else {
                    $FileUploadStatus = FALSE;
                    $posted["txt_uploadfile"] = $posted["txt_uploadfile-name"];
                    echo "File Logo Upload Error.";
                }
            } else {
                $posted["txt_uploadfile"] = $posted["txt_uploadfile-name"];
                echo "File Logo Upload Error..";
            }
            if ($posted['txt_Status'] == "Delivered") {
                for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                    $UpdateColDataString .= $UpdateColumnsDelivered[$j] . " = '" . $posted[$UpdateColumnsDataDeliverd[$j]] . "',";
                $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
                $Sql_input = "UPDATE $sTable SET $UpdateColDataString WHERE $sIndexColumn = " . intval($_GET["id"]);

                $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
            } else if ($posted['txt_Status'] == "Not Delivered") {
                 $UpdateColDataString .= $UpdateColumnsNotDelivered[$j] . " = '" . $posted[$UpdateColumnsDataNotDeliverd[$j]] . "',";
                $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
                $Sql_input = "UPDATE $sTable SET $UpdateColDataString WHERE $sIndexColumn = " . intval($_GET["id"]);

                $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
            }
            header("location:../Closed-drs.php?txt_id=$DrsID");
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
            $output["data"][] = array_merge($row, array('<a data-id="row-' . $row[0] . '" href="javascript:editRow(' . $row[0] . ');" class="btn btn-success"><i class="fa fa-edit"></i></a>&nbsp;<a href="javascript:removeRow(' . $row[0] . ');" class="btn btn-danger" ><i class="fa fa-close"></i></a>'), $row);
        }
        // RETURN IN JSON
        die(trim(json_encode($output))); // . $sQueryDisplay);
        //echo "";
        break;
    default:
        echo "Invalid Command.";
        break;
}