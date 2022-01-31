<?php
//Website Running Parameters
define("HOST_PROTOCOL", "https://");
define("LOCALHOST_PROTOCOL", "http://");
define("WEB_DOMAIN", "spdt.rgvp.in");
define("LOCALHOST_FOLDER", "spdt.rgvp.in/");
define("HOST_FOLDER", ""); // Include Trailing Slash(/).
define("DOCUMENT_ROOT", $_SERVER["DOCUMENT_ROOT"] . "/");
define("IS_LOCAL_IP", strpos($_SERVER["SERVER_NAME"], "192.168"));
//echo $_SERVER["SERVER_NAME"];
//echo strpos($_SERVER["SERVER_NAME"], "192.168");
if ($_SERVER["SERVER_NAME"] == "localhost" || IS_LOCAL_IP !== FALSE) {
    define("SERVER_PATH", DOCUMENT_ROOT . LOCALHOST_FOLDER);
    define("WEB_PROTOCOL", LOCALHOST_PROTOCOL);
    define("RGVPWebURL", WEB_PROTOCOL . $_SERVER["SERVER_NAME"] . "/" . LOCALHOST_FOLDER);
} else {
    define("SERVER_PATH", DOCUMENT_ROOT . HOST_FOLDER);
    define("WEB_PROTOCOL", HOST_PROTOCOL);
    define("RGVPWebURL", WEB_PROTOCOL . $_SERVER["SERVER_NAME"] . "/" . HOST_FOLDER);
}

/* Directory Vars */
require_once("RGVPVars.php");

//Core and Web Paths & URL
define("RGVPCoreURL", RGVPWebURL . RGVPCoreFolder);
define("RGVPCoreProjectURL", RGVPWebURL . RGVPCoreProjectFolder);
define("RGVPWebIncludesURL", RGVPWebURL . RGVPWebIncludesFolder);
define("RGVPCorePath", SERVER_PATH . RGVPCoreFolder);
define("RGVPCoreProjectPath", SERVER_PATH . RGVPCoreProjectFolder);
define("RGVPWebIncludesPath", SERVER_PATH . RGVPWebIncludesFolder);
define("RGVPWebAPIPath", SERVER_PATH . RGVPWebAPIFolder);
define("RGVPWebCssPath", SERVER_PATH . RGVPWebCssFolder);
define("RGVPWebJsPath", SERVER_PATH . RGVPWebJsFolder);
define("RGVPWebImagesPath", SERVER_PATH . RGVPWebImagesFolder);
define("RGVPWebSliderPath", SERVER_PATH . RGVPWebSliderFolder);
define("RGVPWebCategoryPath", SERVER_PATH . RGVPWebCategoryFolder);
define("RGVPWebSubCategoryPath", SERVER_PATH . RGVPWebSubCategoryFolder);
define("RGVPWebProductPath", SERVER_PATH . RGVPWebProductFolder);
define("RGVPWebProductThumbsPath", SERVER_PATH . RGVPWebProductThumbsFolder);
//Web Theme Vars Path
define("RGVPWebThemePath", SERVER_PATH . RGVPWebThemeFolder);
define("RGVPWebThemeHeaderSection", RGVPWebThemePath . "Header-Section.php");
define("RGVPWebThemeHeader", RGVPWebThemePath . "Header.php");
define("RGVPWebThemeFooter", RGVPWebThemePath . "Footer.php");
define("RGVPWebThemeFooterSection", RGVPWebThemePath . "Footer-Section.php");
//Theme Vars URLs
define("RGVPWebThemeURL", RGVPWebURL . RGVPWebThemeFolder);
define("RGVPWebAPIURL", RGVPWebURL . RGVPWebAPIFolder);
define("RGVPWebCssURL", RGVPWebURL . RGVPWebCssFolder);
define("RGVPWebJsURL", RGVPWebURL . RGVPWebJsFolder);
define("RGVPWebImagesURL", RGVPWebURL . RGVPWebImagesFolder);
define("RGVPWebSliderURL", RGVPWebURL . RGVPWebSliderFolder);
define("RGVPWebCategoryURL", RGVPWebURL . RGVPWebCategoryFolder);
define("RGVPWebSubCategoryURL", RGVPWebURL . RGVPWebSubCategoryFolder);
define("RGVPWebProductURL", RGVPWebURL . RGVPWebProductFolder);
define("RGVPWebProductThumbsURL", RGVPWebURL . RGVPWebProductThumbsFolder);

//Admins Panel Paths & URLs
define("RGVPAdminPath", SERVER_PATH . RGVPAdminFolder);
define("RGVPAdminThemePath", RGVPAdminPath . RGVPAdminThemeFolder);
define("RGVPAdminThemeHeaderSection", RGVPAdminThemePath . "Header-Section.php");
define("RGVPAdminThemeHeader", RGVPAdminThemePath . "Header.php");
define("RGVPAdminThemePageHeader", RGVPAdminThemePath . "HeaderPage.php");
define("RGVPAdminThemeFooter", RGVPAdminThemePath . "Footer.php");
define("RGVPAdminThemeFooterSection", RGVPAdminThemePath . "Footer-Section.php");
define("RGVPAdminAPIPath", RGVPAdminPath . RGVPAdminAPIFolder);
define("RGVPAdminURL", RGVPWebURL . RGVPAdminFolder);
define("RGVPAdminThemeURL", RGVPAdminURL . RGVPAdminThemeFolder);
define("RGVPAdminAPIURL", RGVPAdminURL . RGVPAdminAPIFolder);
//Clients - Customers - Users Panel Paths & URLs
define("RGVPClientPath", SERVER_PATH . RGVPClientFolder);
define("RGVPClientThemePath", RGVPClientPath . RGVPClientThemeFolder);
define("RGVPClientThemeHeaderSection", RGVPClientThemePath . "Header-Section.php");
define("RGVPClientThemeHeader", RGVPClientThemePath . "Header.php");
define("RGVPClientThemePageHeader", RGVPClientThemePath . "HeaderPage.php");
define("RGVPClientThemeFooter", RGVPClientThemePath . "Footer.php");
define("RGVPClientThemeFooterSection", RGVPClientThemePath . "Footer-Section.php");
define("RGVPClientAPIPath", RGVPClientPath . RGVPClientAPIFolder);
define("RGVPClientURL", RGVPWebURL . RGVPClientFolder);
define("RGVPClientThemeURL", RGVPClientURL . RGVPClientThemeFolder);
define("RGVPClientAPIURL", RGVPClientURL . RGVPClientAPIFolder);
//Vendors Panel Paths & URLs
define("RGVPVendorPath", SERVER_PATH . RGVPVendorFolder);
define("RGVPVendorThemePath", RGVPVendorPath . RGVPVendorThemeFolder);
define("RGVPVendorThemeHeaderSection", RGVPVendorThemePath . "Header-Section.php");
define("RGVPVendorThemeHeader", RGVPVendorThemePath . "Header.php");
define("RGVPVendorThemePageHeader", RGVPVendorThemePath . "HeaderPage.php");
define("RGVPVendorThemeFooter", RGVPVendorThemePath . "Footer.php");
define("RGVPVendorThemeFooterSection", RGVPVendorThemePath . "Footer-Section.php");
define("RGVPVendorAPIPath", RGVPVendorPath . RGVPVendorAPIFolder);
define("RGVPVendorURL", RGVPWebURL . RGVPVendorFolder);
define("RGVPVendorThemeURL", RGVPVendorURL . RGVPVendorThemeFolder);
define("RGVPVendorAPIURL", RGVPVendorURL . RGVPVendorAPIFolder);
define("API_CALL_METHOD","POST");

/* Application Loading Settings */
date_default_timezone_set('Asia/Kolkata');
ini_set('display_errors', 1);
ini_set('display_warnings', 1);
ini_set('memory_limit', '128M');
ini_set('allow_url_fopen', 1);
error_reporting(0); //E_ALL

/* Includes */
//echo RGVPCorePath;
require_once(RGVPCorePath . 'RGVPCore.php');
//require_once(RGVPCorePath . 'RGVP-DB-Connection.php');
require_once(RGVPCorePath . 'RGVP-Files.php');
require_once(RGVPCorePath . 'RGVP-Mailer.php');
//require_once(RGVPCorePath . 'RGVP-SMS.php');
require_once(RGVPCorePath . 'RGVP-FormBuilder.php');

/* Includes project Classes */
require_once(RGVPCoreProjectPath . 'RGVPWS-AOneLibrary.php');
//require_once(RGVPCoreProjectPath . 'QuestionsGenerator.php');
//var_dump($_SERVER);
$RGVP = new \RGVPCore\RGVPCore();
$PagePath = explode('/', $_SERVER['SCRIPT_NAME']);
$RGVP->Page->FileName = $PagePath[count($PagePath) - 1];
//echo $RGVP->Page->FileName;
$PageListQuery = $RGVP->DB->Execute_Query("SELECT * FROM websiefn_rgvpws.`admin-pages` where FileName = '" . $RGVP->Page->FileName . "';", "GET", "SQLObj");
if ($RGVP->DB->StatusCode == "502") {
    $PageList = mysqli_fetch_assoc($PageListQuery);
    $RGVP->Page->Title = $PageList["Title"];
    $RGVP->Page->Keywords = "";
    //$RGVP->Page->FileName = $PageList["FileName"];
    $RGVP->Page->Description = $PageList['Description'];
} else {
    $Response = json_decode($RGVP->DB->Response);
    // var_dump($Response);
}
$RGVPDBCon = $RGVP->DB->GetConnection();
$postvars = $_POST; // $_POST;
$getvars = $_GET;
$cookievars = $_COOKIE;
$requestvars = $_REQUEST;

foreach ($cookievars as &$val) {
    if (gettype($val) == "string") {
        $val = mysqli_real_escape_string($RGVPDBCon, strip_tags(trim($val)));
    }
}
foreach ($requestvars as &$val) {
    if (gettype($val) == "string") {
        $val = mysqli_real_escape_string($RGVPDBCon, strip_tags(trim($val)));
    }
}
foreach ($getvars as &$val) {
    if (gettype($val) == "string") {
        $val = mysqli_real_escape_string($RGVPDBCon, strip_tags(trim($val)));
    }
}
foreach ($postvars as &$val) {
    if (gettype($val) == "string") {
        $val = mysqli_real_escape_string($RGVPDBCon, strip_tags(trim($val)));
    }
}
$posted = $requestvars;
//var_dump($RGVP);
//var_dump($_SERVER);
//var_dump($_COOKIE);
//$MasterIndex = $RGVP::StrContains(SERVER_PATH . "index.php", $_SERVER["SCRIPT_FILENAME"]) ;

//echo SERVER_PATH . "index.php";
//echo $_SERVER["SCRIPT_FILENAME"];
//$MasterIndex = $RGVP::StrContains(SERVER_PATH . "index.php", $_SERVER["SCRIPT_FILENAME"]);

function WebsiteAccessStatus() {
    $RGVP = $GLOBALS["RGVP"];
    $ServerUri = $_SERVER['REQUEST_URI'];
    if ($RGVP::StrContains(RGVPAdminFolder, $ServerUri) == TRUE ||
            $RGVP::StrContains(RGVPVendorFolder, $ServerUri) == TRUE ||
            $RGVP::StrContains(RGVPClientFolder, $ServerUri) == TRUE) {
        return FALSE;
    } else {
        return TRUE;
    }
}

function WebAPIAccessStatus() {
    $RGVP = $GLOBALS["RGVP"];
    if ($RGVP::StrContains(RGVPWebAPIFolder, $_SERVER['REQUEST_URI']) || $RGVP::StrContains(RGVPAdminAPIFolder, $_SERVER['REQUEST_URI']) || $RGVP::StrContains(RGVPVendorAPIFolder, $_SERVER['REQUEST_URI']) || $RGVP::StrContains(RGVPClientAPIFolder, $_SERVER['REQUEST_URI'])) {
        return TRUE;
    } else {
        return FALSE;
    }
}

$websiteAccess = WebsiteAccessStatus();

$IsAPIAccess = WebAPIAccessStatus();
//echo SERVER_PATH . "index.php";
//echo $_SERVER["SCRIPT_FILENAME"];

$IsNotAPIAccess = FALSE;


//var_dump($IsAPIAccess);
//var_dump($RGVP::UserLoggedIn("UserID"));
if ($websiteAccess == FALSE && $IsAPIAccess == FALSE) {
    if ($RGVP::UserLoggedIn("UserID")) {
        if ($RGVP::StrContains("login.php", strtolower($_SERVER["SCRIPT_NAME"])) || $RGVP::StrContains("signup.php", strtolower($_SERVER["SCRIPT_NAME"]))) {
            //var_dump($_SERVER);
            $serveruri =  $_SERVER['REQUEST_URI'];
            $url = strpos($serveruri,"login.php");
            $url = substr($_SERVER["REQUEST_URI"], 0, $url);
            header('Location: ' . $url);
        }
    } else {
        if ($RGVP::StrContains("login.php", strtolower($_SERVER["SCRIPT_NAME"])) || $RGVP::StrContains("signup.php", strtolower($_SERVER["SCRIPT_NAME"]))) {
            
        } else {
            header('Location: login.php?url=' . $_SERVER['PHP_SELF']);
        }
    }
}


