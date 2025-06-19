<?php

namespace App\Service;

use App\Enum\DayEnum;
use App\Enum\OfferCategoryEnum;

class CalendarCalculator 
{
    private function regrouperHorairesParJour(array $data): array
    {
        $result = [];
        foreach ($data as $item) {
            $jour = $item['nom_jour'];

            $result[$jour][] = [
                'horaire_debut' => $item['horaire_debut'],
                'horaire_fin'   => $item['horaire_fin'],
            ];
        }
        return $result;
    }

    public function getHoraireForDay(array $data, string $day, string $mode = 'startEnd'): string
    {
        $result = "";
        $week = $this->regrouperHorairesParJour($data);

        if (!isset($week[$day])) return "fermé";

        $horaire = $week[$day];

        if ($mode === 'startEnd') {
            $first = $horaire[0]["horaire_debut"];
            $last  = $horaire[count($horaire)-1]["horaire_fin"];
            $result = $this->removeMs($first) . " - " . $this->removeMs($last);
        } elseif ($mode === 'full') {
            $parts = [];
            foreach ($horaire as $h) {
                $parts[] = $this->removeMs($h["horaire_debut"]) . " - " . $this->removeMs($h["horaire_fin"]);
            }
            $result = implode(" → ", $parts);
        }
        return $result;
    }

    private function removeMs(string $heure, ): string
    {
        return substr($heure, 0, 5); 
    }

    public function isOpen(array $data,string $day)
    {
        return $this->getHoraireForDay($data, $day) !== "fermé";
    }

}
