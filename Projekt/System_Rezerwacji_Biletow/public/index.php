<?php
include '../includes/db.php'; // Połączenie z bazą danych
include '../includes/Wydarzenia.php'; // Klasa Wydarzenia

$wydarzenia = new Wydarzenia($conn); // Utworzenie obiektu Wydarzenia
$lista_wydarzen = $wydarzenia->pobierzWydarzenia();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Rezerwacji Biletów</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet"> <!-- Dołącz styl CSS -->
</head>
<body>

    <!-- Nawigacja -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">System Rezerwacji Biletów</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Strona główna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_event.php">Dodaj Wydarzenie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="your_reservations.php">Twoje Rezerwacje</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin_panel.php">Panel Administracyjny</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Sekcja wydarzeń -->
    <div class="container my-4">
        <h1 class="my-4 text-center">Dostępne Wydarzenia</h1>
        <div class="row">
            <?php if (count($lista_wydarzen) > 0): ?>
                <?php foreach ($lista_wydarzen as $wydarzenie): ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?php echo htmlspecialchars($wydarzenie['NAZWA']); ?></h5>
                            <p class="card-text">
                                <strong>Data:</strong> <?php echo htmlspecialchars($wydarzenie['DATA_WYDARZENIA']); ?><br>
                                <strong>Miejsce:</strong> <?php echo htmlspecialchars($wydarzenie['MIEJSCE']); ?><br>
                                <strong>Opis:</strong> <?php echo htmlspecialchars($wydarzenie['OPIS']); ?>
                            </p>
                            <a href="rezerwacja.php?wydarzenie_id=<?php echo $wydarzenie['WYDARZENIE_ID']; ?>" class="btn btn-success">Zarezerwuj</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Brak dostępnych wydarzeń.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer bg-dark text-white text-center py-3">
        <div class="container">
            &copy; 2024 System Rezerwacji Biletów. Wszystkie prawa zastrzeżone.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
