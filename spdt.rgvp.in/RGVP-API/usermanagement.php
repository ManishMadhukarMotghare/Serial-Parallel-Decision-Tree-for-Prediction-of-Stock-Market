<?php

include 'include.php';
$returnstring = "";
$LoginFlag = FALSE;
$CommandType = $postvars["CommandType"];
if ($CommandType == "LOGIN-ADMIN") {
    //$username = ( $_REQUEST["username"];
    //$password = $_REQUEST["password"];
    if ($postvars["username"] != NULL) {
        $Sql_input = "SELECT * FROM Admin_user WHERE Email='" . trim($postvars["username"]) . "'";
        $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");

        if ($RGVP->DB->StatusCode == "502") {
            $num = mysqli_num_rows($Sql_output);

            if ($num > 0) {
                while ($loginrow = mysqli_fetch_assoc($Sql_output)) {
                    if ($loginrow["Password"] === $postvars["password"]) {
                        $RGVP->Cookie->setCookie('UserID', $loginrow["userID"]);
                        $RGVP->Cookie->setCookie('Name', $loginrow["Name"]);
                        $RGVP->Cookie->setCookie('Mobile', $loginrow["Mobile"]);
                        $RGVP->Cookie->setCookie('Email', $loginrow["Email"]);
                        $RGVP->Cookie->setCookie('UserType', $loginrow["UserType"]);
                        $RGVP->Cookie->setCookie('UserRole', $loginrow["UserRole"]);
                        $RGVP->Cookie->setCookie('CompanyID', $loginrow["CompanyID"]);
                        $RGVP->Cookie->setCookie('LoginType', "Admin");
                        $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents AdminID", $loginrow["userID"]);
                        $LoginFlag = TRUE;
                        break;
                    }
                }
                if (!$LoginFlag) {
                    $returnstring = $RGVP::GetStatus("605", FALSE);
                }
            } else {
                $Sql_input = "SELECT employee.*,branch.BranchType as BranchType, branch.HubCode as HubCode  FROM employee inner join branch on branch.Code = employee.Branch WHERE employee.Emailid = '" . trim($postvars["username"]) . "'";
                $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");

                if ($RGVP->DB->StatusCode == "502") {
                    $num = mysqli_num_rows($Sql_output);

                    if ($num > 0) {
                        while ($loginrow = mysqli_fetch_assoc($Sql_output)) {
                            if ($loginrow["Password"] === $postvars["password"]) {
                                $RGVP->Cookie->setCookie('UserID', $loginrow["EmployeeID"]);
                                $RGVP->Cookie->setCookie('Name', $loginrow["Name"]);
                                $RGVP->Cookie->setCookie('Mobile', $loginrow["Mobile"]);
                                $RGVP->Cookie->setCookie('Email', $loginrow["Email"]);
                                $RGVP->Cookie->setCookie('UserType', $loginrow["EmployeeType"]);
                                $RGVP->Cookie->setCookie('UserBranchCode', $loginrow["Branch"]);
                                $RGVP->Cookie->setCookie('UserHubCode', $loginrow["HubCode"]);
                                $RGVP->Cookie->setCookie('UserStationedBranchCode', $loginrow["StationedAt"]);
                                $RGVP->Cookie->setCookie('UserBranchType', $loginrow["BranchType"]);
                                $RGVP->Cookie->setCookie('UserRole', $loginrow["Role"]);
                                $RGVP->Cookie->setCookie('LoginType', "Branch");
                                $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents userID", $loginrow["userID"]);
                                $LoginFlag = TRUE;
                                break;
                            }
                        }
                        if (!$LoginFlag) {
                            $returnstring = $RGVP::GetStatus("605", FALSE);
                        }
                    } else {
                        $returnstring = $RGVP::GetStatus("607", FALSE);
                    }
                } else {
                    $returnstring = $RGVP::GetStatus("503", FALSE,"Invalid User!",$Sql_input);
                }
                //$returnstring = $RGVP::GetStatus("607", FALSE);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE,"Invalid Admin!",$Sql_input);
        }
    } else {
        $returnstring = $RGVP::GetStatus("609", FALSE, 'No Username Received.');
    }
    echo $returnstring;
} else if ($CommandType == "LOGIN-EMPLOYEE") {
    //$username = ( $_REQUEST["username"];
    //$password = $_REQUEST["password"];

    echo $returnstring;
} else if ($CommandType == "LOGIN-STUDENT") {
    //$username = ( $_REQUEST["username"];
    //$password = $_REQUEST["password"];
    if ($postvars["username"] != NULL) {
        $Sql_input = "SELECT * FROM students WHERE Email='" . trim($postvars["username"]) . "'";
        $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
        if ($RGVP->DB->StatusCode == "502") {
            $num = mysqli_num_rows($Sql_output);
            if ($num > 0) {

                while ($loginrow = mysqli_fetch_assoc($Sql_output)) {
                    if ($loginrow["Password"] === $postvars["password"]) {

                        $RGVP->Cookie->setCookie('UserID', $loginrow["UserID"]);
                        $RGVP->Cookie->setCookie('Name', $loginrow["Name"]);
                        $RGVP->Cookie->setCookie('Mobile', $loginrow["Mobile"]);
                        $RGVP->Cookie->setCookie('Email', $loginrow["Email"]);
                        $RGVP->Cookie->setCookie('UserType', $loginrow["UserType"]);
                        //$RGVP->Cookie->setCookie('UserRole', $loginrow["UserRole"]);
                        //$RGVP->Cookie->setCookie('CompanyID', $loginrow["CompanyID"]);
                        $RGVP->Cookie->setCookie('LoginType', "STUDENT");
                        $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents UserID", $loginrow["UserID"]);
                        // break;
                    }
                }
                if (!$RGVP->Cookie->exists('UserID'))
                    $returnstring = $RGVP::GetStatus("605", FALSE);
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE);
        }
    } else {
        $returnstring = $RGVP::GetStatus("609", FALSE, 'No Username Received.');
    }
    echo $returnstring;

//        if ($RGVP::StrContains("Error:", $Sql_output)) {
//            //echo '<div class="alert alert-danger"><strong> DB Error: </strong>' . $Sql_output . '<button type="button" class="close" data-dismiss="alert">X</button></div>';
//        } else {
//            
//                while ($loginrow = mysqli_fetch_assoc($Sql_output)) {
//                    if ($loginrow["Password"] === $password) {
//                        $RGVP->Cookie->setCookie('UserID', $loginrow["UserID"]);
//                        $RGVP->Cookie->setCookie('Name', $loginrow["Name"]);
//                        $RGVP->Cookie->setCookie('MobileNo', $loginrow["MobileNo"]);
//                        $RGVP->Cookie->setCookie('Email', $loginrow["Email"]);
//                        $RGVP->Cookie->setCookie('UserType', $loginrow["UserType"]);
//                        $RGVP->Cookie->setCookie('UserRole', $loginrow["UserRole"]);
//                        $RGVP->Cookie->setCookie('CompanyID', $loginrow["CompanyID"]);
//                        $RGVP->Cookie->setCookie('LoginType', "COMPANY");
//                        echo "true";
//                        // break;
//                    }
//                }
//            } else
//                echo "Incorrect Password Else User not Active. Contact Customer Care.";
//        }
//    } else
//        echo '<div class="alert alert-danger"><strong> DB Error: </strong>' . $Sql_output . '<button type="button" class="close" data-dismiss="alert">X</button></div>';
} else if ($CommandType == "LOGIN-DATAENTRY") {
    //$username = ( $_REQUEST["username"];
    //$password = $_REQUEST["password"];
    if ($postvars["username"] != NULL) {
        $Sql_input = "SELECT * FROM admin_users WHERE Email='" . trim($postvars["username"]) . "'";
        $Sql_output = $RGVP->DB->Execute_Query($Sql_input, "GET", "SQLObj");
        if ($RGVP->DB->StatusCode == "502") {
            $num = mysqli_num_rows($Sql_output);
            if ($num > 0) {

                while ($loginrow = mysqli_fetch_assoc($Sql_output)) {
                    if ($loginrow["Password"] === $postvars["password"]) {

                        $RGVP->Cookie->setCookie('UserID', $loginrow["UserID"]);
                        $RGVP->Cookie->setCookie('Name', $loginrow["Name"]);
                        $RGVP->Cookie->setCookie('Mobile', $loginrow["Mobile"]);
                        $RGVP->Cookie->setCookie('Email', $loginrow["Email"]);
                        $RGVP->Cookie->setCookie('UserType', $loginrow["UserType"]);
                        //$RGVP->Cookie->setCookie('UserRole', $loginrow["UserRole"]);
                        //$RGVP->Cookie->setCookie('CompanyID', $loginrow["CompanyID"]);
                        $RGVP->Cookie->setCookie('LoginType', $CommandType);
                        $returnstring = $RGVP::GetStatus("602", TRUE, "Data Contents UserID", $loginrow["UserID"]);
//                        echo "true";
                        // break;
                    }
                }
                if (!$RGVP->Cookie->exists('UserID'))
                    $returnstring = $RGVP::GetStatus("605", FALSE);
            } else {
                $returnstring = $RGVP::GetStatus("607", FALSE);
            }
        } else {
            $returnstring = $RGVP::GetStatus("503", FALSE);
        }
    } else {
        $returnstring = $RGVP::GetStatus("609", FALSE, 'No Username Received.');
    }
    echo $returnstring;
} else if ($CommandType == "LOGOUT") {
    if ($RGVP::UserLoggedIn("UserID")) {
        //session_destroy();
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach ($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time() - 1000);
                setcookie($name, '', time() - 1000, '/');
            }
        }
        echo "true";
    }
} else if ($CommandType == "VERIFYMOBILE") {
    $Mobile = $_REQUEST['txt_Mobile'];

    $sQuery = " SELECT Mobile FROM userdetails WHERE Mobile='" . $Mobile . "'";
    $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
    $Row = mysqli_num_rows($rResult);

    if ($Row > 0) {
        echo 'true';
    } else {
        echo 'false';
    }
} else if ($CommandType == "VERIFYPAN") {
    $PANNo = $_REQUEST['txt_PANNo'];

    $sQuery = " SELECT PANNo FROM userdetails WHERE PANNo='" . $PANNo . "'";
    $rResult = $RGVP->DB->Execute_Query($sQuery, "GET", "SQLObj");
    $Row = mysqli_num_rows($rResult);

    if ($Row > 0) {
        echo 'true';
    } else {
        echo 'false';
    }
} else {
    echo 'Invalid Command';
}
