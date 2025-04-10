<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Adjust the autoload require if needed based on your project folder structure.
require_once __DIR__ . "/../vendor/autoload.php";

class ContactUsController extends Controller
{
    public function sendEmail()
    {
        // Get input values and sanitize if necessary
        $name = $_POST['contact-us-name'] ?? '';
        $email = $_POST['contact-us-email'] ?? '';
        $message = $_POST['contact-us-message'] ?? '';

        // Basic validation (you might want more robust validation in production)
        if (empty($name) || empty($email) || empty($message)) {
            echo "All fields are required.";
            return;
        }

        // Create a new instance of PHPMailer and enable exceptions
        $mail = new PHPMailer(true);
        try {

            $mail->isSMTP();
            $mail->SMTPAuth = true;

            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->Username = 'fixmetek@gmail.com';
            $mail->Password = 'mgfj rysa smdz ivqv ';

            //Recipients
            $mail->setFrom($email, $name);
            $mail->addReplyTo($email, $name);
            $mail->addAddress('fixmetek@gmail.com', 'FixMe');

            // Content
            $mail->Subject = 'Fix Me Inquiries';
            $mail->Body = "From: $name <$email>\n\nMessage:\n$message";


            $mail->send();

            if (Application::$app->session->get('technician')) {
                header("Location: /technician-help");
            } elseif (Application::$app->session->get('serviceCenter')) {
                header("Location: /service-center-help");
            }

        } catch (Exception $e) {
            // Log the error message, for example:
            error_log("Mail Error: " . $mail->ErrorInfo);
            echo "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
        }
    }
}
