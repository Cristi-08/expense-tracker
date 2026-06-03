<?php
// Citeste mesajele transmise prin URL dupa redirect
$eroare = isset($_GET['eroare']) ? htmlspecialchars($_GET['eroare']) : '';
$succes = isset($_GET['succes']) && $_GET['succes'] === '1';
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inregistrare</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .form-box {
            max-width: 400px;
            margin: 120px auto 40px;
            background-color: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 8px;
            padding: 32px;
        }
        .form-box h1 {
            font-size: 1.4rem;
            margin-bottom: 24px;
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
            padding: 10px 12px;
            background-color: #0f0f0f;
            border: 1px solid #2a2a2a;
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
            padding: 11px;
            background-color: #22c55e;
            border: none;
            border-radius: 8px;
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 500;
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
        /* Mesaj de succes */
        .mesaj-succes {
            background-color: #052e16;
            border: 1px solid #22c55e;
            color: #22c55e;
            border-radius: 6px;
            padding: 10px 14px;
            margin-bottom: 18px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h1>Inregistrare</h1>

    <?php if ($eroare): ?>
        <!-- Afiseaza eroarea primita de la auth.php -->
        <div class="mesaj-eroare"><?= $eroare ?></div>
    <?php endif; ?>

    <?php if ($succes): ?>
        <!-- Afiseaza confirmarea si un link catre login -->
        <div class="mesaj-succes">Cont creat cu succes!</div>
        <p class="form-link">
            <a href="login.php">Intra in cont &rarr;</a>
        </p>
    <?php else: ?>
        <!-- Formularul este ascuns dupa succes -->
        <form action="php/auth.php" method="POST">
            <!-- Camp ascuns pentru a identifica actiunea -->
            <input type="hidden" name="actiune" value="register">

            <div class="form-group">
                <label for="nume">Nume</label>
                <input type="text" id="nume" name="nume" placeholder="Numele tau" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="email@exemplu.com" required>
            </div>

            <div class="form-group">
                <label for="parola">Parola</label>
                <input type="password" id="parola" name="parola" placeholder="Minim 6 caractere" required>
            </div>

            <button type="submit" class="btn-submit">Creeaza cont</button>
        </form>

        <p class="form-link">
            Am deja cont. <a href="login.php">Intra in cont</a>
        </p>
    <?php endif; ?>
</div>

</body>
</html>
