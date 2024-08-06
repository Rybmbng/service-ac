<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dino Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f0f0f0;
        }
        .game-container {
            width: 80%;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .dino {
            width: 50px;
            height: 50px;
            background-image: url('dino.png');
            background-size: 100% 100%;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        .obstacle {
            width: 20px;
            height: 20px;
            background-color: #ccc;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }
        .score {
            font-size: 24px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="game-container">
        <h1>Dino Game</h1>
        <div class="game-area">
            <div class="dino" id="dino"></div>
            <div class="obstacle" id="obstacle"></div>
        </div>
        <div class="score" id="score">Score: 0</div>

        <script>
            const dino = document.getElementById('dino');
            const obstacle = document.getElementById('obstacle');
            const scoreDiv = document.getElementById('score');

            let score = 0;
            let obstacleInterval = null;
            let isJumping = false;

            document.addEventListener('keydown', handleKeydown);

            function handleKeydown(e) {
                if (e.key === ' ') {
                    jump();
                }
            }

            function jump() {
                if (!isJumping) {
                    isJumping = true;
                    dino.style.bottom = '50px';
                    setTimeout(() => {
                        dino.style.bottom = '0';
                        isJumping = false;
                    }, 500);
                }
            }

            function generateObstacle() {
                obstacle.style.left = '50%';
                obstacle.style.transform = 'translateX(-50%)';
                obstacleInterval = setInterval(() => {
                    obstacle.style.left = `${Math.random() * 100}%`;
                }, 1000);
            }

            function checkCollision() {
                const dinoRect = dino.getBoundingClientRect();
                const obstacleRect = obstacle.getBoundingClientRect();

                if (dinoRect.left < obstacleRect.right &&
                    dinoRect.right > obstacleRect.left &&
                    dinoRect.top < obstacleRect.bottom &&
                    dinoRect.bottom > obstacleRect.top) {
                    gameOver();
                }
            }

            function gameOver() {
                clearInterval(obstacleInterval);
                alert(`Game Over! Your score is ${score}`);
                score = 0;
                scoreDiv.innerText = `Score: 0`;
            }

            generateObstacle();
            setInterval(() => {
                score++;
                scoreDiv.innerText = `Score: ${score}`;
                checkCollision();
            }, 1000);
        </script>
    </div>
</body>
</html>