<?php
namespace Lab7;

class Dice {
    private $values = [];

    public function roll($numDice = 1) {
        $this->values = [];
        for ($i = 0; $i < $numDice; $i++) {
            $this->values[] = rand(1, 6);
        }
        return $this->values;
    }

    public function getValues() {
        return $this->values;
    }

    public function calculateScore() {
        $score = 0;
        $valueCounts = array_count_values($this->values);
        foreach ($valueCounts as $value => $count) {
            if ($count >= 3) {
                $score += $value * 3;
            }
            if ($count >= 4) {
                $score += $value * 4;
            }
            if ($count == 5) {
                $score += 50;
            }
        }
        return $score;
    }
}
?>