<?php

namespace App\Enum;

enum OfferCategoryEnum: string
{
    case Restauration = "Restauration";
    case Activity = "Activité";
    case Visite = "Visite";
    case AmusementPark = "Parc d'attraction";
    case Show = "Spectacle";
}

function getCategoryIcon(OfferCategoryEnum $category)
{
    switch ($category) {
        case OfferCategoryEnum::Restauration:
            return [
                "path" => "/assets/icons/restaurant_black.svg",
                "alt" => "Icone de restauration"
            ];
        case OfferCategoryEnum::Activity:
            return [
                "path" => "/assets/icons/sprint_black.svg",
                "alt" => "Icone d'activité"
            ];
        case OfferCategoryEnum::Visite:
            return [
                "path" => "/assets/icons/map_black.svg",
                "alt" => "Icone de visite"
            ];
        case OfferCategoryEnum::AmusementPark:
            return [
                "path" => "/assets/icons/attractions_black.svg",
                "alt" => "Icone de parc d'attraction"
            ];
        case OfferCategoryEnum::Show:
            return [
                "path" => "/assets/icons/show_black.svg",
                "alt" => "Icone de spectacle"
            ];
        default:
            return null;
    }
}
