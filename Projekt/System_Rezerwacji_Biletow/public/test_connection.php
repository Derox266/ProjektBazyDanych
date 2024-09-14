<?php
include '../includes/db.php'; // Włączenie pliku db.php z połączeniem do bazy

// Test połączenia z bazą danych
try {
    // Sprawdzenie, czy połączenie działa
    if ($conn) {
        echo "Połączenie z bazą danych zostało nawiązane poprawnie!";
    } else {
        echo "Połączenie nie zostało nawiązane.";
    }
} catch (PDOException $e) {
    echo "Błąd połączenia: " . $e->getMessage();
}
?>
