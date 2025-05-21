<?php

use Floma\View\Layout;

const ROUTES = [
    '/' => [
        'controller' => App\Controller\MainController::class,
        'method' => 'home',
        'layout' => Layout::FRONT,
    ],

    '/inscriptionM' => [
        'controller' => App\Controller\InscriptionMembreController::class,
        'method' => 'creation_membre',
        'layout' => Layout::INSCRIPTION_FRONT,
    ]
];
