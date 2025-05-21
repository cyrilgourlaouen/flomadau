<?php

use Floma\View\Layout;

const ROUTES = [
    '/' => [
        'controller' => App\Controller\MainController::class,
        'method' => 'home',
    ],
    '/pro'=> [
        'controller' => App\Controller\MainProController::class,
        'method'=> 'home',
    ],
];
