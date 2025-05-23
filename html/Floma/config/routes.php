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
    '/pro/signup' => [
        'controller' => App\Controller\SignupProController::class,
        'method' => 'page',
        'layout' => Layout::BACK,
    ],
    '/pro/signup/submit' => [
        'controller' => App\Controller\SignupProController::class,
        'method' => 'submit',
        'show' => false,
    ],
    '/connexion' => [
        'controller' => App\Controller\ConnexionController::class,
        'method' => 'connection',
        'layout' => Layout::LOG,
    ],
    '/connexion/logIn' => [
        'controller' => App\Controller\ConnexionController::class,
        'method' => 'logIn',
        'view' => false,
    ],
    '/connexion/logOut' => [
        'controller' => App\Controller\ConnexionController::class,
        'method' => 'logOut',
    ]
];

?>