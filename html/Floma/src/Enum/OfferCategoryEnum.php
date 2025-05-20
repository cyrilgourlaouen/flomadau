<?php
namespace App\Enum;

enum OfferCategoryEnum: string
{
    case Restauration   = 'Restauration';
    case Activity       = 'Activité';
    case Visite         = 'Visite';
    case AmusementPark  = 'Parc d\'attraction';
    case Show           = 'Spectacle';

    public function getIcon(): array
    {
        return match ($this) {
            self::Restauration   => [ 'path' => '/assets/icons/restaurant_black.svg',  'alt' => 'Icone de restauration' ],
            self::Activity       => [ 'path' => '/assets/icons/sprint_black.svg',      'alt' => 'Icone d\'activité' ],
            self::Visite         => [ 'path' => '/assets/icons/map_black.svg',         'alt' => 'Icone de visite' ],
            self::AmusementPark  => [ 'path' => '/assets/icons/attractions_black.svg', 'alt' => 'Icone de parc d\'attraction' ],
            self::Show           => [ 'path' => '/assets/icons/show_black.svg',        'alt' => 'Icone de spectacle' ],
        };
    }

    public function getEntity(): string
    {
        return match ($this) {
            self::Restauration   => 'App\Entity\Restauration',
            self::Activity       => 'App\Entity\Activite',
            self::Visite         => 'App\Entity\Visite',
            self::AmusementPark  => 'App\Entity\ParcAttraction',
            self::Show           => 'App\Entity\Spectacle',
        };
    }
}
