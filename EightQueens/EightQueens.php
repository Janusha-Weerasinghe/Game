<?php
// Check if the registration form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registerButton'])) {
    // Validate input
    $playerName = htmlspecialchars($_POST['playerName']);
    // Check if playerName is not empty
    if (!empty($playerName)) {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = ""; // No password set
        $dbname = "game_arcade";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO winners (player_name) VALUES (?)");
        $stmt->bind_param("s", $playerName);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Congratulations, $playerName! You have been registered as a winner.');</script>";
        } else {
            echo "<script>alert('Error registering the winner.');</script>";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "<script>alert('Please enter a valid name.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eight Queens Puzzle</title>
    <style>
        <?php include 'EightQueens.css'; ?>
    </style>
</head>
<body>
    <div class="container">
        <div class="game-container">
            <div class="game-content">
                <div class="topic-container">
                    <h1>Eight Queens Puzzle</h1>
                </div>
                <div class="board-container">
                    <div id="board"></div>
                </div>
                <div class="button-group">
                    <button id="solveButton">Solve</button>
                    <button onclick="resetGame()">Reset Game</button>
                    <button id="playButton">Play</button>
                </div>
            </div>
        </div>
        <div id="registration-container" style="display: none;">
            <h2>Registration</h2>
            <form class="registration-form" method="post" action="">
                <input type="text" name="playerName" placeholder="Enter your name">
                <button type="submit" name="registerButton">Register</button>
            </form>
        </div>
    </div>
    <div id="solution"></div>
    <script src="EightQueens.js"></script>
    <script>
        // Function to show the registration form
        function showRegistrationForm() {
            const registrationContainer = document.getElementById('registration-container');
            registrationContainer.style.display = 'block';
        }

        // Modify the checkPuzzleSolved function to show the registration form when the puzzle is solved
        function checkPuzzleSolved() {
            try {
                const solution = solve();
                if (queens.length === 8 && queens.every(([row, col]) => solution.some(([r, c]) => r === row && c === col))) {
                    const solutionDiv = document.getElementById('solution');
                    solutionDiv.textContent = 'Congratulations! You win!';
                    playMode = false; // Disable play mode after solving the puzzle
                    showRegistrationForm(); // Show the registration form
                }
            } catch (error) {
                console.error('Error checking puzzle solved:', error);
            }
        }
    </script>
</body>
</html>
