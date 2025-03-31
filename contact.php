<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $country = htmlspecialchars($_POST["country"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $company = htmlspecialchars($_POST["company"]);
    $amount = htmlspecialchars($_POST["amount"]);
    $payment_method = htmlspecialchars($_POST["payment_method"]);
    $currency = htmlspecialchars($_POST["currency"]);
    $date = htmlspecialchars($_POST["date"]);
    $scam_type = htmlspecialchars($_POST["scam_type"]);
    $message = htmlspecialchars($_POST["message"]);

    $to = "info@thexasony.com";
    $subject = "New Contact Form Submission";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    $body = "
    <h2>New Contact Form Submission</h2>
    <p><strong>Name:</strong> $name</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Country:</strong> $country</p>
    <p><strong>Phone:</strong> $phone</p>
    <p><strong>Scam Company Name:</strong> $company</p>
    <p><strong>Amount Lost:</strong> $amount</p>
    <p><strong>Payment Method:</strong> $payment_method</p>
    <p><strong>Currency:</strong> $currency</p>
    <p><strong>Last Transaction Date:</strong> $date</p>
    <p><strong>Scam Type:</strong> $scam_type</p>
    <p><strong>Message:</strong> $message</p>";

    if (mail($to, $subject, $body, $headers)) {
        echo json_encode(["success" => true, "message" => "Message sent successfully!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error sending message."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request."]);
}
?>
