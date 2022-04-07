<?php

namespace Plugin\JtlShopPluginStarterKit\Src\Mail;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Plugin\JtlShopPluginStarterKit\Src\Models\EmailCredential;
use Plugin\JtlShopPluginStarterKit\Src\Validations\Alerts;

class Mail
{
    public function sendTestEmail($sender, $receiver)
    {

        $credential = new EmailCredential;
        $credentials = $credential->select('mail_host', 'username', 'password', 'port')->get();

        $credentials = $credentials[0];

        if ($credentials) {
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = $credentials->mail_host;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $credentials->username;                     //SMTP username
                $mail->Password   = $credentials->password;                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = $credentials->port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom($sender, 'Mailer');
                $mail->addAddress($receiver, 'Admin');     //Add a recipient
                $mail->addAddress($receiver);               //Name is optional
                $mail->addReplyTo($receiver, 'Information');
                $mail->addCC('cc@example.com');
                $mail->addBCC('bcc@example.com');

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'TestMail';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                $message = [
                    "status" => "201",
                    "message" => "Test email has been sent successfully"
                ];
                return $message;
            } catch (Exception $e) {
                $message = [
                    "status" => "422",
                    "message" => "Error while sending test email: {$mail->ErrorInfo}"
                ];
                return $message;
            }
        } else {
            Alerts::show('warning', ['post' => 'You have to enter email credentials first']);
        }
    }



    public function sendEmail($sender, $receiver)
    {

        $credential = new EmailCredential;
        $credentials = $credential->select('email','mail_host', 'username', 'password', 'port')->get();

        $credentials = $credentials[0];

        if ($credentials) {
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = $credentials->mail_host;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = $credentials->username;                     //SMTP username
                $mail->Password   = $credentials->password;                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = $credentials->port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom($sender, 'Mailer');
                $mail->addAddress( $credentials->email, 'Admin');     //Add a recipient
                $mail->addAddress( $credentials->email);               //Name is optional
                $mail->addReplyTo( $credentials->email, 'Information');
                $mail->addCC('cc@example.com');
                $mail->addBCC('bcc@example.com');

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'TestMail';
                $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                $message = [
                    "status" => "201",
                    "message" => "Test email has been sent successfully"
                ];
                return $message;
            } catch (Exception $e) {
                $message = [
                    "status" => "422",
                    "message" => "Error while sending test email: {$mail->ErrorInfo}"
                ];
                return $message;
            }
        } else {
            Alerts::show('warning', ['post' => 'You have to enter email credentials first']);
        }
    }
}
