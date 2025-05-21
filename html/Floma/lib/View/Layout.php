<?php
namespace Floma\View;

enum Layout: string
{
    case FRONT  = 'layout.php';
    case BACK   = 'layout_back.php';
    case INSCRIPTION_FRONT = 'layout_inscription.php';
}