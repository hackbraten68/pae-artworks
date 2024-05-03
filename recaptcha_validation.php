<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recaptchaResponse = $_POST["g-recaptcha-response"];

    // Überprüfe das reCAPTCHA
    $recaptchaSecretKey = "SECRET_ACCESS_KEY";
    $recaptchaUrl = "CAPTCHA_URL";
    $recaptchaData = [
        "secret" => $recaptchaSecretKey,
        "response" => $recaptchaResponse
    ];
    $recaptchaOptions = [
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
            "content" => http_build_query($recaptchaData)
        ]
    ];
    $recaptchaContext = stream_context_create($recaptchaOptions);
    $recaptchaResult = file_get_contents($recaptchaUrl, false, $recaptchaContext);
    $recaptchaResultJson = json_decode($recaptchaResult);

    if ($recaptchaResultJson->success) {
        // reCAPTCHA validiert erfolgreich
        // Füge hier deine bestehende Logik für die Formularverarbeitung ein
        // Zum Beispiel:
        // include "form_process.php"; // Hier deine PHP-Logik für die Formularverarbeitung einfügen
    } else {
        // reCAPTCHA nicht bestanden
        echo json_encode(["error" => "reCAPTCHA-Überprüfung fehlgeschlagen"]);
    }
} else {
    // Fehler: Das Formular wurde nicht korrekt gesendet
    echo json_encode(["error" => "Formular konnte nicht gesendet werden"]);
}
?>

