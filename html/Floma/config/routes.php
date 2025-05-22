<?php

use Floma\Enum\Layout;

const ROUTES = [
    '/' => [
        'controller' => App\Controller\MainController::class,
        'method' => 'home',
    ],
    '/pro/connexion' => [
        'controller' => App\Controller\ConnexionProController::class,
        'method' => 'connexionPro',
        'layout' => Layout::BACK,
    ],
];
