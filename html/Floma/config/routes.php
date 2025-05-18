<?php

const ROUTES = [
    '/' => [
        'controller' => App\Controller\MainController::class,
        'method' => 'home',
        'view' => true
    ],
    '/offer/{id}' => [
        'controller' => App\Controller\OfferController::class,
        'method' => 'show',
        'view' => true
    ],
];
