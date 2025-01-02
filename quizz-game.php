<?php
require_once 'games/Quizz.php';
/*session_start();


// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}



// Inicializar a pontuação, se ainda não estiver definida
if (!isset($_SESSION['score'])) {
    $_SESSION['score'] = 0;
}
*/
$quiz = new Quiz();
try {
    // Carregar perguntas do banco de dados
    $questions = $quiz->getQuestions();
    $questionsJson = json_encode($questions); // Converter para JSON para o JavaScript
} catch (Exception $e) {
    die("Erro: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Interativo</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('assets/images/fundo_jogo.jpg');
            /* Substitua pelo caminho da sua imagem */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .quiz-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
        }

        .quiz-question {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .quiz-options button {
            margin-bottom: 10px;
            width: 100%;
        }

        .btn-success {
            background-color: #28a745 !important;
            /* Verde */
            color: white !important;
        }

        .btn-danger {
            background-color: #dc3545 !important;
            /* Vermelho */
            color: white !important;
        }

        .btn-success:hover,
        .btn-danger:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <div class="quiz-container text-center">
        <div id="score" class="mb-3">
            <h2>Pontuação: <span id="score-value">0</span></h2>
        </div>
        <div id="quiz-content">
            <h1 class="quiz-title mb-4">Bem-vindo ao Quiz</h1>
            <p class="quiz-question mb-4">Carregando pergunta...</p>
            <div class="quiz-options">
                <button class="btn btn-primary option-btn" id="option-a">Opção A</button>
                <button class="btn btn-primary option-btn" id="option-b">Opção B</button>
                <button class="btn btn-primary option-btn" id="option-c">Opção C</button>
                <button class="btn btn-primary option-btn" id="option-d">Opção D</button>
            </div>

        </div>
        <button class="btn btn-secondary mt-4 d-none" id="next-btn" onclick="nextQuestion()">Próxima Pergunta</button>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Perguntas carregadas do PHP
        const questions = <?php echo $questionsJson; ?>;
        let currentQuestionIndex = 0;

        function loadQuestion(index) {
            const quizContent = document.getElementById('quiz-content');
            const questionData = questions[index];
            quizContent.querySelector('.quiz-question').textContent = questionData.Q_QUESTION;

            const options = quizContent.querySelectorAll('.quiz-options button');
            options[0].textContent = questionData.Q_OP_A;
            options[0].onclick = () => selectOption(questionData.Q_OP_A, questionData.Q_ID);
            options[1].textContent = questionData.Q_OP_B;
            options[1].onclick = () => selectOption(questionData.Q_OP_B, questionData.Q_ID);
            options[2].textContent = questionData.Q_OP_C;
            options[2].onclick = () => selectOption(questionData.Q_OP_C, questionData.Q_ID);
            options[3].textContent = questionData.Q_OP_D;
            options[3].onclick = () => selectOption(questionData.Q_OP_D, questionData.Q_ID);
        }

        function selectOption(selected, questionId) {
    fetch('check_answer.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ questionId, selected })
    })
        .then(response => response.json())
        .then(data => {
            const correctOption = questions[currentQuestionIndex].Q_CORRECT;
            const options = document.querySelectorAll('.quiz-options button');

            // Itera por todas as opções e aplica estilos
            options.forEach(option => {
                if (option.textContent === correctOption) {
                    option.classList.add('btn-success'); // Marca a correta como verde
                } else if (option.textContent === selected) {
                    option.classList.add('btn-danger'); // Marca a selecionada errada como vermelha
                }
                option.disabled = true; // Desativa os botões após a seleção
            });

            // Mostra mensagem correspondente
            if (data.correct) {
                alert('Resposta correta!');
            } else {
                alert('Resposta errada! A resposta correta é: ' + correctOption);
            }

            // Atualiza a pontuação exibida
            document.getElementById('score-value').textContent = data.score;

            // Mostra o botão de próxima pergunta
            document.getElementById('next-btn').classList.remove('d-none');
        })
        .catch(err => console.error('Erro:', err));
}


function nextQuestion() {
    currentQuestionIndex++;
    if (currentQuestionIndex < questions.length) {
        loadQuestion(currentQuestionIndex);
        document.getElementById('next-btn').classList.add('d-none');

        // Remove classes de estilo e reativa os botões
        const options = document.querySelectorAll('.option-btn');
        options.forEach(option => {
            option.classList.remove('btn-success', 'btn-danger');
            option.disabled = false;
        });
    } else {
        alert('Quiz finalizado! Sua pontuação final foi: ' + document.getElementById('score-value').textContent);
        location.reload();
    }
}


        // Carregar a primeira pergunta ao iniciar
        loadQuestion(currentQuestionIndex);
    </script>
</body>

</html>