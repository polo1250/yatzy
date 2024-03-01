const DICTIONARY_FILE = "dictionary.json";

fetch("words.json")
    .then((response) => response.json())
    .then((data) => {
        words = data;
    })
    .catch((error) => {
        console.error("Error:", error);
    });
