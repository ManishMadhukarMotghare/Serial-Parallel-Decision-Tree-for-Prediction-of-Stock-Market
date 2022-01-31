<?php

/**
 * Author: RG-VP Web Solutions
 * Author URL: http://websiteinnagpur.com
 * License: Binded to use for personal use But Not to modify and Redistribute for commercial use.
 * Description: This File contains Necessary Working Classes and Objects to be used to run the Website.
 * Version: RGVP-Core 1.0
 */

namespace RGVPCore {

    Class RGVPCore {

        var $SMS;
        var $Cookie;
        var $DB;
        var $Crypt;
        var $Page;

        function __construct() {
            $this->SMS = new \RGVPCore\RGVP_SMS();
            $this->Cookie = new \RGVPCore\RGVPCookie();
            $this->DB = new \RGVPCore\RGVPDB();
            $this->Crypt = new \RGVPCore\RGVP_Cryptography();
            $this->Page = new \RGVPCore\Page();
            $this->RGVPCurrencyFormater = new \RGVPCore\RGVPCurrencyFormater();
        }

        //String Functions
        static function StrContains($SubStr, $String) {
            if (is_string($String)){
                if (strpos($String, $SubStr) !== false) {
                    return true;
                }
            }
            return false;
        }

        static function ReplaceLFtoBR($string) {
            return str_replace(array("\r\n", "\n\r", "\n", "\r"), "<br/>", $string);
        }

        static function StrReplace($Find, $Replace, $String) {
            return str_replace($Find, $Replace, $String);
        }

        /*
         * Status Function is used to Return Status Code And Response in JSON Format. 
         * Ex. Output:     */

        static function GETStatus($Code, $status = TRUE, $AdditionalInfo = NULL, $Data = NULL) {
            $Response = "";
            switch ($Code) {
                /* Database Report Codes */
                case "500": $Response = "Database Connected Successfully.";
                    break;
                case "501": $Response = "Database Connection Failed.";
                    break;
                case "502": $Response = "Database Command Executed Successfully. ";
                    break;
                case "503": $Response = "Database Command Execution Failed.";
                    break;
                case "504": $Response = "Unknown";
                    break;
                case "505": $Response = "";
                    break;
                case "506": $Response = "";
                    break;
                case "600": $Response = "Login Attempt Successful";
                    break;
                case "602": $Response = "Login Attempt with Password Successful";
                    break;
                case "604": $Response = "Login Attempt with OTP Successful";
                    break;
                case "601": $Response = "The command has not received at server end.";
                    break;
                case "603": $Response = "The Invalid command has received at server end.";
                    break;
                case "605": $Response = "Login Attempt Failed. Incorrect Username or Password.";
                    break;
                case "607": $Response = "Login Attempt Failed. Incorrect Username or Password. Contact System Admin.";
                    break;
                default: $Response = $AdditionalInfo;
                    break;
            }
            $StatusText = ($status == TRUE) ? "Success" : "Failed";
            $StatusResult = array();
            $StatusResult["status"] = strtolower($StatusText);
            $StatusResult["message"] = $Response;
            $StatusResult["result"] = array();
            $StatusResult["result"]["StatusCode"] = $Code;
            $StatusResult["result"]["AdditionalInfo"] = $AdditionalInfo;
            $StatusResult["result"]["HtmlResponse"] = self::ReportMsg($AdditionalInfo, $StatusText, $Code . " : " . $Response);
            $StatusResult["result"]["Data"] = $Data;


            return json_encode($StatusResult); // '{"status": "' . strtolower($StatusText) . '", "message":"' . $Response . '","result":{"statuscode":"' . $Code . '","AdditionalInfo":"' . $AdditionalInfo . '","HtmlResponse":"' . self::ReportMsg($AdditionalInfo, $StatusText, $Code . " : " . $Response) . '","Data": "' . $Data . '"}}';
        }

        //Date Format Display
        function MySQLDateDisplay($MySQLDate, $DisplayFormat = "d-m-Y") {
            $DateDisplay = strtotime($MySQLDate);
            $DateDisplay = date($DisplayFormat, $DateDisplay);
            return $DateDisplay;
        }

        //Reporting BootStrap Message
        static function ReportMsg($Msg, $MsgType = "Success", $MsgTitle = NULL, $IncludeCloseButton = TRUE) {
            $ReturnHTML = "";
            $MsgClass = 'alert-primary';
            $MsgIcon = "fa-check";
            if ($MsgType == "Success") {
                $MsgClass = 'alert-success';
                $MsgIcon = "fa-check";
            } else if ($MsgType == "Failed") {
                $MsgClass = 'alert-danger';
                $MsgIcon = "fa-ban";
            } else if ($MsgType == "Warning") {
                $MsgClass = 'alert-warning';
                $MsgIcon = "fa-warning";
            } else if ($MsgType == "Info") {
                $MsgClass = 'alert-info';
                $MsgIcon = "fa-info";
            } else {
                $MsgClass = 'alert-success';
                $MsgIcon = "fa-check";
            }
            if (isset($MsgTitle))
                $MsgTitle = '<h4><i class="icon fa ' . $MsgIcon . '"></i> ' . $MsgTitle . '</h4>';
            else
                $MsgTitle = '';

            if ($IncludeCloseButton)
                $btnClose = '<button class="close" aria-hidden="true" type="button" data-dismiss="alert">×</button>';
            else
                $btnClose = '';
            $ReturnHTML = '<div class="alert ' . $MsgClass . ' alert-dismissible">' . $btnClose . $MsgTitle . $Msg . '</div>';

            return $ReturnHTML;
        }

        /**
         * GetNumberLength($Type,$Length)
         * The Function is used to Get the MAX, MIN, Random no. specified in $Length
         * 
         * @param string $Type It is used to define the type of no. you want.<br>
         * - "MIN" = Minimun No. of the Length
         * - "MAX" = Maximun No. of the Length
         * - "RANDOM" = Random No. of the Length
         *  */
        static function GetNumberLength($Type, $Length) {
            if ($Type == "MIN") {
                $MinNo = "1";
                for ($i = 1; $i < $Length; $i++) {
                    $MinNo .= "0";
                }
                return $MinNo;
            }
            if ($Type == "MAX") {
                if ($Length > 0) {
                    return "9" . self::GetNumberLength($Type, $Length - 1);
                }
                return NULL;
            } else if ($Type === "RANDOM") {
                
            }
        }

        //Login Valid Function
        static function UserLoggedIn($UserID = "UserID") {
            $Cookie = new \RGVPCore\RGVPCookie();
            if ($Cookie->exists($UserID)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        //Used In Encryption and Generating Random String Token
        static function AllowedCharset($Type) {
            $AlphabetCAPS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $AlphabetSMALL = "abcdefghijklmnopqrstuvwxyz";
            $DigitsDEC = "0123456789";
            $DigitsHEC = "0123456789ABCEDF";
            $DigitsOCT = "01234567";
            $DigitsBIN = "01";
            $ResultChars = "";
            switch ($Type) {
                case "AlphabetCAPS":
                    $ResultChars = $AlphabetCAPS;
                    break;
                case "AlphabetSMALL":
                    $ResultChars = $AlphabetSMALL;
                    break;
                case "DigitsDEC":
                    $ResultChars = $DigitsDEC;
                    break;
                case "DigitsHEC":
                    $ResultChars = $DigitsHEC;
                    break;
                case "DigitsOCT":
                    $ResultChars = $DigitsOCT;
                    break;
                case "DigitsBIN":
                    $ResultChars = $DigitsBIN;
                    break;
                case "AlphabetMIX":
                    $ResultChars = $AlphabetCAPS . $AlphabetSMALL . $DigitsDEC;
                    break;
                default:
                    $ResultChars = "";
            }
            return $ResultChars;
        }

    }

    Class RGVP_Cryptography {

        var $PlainText;
        var $CipherText;

        function __construct() {
            $this->PlainText = "";
            $this->CipherText = "";
        }

        public function Base64Enc($Content) {
            $this->PlainText = $Content;
            $this->CipherText = base64_encode($this->PlainText);
            return $this->CipherText;
        }

        public function Base64Dec($Content) {
            $this->CipherText = $Content;
            $this->PlainText = base64_decode($this->CipherText);
            return $this->PlainText;
        }

        public static function crypto_rand_secure($min, $max) {
            $range = $max - $min;
            if ($range < 1) {
                return $min;
            } // not so random...
            $log = ceil(log($range, 2));
            $bytes = (int) ($log / 8) + 1; // length in bytes
            $bits = (int) $log + 1; // length in bits
            $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
            do {
                $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
                $rnd = $rnd & $filter; // discard irrelevant bits
            } while ($rnd >= $range);
            return $min + $rnd;
        }

        public static function getToken($length, $CharSet = "AlphabetMIX") {
            $token = "";
            $codeAlphabet = "";
            $TokenChars = RGVPCore::AllowedChars($CharSet);
            $max = strlen($TokenChars); // edited
            for ($i = 0; $i < $length; $i++) {
                $token .= $codeAlphabet[self::crypto_rand_secure(0, $max)];
            }
            return $token;
        }

    }

    Class RGVP_SMS {

        function __construct() {
            
        }

        //SMS Functions
        public function SendSMS($Message, $To) {
            if ($To == "") {
                return 'Error: Empty Number.';
            } else {
                $url = RGVPSMSSendURL;
                $params = RGVPSMSDefaultParams . "&" . RGVPSMSParamNumbers . "=$To&" . RGVPSMSParamMessage . "=" . urlencode($Message);
                $SMSResponse = "";
                $ErrorResponse = "";
                try {
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url . $params);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
                    $response = curl_exec($ch);
                    curl_close($ch);
                    $SMSResponse = $response; //file_get_contents($url.$params);
                    //$SMSResponse = json_decode($SMSResponse);
                    // var_dump($response);
                } catch (Exception $ex) {
                    try {
                        $SMSResponse = file_get_contents($url . $params);
                        // $SMSResponse = json_decode($SMSResponse);

                        $ErrorResponse .= $ex->getMessage();
                    } catch (Exception $ex1) {
                        $SMSResponse = "Error";
                        $ErrorResponse .= $ex1->getMessage();
                    }
                }
                if ($SMSResponse != "Error")
                //if (($SMSResponse[0]["ErrorCode"] == "000"))
                    return \RGVPCore\RGVPCore::GETStatus("650", TRUE, "SMS Sent Successfully.", '{"Response":"' . $SMSResponse . '","ErrorCatch":"' . $ErrorResponse . '"}');
                //else
                // return \RGVPCore\RGVPCore::GETStatus("653", TRUE, "SMS Not Sent. SMSError.", '{"Response":"' . $SMSResponse . '","ErrorCatch":"' . $ErrorResponse . '"}');
                else
                    return \RGVPCore\RGVPCore::GETStatus("651", TRUE, "SMS Not Sent. CatchError.", '{"Response":"' . $SMSResponse . '","ErrorCatch":"' . $ErrorResponse . '"}');
            }
        }

    }

    /**
     * Configuration for: RGVPCookie
     * Please note: The COOKIE_DOMAIN needs the domain where your app is,
     * in a format like this: .mydomain.com
     * Note the . in front of the domain. No www, no http, no slash here!
     * For local development .127.0.0.1 or .localhost is fine, but when deploying you should
     * change this to your real domain, like '.mydomain.com' ! The leading dot makes the cookie available for
     * sub-domains too.
     * @see http://www.php.net/manual/en/function.setcookie.php
     *
     * COOKIE_RUNTIME: How long should a cookie be valid ? 1209600 seconds = 2 weeks
     * COOKIE_DOMAIN: The domain where the cookie is valid for, like '.mydomain.com'
     * COOKIE_SECRET_KEY: Put a random value here to make your app more secure. When changed, all cookies are reset.
     */
    class RGVPCookie {

        function __construct() {
            
        }

        //private $random_token_string = null;
        public function exists($name) {
            return isset($_COOKIE[$name]);
        }

        public function setCookie($name, $value, $location = "/") {
            $random_token_string = hash('sha256', mt_rand());

            $cookie_string_first_part = $value . ':' . $random_token_string;
            $cookie_string_hash = hash('sha256', $cookie_string_first_part . COOKIE_SECRET_KEY);
            $cookie_string = $cookie_string_first_part . ':' . $cookie_string_hash;
            if (setcookie($name, $cookie_string, time() + COOKIE_RUNTIME, $location)) {
                return $random_token_string;
            } else
                return false;
        }

        public function deleteCookie($name, $location = '/') {
            return setcookie($name, false, time() - (3600 * 3650), $location);
        }

        public function getCookieValue($name, $IsJSONFormat = false) {
            list ($cookie_id, $token, $hash) = explode(':', $_COOKIE[$name]);
            if ($hash == hash('sha256', $cookie_id . ':' . $token . COOKIE_SECRET_KEY) && !empty($token)) {
                if ($IsJSONFormat) {
                    $pre = @json_encode(array("id" => $cookie_id, "token" => $token));
                    return $pre;
                    //return toObject(array("id"=>$cookie_id,"token"=>$token));
                } else {
                    return $cookie_id;
                }
            } else {
                return false;
            }
        }

    }

    class RGVPCurrencyFormater {

        public static function Roundoff($Number, $DecimalPlaces = 0, $ReturnArray = false, $ThousandSeparater = ',') {
            if ($ReturnArray) {
                $Returnarray = array();
                if (($Number - floor($Number)) == 0) {
                    $Returnarray["Amount"] = number_format($Number, $DecimalPlaces, '.', $ThousandSeparater);
                    $Returnarray["RoundOffAmount"] = "0.00";
                    $Returnarray["RoundOffSign"] = " ";
                } else if (($Number - floor($Number)) > 0.5) {
                    $Returnarray["RoundOffAmount"] = number_format((floor($Number) + 1) - $Number, $DecimalPlaces, '.', $ThousandSeparater);
                    $Returnarray["RoundOffSign"] = "+";
                    $Returnarray["Amount"] = number_format($Number + $Returnarray["RoundOffAmount"], $DecimalPlaces, '.', $ThousandSeparater);
                } else {
                    $Returnarray["RoundOffAmount"] = number_format($Number - (floor($Number)), $DecimalPlaces, '.', $ThousandSeparater);
                    $Returnarray["RoundOffSign"] = "-";
                    $Returnarray["Amount"] = number_format($Number - $Returnarray["RoundOffAmount"], $DecimalPlaces, '.', $ThousandSeparater);
                }
                return $Returnarray;
            } else {
                return number_format(round($Number, $DecimalPlaces), $DecimalPlaces, '.', $ThousandSeparater);
            }
        }

        public static function moneyFormatIndia($num) {
            $explrestunits = "";
            if (strlen($num) > 3) {
                $lastthree = substr($num, strlen($num) - 3, strlen($num));
                $restunits = substr($num, 0, strlen($num) - 3); // extracts the last three digits
                $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
                $expunit = str_split($restunits, 2);
                for ($i = 0; $i < sizeof($expunit); $i++) {
                    // creates each of the 2's group and adds a comma to the end
                    if ($i == 0) {
                        $explrestunits .= (int) $expunit[$i] . ","; // if is first value , convert into integer
                    } else {
                        $explrestunits .= $expunit[$i] . ",";
                    }
                }
                $thecash = $explrestunits . $lastthree;
            } else {
                $thecash = $num;
            }
            return $thecash; // writes the final format where $currency is the currency symbol.
        }

        public static function trim_all($str, $what = NULL, $with = ' ') {
            if ($what === NULL) {
                //  Character      Decimal      Use
                //  "\0"            0           Null Character
                //  "\t"            9           Tab
                //  "\n"           10           New line
                //  "\x0B"         11           Vertical Tab
                //  "\r"           13           New Line in Mac
                //  " "            32           Space

                $what = "\\x00-\\x20";    //all white-spaces and control chars
            }

            return trim(preg_replace("/[" . $what . "]+/", $with, $str), $what);
        }

        public static function NumbertoWords($Number, $Format = "INDIAN", $PreText = "", $PostText = "") {
            $NumberArray = self::Roundoff($Number, 0, false, '');
            $Number = intval($NumberArray);

            $ReturnArray = array();
            $ReturnArray["FormattedNumber"] = "";
            $ReturnArray["InWords"] = "";
            $ReturnArray["InNumber"] = $Number;
//$amount = '10000034000';
            //$amount = moneyFormatIndia( $amount );
            //echo $amount;
            //Zero Crore Zero Lakh Zero Thousand Zero Hundred Seventy
            //if ($Number == 0)
            //    $ReturnArray["InWords"] .= "Zero";
            //if ($Number < 0)
            //    $ReturnArray["InWords"] .= "Minus " . self::NumbertoWords(abs($Number));
            if (intval($Number / 10000000) > 0) {
                $ReturnArray["InWords"] .= self::TensUnits($Number / 10000000) . " Crore ";
                $ReturnArray["InNumber"] .= "";
                $Number %= 10000000;
            }
            if (intval($Number / 100000) > 0) {
                $ReturnArray["InWords"] .= self::TensUnits($Number / 100000) . " Lakh ";
                $Number %= 100000;
            }
            if (intval($Number / 1000) > 0) {
                $ReturnArray["InWords"] .= self::TensUnits($Number / 1000) . " Thousand ";
                $Number %= 1000;
            }
            if (intval($Number / 100) > 0) {
                $ReturnArray["InWords"] .= self::TensUnits($Number / 100) . " Hundred ";
                $Number %= 100;
            }
            if (intval($Number) > 0) {
                $ReturnArray["InWords"] .= self::TensUnits($Number);
            }
            $ReturnArray["InWords"] .= " Only.";
            return $ReturnArray;
        }

        public static function TensUnits($Number) {
            $unitsMap = array("Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen");
            $tensMap = array("Zero", "Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety");
            $words = "";
            if ($Number < 20)
                $words .= $unitsMap[$Number];
            else {
                $words = $tensMap[$Number / 10];
                if (($Number % 10) > 0)
                    $words .= " " . $unitsMap[$Number % 10];
            }
            return $words;
        }

    }

    class Page {

        public $Title;
        public $Keywords;
        public $Description;
        public $FileName;

        function __construct($Title = NULL, $Description = NULL, $Keywords = NULL) {
            $this->Title = $Title;
            $this->Description = $Description;
            $this->Keywords = $Keywords;
        }

    }

    class RGVPDB {

        var $RGVPCon;
        var $Msg, $RGVPQuery, $Response;
        var $DBConStatus;
        var $Exception;
        var $DBHost, $DBUser, $DBPassword, $DBName;
        var $ConnectTo; // Used to define that the User has mentioned the Params(UserDefined) or to use Default;
        var $StatusCode;
        var $PrimaryKeyID;
        var $Status;

        function __construct($DBHost = NULL, $DBUser = NULL, $DBPassword = NULL, $DBName = NULL) {
            if ($DBHost == NULL || $DBUser == NULL || $DBPassword == NULL) {
                $this->ConnectTo = "DefaultDB";
                $this->DBHost = RGVPDB_HOST;
                $this->DBUser = RGVPDB_USERNAME;
                $this->DBPassword = RGVPDB_PASSWORD;
                $this->DBName = RGVPDB_DBNAME;
            } else {
                $this->ConnectTo = "UserDB";
                $this->DBHost = $DBHost;
                $this->DBUser = $DBUser;
                $this->DBPassword = $DBPassword;
                $this->DBName = $DBName;
            }
        }

        /**
         * It is used to Connect to make Connection to the DB for Default DB or for specific db
         *  using This function by specifying data variables.
         * 
         * GetConnection();
         * 
         * If(Error Not Occurred)
         * @return SQLiConnection => if connection is successful.
         *  
         */
        static function GetConnection($DBHost = NULL, $DBUser = NULL, $DBPassword = NULL, $DBName = NULL) {
            if ($DBHost == NULL || $DBUser == NULL || $DBPassword == NULL)
                return mysqli_connect(RGVPDB_HOST, RGVPDB_USERNAME, RGVPDB_PASSWORD, RGVPDB_DBNAME);
            else
                return mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        }

        /**
         * It is used to Connect to make Connection to the DB for Default DB or for specific db
         *  using This function by specifying data variables.
         * 
         * GetConnection();
         * 
         * If(Error Not Occurred)
         * @return SQLiConnection => if connection is successful.
         *  
         */
        function RGVP_GetConnection($DBHost = NULL, $DBUser = NULL, $DBPassword = NULL, $DBName = NULL) {
            if ($DBHost == NULL || $DBUser == NULL || $DBPassword == NULL)
                return mysqli_connect(RGVPDB_HOST, RGVPDB_USERNAME, RGVPDB_PASSWORD, RGVPDB_DBNAME);
            else
                return mysqli_connect($DBHost, $DBUser, $DBPassword, $DBName);
        }

        /**
         * It is used to Connect to make Connection to the DB.
         * 
         * RGVPDB_GetConnection();
         * 
         * If(Error is Occured)
         * @return SQLiObject => if connection is successful.
         *  
         */
        static function RGVPDB_FilterParams($posted) {
            foreach ($posted as &$val)
                $val = mysqli_real_escape_string(self::RGVPDB_GetConnection(), trim($val));
            return $posted;
        }

        /**
         * It is used to Connect to make Connection to the DB.
         * 
         * RGVPDB_Connect();
         * 
         * If(Error is Occured)
         * @return bool <b>true</b> &nbsp;=> if successfully connected.<br> 
         *              <b>false</b> => if the connection is not successful.
         *  
         */
        function RGVPDB_Connect() {
            try {
                $this->RGVPCon = mysqli_connect($this->DBHost, $this->DBUser, $this->DBPassword, $this->DBName);

                // Check connection
                if (mysqli_connect_errno()) {
                    $this->RGVPCon = NULL;
                    $this->Msg = "Connection Error: " . mysqli_connect_error();
                    $this->StatusCode = "501";
                }
                $this->DBConStatus = "MySqli Connection Open.";
                $this->Status = TRUE;
                return $this->Status;
            } catch (Exception $RGVPExp) {

                $this->Exception = $RGVPExp->getMessage();
                $this->DBConStatus = "MySqli Connection Open Error.";
                $this->Status = FALSE;
                return $this->Status;
            }
        }

        /**
         * It is used to Disconnect to Sleeping Connection Made to the DB.
         * 
         * RGVPDB_Disconnect();
         * 
         * If(Error is Occurred)
         * @return bool It Returns true if connection is successfully disconnected or Returns false if the connection is not Disconnected.
         *   
         */
        function RGVPDB_Disconnect() {
            try {
                if (is_object($this->RGVPCon) && get_class($this->RGVPCon) == 'mysqli') {
                    $result = mysqli_query($this->RGVPCon, "SHOW processlist");
                    while ($myrow = mysqli_fetch_assoc($result)) {
                        if ($myrow['Command'] == "Sleep")
                            mysqli_query($this->RGVPCon, "KILL {$myrow['Id']};");
                        if ($mysqli_connection_thread = mysqli_thread_id($this->RGVPCon))
                            $this->RGVPCon->kill($mysqli_connection_thread);
                    }
                    $this->Status = TRUE;
                    $this->RGVPCon->close();
                    $this->DBConStatus = "MySqli Connection Closed.";
                    return $this->Status;
                }
            } catch (Exception $ex) {
                $this->Status = FALSE;
                $this->Exception = $ex->getMessage();
                $this->DBConStatus = "MySqli Connection Disconnect Error.";
                return $this->Status;
            }
        }

        /**
         * It is used to execute the query.
         * 
         * Execute_Query() Has 3 Params;
         * 
         * @param string $RGVPQuery  Query to be Executed.
         * @param string $CommandType Values: "GET" or "SET"
         *      SET = is used to Execute Query without Retrieving data as in UPDATE, INSERT, DELETE.
         *      GET = is used to Execute Query with Retrieving data as in SELECT COMMAND.
         * @param string $TypeFormat  If The $CommandType is SET then Mention in $TypeFormat = 'UPDATE','INSERT' or 'DELETE'.
         *      IF $CommandType is GET then Mention the $TypeFormat = 'SQLObj','JSON', 'CSV', 'HTML-Table', 'HTML-Table-View','HTML-Table-ViewDelete','HTML-Table-Update','HTML-Table-UpdateDelete'   
         * - 'SQLObj' = Return SQLObject
         * - 'JSON' = Returns JSONObject with following Format
         * - 'CSV' = Returns JSONObject with following Format and Data Format = CSV
         * - 'HTML-Table'= Returns JSONObject with following and Data Format = HTML Table 
         * - 'HTML-Table-View' = Returns JSONObject with following Content and Data Format = HTML Table with View File
         * - 'HTML-Table-ViewDelete' = Returns JSONObject with following Content and Data Format = HTML Table with View And Delete File
         * - 'HTML-Table-Update'= Returns JSONObject with following Content and Data Format = HTML Table with Update File
         * - 'HTML-Table-UpdateDelete' = Returns JSONObject with following Content and Data Format = HTML Table with Update and Delete File
         * 
         * @param string $PrimaryKeyID Specify The ID of the Current Row to be executed in the command.
         * 
         * @return string JSONObject with format:
         * 
         * Ex. '{"status": "success", "message":"DBError","result":{"statuscode":"501","AdditionalInfo":"Connection Error","HtmlResponse":"RGVPReportMsg($AdditionalInfo, $StatusText, $Code . " : " . $Response) . '","Data": "' . $Data . '"}}';
         *  
         * @return mysqli_result If you want to receive SQL Object
         *   
         */
        function Execute_Query($RGVPQuery, $CommandType = "SET", $TypeFormat = NULL, $PrimaryKeyID = NULL) {
            if ($this->RGVPDB_Connect()) {
                $RGVPQueryTimezone = "SET time_zone='+05:30';";
                $RGVPQueryResultTimeZone = mysqli_query($this->RGVPCon, $RGVPQueryTimezone);
                $this->RGVPQuery = $RGVPQuery;
                $RGVPQueryResult = mysqli_query($this->RGVPCon, $RGVPQuery);
                $this->Exception = mysqli_error($this->RGVPCon);
                $this->PrimaryKeyID = mysqli_insert_id($this->RGVPCon);
                $this->RGVPDB_Disconnect();
                if ($RGVPQueryResult === FALSE) {
                    $this->StatusCode = "503";
                    $this->Msg = "DB Command Not Execute. RGVPQueryResult Returned False.Error:" . $this->Exception;
                    $this->Response = \RGVPCore\RGVPCore::GETStatus($this->StatusCode, FALSE, $this->Msg, $this->RGVPQuery);
                    $this->Status = FALSE;
                    return $this->Response;
                } else {
                    $this->StatusCode = "502";
                    $this->Status = TRUE;
                    if ($CommandType == "SET") {
                        switch ($TypeFormat) {
                            case "INSERT":
                                //$this->Exception = var_dump($RGVPQueryResult);
                                $this->Msg = "Record has been successfully Inserted. The Ref. ID: " . $this->PrimaryKeyID . ".";
                                break;
                            case "UPDATE":
                                $this->PrimaryKeyID = $PrimaryKeyID;
                                $this->Msg = "Record has been Successfully Updated." . ($this->PrimaryKeyID != NULL) ? " The Updated Ref. ID: " . $this->PrimaryKeyID . "." : "";
                                break;
                            case "SELECT":
                                $this->PrimaryKeyID = $PrimaryKeyID;
                                $this->Msg = "Record has been Successfully Retrieved. But Incorrect CommandType Selected. Use 'GET' to retrieve Data. ";
                                break;
                            case "DELETE": $this->Msg = "Record has been Successfully Deleted. " . ($this->PrimaryKeyID != NULL) ? " The Deleted Ref. ID: " . $this->PrimaryKeyID . "." : "";
                                break;
                            default:
                                $this->PrimaryKeyID = $PrimaryKeyID;
                                $this->Msg = "Command Executed Successfully.";
                                break;
                        }
                        $this->Response = RGVPCore::GETStatus($this->StatusCode, TRUE, $this->Msg, $this->PrimaryKeyID);
                    } else if ($CommandType == "GET") {
                        switch ($TypeFormat) {
                            case "SQLObj":
                                $this->Msg = "SQLObj Returned.";
                                return $RGVPQueryResult;
                            case "JSON":
                                $this->Msg = "Yet to Process.";
                                break;
                            case "CSV":
                                $this->Msg = "Yet to Process.";
                                break;
                            case "HTML-Table": $this->Msg = "Yet to Process.";
                                break;
                            case "HTML-Table-View":
                                $this->Msg = "Yet to Process.";
                                break;
                            case "HTML-Table-ViewDelete":
                                $this->Msg = "Yet to Process.";
                                break;
                            case "HTML-Table-Update":
                                $this->Msg = "Yet to Process. ";
                                break;
                            case "HTML-Table-UpdateDelete":
                                $this->Msg = "Yet to Process. ";
                                break;
                            default:
                                $this->Msg = "Unknown";
                                break;
                        }
                        $this->Response = \RGVPCore\RGVPCore::GETStatus($this->StatusCode, TRUE, $this->Msg, $PrimaryKeyID);
                        return $this->Response;
                    }
                }
            } else {
                
            }
        }

        /**
         * It is used to execute the query.
         * 
         * Execute_Query() Has 2 Params;
         * 
         * @param MySQLiResult $MySQLiResult  Query to be Executed.
         * @param string $ReturnType  Mention the $TypeFormat = 'Array','HTML-Table', 'JSON','HTML-Select'   
         * - 'Array' = Return Array Object
         * - 'JSON' = Returns JSONObject with following Format
         * - 'HTML-Table'= Returns HTML Table of the Columns 
         * - 'HTML-Select' = Returns HTML Select with following Content and Data Format = HTML Table with View File
         * - 'HTML-Select-Multiple' = Returns HTML Select Multiple with following Content and Data Format = HTML Table with View And Delete File
         * - 'HTML-Table-Update'= Returns JSONObject with following Content and Data Format = HTML Table with Update File
         * - 'HTML-Table-UpdateDelete' = Returns JSONObject with following Content and Data Format = HTML Table with Update and Delete File
         * 
         * @param string $ReturnObjectName Specify The ID and name to the Returning HTML Object to be executed in the command.
         * 
         * @return string JSONObject with format:
         * 
         * Ex. '{"status": "success", "message":"DBError","result":{"statuscode":"501","AdditionalInfo":"Connection Error","HtmlResponse":"RGVPReportMsg($AdditionalInfo, $StatusText, $Code . " : " . $Response) . '","Data": "' . $Data . '"}}';
         *  
         * @return mysqli_result If you want to receive SQL Object
         *   
         */
        function Execute_Structure($MySQLiResult, $ReturnType, $ReturnObjectName = NULL) {
            $ColumnCount = mysqli_num_fields($MySQLiResult);
            $FieldArray = mysqli_fetch_fields($MySQLiResult);
            if ($ReturnType == "HTML-Table") {
                $DisplayTable = "<table id='" . $ReturnObjectName . "' name='" . $ReturnObjectName . "' class='table table-bordered table-hover'  border='1'><tr chass='panel-primary'><th>SN</th><th>Name</th><th>orgname</th><th>table</th><th>orgtable</th><th>def</th>"
                        . "<th>db</th><th>catalog</th><th>max_length</th><th>length</th><th>charsetnr</th><th>flags</th><th>type</th>"
                        . "<th>decimals</th></tr>";
//[0]=> object(stdClass)#4 (13) { ["name"]=> string(7) "StockID" ["orgname"]=> string(7) "StockID" ["table"]=> string(5) "stock" 
//["orgtable"]=> string(5) "stock" ["def"]=> string(0) "" ["db"]=> string(14) "rgvpws_jpmario" ["catalog"]=> string(3) "def" 
//["max_length"]=> int(1) ["length"]=> int(11) ["charsetnr"]=> int(63) 
//["flags"]=> string(44) "NOT_NULL PRI_KEY AUTO_INCREMENT NUM PART_KEY" ["type"]=> string(4) "LONG" ["decimals"]=> int(0) 
                $i = 1;
                foreach ($FieldArray as $Field) {
                    $Field->type = RGVP_MySQL_DataTypes::DataType2String($Field->type);
                    $Field->flags = RGVP_MySQL_DataTypes::Flags2String($Field->flags);
                    $DisplayTable .= '<tr><td>' . $i++ . '</td><td>' . $Field->name . '</td><td>' . $Field->orgname . '</td><td>' . $Field->table . '</td>'
                            . '<td>' . $Field->orgtable . '</td><td>' . $Field->def . '</td><td>' . $Field->db . '</td><td>' . $Field->catalog . '</td>'
                            . '<td>' . $Field->max_length . '</td><td>' . $Field->length . '</td><td>' . $Field->charsetnr . '</td><td>' . $Field->flags . '</td>'
                            . '<td>' . $Field->type . '</td><td>' . $Field->decimals . '</td></tr>';
                }
                $DisplayTable .= "</table>\n";
                return $DisplayTable;
            } else if ($ReturnType == "HTML-Select") {
                $DisplayTable = "<select id='" . $ReturnObjectName . "' class='form-control' name='" . $ReturnObjectName . "'>";
                //[0]=> object(stdClass)#4 (13) { ["name"]=> string(7) "StockID" ["orgname"]=> string(7) "StockID" ["table"]=> string(5) "stock" 
                //["orgtable"]=> string(5) "stock" ["def"]=> string(0) "" ["db"]=> string(14) "rgvpws_jpmario" ["catalog"]=> string(3) "def" 
                //["max_length"]=> int(1) ["length"]=> int(11) ["charsetnr"]=> int(63) 
                //["flags"]=> string(44) "NOT_NULL PRI_KEY AUTO_INCREMENT NUM PART_KEY" ["type"]=> string(4) "LONG" ["decimals"]=> int(0) 

                foreach ($FieldArray as $Field) {
                    $Field->type = RGVP_MySQL_DataTypes::DataType2String($Field->type);
                    $Field->flags = RGVP_MySQL_DataTypes::Flags2String($Field->flags);
                    $DisplayTable .= '<option value="' . $Field->name . '">' . $Field->name . '</option>';
                }
                $DisplayTable .= "</select>\n";
                return $DisplayTable;
            } else if ($ReturnType == "HTML-Select-Multiple") {
                $DisplayTable = "<select id='" . $ReturnObjectName . "' name='" . $ReturnObjectName . "' class='form-control' multiple='multiple'>";
                //[0]=> object(stdClass)#4 (13) { ["name"]=> string(7) "StockID" ["orgname"]=> string(7) "StockID" ["table"]=> string(5) "stock" 
                //["orgtable"]=> string(5) "stock" ["def"]=> string(0) "" ["db"]=> string(14) "rgvpws_jpmario" ["catalog"]=> string(3) "def" 
                //["max_length"]=> int(1) ["length"]=> int(11) ["charsetnr"]=> int(63) 
                //["flags"]=> string(44) "NOT_NULL PRI_KEY AUTO_INCREMENT NUM PART_KEY" ["type"]=> string(4) "LONG" ["decimals"]=> int(0) 

                foreach ($FieldArray as $Field) {
                    $Field->type = RGVP_MySQL_DataTypes::DataType2String($Field->type);
                    $Field->flags = RGVP_MySQL_DataTypes::Flags2String($Field->flags);
                    $DisplayTable .= '<option value="' . $Field->name . '">' . $Field->name . '</option>';
                }
                $DisplayTable .= "</select>\n";
                return $DisplayTable;
            } else if ($ReturnType == "Array") {
                foreach ($FieldArray as $Field) {
                    $Field->type = RGVP_MySQL_DataTypes::DataType2String($Field->type);
                    $Field->flags = RGVP_MySQL_DataTypes::Flags2String($Field->flags);
                }
                return $FieldArray;
            } else if ($ReturnType == "JSON") {
                foreach ($FieldArray as $Field) {
                    $Field->type = RGVP_MySQL_DataTypes::DataType2String($Field->type);
                    $Field->flags = RGVP_MySQL_DataTypes::Flags2String($Field->flags);
                }
                return json_encode($FieldArray);
            }
        }

        static function ExecuteQuery($RGVPQuery) {
            if (RGVPDB_Connect()) {
                $Sql_input = $RGVPQuery;
                $Sql_output = RGVP_ExecuteNonQuery($Sql_input);
                if (RGVPcontainsString("Error:", $Sql_output)) {
                    return RGVPReportMsg($Sql_output, "Failed", 'DB Command Execute Error', TRUE);
                } else {
                    RGVPDB_Disconnect();
                    return RGVPReportMsg($Sql_output, "Success", 'Command Executed Successfully.', TRUE);
                }
            } else
                return RGVPReportMsg("Error Establishing Connection. <br>Query: " . $RGVPQuery, "Failed", 'DB Connection Error', TRUE);
        }

        //RGVPQueryReturnFormats
        //1. SQLOBJECT
        //2. HTMLTABLE
        //

        static function ExecuteQuerySELECT($RGVPQuery, $RGVPQueryReturn = "SET") {

            $Sql_input = $RGVPQuery;
            $Sql_output = RGVP_ExecuteSelectQuery($Sql_input);
            if (RGVPcontainsString("Error:", $Sql_output)) {
                return RGVPReportMsg($Sql_output, "Failed", 'DB Command Execute Error', TRUE);
            } else
                return $Sql_output;
        }

        function FillSelect($Table, $DisplayColumn, $IsEnum = FALSE, $ValueColumn = NULL, $ControlID = NULL, $ControlName = NULL, $CssClass = "form-control") {
            if (!isset($ValueColumn))
                $ValueColumn = $DisplayColumn;
            if (!isset($ControlName))
                $ControlName = "ddl_" . $Table;
            if (!isset($ControlID))
                $ControlID = "ddl_" . $Table;
            $ReturnSelect = '<select name="' . $ControlName . '" id="' . $ControlID . '" class="' . $CssClass . '">';
            $result = "";
            if ($IsEnum) {
                $result = $this->Execute_Query("SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$Table' AND COLUMN_NAME = '$DisplayColumn'", "GET", 'SQLObj');
                $row = mysqli_fetch_assoc($result);
                $ArrayFields = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE']) - 6))));
                foreach ($ArrayFields as $Field) {
                    $ReturnSelect = $ReturnSelect . '<option value="' . htmlspecialchars($Field) . '">' . htmlspecialchars($Field) . '</option>';
                }
            } else
                $result = $this->Execute_Query("SELECT $ValueColumn,$DisplayColumn FROM $Table", "GET", 'SQLObj');
            while ($row = mysqli_fetch_assoc($result))
                $ReturnSelect = $ReturnSelect . '<option value="' . htmlspecialchars($row[$ValueColumn]) . '">' . htmlspecialchars($row[$DisplayColumn]) . '</option>';
            $ReturnSelect = $ReturnSelect . '</select>';
            return $ReturnSelect;
        }

        function FillSelectQuery($RGVPFillQuery, $DisplayColumn, $ValueColumn = NULL, $ControlID = NULL, $ControlName = NULL, $CssClass = "form-control", $datasearch = NULL, $Required = NULL) {

            if (!isset($ValueColumn))
                $ValueColumn = $DisplayColumn;
            if (!isset($ControlName))
                $ControlName = "ddl_" . $RGVPFillQuery;
            if (!isset($ControlID))
                $ControlID = "ddl_" . $RGVPFillQuery;
            $ReturnSelect = '<select name="' . $ControlName . '" id="' . $ControlID . '" class="' . $CssClass . '" data-live-search="' . $datasearch . '"' . $Required . '>';
            $result = "";
            $result = $this->Execute_Query($RGVPFillQuery, "GET", 'SQLObj');
            while ($row = mysqli_fetch_assoc($result))
                $ReturnSelect = $ReturnSelect . '<option value="' . htmlspecialchars($row[$ValueColumn]) . '">' . htmlspecialchars($row[$DisplayColumn]) . '</option>';
            $ReturnSelect = $ReturnSelect . '</select>';
            return $ReturnSelect;
        }

        function FilterInputs($Array) {
            foreach ($Array as &$ArrayItem)
                if ($ArrayItem)
                    $ArrayItem = mysqli_real_escape_string(self::RGVPDB_GetConnection(), $ArrayItem);
            return $Array;
        }

    }

    class RGVP_MySQL_DataTypes {

        public static function DataType2String($type_id) {
            static $types;
            if (!isset($types)) {
                $types = array();
                $constants = get_defined_constants(true);
                foreach ($constants['mysqli'] as $c => $n)
                    if (preg_match('/^MYSQLI_TYPE_(.*)/', $c, $m))
                        $types[$n] = $m[1];
            }
            return array_key_exists($type_id, $types) ? $types[$type_id] : NULL;
        }

        public static function Flags2String($flags_num) {
            static $flags;
            if (!isset($flags)) {
                $flags = array();
                $constants = get_defined_constants(true);
                foreach ($constants['mysqli'] as $c => $n)
                    if (preg_match('/MYSQLI_(.*)_FLAG$/', $c, $m))
                        if (!array_key_exists($n, $flags))
                            $flags[$n] = $m[1];
            }
            $result = array();
            foreach ($flags as $n => $t)
                if ($flags_num & $n)
                    $result[] = $t;
            return implode(' ', $result);
        }

    }

}    