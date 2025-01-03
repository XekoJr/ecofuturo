<?php

require_once './games/Quizz.php';

session_start();
// Check if the user is logged in
if (isset($_COOKIE['user'])) {
    $currentUser = json_decode($_COOKIE['user'], true);
} else {
    // Redirect to login page if not logged in
    header("Location: ./views/login.php");
    exit();
}

// Continuar com o carregamento do quiz
$quiz = new Quiz();
$questions = $quiz->getQuestions();

// Inicializa pontuação na sessão
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Infantil</title>
    <link rel="stylesheet" href="assets/css/quizz.css">
</head>

<body>
<a href="javascript:history.back()" class="back-button">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" fill="none">
        <circle cx="24" cy="24" r="24" fill="#0056b3" />
        <path d="M28 36L16 24L28 12" stroke="#f0f0f0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
</a>
    <div class="container">
        <div id="score-display" class="score-box">
            Pontos: <span id="current-score">0</span>
        </div>
        <div id="quiz-container" class="quiz-card">
            <h3 id="question"></h3>
            <div id="options"></div>
            <button id="next-btn" class="btn hidden">Próxima Pergunta</button>
        </div>
        <div id="result" class="hidden">
            <h2>Parabéns!</h2>
            <p>Acertas-te <span id="score"></span> pontos de um total possível de <span id="total"></span>!</p>
            <h3>Respostas Erradas:</h3>
            <ul id="answers-log"></ul> <!-- Lista para respostas -->
            <button id="restart-btn" class="btn">Reiniciar</button> <!-- Botão Restart -->
        </div>
    </div>
    <script>
        // Inicializa variáveis globais
        const quizData = <?= json_encode(array_map(function ($question) {
            return [
                'id' => $question['Q_ID'],
                'question' => $question['Q_QUESTION'],
                'options' => [
                    $question['Q_OP_A'],
                    $question['Q_OP_B'],
                    $question['Q_OP_C'],
                    $question['Q_OP_D']
                ],
                'answer' => $question['Q_CORRECT']
            ];
        }, $questions)); ?>;

        let currentQuestionIndex = 0;
        let score = <?= $_SESSION['score']; ?>;
        const totalQuestions = quizData.length;
        let answersLog = []; // Inicializa o log de respostas

        const questionEl = document.getElementById("question");
        const optionsEl = document.getElementById("options");
        const nextBtn = document.getElementById("next-btn");
        const resultEl = document.getElementById("result");
        const scoreEl = document.getElementById("score");
        const totalEl = document.getElementById("total");
        const currentScoreEl = document.getElementById("current-score");

        function loadQuestion() {
            const current = quizData[currentQuestionIndex];
            questionEl.textContent = current.question;
            optionsEl.innerHTML = "";

            current.options.forEach(option => {
                const button = document.createElement("button");
                button.textContent = option;
                button.onclick = () => selectAnswer(button, current.answer);
                optionsEl.appendChild(button);
            });

            // Esconde o botão "Próxima Pergunta" ao carregar uma nova pergunta
            nextBtn.classList.add("hidden");
            nextBtn.style.display = "none";
        }

        function selectAnswer(button, correctAnswer) {
            // Verifica se a resposta selecionada está correta
            const isCorrect = button.textContent === correctAnswer;

            // Armazena a pergunta, resposta do jogador e a correta
            answersLog.push({
                question: quizData[currentQuestionIndex].question,
                playerAnswer: button.textContent,
                correctAnswer: correctAnswer,
                isCorrect: isCorrect
            });

            // Aplica estilo ao botão selecionado
            if (isCorrect) {
                button.classList.add("correct");
                score += 5;
                currentScoreEl.textContent = score;
            } else {
                button.classList.add("incorrect");
            }

            // Destaca a resposta correta
            Array.from(optionsEl.children).forEach(btn => {
                btn.disabled = true;
                if (btn.textContent === correctAnswer) {
                    btn.classList.add("correct");
                }
            });

            // Mostra o botão "Próxima Pergunta"
            nextBtn.classList.remove("hidden");
            nextBtn.style.display = "inline-block";
        }

        nextBtn.addEventListener("click", () => {
            currentQuestionIndex++;
            if (currentQuestionIndex < totalQuestions) {
                loadQuestion();
            } else {
                showResult();
            }
        });

        function showResult() {
            questionEl.style.display = "none";
            optionsEl.style.display = "none";
            nextBtn.style.display = "none";
            resultEl.classList.remove("hidden");
            scoreEl.textContent = score;
            totalEl.textContent = totalQuestions * 5;

            saveScoreToDatabase(score); // Enviar pontuação para o servidor

            const answersLogEl = document.getElementById("answers-log");
            answersLogEl.innerHTML = ""; // Limpa a lista

            // Preenche a lista com respostas erradas
            answersLog.forEach((log) => {
                if (!log.isCorrect) {
                    const listItem = document.createElement("li");
                    listItem.classList.add("wrong-answer"); // Adiciona classe para estilizar
                    listItem.innerHTML = `
            <strong>Pergunta:</strong> ${log.question}<br>
            <span class="player-answer">Resposta: ${log.playerAnswer}</span><br>
            <span class="correct-answer">Resposta Correta: ${log.correctAnswer}</span>
        `;
                    answersLogEl.appendChild(listItem);
                }
            });


            // Mensagem caso todas as respostas estejam corretas
            if (answersLog.every(log => log.isCorrect)) {
                answersLogEl.innerHTML = "<p>Parabéns! Acertas-te todas as perguntas.</p>";
            }
        }

        function saveScoreToDatabase(points) {
            fetch('savescore.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({ points }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log("Pontuação salva com sucesso!");
                    } else {
                        console.error("Erro ao salvar pontuação:", data.message);
                    }
                })
                .catch(error => console.error("Erro ao conectar ao servidor:", error));
        }


        const restartBtn = document.getElementById("restart-btn");
        restartBtn.addEventListener("click", () => {
            currentQuestionIndex = 0;
            score = 0;
            answersLog = []; // Limpa o log de respostas
            currentScoreEl.textContent = score;

            resultEl.classList.add("hidden");
            questionEl.style.display = "block";
            optionsEl.style.display = "block";
            nextBtn.classList.add("hidden");
            nextBtn.style.display = "none";

            loadQuestion();
        });

        loadQuestion();
    </script>
</body>

</html>