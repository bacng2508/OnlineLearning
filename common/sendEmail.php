<?php
//Start Forget Password
function sendMail($email) {
    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $account = pdo_query_one($sql);

    if ($account !== false) {
        // Tạo một chuỗi ngẫu nhiên
        $randomString = bin2hex(random_bytes(4)); // 8 ký tự hex (4 bytes)
        $hash_pass = sha1($randomString);

        $stsm = "UPDATE users SET user_password = '$hash_pass' WHERE user_email = '$email'";
        pdo_execute($stsm);

        sendMailPass($email, $account['user_name'], $randomString);
        
        return "Mật khẩu mới đã được gửi về Email của bạn!";
    }

    return "Email bạn nhập không tồn tại trong hệ thống.";

}

function sendMailPass($email, $username, $pass) {
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);
    $mail->CharSet = 'UTF-8';

    try {
        //Server settings
        $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                 //Enable SMTP authentication
        $mail->Username   = 'bacnhph31350@fpt.edu.vn';                     //SMTP username
        $mail->Password   = 'qdnbhwsgbgvywsxx';                               //SMTP password
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('bacnhph31350@fpt.edu.vn', 'PolyUni yêu cầu lấy lại mật khẩu');
        $mail->addAddress($email, $username);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = '[PolyUni] yêu cầu lấy lại mật khẩu';
        $mail->Body    = 'Mật khẩu mới của bạn là: ' . $pass;

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
// End Forget Password
?>