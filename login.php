<?php
// Citeste mesajul de eroare transmis prin URL dupa redirect
$eroare = isset($_GET['eroare']) ? htmlspecialchars($_GET['eroare']) : '';

$lang = $_COOKIE['lang'] ?? 'ro';
$translations = [
    'ro' => [
        'dashboard' => 'Panou principal', 'add' => 'Adauga', 'logout' => 'Deconectare', 'balance' => 'Sold curent', 'transactions' => 'Tranzactii', 'amount' => 'Suma (lei)', 'category' => 'Categorie', 'type' => 'Tip', 'date' => 'Data', 'description' => 'Descriere (optional)', 'income' => 'Venit', 'expense' => 'Cheltuiala', 'no_transactions' => 'Nu ai adaugat inca nicio tranzactie.', 'success' => 'Tranzactia a fost adaugata.',
        'login_title' => 'Autentificare',
        'nav_register' => 'Creeaza cont',
        'auth_subtitle' => 'Bun venit inapoi.',
        'auth_bullets' => ['Adauga venituri si cheltuieli in cateva secunde', 'Vezi soldul actualizat in timp real', 'Filtreaza si analizeaza tranzactiile usor'],
    ],
    'en' => [
        'dashboard' => 'Dashboard', 'add' => 'Add', 'logout' => 'Logout', 'balance' => 'Current balance', 'transactions' => 'Transactions', 'amount' => 'Amount (lei)', 'category' => 'Category', 'type' => 'Type', 'date' => 'Date', 'description' => 'Description (optional)', 'income' => 'Income', 'expense' => 'Expense', 'no_transactions' => 'No transactions yet.', 'success' => 'Transaction added.',
        'login_title' => 'Sign in',
        'nav_register' => 'Create account',
        'auth_subtitle' => 'Welcome back.',
        'auth_bullets' => ['Add income and expenses in seconds', 'See your balance update in real time', 'Filter and analyze your transactions easily'],
    ],
];
$t = $translations[$lang];
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificare</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .auth-page {
            display: flex;
            flex: 1;
        }

        .auth-side {
            flex: 0 0 40%;
            background-color: #0a0a0a;
            border-right: 1px solid #27272a;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
        }

        .auth-side-content { max-width: 380px; }

        .auth-logo {
            font-size: 1.8rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 16px;
        }

        .auth-subtitle {
            font-size: 1.15rem;
            color: #cccccc;
            margin-bottom: 28px;
            line-height: 1.5;
        }

        .auth-bullets {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .auth-bullets li {
            position: relative;
            padding: 8px 0 8px 26px;
            color: #888888;
            font-size: 0.9rem;
        }

        .auth-bullets li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #22c55e;
            font-weight: 700;
        }

        .auth-form-side {
            flex: 1;
            background-color: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
        }

        .form-box {
            width: 100%;
            max-width: 360px;
            background: none;
            border: none;
            padding: 0;
        }

        .form-box h1 {
            font-size: 1.5rem;
            margin-bottom: 24px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            color: #888888;
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            background-color: #0a0a0a;
            border: 1px solid #27272a;
            border-radius: 6px;
            color: #ffffff;
            font-size: 0.95rem;
        }

        .form-group input:focus {
            outline: none;
            border-color: #22c55e;
        }

        .btn-submit {
            width: 100%;
            text-align: center;
            padding: 12px;
            background-color: #22c55e;
            border: none;
            border-radius: 8px;
            color: #000000;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
        }

        .btn-submit:hover {
            background-color: #4ade80;
        }

        .form-link {
            display: block;
            text-align: center;
            margin-top: 16px;
            font-size: 0.9rem;
            color: #888888;
        }

        .form-link a {
            color: #22c55e;
        }

        /* Mesaj de eroare */
        .mesaj-eroare {
            background-color: #3b0e0e;
            border: 1px solid #f87171;
            color: #f87171;
            border-radius: 6px;
            padding: 10px 14px;
            margin-bottom: 18px;
            font-size: 0.9rem;
        }

        /* responsive: ascunde coloana stanga pe mobil */
        @media (max-width: 768px) {
            .auth-side { display: none; }
            .auth-form-side { min-height: 100vh; padding: 80px 20px 40px; }
        }
    </style>
</head>
<body>

<header class="auth-header">
    <a href="index.php" class="auth-header-logo">
        <span class="auth-header-name">ExpenseTracker</span>
    </a>
    <div class="auth-header-right">
        <a href="register.php" class="auth-switch-btn"><?= $t['nav_register'] ?></a>
        <button class="theme-toggle" id="theme-toggle" type="button" aria-label="Schimba tema">🌙</button>
        <button id="lang-btn" type="button" class="lang-btn">RO</button>
    </div>
</header>

<div class="auth-page">
    <div class="auth-side">
        <div class="auth-side-content">
            <div class="auth-logo">ExpenseTracker</div>
            <p class="auth-subtitle"><?= $t['auth_subtitle'] ?></p>
            <ul class="auth-bullets">
                <?php foreach ($t['auth_bullets'] as $bullet): ?>
                    <li><?= $bullet ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="auth-form-side">
        <div class="form-box">
            <h1><?= $t['login_title'] ?></h1>

            <?php if ($eroare): ?>
                <!-- Afiseaza eroarea primita de la auth.php -->
                <div class="mesaj-eroare"><?= $eroare ?></div>
            <?php endif; ?>

            <form action="php/auth.php" method="POST">
                <!-- Camp ascuns pentru a identifica actiunea -->
                <input type="hidden" name="actiune" value="login">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="email@exemplu.com" required>
                </div>

                <div class="form-group">
                    <label for="parola">Parola</label>
                    <input type="password" id="parola" name="parola" placeholder="Parola ta" required>
                </div>

                <button type="submit" class="btn-submit">Intra in cont</button>
            </form>

            <p class="form-link">
                Nu am cont. <a href="register.php">Creeaza cont</a>
            </p>
        </div>
    </div>
</div>

<script src="js/script.js"></script>
</body>
</html>
