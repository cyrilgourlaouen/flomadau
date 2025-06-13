<?php

namespace App\Service;

use App\Enum\OfferCategoryEnum;

class CategoryContent 
{
    public function getContentCategory(mixed $cate, string $nameCate, string $accessibility, ?array $more = null): string 
    {
        $content = "";
        if ($nameCate === OfferCategoryEnum::Show->value) {
            $content .= "<div class='align'><img src='./assets/icons/schedule_primary.svg' alt='horloge'><p>" . $cate["duree"] .  " heures</p></div>" .
            "<div class='align'><img src='./assets/icons/accessibility_primary.svg' alt='accessibility'><p>$accessibility</p></div>" .
            "<div class='align'><img src='./assets/icons/family_primary.svg' alt='family'><p>" . $cate["capacite"] .  " personnes maximum</p></div>";
        }
        elseif ($nameCate === OfferCategoryEnum::Activity->value) {
            $content .= "<div class='flex-row align-start gap-md'><div class='presta'><p class='semi-bold'>Prestation incluse</p>" . $this->getStringPresta($cate["prestations_incluses"]) . "</div>" .
            "<div class='presta'><p class='semi-bold'>Prestation non incluse</p>" . $this->getStringPresta($cate["prestations_non_incluses"]) . "</div></div>" .
            "<div class='align'><img src='./assets/icons/euro_symbol_primary.svg' alt='euro'><p>" . $cate["prix_minimal"] .  " euros</p></div>" .
            "<div class='align'><img src='./assets/icons/schedule_primary.svg' alt='horloge'><p>" . $cate["duree"] .  " heures</p></div>" .
            "<div class='align'><img src='./assets/icons/accessibility_primary.svg' alt='accessibility'><p>$accessibility</p></div>" .
            "<div class='align'><img src='./assets/icons/family_primary.svg' alt='famille'><p>Dès " . $cate["age_requis"] .  " ans minimum</p></div>";
        }
        elseif ($nameCate === OfferCategoryEnum::AmusementPark->value) {
            $content .= "<div class='align'><img src='./assets/icons/accessibility_primary.svg' alt='accessibility'><p>$accessibility</p></div>" .  
            "<div class='align'><img src='./assets/icons/attractions_primary.svg' alt='family'><p>" . $cate["nombre_attraction"] .  " attractions</p></div>" .
            "<div class='align'><img src='./assets/icons/euro_symbol_primary.svg' alt='famille'><p>Dès " . str_replace(".",",",(string) $cate["prix_minimal"]) .  " euros</p></div>";
            if ($cate["url_plan"]) {
                $content .= "<h3>Plan du parc d'attraction</h3>" .
                "<a class='carteRestau' href='./uploads/parcAttraction/" . $cate["url_plan"] . "'download='./uploads/parcAttraction/" . $cate["url_plan"] . "' alt='carte'>Télécharger le plan du parc d'attraction</a>";
            }
        }
        elseif ($nameCate === OfferCategoryEnum::Restauration->value) {
            $content .= "<div class='align'><img src='./assets/icons/accessibility_primary.svg' alt='accessibility'><p>$accessibility</p></div>" .
            "<div class='align'><img src='./assets/icons/restaurant_primary.svg' alt='restaurant'><p>" . $this->getStringMoments($more) .  "</p></div>" .
            "<div class='align'>" . str_repeat("<img src='/assets/icons/paid_primary.svg' alt='Icone d'euro'>", $cate["gamme_de_prix"]) .  "</div>";
            if ($cate["url_carte_restaurant"]) {
                $content .= "<h3>Carte du restaurant</h3>" .
                "<a class='carteRestau' href='./uploads/restaurant/" . $cate["url_carte_restaurant"] . "'download='./uploads/restaurant/" . $cate["url_carte_restaurant"] . "' alt='carte'>Télécharger la carte du restaurant</a>";
            }
            
        }
        elseif ($nameCate === OfferCategoryEnum::Visite->value) {
            $content .= "<div class='align'><img src='./assets/icons/schedule_primary.svg' alt='horloge'><p>" . $cate["duree"] .  " heures</p></div>" .
            "<div class='align'><img src='./assets/icons/accessibility_primary.svg' alt='accessibility'><p>$accessibility</p></div>" .
            "<div class='align'><img src='./assets/icons/translate_primary.svg' alt='translate'><p>" . $this->getStringLanguages($more) .  " </p></div>";
        }
        return $content;
    }

    private function getStringPresta(string $presta) 
    {
        $ret = "";
        $prestaArray = explode(",", $presta);
        if (sizeof($prestaArray) > 1) {
            $ret .= "<ul>";
            foreach($prestaArray as $prestas) {
                $ret .= "<li>$prestas</li>";
            }
            $ret .= "</ul>";
            return $ret;
        }
        return "<ul><li>$presta</li></ul>";
    }

    private function getStringMoments(array $momentArray) 
    {
        $ret = "";
        foreach($momentArray as $moment) {
            $ret .= $moment['nom_type'] . ", ";
        }
        return $ret;
    }

    private function getStringLanguages(array $momentArray) 
    {
        $ret = "";
        foreach($momentArray as $moment) {
            $ret .= $moment['nom_langue'] . ", ";
        }
        return substr($ret, 0, -2);
    }
}