<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'sendongthap31bn@gmail.com'; // Địa chỉ email người gửi
    $mail->Password = 'jtbl aige byxi ekzo'; // Mật khẩu của tài khoản email
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Email content
    $mail->setFrom('sendongthap31bn@gmail.com', 'Your Name'); // Địa chỉ email gửi và tên người gửi
    $mail->addAddress('sendongthap31bn@gmail.com'); // Địa chỉ email nhận
    $mail->Subject = 'Test Email'; // Chủ đề email
    $mail->Body = 'This is a test email sent from PHPMailer.'; // Nội dung email

    // Gửi email và kiểm tra kết quả
    if ($mail->send()) {
        echo 'success'; // Gửi thành công
    } else {
        echo 'error: ' . $mail->ErrorInfo; // Lỗi nếu gửi không thành công
    }

} catch (Exception $e) {
    echo 'error: ' . $e->getMessage(); // Lỗi trong quá trình gửi
}
?>