<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $unit_name = $_POST['unit_name'];
    $tax_code = $_POST['tax_code'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'sendongthap31bn@gmail.com'; // Địa chỉ email gửi
        $mail->Password = 'jtbl aige byxi ekzo'; // Mật khẩu ứng dụng hoặc mật khẩu của tài khoản email
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set encoding to UTF-8
        $mail->CharSet = 'UTF-8';
        
        // Email content
        $mail->setFrom('sendongthap31bn@gmail.com', 'ManLab');
        $mail->addAddress('sendongthap31bn@gmail.com'); // Địa chỉ email nhận thông báo
        $mail->Subject = 'Bạn nhận được thông báo từ ManLab'; // Tiêu đề email

        // Nội dung email
        $mail->isHTML(true); 
        $mail->Body = '
        <div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
            <h2 style="color: #2c3e50; border-bottom: 2px solid #e74c3c; padding-bottom: 10px;">
                Bạn nhận được thông báo từ ManLab:
            </h2>
            <p><strong>Tên:</strong> ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</p>
            <p><strong>Số điện thoại:</strong> ' . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . '</p>
            <p><strong>Email:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>
            <p><strong>Tên đơn vị (tổ chức):</strong> ' . htmlspecialchars($unit_name, ENT_QUOTES, 'UTF-8') . '</p>
            <p><strong>Mã số thuế đơn vị (tổ chức):</strong> ' . htmlspecialchars($tax_code, ENT_QUOTES, 'UTF-8') . '</p>
            <p><strong>Yêu cầu:</strong> ' . htmlspecialchars($subject, ENT_QUOTES, 'UTF-8') . '</p>
            <p><strong>Nội dung:</strong></p>
            <div style="background-color: #f9f9f9; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                ' . nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')) . '
            </div>
            <p style="margin-top: 20px; font-size: 0.9em; color: #888;">
                Đây là email tự động. Vui lòng không trả lời email này.
            </p>
        </div>';

        // Gửi email
        if ($mail->send()) {
            echo 'success';
        } else {
            echo 'error: ' . $mail->ErrorInfo;
        }

    } catch (Exception $e) {
        echo 'error: ' . $e->getMessage();
    }
}
?>