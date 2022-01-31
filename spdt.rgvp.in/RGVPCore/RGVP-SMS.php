<?php
/**
 * Author: RG-VP Web Solutions
 * Author URL: http://websiteinnagpur.com
 * License: Binded to use for personal use But Not to modify and Redistribute for commercial use.
 * Description: This File contains Necessary Working Classes and Objects to be used to run the Website.
 * Version: RGVP-Core 1.0
 */
 Class RGVP_SMS {

        function __construct() {
            
        }

        //SMS Functions
        public static function SendSMS($Message, $To) {
            if ($To == "") {
                return 'Error: Empty Number.';
            } else {
                $url = RGVPSMS_SendURL;
                $params = RGVPSMS_DefaultParams . "&" . RGVPSMS_ParamNumbers . "=$To&" . RGVPSMS_ParamMessage . "=" . urlencode($Message);
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
                } catch (Exception $ex) {
                    try {
                        $SMSResponse = file_get_contents($url . $params);
                        $ErrorResponse .= $ex->getMessage();
                    } catch (Exception $ex1) {
                        $SMSResponse = "Error";
                        $ErrorResponse .= $ex1->getMessage();
                    }
                }
                if ($SMSResponse != "Error")
                    if (is_numeric($SMSResponse))
                        return \RGVPCore\RGVPCore::GETStatus("650", TRUE, "SMS Sent Successfully.", '{"Response":"' . $SMSResponse . '","ErrorCatch":"' . $ErrorResponse . '"}');
                    else
                        return \RGVPCore\RGVPCore::GETStatus("653", TRUE, "SMS Not Sent. SMSError.", '{"Response":"' . $SMSResponse . '","ErrorCatch":"' . $ErrorResponse . '"}');
                else
                    return \RGVPCore\RGVPCore::GETStatus("651", TRUE, "SMS Not Sent. CatchError.", '{"Response":"' . $SMSResponse . '","ErrorCatch":"' . $ErrorResponse . '"}');
            }
        }

    }