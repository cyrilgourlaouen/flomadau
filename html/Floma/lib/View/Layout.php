<?php
namespace Floma\View;

enum Layout: string
{
    case FRONT  = 'layout.php';
    case BACK   = 'layout_back.php';
    case FRONT_INSCRIPTION   = 'layout_inscription.php';
}