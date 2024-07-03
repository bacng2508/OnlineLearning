<?php
//Đăng ký
function signUp($email, $user, $pass, $user_name) {
    // Kiểm tra xem username hoặc email đã tồn tại chưa
    $check_sql = "SELECT * FROM users WHERE username = '$user' OR user_email = '$email'";
    $existing_user = pdo_query_one($check_sql);

    if ($existing_user) {
        // Nếu đã tồn tại, trả về thông báo
        return 'Email hoặc Username đã tồn tại, vui lòng đăng ký tài khoản khác!';
    } else {
        // Nếu không tồn tại, thêm tài khoản mới
        $insert_sql = "INSERT INTO users(user_email, username, user_password, user_name, roles) 
                        VALUES('$email', '$user', '$pass', '$user_name', 3)";

        pdo_execute($insert_sql);
        return 'Đã đăng ký thành công, vui lòng đăng nhập!';
    }
}

//Đăng nhập User
function signIn($user, $pass){
    $sql = "SELECT * FROM users WHERE (username = '$user' OR user_email = '$user') AND user_password = '$pass' AND roles = 3";
    $reslut = pdo_query_one($sql);
    return $reslut;
}

//
function update_user_session_id($user_session_id, $user_id){
    $sql = "UPDATE users SET user_session_id = $user_session_id 
            WHERE user_id = $user_id";
    pdo_query($sql);
}

//
function update_session($user_id){
    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $check_account = pdo_query_one($sql);
    return $check_account;
}

//
function update_account($user_id, $user_email, $user_name, $user_phone, $user_avatar){
    $sql = "UPDATE users SET user_email='$user_email', user_name='$user_name',user_phone='$user_phone',user_avatar='$user_avatar'  
            WHERE user_id = $user_id";
    $update =  pdo_execute($sql);
    return $update;
}

//change password
function change_password($user_id, $user_password){
    $sql = "UPDATE users SET user_password = '$user_password'  
            WHERE user_id = $user_id";
    pdo_execute($sql);
}

//Start Forget Password
// function sendMail($email) {
//     $sql = "SELECT * FROM users WHERE user_email = '$email'";
//     $account = pdo_query_one($sql);

//     if ($account !== false) {
//         // Tạo một chuỗi ngẫu nhiên
//         $randomString = bin2hex(random_bytes(4)); // 8 ký tự hex (4 bytes)
//         $hash_pass = sha1($randomString);

//         $stsm = "UPDATE users SET user_password = '$hash_pass' WHERE user_email = '$email'";
//         pdo_execute($stsm);

//         sendMailPass($email, $account['user_name'], $randomString);
        
//         return "Mật khẩu mới đã được gửi về Email của bạn!";
//     }

//     return "Email bạn nhập không tồn tại trong hệ thống.";

// }

// function sendMailPass($email, $username, $pass) {
//     require 'PHPMailer/src/Exception.php';
//     require 'PHPMailer/src/PHPMailer.php';
//     require 'PHPMailer/src/SMTP.php';

//     $mail = new PHPMailer\PHPMailer\PHPMailer(true);
//     $mail->CharSet = 'UTF-8';

//     try {
//         //Server settings
//         $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_OFF;                      //Enable verbose debug output
//         $mail->isSMTP();                                            //Send using SMTP
//         $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
//         $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//         $mail->Username   = 'hieptqph43210@fpt.edu.vn';                     //SMTP username
//         $mail->Password   = 'wuylvzynfhrwvlgs';                               //SMTP password
//         $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
//         $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//         //Recipients
//         $mail->setFrom('hieptqph43210@fpt.edu.vn', 'PolyUni yêu cầu lấy lại mật khẩu');
//         $mail->addAddress($email, $username);     //Add a recipient

//         //Content
//         $mail->isHTML(true);                                  //Set email format to HTML
//         $mail->Subject = '[PolyUni] yêu cầu lấy lại mật khẩu';
//         $mail->Body    = 'Mật khẩu mới của bạn là: ' . $pass;

//         $mail->send();
//     } catch (Exception $e) {
//         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//     }
// }
// End Forget Password

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ADMIN//

//login
function loginAdmin($user, $pass){
    $sql = "SELECT * FROM users WHERE (username = '$user' OR user_email = '$user') AND user_password = '$pass' AND (roles = 2 OR roles = 1)";
    $reslut = pdo_query_one($sql);
    return $reslut;
}



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>