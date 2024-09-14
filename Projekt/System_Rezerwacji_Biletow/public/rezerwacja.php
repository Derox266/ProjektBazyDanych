<?php
include '../includes/db.php'; // Połączenie z bazą danych
include '../includes/Wydarzenia.php'; // Klasa Wydarzenia

if (!isset($_GET['wydarzenie_id'])) {
    die("Nie podano ID wydarzenia.");
}

$wydarzenie_id = $_GET['wydarzenie_id'];

// Utwórz obiekt wydarzenia
$wydarzenia = new Wydarzenia($conn);
$wydarzenie = $wydarzenia->pobierzWydarzenie($wydarzenie_id);

if (!$wydarzenie) {
    die("Nie znaleziono wydarzenia.");
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rezerwacja Miejsc</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="my-4">Rezerwacja miejsc na wydarzenie: <?php echo htmlspecialchars($wydarzenie['NAZWA']); ?></h1>
        
        <!-- Formularz rezerwacji -->
        <form action="zarezerwuj.php" method="POST">
            <input type="hidden" name="wydarzenie_id" value="<?php echo $wydarzenie_id; ?>">
            <div class="mb-3">
                <label for="ilosc_miejsc" class="form-label">Ilość miejsc:</label>
                <input type="number" class="form-control" id="ilosc_miejsc" name="ilosc_miejsc" required>
            </div>
            <div class="mb-3">
                <label for="imie" class="form-label">Imię:</label>
                <input type="text" class="form-control" id="imie" name="imie" required>
            </div>
            <div class="mb-3">
                <label for="nazwisko" class="form-label">Nazwisko:</label>
                <input type="text" class="form-control" id="nazwisko" name="nazwisko" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Zarezerwuj</button>
        </form>
    </div>
</body>
</html>
