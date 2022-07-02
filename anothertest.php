<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\PHPMailer\src\Exception.php';
require 'C:\PHPMailer\src\PHPMailer.php';
require 'C:\PHPMailer\src\SMTP.php';

$mail = new PHPMailer(TRUE);
try {

$mail->setFrom('ayomikunakintade@gmail.com', 'Ayomikun');//sender
$mail->addAddress('wilayakintade@gmail.com', 'WilAy');//receiver
$mail->Subject = 'Test';
$mail->Body = 'customer deatails.';
$mail->isSMTP();//use smtp
$mail->Host = 'smtp.gmail.com';//smtp server address
$mail->Port = 465;//smtp port
$mail->SMTPAuth = TRUE;//smtp authentication
$mail->SMTPSecure = 'ssl';//encryption
$mail->Username = 'ayomikunakintade@gmail.com';//smtp authentication username
$mail->Password = 'ibunkunoluwa';//smtp authentication password
$mail->SMTPDebug = 4;
$mail->send();
}
catch (Exception $e)
{

echo $e->errorMessage();
}
catch (\Exception $e)
{

echo $e->getMessage();
}
?>