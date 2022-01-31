<?php

/**
 * Author: RG-VP Web Solutions
 * Author URL: http://websiteinnagpur.com
 * License: Binded to use for personal use But Not to modify and Redistribute for commercial use.
 * Description: This File contains Necessary Variables to be used by the Website.
 * Version: RGVP-Core 1.0
 */
//Software Development Details
define("WebsiteVersionName", "RGVP Basic 1.0");
define("WebsiteVersion", "1.0");
define("WebsiteChangeLog", "WebsiteChangeLog.txt");
define("AdminPanelVersion", "1.0");
define("AdminPanelVersionName", "RGVP-Core 1.0");
define("AdminPanelChangeLog", "WebsiteAdminChangeLog.txt");

//Developer Organization Detials
define("RGVPWS_DevOrg","RG-VP Web Solutions");
define("RGVPWS_DevSlogan","We Build Websites and Your Business Too!");
define("RGVPWS_DevSupportEmail","support@websiteinnagpur.com");
define("RGVPWS_DevWebsite","https://websiteinnagpur.com");
define("RGVPWS_DevContactNumber","+91 9518752753");
define("RGVPWS_DevContactEmail","contact@websiteinnagpur.com");
define("RGVPWS_DevDataEmail","data@websiteinnagpur.com");

//Organization Detials
define("RGVPWS_Org","Stock Prediction Model");
define("RGVPWS_OrgSlogan","PhD Scholor");
define("RGVPWS_OrgWebsite","https:///");
define("RGVPWS_OrgEmail","manishmotghare@rknce.in");
define("RGVPWS_OrgPAN","NA");
define("RGVPWS_OrgGST","NA"); // Write NA if not available
define("RGVPWS_OrgGSTStateCode",substr(RGVPWS_OrgGST, 0, 2));

//Meta Tags
define("MetaTitle","Manish Motghare | Nagpur, Maharashtra, India");
define("MetaDescription",".");
define("MetaKeywords","Manish Motghare");

//Web & Core Directories
define("RGVPCoreFolder", "RGVPCore/");
define("RGVPCoreProjectFolder","RGVPCoreProject/");
define("RGVPWebThemeFolder", "RGVP-Theme/");
define("RGVPWebAPIFolder","RGVP-API/");
define("RGVPWebIncludesFolder","WebIncludes/");
//Static and Styling Directories
define("RGVPWebCssFolder","css/");
define("RGVPWebJsFolder","js/");
//Images Directories
define("RGVPWebImagesFolder","images/");
define("RGVPWebSliderFolder","Slider/");
define("RGVPWebCategoryFolder","Category/");
define("RGVPWebSubCategoryFolder","Subcategory/");
define("RGVPWebProductFolder","Products/");
define("RGVPWebProductThumbsFolder","Thumbs/");
//Admin Panel Directories
define("RGVPAdminFolder", "");
define("RGVPAdminThemeFolder", "RGVP-Theme/");
define("RGVPAdminAPIFolder", "RGVP-API/");
//Client Panel Directories
define("RGVPClientFolder", "RGVP-Student/");
define("RGVPClientThemeFolder", "RGVP-Theme/");
define("RGVPClientAPIFolder", "RGVP-API/");
//Vendor Panel Directories
define("RGVPVendorFolder", "RGVP-DataEntry/");
define("RGVPVendorThemeFolder", "RGVP-Theme/");
define("RGVPVendorAPIFolder", "RGVP-API/");

//DB Connection Params
//define("RGVPDB_HOST","websiteinnagpur.com");
//define("RGVPDB_USERNAME","websiefn_ecelest");
//define("RGVPDB_PASSWORD","=cMhb^6IA26a");
//define("RGVPDB_DBNAME","websiefn_ecelestial");
//define("RGVPDB_HOST","localhost:3306");
//define("RGVPDB_USERNAME","root");
//define("RGVPDB_PASSWORD","");
//define("RGVPDB_DBNAME","kexpress");

define("RGVPDB_HOST","rgvp.in");
define("RGVPDB_USERNAME","rgvpiqgy_rndspdt");
define("RGVPDB_PASSWORD","^UqCLX(ZwEc9");
define("RGVPDB_DBNAME","rgvpiqgy_rnd_spdt");
//Cookie & Encryption Parameters;
define("RGVPCookieExpiryTime",3600);  // Cookie Lasts for 1 hr.
define("RGVPEncryptionSalt","RGVP@1gp{+$78sfpMJFe-92s");
define("COOKIE_RUNTIME", RGVPCookieExpiryTime);
define("COOKIE_DOMAIN", "." . WEB_DOMAIN);
define("COOKIE_SECRET_KEY", RGVPEncryptionSalt);

//Email Configuration Params
define("RGVPMailSMTPHost","mail.rgvp.in");
define("RGVPMailSMTPDebug",0); //Different Levels of debugging PHP Mailer Function - Level 0 - Level 4;
define("RGVPMailUseSSL",FALSE);
define("RGVPMailSMTPSecureProtocol","ssl"); // Use ssl or tls
define("RGVPMailSMTPAuth",TRUE);
define("RGVPMailSMTPPort",25); // SMTP Ports 25, 465 for ssl, 587 for tls;
define("RGVPMailusername","no-reply@rgvp.in");
define("RGVPMailpassword","Admin12345@");
define("RGVPMailFrom","no-reply@rgvp.in");
define("RGVPMailFromName","Manish Motghare");
define("RGVPMailReplyto","");
define("RGVPMailReplytoName","Manish Motghare");

//SMS Configuration Params
define("RGVPSMSHost","http://bulksms.websiteinnagpur.com/api/mt/SendSMS?");
define("RGVPSMSport","80");
define("RGVPSMSusername","bifs.in");
define("RGVPSMSpassword","smsRGVP1@");
define("RGVPSMSSendURL","http://bulksms.websiteinnagpur.com/api/mt/SendSMS?");
define("RGVPSMSSenderID","RGVPWS");
define("RGVPSMSApiKey","");
define("RGVPSMSDefaultParams","senderid=" . RGVPSMSSenderID . "&user=" . RGVPSMSusername . "&password=" . RGVPSMSpassword . "&channel=Trans&DCS=0&flashsms=0&route=06");
define("RGVPSMSParamNumbers","number"); // Name of the Parameter of Mobile Numbers.
define("RGVPSMSParamMessage","text"); // Name of the Parameter of Message to be sent.

//PhD NSE Stock Api Key
define("NSE-API","302DC31S4SVZD8VI");
define("API","302DC31S4SVZD8VI");
