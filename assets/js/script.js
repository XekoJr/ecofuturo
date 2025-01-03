document.addEventListener('DOMContentLoaded', () => {
    const objects = document.querySelectorAll('.object');
    const containers = document.querySelectorAll('.container');
    let startTime = Date.now();
    let points = 0;
    let correctAnswers = 0;
    alert('Arrasta os objetos para o respetivo contentor.');

    objects.forEach(object => {
        object.addEventListener('dragstart', dragStart);
    });

    containers.forEach(container => {
        container.addEventListener('dragover', dragOver);
        container.addEventListener('drop', drop);
    });

    function dragStart(event) {
        event.dataTransfer.setData('text/plain', event.target.dataset.type);
    }

    function dragOver(event) {
        event.preventDefault();
    }

    function drop(event) {
        event.preventDefault();
        const objectType = event.dataTransfer.getData('text/plain');
        const containerType = event.target.dataset.type || event.target.closest('.container').dataset.type;
        const answerElement = document.getElementById('answer');
        const pointsDisplay = document.querySelector('#points-display h3');
        const timeTaken = (Date.now() - startTime) / 1000; // Time taken in seconds

        console.log('Drop:', { objectType, containerType });

        if (objectType === containerType) {
            const object = document.querySelector(`[data-type="${objectType}"]`);
            event.target.closest('.container').appendChild(object);
            object.style.position = 'absolute';

            let streak = parseInt(answerElement.dataset.streak) || 0;
            streak++;
            answerElement.dataset.streak = streak;

            let basePoints = Math.max(100 - timeTaken * 10, 10); // Base points decrease with time, minimum 10 points
            let streakMultiplier = streak > 1 ? streak : 1; // Streak multiplier
            points += basePoints * streakMultiplier;
            points = Math.round(points); // Round points to the nearest integer

            answerElement.style.color = 'green';
            answerElement.textContent = `Correto! (Sequência: ${streak})`;
            pointsDisplay.textContent = `${points}`;

            // Increment correct answers count
            correctAnswers++;
            if (correctAnswers >= 5) {
                // Send GET request with the score to save
                fetch(`Recycling-game.php?score=${points}`)
                    .then(response => response.text())
                    .then(data => {
                        console.log('Score saved:', data);
                        setTimeout(() => {
                            window.location.href = 'games.php';
                        }, 3000);
                    })
                    .catch(error => console.error('Error saving score:', error));
            }

            // Reset the start time for the next drag
            startTime = Date.now();
        } else {
            let streak = 0;
            answerElement.dataset.streak = streak;
            points = Math.max(points / 1.5, 0); // Penalty for wrong answer
            points = Math.round(points); // Round points to the nearest integer
            answerElement.style.color = 'red';
            answerElement.textContent = `Errado.. tenta novamente!`;
            pointsDisplay.textContent = `${points}`;
        }
    }
});