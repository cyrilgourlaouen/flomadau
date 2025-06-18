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
        'layout' => Layout::BACK,
    ],
    '/pro/connexion/login' => [
        'controller' => App\Controller\ConnexionProController::class,
        'method' => 'logIn',
        'layout' => Layout::BACK,
        'view' => false,
    ],
    '/pro/connexion/logout' => [
        'controller' => App\Controller\ConnexionProController::class,
        'method' => 'logOut',
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
    '/pro/check' => [
        'controller' => App\Controller\CheckDataProController::class,
        'method' => 'home',
        'layout' => Layout::BACK,
    ],
    '/connexion'=> [
        'controller' => App\Controller\ConnexionController::class,
        'method' => 'connection',
        'layout' => Layout::LOG,
    ],
    '/connexion/logIn' => [
        'controller' => App\Controller\ConnexionController::class,
        'method' => 'logIn',
    ],
    '/connexion/logOut' => [
        'controller' => App\Controller\ConnexionController::class,
        'method' => 'logOut',
    ],
    '/consultationMembre' => [
        'controller' => App\Controller\ConsultationMController::class,
        'method' => 'consultation',
    ],
    '/offre/creation' => [
        'controller' => App\Controller\Creation\CreationOffreController::class,
        'method' => 'home',
        'layout' => Layout::BACK,
    ],
    '/offre/creation/new' => [
        'controller' => App\Controller\Creation\CreationOffreController::class,
        'method' => 'newOffer',
        'view' => false,
    ],
];
?>