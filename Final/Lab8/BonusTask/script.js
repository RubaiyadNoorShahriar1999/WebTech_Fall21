(function (doc) {
    doc.addEventListener("DOMContentLoaded", function () {

        let scores, currentScore, activePlayer, selectDiv, isStarted, winingScore = 100, dice;

        const player = ["player-0", "player-1"];
        const scoreBoard = ["score-0", "score-1"];
        const currentBoard = ["current-0", "current-1"];
        const scoreBoardTitle = ["score-title-0", "score-title-1"];
        const currentBoardTitle = ["current-title-0", "current-title-1"];

        initGame();

        /**
         * All Events
         */

        getElem("btn-roll").addEventListener("click", rollDice);
        getElem("btn-hold").addEventListener("click", holdScore);
        getElem("btn-new").addEventListener("click", initGame);


        /**
         * all function
         */

        function getElem(id) {
            return doc.getElementById(id);
        }

        function rollDice() {

            if (isStarted) {
                // Generate Ramdom Number for roll the dice
                let randomDice = (Math.floor(Math.random() * 6) + 1);
                // console.log( dice );

                // Update the round score if the roll dice shows 1
                if (randomDice !== 1) {
                    currentScore += randomDice;
                    dice.style.backgroundImage = 'url("img/' + randomDice + '.png")';
                } else {
                    nextPlayer();
                }
            }
        }

        function holdScore() {
            if (isStarted) {
                // Add the scores in score var
                scores[activePlayer] += currentScore;

                // Update the UI
                getElem("score-" + activePlayer).innerText = scores[activePlayer];

                // Check IF player won
                if (scores[activePlayer] >= winingScore) {
                    getElem("name-" + activePlayer).innerText = "Winner !";

                    isStarted = false;

                    changePlayerView(activePlayer, 'green')

                } else {
                    nextPlayer();
                }
            }
        }

        function initGame() {
            scores = [0, 0];
            currentScore = 0;
            activePlayer = 0;
            winingScore = 100;
            isStarted = true;
            dice = getElem("dice-img");

            for (let i = 0; i < selectDiv.length; i++) {
                getElem(selectDiv[i]).innerText = "0";
            }

            for (let i = 0; i < 3; i++) {
                changePlayerView(activePlayer, 'black')
            }

            for (let i = 0; i < player.length; i++) {
                getElem(player[i]).innerText = "Player " + i + 1;
            }

            // getElem("player-0").innerText = "Player 1";
            // getElem("player-1").innerText = "Player 2";

            // initialize the current active player in view
            changePlayerView(activePlayer, 'red')
        }

        function nextPlayer() {
            // disable the current palyer invew
            changePlayerView(activePlayer, 'black')

            // toggle the player
            activePlayer === 0 ? activePlayer = 1 : activePlayer = 0;
            currentScore = 0;

            // active the next player in view
            changePlayerView(activePlayer, 'red')
        }

        function changePlayerView(_activePlayer, _color) {
            getElem("player-" + _activePlayer).style.color = _color;
            getElem("score-title-" + _activePlayer).style.color = _color;
            getElem("score-" + _activePlayer).style.color = _color;
        }

    });
}(document));