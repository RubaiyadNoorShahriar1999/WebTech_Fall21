(function (dom, _log) {
    const winingScore = 100;
    const activeColor = "rgba(108, 92, 231,1.0)";
    const deactiveColor = "unset";
    const winColor = "rgba(0, 184, 148, 1.0)";

    const playerBoard = ["#player-0", "#player-1"];
    const dice = ["#dice-img"];
    const scoreBoard = ["#score-0", "#score-1"];
    const currentBoard = ["#current-0", "#current-1"];
    const playerSectionBoard = [".player-section-0", ".player-section-1"];

    const diceElem = [],
        playerSectionElem = [],
        playerElem = [],
        scoreElem = [],
        currentElem = [];

    let activePlayer, currentScore, isStarted, scores;

    function holdScore() {
        if (isStarted) {
            // add current score to player score
            scores[activePlayer] += currentScore;

            // Update the UI
            scoreElem[activePlayer].innerText = scores[activePlayer];

            // Check IF player won
            if (scores[activePlayer] >= winingScore) {
                playerElem[activePlayer].innerText = "Winner!!!";

                isStarted = false;

                buttonAction(!isStarted);

                changePlayerView(activePlayer, winColor);
                getElem("#btn-new").disabled = false;
            } else {
                nextPlayer();
            }
        }
    }

    function rollDice() {
        if (isStarted) {
            // Generate Ramdom Number for roll the dice (1 - 6)
            let randomDice = Math.floor(Math.random() * 6) + 1;

            // Update the round score if the roll dice shows 1
            if (randomDice !== 1) {
                currentScore += randomDice;
                // Check if player is win or not
                if (scores[activePlayer] + currentScore >= winingScore) {
                    buttonAction(false);
                    holdScore();
                    isStarted = false;
                    return;
                }

                buttonAction(true);
                isStarted = false;

                setTimeout(() => {
                    diceElem[0].style.backgroundImage =
                        'url("img/' + randomDice + '.png")';
                    currentElem[activePlayer].innerText = currentScore;

                    buttonAction(false);
                    isStarted = true;
                }, 200);
            } else {
                diceElem[0].style.backgroundImage =
                    'url("img/' + randomDice + '.png")';

                playerSectionElem[activePlayer].style.backgroundColor =
                    "rgba(255, 0, 0, 0.3)";
                playerSectionElem[activePlayer].style.color = "#2d3436";
                buttonAction(true);

                setTimeout(nextPlayer, 1000);
            }
        }
    }

    function initGame() {
        activePlayer = 0;
        currentScore = 0;
        isStarted = true;
        scores = [0, 0];

        // Dice Image
        for (let i = 0; i < dice.length; ++i) {
            diceElem[i] = getElem(dice[i]);
        }

        // Player
        for (let i = 0; i < playerBoard.length; ++i) {
            playerSectionElem[i] = getElem(playerSectionBoard[i]);
            playerElem[i] = getElem(playerBoard[i]);
            scoreElem[i] = getElem(scoreBoard[i]);
            currentElem[i] = getElem(currentBoard[i]);
        }

        // Initialize Dice
        diceElem[0].style.background =
            'center / contain no-repeat url("img/default.png")';

        // Initialize DOM value
        for (let i = 0; i < playerElem.length; ++i) {
            playerElem[i].innerText = `Player ${i + 1}`;
            scoreElem[i].innerText = scores[i];
            currentElem[i].innerText = currentScore;
        }

        // Active the disabled button
        buttonAction(!isStarted);

        // Active player in the dom
        changePlayerView(1, deactiveColor, "#2d3436");

        changePlayerView(activePlayer, activeColor);
    }

    function nextPlayer() {
        currentElem[activePlayer].innerText = "0";
        // disable the current palyer invew
        changePlayerView(activePlayer, deactiveColor, "#2d3436");

        // toggle the player
        activePlayer === 0 ? (activePlayer = 1) : (activePlayer = 0);
        currentScore = 0;

        // active the next player in view
        diceElem[0].style.backgroundImage = 'url("img/default.png")';

        buttonAction(false);

        changePlayerView(activePlayer, activeColor);
    }

    function buttonAction(state) {
        getElem("#btn-new").disabled = state;
        getElem("#btn-roll").disabled = state;
        getElem("#btn-hold").disabled = state;
    }

    function changePlayerView(_activePlayer, _color, _txtColor = "white") {
        playerSectionElem[_activePlayer].style.background = _color;
        playerSectionElem[_activePlayer].style.color = _txtColor;
    }

    function getElem(selector) {
        return dom.querySelector(selector);
    }

    dom.addEventListener("DOMContentLoaded", () => {
        initGame();

        // _log(playerSectionElem,playerElem, scoreElem, currentElem, scoreTitleElem, currentTitleElem);

        getElem("#btn-new").addEventListener("click", initGame);
        getElem("#btn-roll").addEventListener("click", rollDice);
        getElem("#btn-hold").addEventListener("click", holdScore);
    });
})(document, console.log);
