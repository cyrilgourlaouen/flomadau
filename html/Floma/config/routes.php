<?php

use Floma\View\Layout;

const ROUTES = [
    '/' => [
        'controller' => App\Controller\MainController::class,
        'method' => 'home',
    ],

    'informationM' => [
        'controller' => App\Controller\InformationMController::class,
        'method' => 'information',
    ]
];
