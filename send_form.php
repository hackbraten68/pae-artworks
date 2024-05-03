<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    $to = "email@gmail.com"; // HIER EMAIL ANGEBEN !
    $subject = "Neue Kontaktanfrage von $name";
    $body = "Name: $name\n\nE-Mail: $email\n\nNachricht: $message";
    mail($to, $subject, $body);

    
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Formular konnte nicht gesendet werden"]);
}
?>
