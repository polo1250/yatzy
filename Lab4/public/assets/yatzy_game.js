// yatzy_game.js
import { rollDie } from "./dice.js";

class YatzyGame {
    constructor() {
        this.rollNumber = 0; // Current roll number (0 to 3)
        this.diceValues = [0, 0, 0, 0, 0]; // Initial values of the dice
        this.diceStates = [false, false, false, false, false]; // Whether to keep or reroll each die (false for reroll)
    }

    // Roll all dice that are not kept
    rollDice() {
        for (let i = 0; i < this.diceValues.length; i++) {
            if (!this.diceStates[i] || this.rollNumber === 0) {
                this.diceValues[i] = rollDie();
            }
        }
        if (this.rollNumber < 3) {
            this.rollNumber++;
        }
    }

    // Method to set a die's state (keep or reroll)
    setDieState(index, state) {
        if (index >= 0 && index < this.diceStates.length) {
            this.diceStates[index] = state;
        }
    }

    // Method to reset the game for a new turn
    resetTurn() {
        this.rollNumber = 0;
        this.diceValues.fill(0);
        this.diceStates.fill(false);
    }
}

// Export the YatzyGame class
export { YatzyGame };
