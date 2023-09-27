<?php
ob_start();
require 'PHPMailer.php';
require 'SMTP.php';
require 'Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
error_reporting(E_ALL);
ini_set('display_errors', 1);
    try
    {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            header('Location:../../valid.html');
            exit();
            $myhoster = "HOSTING";
            $mymail = "contact@develobyte.online";
            $myname = "Tibo Krekelbergh";
            $myphonenumber = "+32 497 42 92 96";

            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            

            $body = "
            <!DOCTYPE html>
            <html>
            <head>
                <title>Bericht</title>
                <style>
                h2
                {
                    margin:0;
                    padding:0;
                }
                h3
                {
                    margin:0;
                    margin-bottom:0rem;
                    padding:0;
                }
                p
                {
                    margin:0;
                    padding:0;
                }
                </style>
            </head>
            <body>
                <p>$message</p>
            </body>
            </html>
            
            ";

            //Create new instance
            $mail = new PHPMailer(true);

            //Server Settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = $myhoster;
            $mail->SMTPAuth= "true";        
            $mail->Username = "no-reply@develobyte.online";
            $mail->Password = "";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = 465;  
    
            //Recipients
            $mail->setFrom($email, $name);
            $mail->addAddress($mymail);
            $mail->addReplyTo($email);

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            
            $mail->send();
            echo "Email was sent";
            $mail->smtpClose();



            //Reply
            //Create new instance
            $replymail =  new PHPMailer(true);


            //Server Settings
            $replymail->SMTPDebug = SMTP::DEBUG_SERVER;
            $replymail->isSMTP();
            $replymail->Host = $myhoster;
            $replymail->SMTPAuth= "true";        
            $replymail->Username = $mymail;
            $replymail->Password = "";
            $replymail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $replymail->Port = 465;  


             //Recipients
             $replymail->setFrom($mymail, $myname);
             $replymail->addAddress($email);
             $replymail->addReplyTo($mymail);
 
 
             //Content
             $replybody = "
             <h2>Bedankt voor uw bericht!</h2>
             <p>Ik zal u zo snel mogelijk proberen terug te contacteren.<br><br>
             Met vriendelijke groet<br>
             $myname<br>
             $myphonenumber<br>
             $mymail
             </p>
             ";
             $replymail->isHTML(true);                                  //Set email format to HTML
             $replymail->Subject = "Bedankt voor uw bericht!";
             $replymail->Body = $replybody;
 
 
             
             $replymail->send();
             echo "Email was sent";
             $replymail->smtpClose();




            //MESSAGE HAS BEEN SUCCESSFULLY SEND
            header('Location:../../valid.html');
            exit();
        }
        catch(Exception $e)
        {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            header('Location:../../notvalid.html');
            exit();
        }
        ?>