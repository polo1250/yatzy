<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';
require 'models/Game.php';

$app = AppFactory::create();
$game = new Game('../assets/dictionary.json'); // replace with your dictionary file path

// CORS Middleware
$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

$app->post('/getNewWord', function (Request $request, Response $response, $args) {
    $game = new Game('../assets/dictionary.json'); // replace with your dictionary file path
    $gameData = $game->setupGame();

    $response->getBody()->write(json_encode($gameData));
    return $response->withHeader('Content-Type', 'application/json');
});

// Submit Word Endpoint
// $app->post('/submitWord', function (Request $request, Response $response, $args) {
//     $params = (array)$request->getParsedBody();
//     $word = $params['word'];
//     $currentWord = $params['currentWord'];
//     $middleLetter = $params['middleLetter'];

//     // Assuming you have a function to check the submitted word
//     $checkResult = checkSubmittedWord($word, $currentWord, $middleLetter); // Implement this function

//     $response->getBody()->write(json_encode($checkResult));
//     return $response->withHeader('Content-Type', 'application/json');
// });

$app->run();
