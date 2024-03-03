<?php
namespace Lab6;
class Dice {
    public function roll() {
        // Generate a random number between 1 and 6
        $randomNumber = rand(1, 6);
        
        return $randomNumber;
    }
}
?>
