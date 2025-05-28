<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livre d'or</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            text-align: center;
            color: #333;
        }

        form {
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        textarea {
            min-height: 80px;
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #17a2b8;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        input[type="submit"]:hover {
            background-color: #138496;
        }

        .message-entry {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 15px;
            border: 1px solid #dee2e6;
        }

        .message-entry strong {
            color: #007bff;
        }

        .message-entry .date {
            font-size: 0.85em;
            color: #6c757d;
            margin-top: 5px;
            text-align: right;
        }

        .error {
            color: #dc3545;
            margin-bottom: 15px;
            font-weight: bold;
            text-align: center;
        }

        .success {
            color: #28a745;
            margin-bottom: 15px;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Livre d'or</h1>

        <h2>Laisser un message</h2>
        <form action="guestbook.php" method="post">
            <label for="name">Votre Nom:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="message">Votre Message:</label>
            <textarea id="message" name="message" required></textarea><br>

            <input type="submit" value="Poster le message">
        </form>

        <?php
        $guestbook_file = 'guestbook.txt';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = trim($_POST['name']);
            $message = trim($_POST['message']);
            $date = date('Y-m-d H:i:s');

            if (empty($name) || empty($message)) {
                echo "<div class='error'>Veuillez remplir tous les champs.</div>";
            } else {
                // Format: Name|Message|Date\n
                $entry = htmlspecialchars($name) . "|" . htmlspecialchars($message) . "|" . $date . "\n";

                // Append to file
                if (file_put_contents($guestbook_file, $entry, FILE_APPEND | LOCK_EX) !== false) {
                    echo "<div class='success'>Votre message a été ajouté.</div>";
                } else {
                    echo "<div class='error'>Erreur lors de l'écriture du message.</div>";
                }
            }
        }

        echo "<h2>Messages des visiteurs</h2>";

        if (file_exists($guestbook_file) && is_readable($guestbook_file)) {
            $messages = file($guestbook_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            if (empty($messages)) {
                echo "<p>Aucun message pour le moment.</p>";
            } else {
                // Display messages in reverse chronological order (newest first)
                $messages = array_reverse($messages);
                foreach ($messages as $line) {
                    list($name, $message, $date) = explode('|', $line, 3); // Limit 3 to handle potential | in message
                    echo "<div class='message-entry'>";
                    echo "<strong>" . $name . "</strong><br>";
                    echo nl2br($message);
                    echo "<div class='date'>Posté le: " . $date . "</div>";
                    echo "</div>";
                }
            }
        } else {
            echo "<p>Le fichier du livre d'or n'existe pas ou n'est pas accessible en lecture.</p>";
        }
        ?>
    </div>

</body>

</html>