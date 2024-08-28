<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $cognome = $_POST['cognome'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $messaggio = $_POST['messaggio'] ?? '';
    $ruoli = isset($_POST['ruolo']) ? implode(", ", $_POST['ruolo']) : '';

    $to = "segreteriauniversome@gmail.com";
    $subject = "Nuovo messaggio dal form di contatto";

    $message = "Hai ricevuto un nuovo messaggio dal form di contatto:\n\n";
    $message .= "Nome: $nome\n";
    $message .= "Cognome: $cognome\n";
    $message .= "Telefono: $telefono\n";
    $message .= "Email: $email\n";
    $message .= "Messaggio: $messaggio\n";
    $message .= "Ruoli di interesse: $ruoli\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(["success" => true, "message" => "Email inviata con successo!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Si è verificato un errore durante l'invio dell'email."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Metodo non consentito"]);
}
?>