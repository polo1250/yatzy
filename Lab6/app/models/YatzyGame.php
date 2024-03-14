<?php
namespace Lab6;

class YatzyGame {
    private $roll;
    private $diceValues;
    private $diceStates;

    public function __construct() {
        $this->roll = 0;
        $this->diceValues = array_fill(0, 5, 0);
        $this->diceStates = array_fill(0, 5, false);
    }

    public function getRoll() {
        return $this->roll;
    }

    public function getDiceValues() {
        return $this->diceValues;
    }

    public function getDiceStates() {
        return $this->diceStates;
    }

    public function rollDice() {
        $dice = new Dice();
        for ($i = 0; $i < 5; $i++) {
            if (!$this->diceStates[$i]) {
                $this->diceValues[$i] = $dice->roll()[0];
            }
        }
        $this->roll++;
    }

    public function keepDice($index) {
        $this->diceStates[$index] = true;
    }

    public function rerollDice($index) {
        $this->diceStates[$index] = false;
    }
}
?>