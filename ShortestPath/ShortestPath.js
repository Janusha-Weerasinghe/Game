const cities = ["City A", "City B", "City C", "City D", "City E", "City F", "City G", "City H", "City I", "City J"];
let graph = Array(10).fill().map(() => Array(10).fill(0));
let openCity;

function assignRandomDistances() {
    for (let i = 0; i < 10; i++) {
        for (let j = i + 1; j < 10; j++) {
            const distance = Math.floor(Math.random() * 46) + 5; // Random distance between 5 and 50
            graph[i][j] = distance;
            graph[j][i] = distance;
        }
    }
}

function createTable() {
    const distanceTableDiv = document.getElementById('distanceTable');
    let tableHTML = "<table border='1'><thead><tr><th>City</th>";
    for (let city of cities) {
        tableHTML += `<th>${city}</th>`;
    }
    tableHTML += "</tr></thead><tbody>";

    for (let i = 0; i < cities.length; i++) {
        tableHTML += `<tr><td>${cities[i]}</td>`;
        for (let j = 0; j < cities.length; j++) {
            if (i === j) {
                tableHTML += `<td></td>`; // Empty cell for diagonal entries
            } else if (i === 0) { // City A to all cities
                tableHTML += `<td></td>`;
            } else if (i === 1 && j >= 1) { // City B to City B and beyond
                tableHTML += `<td></td>`;
            } else if (i === 2 && j >= 2) { // City C to City C and beyond
                tableHTML += `<td></td>`;
            } else if (i === 3 && j >= 3) { // City D to City D and beyond
                tableHTML += `<td></td>`;
            } else if (i === 4 && j >= 4) { // City E to City E and beyond
                tableHTML += `<td></td>`;
            } else if (i === 5 && j >= 5) { // City F to City F and beyond
                tableHTML += `<td></td>`;
            } else if (i === 6 && j >= 6) { // City G to City G and beyond
                tableHTML += `<td></td>`;
            } else if (i === 7 && j >= 7) { // City H to City H and beyond
                tableHTML += `<td></td>`;
            } else if (i === 8 && j >= 8) { // City I to City I and beyond
                tableHTML += `<td></td>`;
            } else if (i === 9 && j === 9) { // City J to City J
                tableHTML += `<td></td>`;
            } else {
                tableHTML += `<td>${graph[i][j]}</td>`;
            }
        }
        tableHTML += "</tr>";
    }
    tableHTML += "</tbody></table>";
    distanceTableDiv.innerHTML = tableHTML;
}

function setupGame() {
    const playerName = prompt("Enter your name:");
    if (!playerName) {
        alert("Please enter your name to start the game.");
        return;
    }
    assignRandomDistances();
    createTable();
    openCity = Math.floor(Math.random() * cities.length);
    document.getElementById('playerName').textContent = playerName;

    const startCityDropdown = document.getElementById('startCityInput');
    const endCityInputs = document.getElementById('endCityInputs');

    cities.forEach(city => {
        const option = document.createElement('option');
        option.text = city;
        startCityDropdown.add(option);

        const label = document.createElement('label');
        label.textContent = `Distance to ${city}:`;
        const input = document.createElement('input');
        input.type = 'number';
        input.min = 5; // Minimum distance
        input.max = 50; // Maximum distance
        input.setAttribute('data-end-city', city);
        endCityInputs.appendChild(label);
        endCityInputs.appendChild(input);
    });

    document.getElementById('gameContainer').style.display = 'block';
}

function checkDistances() {
    const startCity = document.getElementById('startCityInput').value;
    const endCityInputs = document.querySelectorAll('#endCityInputs input');
    const resultsDiv = document.getElementById('results');
    resultsDiv.innerHTML = ''; // Clear previous results

    let allCorrect = true;
    let answers = []; // Define answers array

    endCityInputs.forEach(input => {
        const endCity = input.getAttribute('data-end-city');
        const userDistance = parseInt(input.value.trim());

        if (isNaN(userDistance)) {
            alert(`Please enter a valid distance for ${endCity}.`);
            allCorrect = false;
            return;
        }

        const startCityIndex = cities.indexOf(startCity);
        const endCityIndex = cities.indexOf(endCity);
        const correctDistance = graph[startCityIndex][endCityIndex];

        answers.push(userDistance); // Store user's distance
        if (userDistance === correctDistance) {
            resultsDiv.innerHTML += `${endCity}: Correct<br>`;
        } else {
            resultsDiv.innerHTML += `${endCity}: Wrong<br>`;
            allCorrect = false;
        }
    });

    if (allCorrect) {
        const winnerName = prompt("Congratulations! You won! Please enter your name:");
        if (winnerName) {
            resultsDiv.innerHTML += `<br>Winner: ${winnerName}`;
        } else {
            resultsDiv.innerHTML += "<br>No name entered.";
        }
        // Send data to the server only if all distances are correct
        sendDataToServer(answers);
    }
}

function sendDataToServer(answers) {
    const playerName = document.getElementById('playerName').textContent;
    const timeTaken = 0; // Placeholder for time taken, replace with actual value if needed

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'ShortestPath.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Data sent successfully');
            } else {
                console.error('Failed to send data');
            }
        }
    };
    const data = `playerName=${playerName}&answers=${JSON.stringify(answers)}&timeTaken=${timeTaken}`;
    xhr.send(data);
}

document.addEventListener('DOMContentLoaded', setupGame);
