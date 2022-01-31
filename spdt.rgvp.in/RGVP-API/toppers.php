<?php include "include.php";// VARIABLES
                        $SelectColumns = array("toppersID","Name","Exam","Percentage_CGPA","DepartmentID","OrderBy","Photo","Year","AddedBy","UpdateBy","AddedDate","UpdateDate"); // array("id", "name", "email", "mobile", "start_date");
                        $InsertColumns = array("Name","Exam","Percentage_CGPA","DepartmentID","OrderBy","Photo","Year","AddedBy","UpdateBy");
                        $UpdateColumns = array("Name","Exam","Percentage_CGPA","DepartmentID","OrderBy","Photo","Year","AddedBy","UpdateBy");
                        $InsertColumnsData = array("txt_Name","txt_Exam","txt_Percentage_CGPA","txt_DepartmentID","txt_OrderBy","txt_Photo","txt_Year","txt_AddedBy","txt_UpdateBy");
                        $ColumnAPIUpdateData = array("txt_Name","txt_Exam","txt_Percentage_CGPA","txt_DepartmentID","txt_OrderBy","txt_Photo","txt_Year","txt_AddedBy","txt_UpdateBy");
                        $InsertColDataString = "";
                        $UpdateColDataString = "";
                        $sIndexColumn = "toppersID";
                        $sTable = "toppers";
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
                                // AJAX ADD FROM JQUERY
                                if (isset($_REQUEST)) {
                                    $posted["txt_Photo"] = "";
            
                                    //dbinit($gaSql);
                                    foreach ($InsertColumnsData as $FieldData)
                                        $InsertColDataString .= "'".$posted[$FieldData]."',";
                                    $InsertColDataString = substr($InsertColDataString, 0, strlen($InsertColDataString)-1);
                             $Sql_input = "INSERT INTO $sTable (".implode(",", $InsertColumns).") VALUES ($InsertColDataString)";
                                    $Sql_input = str_replace(",,", ",'',", $Sql_input);
                                    $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "INSERT"); 
                                    $id = $RGVP->DB->PrimaryKeyID;
                                    
                                     $path = $_SERVER['DOCUMENT_ROOT'] . "/images/toppers/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus = FALSE;
            $logo_name = basename($_FILES["txt_Photo"]["name"]);
            //$photo_location = $photo_name;
            $Extension = pathinfo($logo_name, PATHINFO_EXTENSION);


            $logo_name = "Photo." . $Extension;
            $logo_file_path = $path . $logo_name;

            if (file_exists($logo_file_path))
                unlink($logo_file_path);
            if (move_uploaded_file($_FILES["txt_Photo"]["tmp_name"], $logo_file_path))
             $FileUploadStatus = TRUE;
            else
             $FileUploadStatus = FALSE;
                
     if ($FileUploadStatus) {
            $Sql_input = "UPDATE toppers SET Photo = '" . $logo_name . "'  where toppersID = '$id'";
                $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
//                echo $RGVP->DB->Response;
            }
                                }
                              header("location:../toppers.php");
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
                                    die(json_encode(mysqli_fetch_assoc($Sql_output)));
                                }
                                break;
                                
                                
                                  case "UPDATE":
 if (isset($posted["id"]) && 0 < intval($posted["id"])) {
            // SAVE DATA
            $id = $posted["txt_toppersID"];
            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/toppers/" . $id . "/";
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
           
            
            for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
       $Sql_input = "UPDATE $sTable SET $sTable.$UpdateColDataString WHERE $sIndexColumn = " . intval($posted["id"]);

            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
        }
      header("location:../toppers.php");
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
                                    $output["data"][] = array_merge( array('<a href="view-toppers.php?ID=' . $row[0] . '" class="btn btn-warning" ><i class="fa fa-eye"></i></a>&nbsp;<a href="javascript:removeRow(' . $row[0] . ');" class="btn btn-danger" ><i class="fa fa-close"></i></a>'),$row,$row);
                                }
                                // RETURN IN JSON
                                die(trim(json_encode($output))); // . $sQueryDisplay);
                                //echo "";
                                break;
                        default:
                                echo "Invalid Command.";
                                break;
                        }