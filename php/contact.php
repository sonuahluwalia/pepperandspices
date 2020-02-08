<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Load Composer's autoloader
require 'vendor/autoload.php';

// Email Submit
// Note: filter_var() requires PHP >= 5.2.0
if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['subject']) && isset($_POST['message']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

  // detect & prevent header injections
  $test = "/(content-type|bcc:|cc:|to:)/i";
  foreach ($_POST as $key => $val) {
    if (preg_match($test, $val)) {
      exit;
    }
  }


  // $headers = 'From: ' . $_POST["name"] . '<' . $_POST["email"] . '>' . "\r\n" .
  //     'Reply-To: ' . $_POST["email"] . "\r\n" .
  //     'X-Mailer: PHP/' . phpversion();

  //   //
  //   mail( "pepperandspices2020@gmail.com", $_POST['subject'], $_POST['message'], $headers );

  //   //      ^
  //   //  Replace with your email 




  // Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);
  $error = [];

  try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';              // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'pepperandspices2020@gmail.com';    // SMTP username
    $mail->Password   =  'Denmark123*@*@';               // SMTP password 
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
     $mail->setFrom('no-reply@pepperandspices.com', 'pepper&spices');
     $mail->addAddress('pepperandspices2020@gmail.com');     // Add a recipient
    $mail->addReplyTo('infopepper&spices@gmail.com', 'Information');
    /* $mail->addCC('cc@example.com');
  $mail->addBCC('bcc@example.com');
  */
    // Attachments

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'New Enquiry For  From  ' . $_POST['name'];
    $mail->Body    = 'Hello Admin , <br> New request from website for  ,  
                   details are: <br>  
                   <b>   Contact person: <b>' . $_POST['name'] . '
                   <br>  Email: <b>' . $_POST['email'] . '
                   <br>  Subject: <b>' . $_POST['subject'] . '
                   <br>  Message: <b>' . $_POST['message'];
    $mail->AltBody = 'Thank You,<br>';
    $mail->send();
    
    header( "Location: http://localhost/pepper&spices" );
    //echo 1;
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
