<?php

const ROUTES = [
    '/' => [
        'controller' => App\Controller\MainController::class,
        'method' => 'home',
        'view' => true
    ],
    '/informationM' => [
        'controller' => App\Controller\InformationMController::class,
        'method' => 'information',
        'view' => true
    ]
];
