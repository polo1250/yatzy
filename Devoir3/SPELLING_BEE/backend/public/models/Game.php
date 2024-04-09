<?php
class Game {
    private $words;
    private $seven_letter_words;
    private $dictionary_file_path;
    private $middleLetter;
    private $currentScore;
    private $currentWord;
    private $guessedWords;
    private $PANGRAM_BONUS;

    public function __construct($dictionary_file_path) {
        $this->dictionary_file_path = $dictionary_file_path;
        $this->words = [];
        $this->sevenLetterWords = [];
        $this->middleLetter = '';
        $this->currentScore = 0;
        $this->currentWord = [];
        $this->userGuessedWord = [];
        $this->userGuesses = [];
        $this->PANGRAM_BONUS = 7;
        $this->loadWordsAndFilterSevenLetterWords();
    }

    private function isPangram($word) {
        $letters = str_split($word);
        $unique_letters = array_unique($letters);
        return count($unique_letters) == 7;
    }

    private function shuffleWord($word) {
        $letters = str_split($word);
        shuffle($letters);
        return implode('', $letters);
    }

    private function getSevenLetterWords() {
        return array_filter($this->words, function($word) {
            return strlen($word) == 7;
        });
    }

    public function checkWord($guessedWord) {
        if (
            in_array($guessedWord, $this->words) && // Check if the word is in the dictionary
            strpos($guessedWord, $this->middleLetter) !== false && // Check if the word contains the middle letter
            !in_array($guessedWord, $this->userGuesses) // Check if the word has not already been guessed
        ) {
            $this->userGuesses[] = $guessedWord; // Add the word to the list of guessed words
    
            return true;
        } else {
            return false;
        }
    }

    public function scoreWord($guessedWord) {
        $score = 1; // Initial score
        $word = strtolower($guessedWord); // Convert the word to lowercase
    
        if (strlen($word) > 4) {
            $score = strlen($word); // Set score to word length if greater than 4
        }
    
        if ($this->isPangram($word)) {
            $score += $this->PANGRAM_BONUS; // Add pangram bonus
        }
    
        $this->currentScore += $score; // Update current score
        return $this->currentScore; // Return updated score
    }

    private function loadWordsAndFilterSevenLetterWords() {
        $this->words = json_decode(file_get_contents($this->dictionary_file_path));
        $this->seven_letter_words = $this->getSevenLetterWords();
    }
}
?>