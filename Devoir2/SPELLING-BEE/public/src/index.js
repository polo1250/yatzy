const DICTIONARY_FILE = "../assets/dictionary.json";

class SpellingBee {
    constructor(filename) {
        this.dictionary_filename = filename;
        this.words = [];
        this.seven_letter_words = [];
        this.middleLetter = "";
        this.currentScore = 0;
        this.currentWord = [];
        this.userGuessedWord = [];
        this.userGuesses = [];
        this.PANGRAM_BONUS = 7;
    }

    populateHoneycomb() {
        this.currentWord =
            this.seven_letter_words[
                Math.floor(Math.random() * this.seven_letter_words.length)
            ].split("");

        let letters = this.currentWord;
        this.shuffleArray(letters);

        this.middleLetter = letters[Math.floor(letters.length / 2)];

        for (let i = 1; i <= 7; i++) {
            let cell = document.querySelector("#honeycomb-cell-" + i);
            cell.innerHTML = letters[i - 1];
        }
    }

    addEventListenersToHoneycomb() {
        let inputField = document.querySelector("#input");
        for (let i = 1; i <= 7; i++) {
            let cell = document.querySelector("#honeycomb-cell-" + i);
            cell.addEventListener("click", () => {
                this.userGuessedWord.push(cell.textContent);
                inputField.value = this.userGuessedWord.join("");
            });
        }
    }

    checkWord() {
        let word = this.userGuessedWord.join("");
        if (
            this.words.includes(word) &&
            word.includes(this.middleLetter) &&
            !this.userGuesses.includes(word)
        ) {
            this.userGuesses.push(word);
            return true;
        } else {
            return false;
        }
    }

    scoreWord() {
        let score = 1;
        let word = this.userGuessedWord.join("").toLowerCase();

        if (word.length > 4) {
            score = word.length;
        }

        if (this.isPangram(word)) {
            score += this.PANGRAM_BONUS;
        }

        this.currentScore += score;
        return this.currentScore;
    }

    clearInput() {
        game.userGuessedWord = [];
        document.querySelector("#input").value = "";
    }

    // private
    async loadWordsAndFilterSevenLetterWords() {
        try {
            let response = await fetch(this.dictionary_filename);
            let data = await response.json();
            this.words = data;
            this.seven_letter_words = this.getSevenLetterWords();
        } catch (error) {
            console.error("Error:", error);
        }
    }

    // private
    getSevenLetterWords() {
        return this.words.filter((word) => word.length === 7);
    }

    // private
    shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            let j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]]; // Swap elements
        }
    }

    // private
    isPangram(word) {
        return this.currentWord.every((letter) => {
            return word.includes(letter);
        });
    }
}

// Main Part
let game = new SpellingBee(DICTIONARY_FILE);
await game.loadWordsAndFilterSevenLetterWords();
game.populateHoneycomb();
game.addEventListenersToHoneycomb();

document.querySelector("#button-reset").addEventListener("click", function () {
    game.clearInput();
    game.populateHoneycomb();
});

document.querySelector("#button-submit").addEventListener("click", function () {
    if (game.checkWord()) {
        game.scoreWord();
        document.querySelector("#score").innerHTML = game.currentScore;
        game.clearInput();
    } else {
        alert("This word is not valid");
    }
});

document
    .querySelector("#button-clear")
    .addEventListener("click", game.clearInput);
