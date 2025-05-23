<?php

namespace App\Service;

use App\Enum\OptionVisibiliteEnum;

class OfferVisibilitySort
{
     /**
     * Calcule le rang de visibilité d’une offre.
     *   0 = À la Une
     *   1 = En Relief (et pas À la Une)
     *   2 = aucune option
     */
    public function visibilityRank(array $offer): int
    {
        $data = $offer['optionVisibiliteData'] ?? null;
        if (!$data) {
            return 2;
        }

        if (isset($data['nom_option'])) {
            $data = [$data];
        }

        $isRelief = false;
        foreach ($data as $opt) {
            $label = $opt['nom_option'] ?? null;

            if ($label === OptionVisibiliteEnum::ALaUne->value) {
                return 0;
            }
            if ($label === OptionVisibiliteEnum::EnRelief->value) {
                $isRelief = true;
            }
        }

        return $isRelief ? 1 : 2;
    }

    public function sortVisibility(array $offers): array
    {
        $rank = [
            0 => [], // À la Une
            1 => [], // En Relief
            2 => [], // Aucune option
        ];

        foreach ($offers as $offer) {
            $rank[$this->visibilityRank($offer)][] = $offer;
        }

        return array_merge(...$rank);
    }
}