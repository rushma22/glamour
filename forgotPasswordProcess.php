<?php
require "connection.php";
require "SMTP.php";
require "PHPMailer.php"; 
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if(isset($_GET["e"])){
    $email = $_GET["e"];

    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."'" );
    $n = $rs->num_rows;

    if($n==1){
        $code = uniqid();

        Database::iud("UPDATE `users` SET `verification_code`='".$code."' WHERE 
        `email`='".$email."'");

        $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'rushytq@gmail.com';
            $mail->Password = 'wrhkaaynzgixxttx';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('rushytq@gmail.com', 'Reset Password');
            $mail->addReplyTo('rushytq@gmail.com', 'Reset Password');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Glamour forgot password verification code';
            $bodyContent = '<h1 style="color:green;"> You verification code is '.$code.'</h1>';
            $mail->Body    = $bodyContent;

            if(!$mail->send()){
                echo("Sending failed");

            }else{
                echo("Success");
            }

    }else{
        echo("Invalid email address");
    }
}else{
    echo("Please enter your email first");
}

?>