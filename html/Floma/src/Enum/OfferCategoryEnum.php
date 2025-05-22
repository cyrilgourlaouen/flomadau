<?php
namespace App\Enum;

use App\Manager\ActiviteManager;
use App\Manager\ParcAttractionManager;
use App\Manager\RestaurantManager;
use App\Manager\SpectacleManager;
use App\Manager\VisiteManager;
use App\Resource\ActiviteResource;
use App\Resource\ParcAttractionResource;
use App\Resource\RestaurantResource;
use App\Resource\SpectacleResource;
use App\Resource\VisiteResource;

enum OfferCategoryEnum: string
{
    case Restauration = 'Restaurant';
    case Activity = 'Activite';
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

    public function getManager()
    {
        return match ($this) {
            self::Activity => new ActiviteManager(),
            self::Show => new SpectacleManager(),
            self::Visite => new VisiteManager(),
            self::AmusementPark => new ParcAttractionManager(),
            self::Restauration => new RestaurantManager(),
        };
    }

    public function getResource()
    {
        return match ($this) {
            self::Activity => ActiviteResource::class,
            self::Show => SpectacleResource::class,
            self::Visite => VisiteResource::class,
            self::AmusementPark => ParcAttractionResource::class,
            self::Restauration => RestaurantResource::class,
        };
    }
}
