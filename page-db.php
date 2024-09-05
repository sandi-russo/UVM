<?php
// Recupera le informazioni di connessione dal file wp-config.php
$servername = DB_HOST;
$username = DB_USER;
$password = DB_PASSWORD;
$dbname = DB_NAME;

// Crea una connessione al database
$conn = new mysqli($servername, $username, $password, $dbname);

// Controlla la connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

// Stampa informazioni sulla connessione
echo "Connessione riuscita al database: " . $dbname . "<br>";
echo "Server MySQL/MariaDB: " . $servername . "<br>";
echo "Versione del server: " . $conn->server_info . "<br>";

// Chiudi la connessione
$conn->close();
?>
