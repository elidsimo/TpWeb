<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Quiz PHP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f0f2f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .question-block {
            margin-bottom: 25px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #fdfdfd;
        }

        .question-block p {
            font-weight: bold;
            margin-bottom: 10px;
            color: #444;
        }

        .question-block label {
            display: block;
            margin-bottom: 8px;
            cursor: pointer;
        }

        .question-block input[type="radio"] {
            margin-right: 8px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            display: block;
            margin: 20px auto 0;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .results {
            margin-top: 30px;
            padding: 20px;
            border: 1px solid #28a745;
            background-color: #d4edda;
            border-radius: 8px;
            color: #155724;
        }

        .results h2 {
            color: #28a745;
            margin-bottom: 15px;
        }

        .results p.score {
            font-size: 1.3em;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .results ul {
            list-style: none;
            padding: 0;
        }

        .results ul li {
            margin-bottom: 10px;
            padding: 8px;
            border-bottom: 1px dashed #c3e6cb;
        }

        .results ul li:last-child {
            border-bottom: none;
        }

        .correct {
            color: #28a745;
            font-weight: bold;
        }

        .incorrect {
            color: #dc3545;
            font-weight: bold;
        }

        .your-answer {
            font-style: italic;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Mini Quiz PHP</h1>

        <?php
        // Define the quiz questions and correct answers
        $questions = [
            1 => [
                'question' => 'Quelle fonction PHP est utilisée pour démarrer une session?',
                'options' => [
                    'a' => 'start_session()',
                    'b' => 'session_start()',
                    'c' => 'begin_session()',
                    'd' => 'session_init()'
                ],
                'correct_answer' => 'b'
            ],
            2 => [
                'question' => 'Quel superglobal est utilisé pour collecter les données de formulaire soumises avec la méthode POST?',
                'options' => [
                    'a' => '$_GET',
                    'b' => '$_REQUEST',
                    'c' => '$_POST',
                    'd' => '$_FORM'
                ],
                'correct_answer' => 'c'
            ],
            3 => [
                'question' => 'Quel opérateur est utilisé pour la concaténation de chaînes de caractères en PHP?',
                'options' => [
                    'a' => '+',
                    'b' => '.',
                    'c' => '&',
                    'd' => 'concat()'
                ],
                'correct_answer' => 'b'
            ],
            4 => [
                'question' => 'Laquelle de ces fonctions permet de lire le contenu d\'un fichier en PHP?',
                'options' => [
                    'a' => 'file_write()',
                    'b' => 'readfile()',
                    'c' => 'get_file_content()',
                    'd' => 'file_put_contents()'
                ],
                'correct_answer' => 'b'
            ],
            5 => [
                'question' => 'Quel est le moyen correct de commenter une seule ligne en PHP?',
                'options' => [
                    'a' => '/* Comment */',
                    'b' => '',
                    'c' => '# Comment',
                    'd' => '// Comment'
                ],
                'correct_answer' => 'd'
            ]
        ];

        $score = 0;
        $show_results = false;
        $user_answers = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $show_results = true;
            foreach ($questions as $q_num => $data) {
                $user_answer = $_POST['q' . $q_num] ?? null;
                $user_answers[$q_num] = $user_answer;

                if ($user_answer === $data['correct_answer']) {
                    $score++;
                }
            }
        }
        ?>

        <form action="quiz.php" method="post">
            <?php foreach ($questions as $q_num => $data): ?>
                <div class="question-block">
                    <p><?php echo $q_num . '. ' . htmlspecialchars($data['question']); ?></p>
                    <?php foreach ($data['options'] as $option_key => $option_text): ?>
                        <label>
                            <input type="radio" name="q<?php echo $q_num; ?>" value="<?php echo $option_key; ?>" <?php
                                  if ($show_results && isset($user_answers[$q_num]) && $user_answers[$q_num] === $option_key) {
                                      echo 'checked';
                                  }
                                  if ($show_results && $user_answers[$q_num] === $option_key && $option_key !== $data['correct_answer']) {
                                      echo 'class="incorrect-answer"'; // Optional: for styling incorrect user answers
                                  }
                                  ?>         <?php echo $show_results ? 'disabled' : ''; ?>>
                            <?php echo htmlspecialchars($option_text); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>

            <?php if (!$show_results): ?>
                <input type="submit" value="Soumettre le Quiz">
            <?php else: ?>
                <div class="results">
                    <h2>Vos Résultats</h2>
                    <p class="score">Votre score final est de : <span
                            class="<?php echo ($score >= count($questions) / 2) ? 'correct' : 'incorrect'; ?>"><?php echo $score; ?>
                            / <?php echo count($questions); ?></span></p>
                    <ul>
                        <?php foreach ($questions as $q_num => $data): ?>
                            <li>
                                <strong>Question <?php echo $q_num; ?>:</strong>
                                <?php echo htmlspecialchars($data['question']); ?><br>
                                Votre réponse:
                                <?php
                                $user_ans = $user_answers[$q_num] ?? 'Non répondu';
                                $correct_ans = $data['correct_answer'];

                                if ($user_ans === $correct_ans) {
                                    echo "<span class='correct'>" . htmlspecialchars($data['options'][$user_ans]) . " (Correct)</span>";
                                } else {
                                    echo "<span class='incorrect'>" . htmlspecialchars($data['options'][$user_ans] ?? $user_ans) . " (Incorrect)</span>";
                                    echo "<br>Réponse correcte: <span class='correct'>" . htmlspecialchars($data['options'][$correct_ans]) . "</span>";
                                }
                                ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="quiz.php">Recommencer le quiz</a>
                </div>
            <?php endif; ?>
        </form>
    </div>

</body>

</html>