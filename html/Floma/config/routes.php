<?php

use Floma\View\Layout;

const ROUTES = [
    '/' => [
        'controller' => App\Controller\MainController::class,
        'method' => 'home',
    ],
    'connexion'=> [
        'controller' => App\Controller\ConnexionController::class,
        'method' => 'logIn',
    ]
];
