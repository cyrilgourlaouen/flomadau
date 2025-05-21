<?php
namespace App\Enum;

use App\Entity\Activite;
use App\Entity\ParcAttraction;
use App\Entity\Restaurant;
use App\Entity\Spectacle;
use App\Entity\Visite;

enum OfferCategoryEnum: string
{
    case Restauration = 'Restauration';
    case Activity = 'Activité';
    case Visite = 'Visite';
    case AmusementPark = 'Parc d\'attraction';
    case Show = 'Spectacle';

    public function getIcon(): array
    {
        return match ($this) {
            self::Restauration => ['path' => '/assets/icons/restaurant_black.svg', 'alt' => 'Icone de restauration'],
            self::Activity => ['path' => '/assets/icons/sprint_black.svg', 'alt' => 'Icone d\'activité'],
            self::Visite => ['path' => '/assets/icons/map_black.svg', 'alt' => 'Icone de visite'],
            self::AmusementPark => ['path' => '/assets/icons/attractions_black.svg', 'alt' => 'Icone de parc d\'attraction'],
            self::Show => ['path' => '/assets/icons/show_black.svg', 'alt' => 'Icone de spectacle'],
        };
    }

    public function getEntity(): string
    {
        return match ($this) {
            self::Activity => Activite::class,
            self::Show => Spectacle::class,
            self::Visite => Visite::class,
            self::AmusementPark => ParcAttraction::class,
            self::Restauration => Restaurant::class,
        };
    }
}
