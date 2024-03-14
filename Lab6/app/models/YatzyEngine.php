<?php
namespace Lab6;

class YatzyEngine {
    private $game;
    private $totalScore;
    private $upperSectionScore;

    public function __construct(YatzyGame $game) {
        $this->game = $game;
        $this->totalScore = 0;
        $this->upperSectionScore = 0;
    }

    public function calculateRoundScore($scoreType) {
        $diceValues = $this->game->getDiceValues();
        $roundScore = 0;
        foreach ($diceValues as $value) {
            if ($value == $scoreType) {
                $roundScore += $value;
            }
        }
        if ($scoreType >= 1 && $scoreType <= 6) {
            $this->upperSectionScore += $roundScore;
        }
        return $roundScore;
    }

    public function updateTotalScore() {
        $this->totalScore += $this->calculateRoundScore($this->game->getRoll());
        if ($this->upperSectionScore >= 63) {
            $this->totalScore += 50; // bonus
        }
        return $this->totalScore;
    }
}
?>