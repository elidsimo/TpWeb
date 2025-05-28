<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculatrice PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 8px;
            max-width: 300px;
        }

        input[type="number"],
        select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .result {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #4CAF50;
            background-color: #e6ffe6;
            border-radius: 4px;
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

    <h1>Calculatrice Simple</h1>

    <form action="exercice1.php" method="post">
        <label for="num1">Nombre 1:</label><br>
        <input type="number" id="num1" name="num1" step="any" required><br><br>

        <label for="operation">Opération:</label><br>
        <select id="operation" name="operation" required>
            <option value="add">Addition (+)</option>
            <option value="subtract">Soustraction (-)</option>
            <option value="multiply">Multiplication (*)</option>
            <option value="divide">Division (/)</option>
        </select><br><br>

        <label for="num2">Nombre 2:</label><br>
        <input type="number" id="num2" name="num2" step="any" required><br><br>

        <input type="submit" value="Calculer">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $operation = $_POST['operation'];
        $result = 0;
        $error = false;

        if (!is_numeric($num1) || !is_numeric($num2)) {
            echo "<div class='error'>Veuillez entrer des nombres valides.</div>";
            $error = true;
        } else {
            switch ($operation) {
                case 'add':
                    $result = $num1 + $num2;
                    break;
                case 'subtract':
                    $result = $num1 - $num2;
                    break;
                case 'multiply':
                    $result = $num1 * $num2;
                    break;
                case 'divide':
                    if ($num2 != 0) {
                        $result = $num1 / $num2;
                    } else {
                        echo "<div class='error'>Erreur : Division par zéro impossible.</div>";
                        $error = true;
                    }
                    break;
                default:
                    echo "<div class='error'>Opération non valide.</div>";
                    $error = true;
                    break;
            }

            if (!$error) {
                echo "<div class='result'>Résultat: " . htmlspecialchars($result) . "</div>";
            }
        }
    }
    ?>

</body>

</html>