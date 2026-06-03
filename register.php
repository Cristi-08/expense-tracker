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
        .form-box .btn-submit {
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
        .form-box .btn-submit:hover {
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
    </style>
</head>
<body>

<div class="form-box">
    <h1>Inregistrare</h1>

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
            <input type="password" id="parola" name="parola" placeholder="Alege o parola" required>
        </div>

        <button type="submit" class="btn-submit">Creeaza cont</button>
    </form>

    <p class="form-link">
        Am deja cont. <a href="login.php">Intra in cont</a>
    </p>
</div>

</body>
</html>
