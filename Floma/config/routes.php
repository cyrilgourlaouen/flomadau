<?php

const ROUTES = [
    '/' => [
        'controller' => App\Controller\MainController::class,
        'method' => 'home',
        'view' => true
    ],
    '/blog' => [
        'controller' => App\Controller\ArticleController::class,
        'method' => 'index',
        'view' => true
    ],
    '/blog/add' => [
        'controller' => App\Controller\ArticleController::class,
        'method' => 'add',
        'view' => false
    ],
];
