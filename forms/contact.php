<?php
// forms/contact.php

// Email tujuan
$receiving_email_address = 'anaskhoiri19@gmail.com';

// Cek kalau request-nya adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Ambil dan amankan data dari form
    $name    = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email   = isset($_POST['email']) ? trim($_POST['email']) : '';
    $subject = isset($_POST['subject']) ? trim($_POST['subject']) : 'No Subject';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Validasi sederhana
    if ($name === '' || $email === '' || $message === '') {
        echo 'Please fill in all required fields.';
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email format.';
        exit;
    }

    // Susun isi email
    $email_subject = "Contact Form: " . $subject;
    $email_body    = "You have received a new message from the contact form.\n\n"
                   . "Name   : $name\n"
                   . "Email  : $email\n"
                   . "Subject: $subject\n\n"
                   . "Message:\n$message\n";

    // Header email
    $headers  = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Kirim email (catatan: mail() sering tidak jalan di localhost tanpa konfigurasi mail server)
    if (mail($receiving_email_address, $email_subject, $email_body, $headers)) {
        // BootstrapMade JS biasanya menganggap "OK" sebagai sukses
        echo 'OK';
    } else {
        echo 'Failed to send email. Please try again later.';
    }

} else {
    // Jika file diakses langsung tanpa POST
    echo 'Invalid request method.';
}
?>
