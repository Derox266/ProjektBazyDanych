<?php
// Konfiguracja połączenia z bazą danych Oracle
$host = 'localhost';  // Adres hosta (localhost dla lokalnej bazy danych)
$port = '1521';       // Port Oracle (domyślnie 1521)
$dbname = 'xe';       // Nazwa bazy danych (XE dla Oracle XE)
$username = 'system'; // Użytkownik bazy danych (możesz podać innego, jeśli go stworzyłeś)
$password = 'studentaplikacja'; // Hasło do bazy danych Oracle

// Użycie PDO do połączenia z bazą danych Oracle
$dsn = "oci:dbname=(DESCRIPTION=
    (ADDRESS=(PROTOCOL=TCP)(HOST=$host)(PORT=$port))
    (CONNECT_DATA=(SERVICE_NAME=$dbname)))";

try {
    // Tworzenie nowego obiektu PDO
    $conn = new PDO($dsn, $username, $password);
    
    // Ustawienie trybu raportowania błędów na wyjątki
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Opcjonalnie: potwierdzenie, że połączenie działa
    // echo "Połączono z bazą danych Oracle!";
    
} catch (PDOException $e) {
    // Obsługa błędów
    echo "Błąd połączenia: " . $e->getMessage();
}
?>
