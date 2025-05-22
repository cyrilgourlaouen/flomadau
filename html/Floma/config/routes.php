<?php

use Floma\View\Layout;

const ROUTES = [
    '/' => [
        'controller' => App\Controller\MainController::class,
        'method' => 'home',
    ],
    '/pro' => [
        'controller' => App\Controller\MainProController::class,
        'method' => 'home',
        'layout' => Layout::BACK,
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