<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de Mot de Passe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
        }

        input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .password-output {
            margin-top: 20px;
            padding: 15px;
            background-color: #e0f7fa;
            border: 1px solid #00bcd4;
            border-radius: 4px;
            word-break: break-all;
        }

        .error {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #f44336;
            background-color: #ffe6e6;
            border-radius: 4px;
            color: #f44336;
        }
    </style>
</head>

<body>

    <h1>Générateur de Mot de Passe Aléatoire</h1>

    <form action="exercice2.php" method="post">
        <label for="length">Longueur du mot de passe désirée (min 6, max 32):</label><br>
        <input type="number" id="length" name="length" min="6" max="32" value="12" required><br><br>
        <input type="submit" value="Générer le mot de passe">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $length = filter_input(INPUT_POST, 'length', FILTER_VALIDATE_INT);

        if ($length === false || $length < 6 || $length > 32) {
            echo "<div class='error'>Veuillez entrer une longueur valide entre 6 et 32.</div>";
        } else {
            function generateStrongPassword($length = 12)
            {
                $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;:,.<>?';
                $password = '';
                $charCount = strlen($chars) - 1;

                for ($i = 0; $i < $length; $i++) {
                    $password .= $chars[mt_rand(0, $charCount)];
                }
                return $password;
            }

            $generatedPassword = generateStrongPassword($length);
            echo "<div class='password-output'>Mot de passe généré: <strong>" . htmlspecialchars($generatedPassword) . "</strong></div>";
        }
    }
    ?>

</body>

</html>