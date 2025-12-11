<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Email tujuan
$receiving_email_address = 'anaskhoiri19@gmail.com';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? 'No Subject');
    $message = trim($_POST['message'] ?? '');

    if ($name == '' || $email == '' || $message == '') {
        echo "Please fill all required fields.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Mulai PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'anaskhoiri19@gmail.com';
        $mail->Password   = 'powl icyj apni lfqx';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Email pengirim & penerima
        $mail->setFrom($email, $name);
        $mail->addAddress($receiving_email_address);

        // Isi email
        $mail->Subject = "Contact Form: $subject";
        $mail->Body    =
            "Name: $name\n" .
            "Email: $email\n" .
            "Subject: $subject\n\n" .
            "Message:\n$message\n";

        // Kirim
        $mail->send();
        echo "OK";

    } catch (Exception $e) {
        echo "Email failed: {$mail->ErrorInfo}";
    }

} else {
    echo "Invalid Request Method";
}
?>
