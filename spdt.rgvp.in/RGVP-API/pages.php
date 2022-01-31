<?php include "include.php";// VARIABLES
                        $SelectColumns = array("PageID","PageType","AssociateID","Name","Alias","ImageThumb","ImageMain","ImageBanner","Video","Intro","Discription","OrderID","Status","AddedBy","UpdateBy","AddedDate","UpdateDate"); // array("id", "name", "email", "mobile", "start_date");
                        $InsertColumns = array("PageType","AssociateID","`Name`","Alias","ImageThumb","ImageMain","ImageBanner","Video","Intro","Discription","OrderID","Status","AddedBy","UpdateBy");
                        $UpdateColumns = array("PageType","AssociateID","Name","Alias","ImageThumb","ImageMain","ImageBanner","Video","Intro","Discription","OrderID","Status","AddedBy","UpdateBy");
                        $InsertColumnsData = array("ddl_PageType","txt_AssociateID","txt_Name","txt_Alias","txt_ImageThumb","txt_ImageMain","txt_ImageBanner","txt_Video","txt_Intro","txt_Discription","txt_OrderID","ddl_Status","txt_AddedBy","txt_UpdateBy");
                        $ColumnAPIUpdateData = array("ddl_PageType","txt_AssociateID","txt_Name","txt_Alias","txt_ImageThumb","txt_ImageMain","txt_ImageBanner","txt_Video","txt_Intro","txt_Discription","txt_OrderID","ddl_Status","txt_AddedBy","txt_UpdateBy");
                        $InsertColDataString = "";
                        $UpdateColDataString = "";
                        $sIndexColumn = "PageID";
                        $sTable = "pages";
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
                                    $posted["txt_ImageThumb"] = "";
                                    $posted["txt_ImageMain"] = "";
                                    $posted["txt_ImageBanner"] = "";
                                    //dbinit($gaSql);
                                    foreach ($InsertColumnsData as $FieldData)
                                        $InsertColDataString .= "'".$posted[$FieldData]."',";
                                    $InsertColDataString = substr($InsertColDataString, 0, strlen($InsertColDataString)-1);
                             $Sql_input = "INSERT INTO $sTable (".implode(",", $InsertColumns).") VALUES ($InsertColDataString)";
                                    $Sql_input = str_replace(",,", ",'',", $Sql_input);
                                    $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "INSERT"); 
                                    $id = $RGVP->DB->PrimaryKeyID;
                                    
            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/pages/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus1 = FALSE;
         $image_thumb_name = basename($_FILES["txt_ImageThumb"]["name"]);
            //$photo_location = $photo_name;
            $Extension = pathinfo($image_thumb_name, PATHINFO_EXTENSION);


            $image_thumb_name = "ImageThumb." . $Extension;
            $image_thumb_file_path = $path . $image_thumb_name;

            if (file_exists($image_thumb_file_path))
                unlink($image_thumb_file_path);
            if (move_uploaded_file($_FILES["txt_ImageThumb"]["tmp_name"], $image_thumb_file_path))
           echo  $FileUploadStatus1 = TRUE;
            else
           echo  $FileUploadStatus1 = FALSE;
            
            
            
             $path = $_SERVER['DOCUMENT_ROOT'] . "/images/pages/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus2 = FALSE;
            $imagemain_name = basename($_FILES["txt_ImageMain"]["name"]);
            //$photo_location = $photo_name;
            $Extension = pathinfo($imagemain_name, PATHINFO_EXTENSION);


          $imagemain_name = "ImageMain." . $Extension;
            $imagemain_file_path = $path . $imagemain_name;

            if (file_exists($imagemain_file_path))
                unlink($imagemain_file_path);
            if (move_uploaded_file($_FILES["txt_ImageMain"]["tmp_name"], $imagemain_file_path)){
            echo   $FileUploadStatus2 = TRUE;
                } else {
           echo   $FileUploadStatus2 = FALSE;
                }      
                
            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/pages/" . $id . "/";
            if (!is_dir($path))
                mkdir($path, 0777, true);

            $FileUploadStatus3 = FALSE;
            $imagebanner_name = basename($_FILES["txt_ImageBanner"]["name"]);
            //$photo_location = $photo_name;
            $Extension = pathinfo($imagebanner_name, PATHINFO_EXTENSION);


            $imagebanner_name = "ImageBanner." . $Extension;
            $imagebanner_file_path = $path . $imagebanner_name;

            if (file_exists($imagebanner_file_path))
                unlink($imagebanner_file_path);
            if (move_uploaded_file($_FILES["txt_ImageBanner"]["tmp_name"], $imagebanner_file_path)){
              echo $FileUploadStatus3 = TRUE;
                } else {
           echo   $FileUploadStatus3 = FALSE;
                }  
                
     if ($FileUploadStatus1 && $FileUploadStatus2 && $FileUploadStatus3) {
             $Sql_input = "UPDATE pages SET ImageThumb = '" . $image_thumb_name . "' ,  ImageMain = '" . $imagemain_name . "' , ImageBanner ='".$imagebanner_name."' where PageID = '$id'";
                $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
//                echo $RGVP->DB->Response;
            }
                                }
                              header("location:../pages.php");
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
            $id = $posted["txt_PageID"];
            $path = $_SERVER['DOCUMENT_ROOT'] . "/images/pages/" . $id . "/";
            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }
            
            $FileUploadStatus = FALSE;

            if (file_exists($_FILES["txt_ImageThumb"]["tmp_name"])) {
                $imagethumb_file_upload = basename($_FILES["txt_ImageThumb"]["name"]);
                $Extension = pathinfo($imagethumb_file_upload, PATHINFO_EXTENSION);
                $imagethumb_dir = $path;
                $imagethumb_file = "LogoThumb." . $Extension;
                $imagethumb_file_path = $imagethumb_dir . $imagethumb_file;

                if (move_uploaded_file($_FILES["txt_ImageThumb"]["tmp_name"], $imagethumb_file_path)) {
                    $FileUploadStatus = TRUE;
                    $posted["txt_ImageThumb"] = $imagethumb_file;
                } else {
                    $FileUploadStatus = FALSE;
                    $posted["txt_ImageThumb"] = $posted["txt_ImageThumb-name"];
                    echo "File Logo Upload Error.";
                }
            } else {
                $posted["txt_ImageThumb"] = $posted["txt_ImageThumb-name"];
                echo "File Logo Upload Error..";
            }
            if (file_exists($_FILES["txt_ImageMain"]["tmp_name"])) {
                $imagemain_image_upload = basename($_FILES["txt_ImageMain"]["name"]);
                $Extension = pathinfo($imagemain_image_upload, PATHINFO_EXTENSION);
                $imagemain_image_dir = $path;
                $imagemain_image_name = "ImageMain." . $Extension;
                $imagemain_image_path = $imagemain_image_dir. $imagemain_image_name;

                if (move_uploaded_file($_FILES["txt_ImageMain"]["tmp_name"], $imagemain_image_path)) {
                    $FileUploadStatus1 = TRUE;
                    $posted["txt_ImageMain"] = $imagemain_image_name;
                } else {
                    echo "File Banner Upload Error.";
                    $FileUploadStatus1 = FALSE;
                    $posted["txt_ImageMain"] = $posted["txt_ImageMain-name"];
                }
            } else {
                echo "File Banner Upload Error..";
                $posted["txt_ImageMain"] = $posted["txt_ImageMain-name"];
            }
            
            if (file_exists($_FILES["txt_ImageBanner"]["tmp_name"])) {
                $bannerimage_image_upload = basename($_FILES["txt_ImageBanner"]["name"]);
                $Extension = pathinfo($bannerimage_image_upload, PATHINFO_EXTENSION);
                $bannerimage_image_dir = $path;
                $bannerimage_image_name = "ImageBanner." . $Extension;
                $bannerimage_image_path = $bannerimage_image_dir. $bannerimage_image_name;

                if (move_uploaded_file($_FILES["txt_ImageBanner"]["tmp_name"], $bannerimage_image_path)) {
                    $FileUploadStatus1 = TRUE;
                    $posted["txt_ImageBanner"] = $bannerimage_image_name;
                } else {
                    echo "File Banner Upload Error.";
                    $FileUploadStatus1 = FALSE;
                    $posted["txt_ImageBanner"] = $posted["txt_ImageBanner-name"];
                }
            } else {
                echo "File Banner Upload Error..";
                $posted["txt_ImageBanner"] = $posted["txt_ImageBanner-name"];
            }
            for ($j = 0; $j < count($ColumnAPIUpdateData); $j++)
                $UpdateColDataString .= $UpdateColumns[$j] . " = '" . $posted[$ColumnAPIUpdateData[$j]] . "',";
            $UpdateColDataString = substr($UpdateColDataString, 0, strlen($UpdateColDataString) - 1);
         $Sql_input = "UPDATE $sTable SET $sTable.$UpdateColDataString WHERE $sIndexColumn = " . intval($posted["id"]);

            $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "SET", "UPDATE");
        }
      header("location:../pages.php");
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
                                    $output["data"][] = array_merge( array('<a href="view-pages.php?ID=' . $row[0] . '" class="btn btn-warning" ><i class="fa fa-eye"></i></a>&nbsp;<a href="javascript:removeRow(' . $row[0] . ');" class="btn btn-danger" ><i class="fa fa-close"></i></a>'),$row,$row);
                                }
                                // RETURN IN JSON
                                die(trim(json_encode($output))); // . $sQueryDisplay);
                                //echo "";
                                break;
                        default:
                                echo "Invalid Command.";
                                break;
                        }