<?php
require_once('_config.php');

use Lab6\Dice;
use Lab6\YatzyGame;
use Lab6\YatzyEngine;

$game = new YatzyGame();
$engine = new YatzyEngine($game);

for ($i=1; $i<=3; $i++) {
  echo "ROLL {$i}:<br>";
  $game->rollDice();
  foreach ($game->getDiceValues() as $value) {
    echo "Die: {$value}<br>";
  }
  $roundScore = $engine->calculateRoundScore($i);
  echo "Round score: {$roundScore}<br>";
  $totalScore = $engine->updateTotalScore();
  echo "Total score: {$totalScore}<br><br>";
}
?>