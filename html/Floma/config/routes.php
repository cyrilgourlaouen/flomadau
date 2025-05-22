<?php

use Floma\View\Layout;

const ROUTES = [
    '/' => [
        'controller' => App\Controller\MainController::class,
        'method' => 'home',
        'layout' => Layout::FRONT,
    ],

    '/inscription/membre' => [
        'controller' => App\Controller\InscriptionController::class,
        'method' => 'home',
        'layout' => Layout::FRONT_INSCRIPTION,
    ],

    '/inscription/membre/sign-up' => [
        'controller' => App\Controller\InscriptionController::class,
        'method' => 'signUp',
        'view' => false,
    ],

    '/pro' => [
        'controller' => App\Controller\MainProController::class,
        'method' => 'home',
        'layout' => Layout::BACK,
    ],
];
