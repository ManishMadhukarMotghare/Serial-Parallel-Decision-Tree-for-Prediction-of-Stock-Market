<?php include "include.php";// VARIABLES
                        $SelectColumns = array("PlacedID","CompanyName","CompanyLogo","StudentName","StudentPhoto","Package","DepartmentID","OrderBy","AddedBy","UpdateBy","AddedDate","UpdateDate"); // array("id", "name", "email", "mobile", "start_date");
                        $InsertColumns = array("CompanyName","CompanyLogo","StudentName","StudentPhoto","Package","DepartmentID","OrderBy","AddedBy","UpdateBy");
                        $UpdateColumns = array("CompanyName","CompanyLogo","StudentName","StudentPhoto","Package","DepartmentID","OrderBy","AddedBy","UpdateBy");
                        $InsertColumnsData = array("txt_CompanyName","txt_CompanyLogo","txt_StudentName","txt_StudentPhoto","txt_Package","txt_DepartmentID","txt_OrderBy","txt_AddedBy","txt_UpdateBy");
                        $ColumnAPIUpdateData = array("txt_CompanyName","txt_CompanyLogo","txt_StudentName","txt_StudentPhoto","txt_Package","txt_DepartmentID","txt_OrderBy","txt_AddedBy","txt_UpdateBy");
                        $InsertColDataString = "";
                        $UpdateColDataString = "";
                        $sIndexColumn = "PlacedID";
                        $sTable = "placedstudents";
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
                                    //dbinit($gaSql);
                                    foreach ($InsertColumnsData as $FieldData)
                                        $InsertColDataString .= "'".$posted[$FieldData]."',";
                                    $InsertColDataString = substr($InsertColDataString, 0, strlen($InsertColDataString)-1);
                             echo       $Sql_input = "INSERT INTO $sTable (".implode(",", $InsertColumns).") VALUES ($InsertColDataString)";
                                    $Sql_input = str_replace(",,", ",'',", $Sql_input);
                                    $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "INSERT"); 
                                    $id = $RGVP->DB->PrimaryKeyID;
//                                    $Sql_output = $RGVP->DB->Execute_Query("SELECT ".implode(",",$SelectColumns)." FROM $sTable WHERE $sIndexColumn = " . $id, "GET", "SQLObj");
//                                    die(json_encode(mysqli_fetch_assoc($Sql_output)));
                                    
                                     $path = $_SERVER['DOCUMENT_ROOT'] . "/images/company/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus = FALSE;
            $logo_name = basename($_FILES["txt_CompanyLogo"]["name"]);
            //$photo_location = $photo_name;
            $Extension = pathinfo($logo_name, PATHINFO_EXTENSION);


            $logo_name = "LogoImage." . $Extension;
            $logo_file_path = $path . $logo_name;

            if (file_exists($logo_file_path))
                unlink($logo_file_path);
            if (move_uploaded_file($_FILES["txt_CompanyLogo"]["tmp_name"], $logo_file_path))
             $FileUploadStatus = TRUE;
            else
             $FileUploadStatus = FALSE;
            
            
            
             $path1 = $_SERVER['DOCUMENT_ROOT'] . "/images/PlacedStudent/" . $id . "/";
            if (!is_dir($path1))
                mkdir($path1, 0777, true);

            $FileUploadStatus1 = FALSE;
            $banner_name = basename($_FILES["LogoImage"]["name"]);
            //$photo_location = $photo_name;
           $Extension1 = pathinfo($banner_name, PATHINFO_EXTENSION);


            $banner_name = "StudentImage." . $Extension1;
            $banner_file_path = $path1 . $banner_name;

            if (file_exists($banner_file_path))
                unlink($banner_file_path);
            if (move_uploaded_file($_FILES["txt_StudentPhoto"]["tmp_name"], $banner_file_path)){
            $FileUploadStatus1 = TRUE;
                } else {
            $FileUploadStatus1 = FALSE;
                }                  
     if ($FileUploadStatus && $FileUploadStatus1) {
            $Sql_input = "UPDATE placedstudents SET CompanyLogo = '" . $logo_name . "' ,  StudentPhoto = '" . $banner_name . "' where PlacedID = '$id'";
                $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
//                echo $RGVP->DB->Response;
            }
                                }
                              header("location:../placedstudents.php");
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
            $id = $posted["txt_DepartmentID"];
            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/company/" . $id . "/";
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            
            $FileUploadStatus = FALSE;

            if (file_exists($_FILES["txt_CompanyLogo"]["tmp_name"])) {
                $Logo_file_upload = basename($_FILES["txt_CompanyLogo"]["name"]);
                $Extension = pathinfo($Logo_file_upload, PATHINFO_EXTENSION);
                $Logo_dir = $path;
                $Logo_file = "LogoImage." . $Extension;
                $Logo_file_path = $Logo_dir . $Logo_file;

                if (move_uploaded_file($_FILES["txt_CompanyLogo"]["tmp_name"], $Logo_file_path)) {
                    $FileUploadStatus = TRUE;
                    $posted["txt_CompanyLogo"] = $Logo_file;
                } else {
                    $FileUploadStatus = FALSE;
                    $posted["txt_CompanyLogo"] = $posted["txt_CompanyLogo-name"];
                    echo "File Logo Upload Error.";
                }
            } else {
                $posted["txt_CompanyLogo"] = $posted["txt_CompanyLogo-name"];
                echo "File Logo Upload Error..";
            }
            
            $path1 = $_SERVER['DOCUMENT_ROOT'] . "/images/PlacedStudent/" . $id . "/";
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            
            $FileUploadStatus = FALSE;
            if (file_exists($_FILES["txt_StudentPhoto"]["tmp_name"])) {
                $Banner_image_upload = basename($_FILES["txt_StudentPhoto"]["name"]);
                $Extension1 = pathinfo($Banner_image_upload, PATHINFO_EXTENSION);
                $Banner_image_dir = $path1;
                $Banner_image_name = "StudentImage." . $Extension1;
                $Banner_image_path = $Banner_image_dir. $Banner_image_name;

                if (move_uploaded_file($_FILES["txt_StudentPhoto"]["tmp_name"], $Banner_image_path)) {
                    $FileUploadStatus1 = TRUE;
                    $posted["txt_StudentPhoto"] = $Banner_image_name;
                } else {
                    echo "File Banner Upload Error.";
                    $FileUploadStatus1 = FALSE;
                    $posted["txt_StudentPhoto"] = $posted["txt_StudentPhoto-name"];
                }
            } else {
                echo "File Banner Upload Error..";
                $posted["txt_StudentPhoto"] = $posted["txt_StudentPhoto-name"];
            }
            for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
       $Sql_input = "UPDATE $sTable SET $UpdateColDataString WHERE $sIndexColumn = " . intval($posted["id"]);

            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
        }
        header("location:../placedstudents.php");
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
                                    $output["data"][] = array_merge( array('<a href="view-placedstudents.php?ID=' . $row[0] . '" class="btn btn-warning" ><i class="fa fa-eye"></i></a>&nbsp;<a href="javascript:removeRow(' . $row[0] . ');" class="btn btn-danger" ><i class="fa fa-close"></i></a>'),$row,$row);
                                }
                                // RETURN IN JSON
                                die(trim(json_encode($output))); // . $sQueryDisplay);
                                //echo "";
                                break;
                        default:
                                echo "Invalid Command.";
                                break;
                        }