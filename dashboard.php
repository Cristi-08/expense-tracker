<?php
// Porneste sesiunea - obligatoriu pe paginile protejate
session_start();

// Daca utilizatorul nu e autentificat, trimite-l la login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Preia datele utilizatorului din sesiune
$user_id   = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Citeste cheltuielile din JSON
$fisier     = 'data/expenses.json';
$continut   = file_get_contents($fisier);
$cheltuieli = json_decode($continut, true);

// Daca fisierul e gol sau invalid, initializam un array gol
if (!is_array($cheltuieli)) {
    $cheltuieli = [];
}

// Filtreaza doar cheltuielile utilizatorului curent
$cheltuieli_mele = [];
foreach ($cheltuieli as $cheltuiala) {
    if ($cheltuiala['user_id'] === $user_id) {
        $cheltuieli_mele[] = $cheltuiala;
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .dashboard-wrap {
            max-width: 800px;
            margin: 100px auto 40px;
            padding: 0 24px;
        }
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }
        .dashboard-header h1 {
            font-size: 1.4rem;
        }
        .btn-logout {
            background-color: transparent;
            border: 1px solid #2a2a2a;
            color: #888888;
            padding: 7px 16px;
            border-radius: 8px;
            font-size: 0.9rem;
            text-decoration: none;
        }
        .btn-logout:hover {
            border-color: #f87171;
            color: #f87171;
        }
        /* Mesaj cand nu sunt cheltuieli */
        .mesaj-gol {
            background-color: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 8px;
            padding: 32px;
            text-align: center;
            color: #888888;
            font-size: 0.95rem;
        }
        /* Tabel cheltuieli */
        .tabel-cheltuieli {
            width: 100%;
            border-collapse: collapse;
            background-color: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 8px;
            overflow: hidden;
        }
        .tabel-cheltuieli th {
            text-align: left;
            padding: 12px 16px;
            font-size: 0.8rem;
            color: #888888;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 1px solid #2a2a2a;
        }
        .tabel-cheltuieli td {
            padding: 12px 16px;
            font-size: 0.95rem;
            border-bottom: 1px solid #2a2a2a;
            color: #ffffff;
        }
        .tabel-cheltuieli tr:last-child td {
            border-bottom: none;
        }
        .tabel-cheltuieli tr:hover td {
            background-color: #222222;
        }
        /* Suma cu culoare rosie */
        .suma-rosie {
            color: #f87171;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="dashboard-wrap">
    <div class="dashboard-header">
        <h1>Bun venit, <?= htmlspecialchars($user_name) ?>!</h1>
        <a href="logout.php" class="btn-logout">Deconectare</a>
    </div>

    <?php if (empty($cheltuieli_mele)): ?>
        <!-- Nu are inca nicio cheltuiala adaugata -->
        <div class="mesaj-gol">
            Nu ai adaugat inca nicio cheltuiala.
        </div>
    <?php else: ?>
        <!-- Tabel cu cheltuielile utilizatorului -->
        <table class="tabel-cheltuieli">
            <thead>
                <tr>
                    <th>Descriere</th>
                    <th>Categorie</th>
                    <th>Suma</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cheltuieli_mele as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['descriere'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($c['categorie'] ?? '-') ?></td>
                        <td class="suma-rosie"><?= htmlspecialchars($c['suma'] ?? '0') ?> RON</td>
                        <td><?= htmlspecialchars($c['data'] ?? '-') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
