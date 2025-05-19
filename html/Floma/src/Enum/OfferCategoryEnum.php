<?php

enum OfferCategory: string
{
    case Restauration = "Restauration";
    case Activity = "Activité";
    case Visite = "Visite";
    case AmusementPark = "Parc d'attraction";
    case Show = "Spectacle";
}

function getCategoryIcon(OfferCategory $category)
{
    switch ($category) {
        case OfferCategory::Restauration:
            return [
                "path" => "/assets/icons/restaurant_black.svg",
                "alt" => "Icone de restauration"
            ];
        case OfferCategory::Activity:
            return [
                "path" => "/assets/icons/sprint_black.svg",
                "alt" => "Icone d'activité"
            ];
        case OfferCategory::Visite:
            return [
                "path" => "/assets/icons/map_black.svg",
                "alt" => "Icone de visite"
            ];
        case OfferCategory::AmusementPark:
            return [
                "path" => "/assets/icons/attractions_black.svg",
                "alt" => "Icone de parc d'attraction"
            ];
        case OfferCategory::Show:
            return [
                "path" => "/assets/icons/show_black.svg",
                "alt" => "Icone de spectacle"
            ];
        default:
            return null;
    }
}
