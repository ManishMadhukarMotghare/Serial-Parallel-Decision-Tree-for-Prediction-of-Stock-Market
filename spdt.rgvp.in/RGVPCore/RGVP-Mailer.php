<?php
/**
 * Author: RG-VP Web Solutions
 * Author URL: http://websiteinnagpur.com
 * License: Binded to use for personal use But Not to modify and Redistribute for commercial use.
 * Description: This File contains Necessary Working Classes and Objects to be used to run the Website.
 * Version: RGVP-Core 1.0
 */

$RGVPMail_SMTPAuth = TRUE;

Class RGVP_Mailer {

    private $mailSubject, $mailBody, $mail;

    function __construct() {
        
    }

    public static function SendMail($Subject, $Body, $To = "", $Cc = "") {
        include_once 'RGVPphpmailer/PHPMailerAutoload.php';
        include_once 'RGVPphpmailer/class.smtp.php';
        $mail = new PHPMailer();
        if(RGVPMailSMTPDebug > 0)
        $mail->SMTPDebug = RGVPMailSMTPDebug;              // Enable verbose debug output
        $mail->isSMTP();                                                // Set mailer to use SMTP
        $mail->Host = RGVPMailSMTPHost;                  // Specify main and backup SMTP servers
        $mail->SMTPAuth = RGVPMailSMTPAuth;               // Enable SMTP authentication
        $mail->Username = RGVPMailusername;                // SMTP username
        $mail->Password = RGVPMailpassword;                // SMTP password
        if (RGVPMailUseSSL)
            $mail->SMTPSecure = RGVPMailSMTPSecureProtocol;  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = RGVPMailSMTPPort;                    // TCP port to be used to connect.
        $mail->setFrom(RGVPMailFrom, RGVPMailFromName);
        if ($To != "")
            $mail->addAddress($To);
        else
            $mail->addAddress('', '');
        if($Cc != "")
            $mail->addCC($Cc);
        $mail->addReplyTo(RGVPMailReplyto, RGVPMailReplytoName);
        //$mail->addCC('cc@example.com');                               //$mail->addBCC('bcc@example.com');
        //$mail->addAttachment('/var/tmp/file.tar.gz');                 // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');            // Optional name
        $mail->isHTML(true);                                            // Set email format to HTML
        $mail->Subject = $Subject; //'New Enqiry Registered.';
        $mail->Body = $Body; //'New Enqiry Registered.<br><hr><br>';
        // $mail->AltBody = $Subject ; //'This is the body in plain text for non-HTML mail clients';
        if (!$mail->send()) {
            return 'Error: ' . $mail->ErrorInfo;
        } else {
            return 'Sent';
        }
    }

    public static function SendMailPEAR($Subject, $Body, $To="",$cc="") {
        include 'Mail.php';
        $headers = array(
            'From' => RGVPMailFrom,
            'To' => $To,
            'Subject' => $Subject
        );

        $SMTPConnect = array(
            'host' => RGVPMailSMTPHost,
            'auth' => RGVPMailSMTPAuth,
            'port' => RGVPMailSMTPPort,
            'username' => RGVPMailusername,
            'password' => RGVPMailpassword
        );
        $Mailsender = & Mail::factory('smtp', $SMTPConnect);
        $mail = $Mailsender->send($To, $headers, $Body);

        if(PEAR::isError($mail)) {
            return"<p>" . $mail->getMessage() . "</p>";
        } else {
            return "<p>Email successfully sent! to $To</p>";
        }
    }

}
