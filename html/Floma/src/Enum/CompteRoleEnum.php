<?php
namespace App\Enum;
use App\Manager\MembreManager;
use App\Manager\ProfessionnelManager;
use App\Resource\MembreResource;
use App\Resource\ProfessionnelResource;

enum CompteRoleEnum: string
{
    case Professionnel = 'Professionnel';
    case Membre = 'Membre';

    public function getManager()
    {
        return match ($this) {
            self::Professionnel => new ProfessionnelManager(),
            self::Membre => new MembreManager(),
        };
    }

    public function getResource()
    {
        return match ($this) {
            self::Professionnel => ProfessionnelResource::class,
            self::Membre => MembreResource::class,
        };
    }
}
