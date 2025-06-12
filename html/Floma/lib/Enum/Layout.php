<?php
namespace Floma\Enum;

enum Layout: string
{
    case FRONT  = 'layout.php';
    case BACK   = 'layout_back.php';
    case LOG = 'layout_connection.php';
    case FRONT_INSCRIPTION   = 'layout_inscription.php';
}