<?php
// // Establish connection to your MySQL database
// $servername = "localhost"; // Change to your server name if different
// $username = "root"; // Change to your MySQL username
// $password = ""; // Change to your MySQL password if set
// $database = "gaming_database"; // Change to your database name

// // Create connection
// $conn = new mysqli($servername, $username, $password, $database);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

include('../MySqlDataBaseConnection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $player_name = $_POST['player_name'];
    $correct_answer = $_POST['correct_answer'];
    $time_taken = $_POST['time_taken'];

    // Prepare SQL statement to insert data into database
    $stmt = $conn->prepare("INSERT INTO predict_value_winner (player_name, correct_answer, time_taken) VALUES (?, ?, ?)");
    
    // Check if the statement is prepared successfully
    if ($stmt === FALSE) {
        die("Error: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sss", $player_name, $correct_answer, $time_taken);

    // Execute the prepared statement
    if ($stmt->execute() === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Predict the Value Index</title>
    <link rel="stylesheet" href="PredictValIndex.css">
</head>
<body>
    <div class="container">
        <h1>Predict the Value Index</h1>
        <p>The array contains 5000 random numbers between 1 and 1000000, sorted in ascending order.</p>
        <p>Value: <span id="value"></span></p>
        <p>Hint: <span id="hint"></span></p>
        <p>Choices:</p>
        <form id="choiceForm">
            <!-- Radio buttons for choices will be added dynamically -->
        </form>
        <button id="submitBtn" disabled>Submit</button>
        <p id="result"></p>
        <button id="playAgainBtn">Play Again</button>
    </div>
    <script src="PredictValIndex.js"></script>
</body>
</html>