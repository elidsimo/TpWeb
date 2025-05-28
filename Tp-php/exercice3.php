<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Contact</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .success {
            margin-top: 20px;
            padding: 15px;
            background-color: #d4edda;
            border: 1px solid #28a745;
            border-radius: 4px;
            color: #155724;
        }

        .error {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #dc3545;
            background-color: #f8d7da;
            border-radius: 4px;
            color: #721c24;
        }

        .data-display strong {
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>

    <h1>Contactez-nous</h1>

    <form action="exercice3.php" method="post">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea><br>

        <input type="submit" value="Envoyer">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nom = trim($_POST['nom']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);

        if (empty($nom) || empty($email) || empty($message)) {
            echo "<div class='error'>Erreur: Tous les champs sont obligatoires.</div>";
        } else {
            echo "<div class='success'>Message envoyé avec succès! Voici les données reçues:</div>";
            echo "<div class='data-display'>";
            echo "<strong>Nom:</strong> " . htmlspecialchars($nom) . "<br>";
            echo "<strong>Email:</strong> " . htmlspecialchars($email) . "<br>";
            echo "<strong>Message:</strong> " . nl2br(htmlspecialchars($message)) . "<br>";
            echo "</div>";
        }
    }
    ?>

</body>

</html>