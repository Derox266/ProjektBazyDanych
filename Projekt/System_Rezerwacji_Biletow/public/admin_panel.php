<?php
include '../includes/db.php';
include '../includes/Wydarzenia.php';
include '../includes/Rezerwacje.php';

$wydarzenia = new Wydarzenia($conn);
$rezerwacje = new Rezerwacje($conn);

$lista_wydarzen = $wydarzenia->pobierzWydarzenia();
$lista_rezerwacji = $rezerwacje->pobierzRezerwacje();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administracyjny</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet"> <!-- Dołącz styl CSS -->
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1 0 auto;
        }
        .footer {
            flex-shrink: 0;
            padding: 5px 0; /* Mniejszy padding w stopce */
        }
    </style>
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
                        <a class="nav-link" href="index.php">Strona główna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_event.php">Dodaj Wydarzenie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="your_reservations.php">Twoje Rezerwacje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admin_panel.php">Panel Administracyjny</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container content my-4">
        <h1 class="text-center mb-4">Panel Administracyjny</h1>

        <!-- Zarządzanie Wydarzeniami -->
        <h2 class="my-4 text-primary">Zarządzanie Wydarzeniami</h2>
        <div class="row">
            <?php if (count($lista_wydarzen) > 0): ?>
                <?php foreach ($lista_wydarzen as $wydarzenie): ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-success"><?php echo htmlspecialchars($wydarzenie['NAZWA']); ?></h5>
                            <p class="card-text">
                                <strong>Data:</strong> <?php echo htmlspecialchars($wydarzenie['DATA_WYDARZENIA']); ?><br>
                                <strong>Miejsce:</strong> <?php echo htmlspecialchars($wydarzenie['MIEJSCE']); ?><br>
                                <strong>Opis:</strong> <?php echo htmlspecialchars($wydarzenie['OPIS']); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-warning">Brak wydarzeń.</p>
            <?php endif; ?>
        </div>

        <!-- Zarządzanie Rezerwacjami -->
        <h2 class="my-4 text-primary">Zarządzanie Rezerwacjami</h2>
        <div class="row">
            <?php if (count($lista_rezerwacji) > 0): ?>
                <?php foreach ($lista_rezerwacji as $rezerwacja): ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-info">Wydarzenie ID: <?php echo htmlspecialchars($rezerwacja['WYDARZENIE_ID']); ?></h5>
                            <p class="card-text">
                                <strong>Data rezerwacji:</strong> <?php echo htmlspecialchars($rezerwacja['DATA_REZERWACJI']); ?><br>
                                <strong>Status:</strong> <?php echo htmlspecialchars($rezerwacja['STATUS']); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center text-warning">Brak rezerwacji.</p>
            <?php endif; ?>
        </div>
    </div>

    <footer class="footer bg-dark text-white text-center py-2"> <!-- Zmniejszony padding w stopce -->
        <div class="container">
            &copy; 2024 System Rezerwacji Biletów. Wszystkie prawa zastrzeżone.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
