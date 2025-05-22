<?php

use Floma\Enum\Layout;

const ROUTES = [
    '/' => [
        'controller' => App\Controller\MainController::class,
        'method' => 'home',
    ],
    '/offer/{id}' => [
        'controller' => App\Controller\OfferController::class,
        'method' => 'show',
    ],
    '/pro' => [
        'controller' => App\Controller\MainProController::class,
        'method' => 'home',
        'layout' => Layout::BACK,
    ],
    '/pro/connexion' => [
        'controller' => App\Controller\ConnexionProController::class,
        'method' => 'connexionPro',
    ],
    '/pro/connexion/login' => [
        'controller' => App\Controller\ConnexionProController::class,
        'method' => 'logIn',
        'layout' => Layout::BACK,
    ],
];
