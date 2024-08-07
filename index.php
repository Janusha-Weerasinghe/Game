<?php

?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Game Arcade</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Merienda:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
  <header>
    <h1>Pink Arcade</h1>
  </header>
  <main>
    <div class="game-list">
      <a href="EightQueens/EightQueens.php" class="game-link">
        <div class="game-card">
          <img src="queen.png" alt="Eight Queens">
          <div class="game-info">
            <h2>Eight Queens</h2>
            <p>"Place eight queens on a chessboard so that no two queens threaten each other."</p>
          </div>
        </div>
      </a>
      <a href="TicTacToe/index.html" class="game-link">
        <div class="game-card">
          <img src="tictactoe.png" alt="Tic Tac Toe">
          <div class="game-info">
            <h2>Tic Tac Toe</h2>
            <p>"Get three in a row to win this classic Tic-Tac-Toe game against the computer!"</p>
          </div>
        </div>
      </a>
      <a href="ShortestPath/ShortestPath.php" class="game-link">
        <div class="game-card">
          <img src="shortest.png" alt="Shortest Path">
          <div class="game-info">
            <h2>Shortest Path</h2>
            <p>"Find the shortest path and distance between cities."</p>
          </div>
        </div>
      </a>
      <a href="RememberValueIndex2/index.html" class="game-link">
        <div class="game-card">
          <img src="rem.png" alt="Remember Value Index">
          <div class="game-info">
            <h2>Remember Value Index</h2>
            <p>"Identify the index of two randomly selected numbers from the list."</p>
          </div>
        </div>
      </a>
      <a href="PredictValueIndex2/PredictValIndex.php" class="game-link">
        <div class="game-card">
          <img src="predict.png" alt="Predict Value Index">
          <div class="game-info">
            <h2>Predict Value Index</h2>
            <p>"Guess the index of a randomly selected number from 1 to 1000000 by choosing from four options"</p>
          </div>
        </div>
      </a>
    </div>
  </main>
</body>
</html>