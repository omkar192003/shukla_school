<?php
include('smtp/PHPMailerAutoload.php');

echo smtp_mailer('prathameshshukla786@gmail.com', 'New Enquiry Forms', 'Hello,');
function smtp_mailer($to, $subject, $msg){
    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; 
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 2; 
    $mail->Username = "prathameshshukla786@gmail.com";
    $mail->Password = "stbf vhup hcmt ussb"; 
    $mail->SetFrom("prathameshshukla786@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => false
        )
    );
    if(!$mail->Send()){
        echo $mail->ErrorInfo;
    } else {
        return 'Sent';
    }
}
?>
