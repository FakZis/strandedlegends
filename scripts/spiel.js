let userScore = 0;
let computerScore = 0;
const userScore_span = document.getElementById("user-score");
const computerScore_span = document.getElementById("computer-score");
const scoreBoard_div = document.querySelector(".score-board");
const result_p = document.querySelector(".result p");
const titan_div = document.getElementById("t");
const warlock_div = document.getElementById("w");
const hunter_div = document.getElementById("h");

function getComputerChoice() {
    const choices = ['t', 'w', 'h'];
    const randomNumber = Math.floor(Math.random() *3);
    return choices[randomNumber];
}

function convertToWord(letter) {
    if (letter === "t") return "Titan";
    if (letter === "w") return "Warlock";
    return "Hunter";
}

function win(userChoice, computerChoice) {
    const userChoice_div = document.getElementById(userChoice);
    userScore++;
    userScore_span.innerHTML = userScore;
    computerScore_span.innerHTML = computerScore;
    result_p.innerHTML = convertToWord(userChoice) + " schlägt " + convertToWord(computerChoice) + " <br>Du hast gesiegt! ";
    userChoice_div.classList.add('green-glow');
    setTimeout(function() { userChoice_div.classList.remove('green-glow') }, 450);
}

function lose(userChoice, computerChoice) {
    const userChoice_div = document.getElementById(userChoice);
    computerScore++;
    userScore_span.innerHTML = userScore;
    computerScore_span.innerHTML = computerScore;
    result_p.innerHTML = convertToWord(userChoice) + " verliert gegen " + convertToWord(computerChoice) + "<br>Du hast verloren!";
    userChoice_div.classList.add('red-glow');
    setTimeout(function() { userChoice_div.classList.remove('red-glow') }, 450);
}

function draw(userChoice, computerChoice) {
    const userChoice_div = document.getElementById(userChoice);
    result_p.innerHTML = convertToWord(userChoice) + " gegen " + convertToWord(computerChoice) + " <br>Es ist ein Unentschieden!";
    userChoice_div.classList.add('grey-glow');
    setTimeout(function() { userChoice_div.classList.remove('grey-glow') }, 450);
}

function game(userChoice) {
    const computerChoice = getComputerChoice();
    switch (userChoice + computerChoice) {
        case "tw":
        case "wh":
        case "ht":
            win(userChoice, computerChoice);
            break;
        case "th":
        case "wt":
        case "hw":
            lose(userChoice, computerChoice);
            break;
        case "tt":
        case "ww":
        case "hh":
            draw(userChoice, computerChoice);
            break;
    }
}

function main() {
    titan_div.addEventListener('click', function() {
        game("t");
    })

    warlock_div.addEventListener('click', function() {
        game("w");
    })

    hunter_div.addEventListener('click', function() {
        game("h");
    })
}

main();
