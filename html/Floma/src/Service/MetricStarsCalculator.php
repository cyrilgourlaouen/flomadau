<?php

namespace App\Service;

class MetricStarsCalculator 
{
    public function roundToHalf(float $x): float 
    {
        return round($x * 2) / 2;
    }

    public function calculStars($AvrgRat): string|null
    {
        if (!$AvrgRat) {
            return str_repeat("<img src='./assets/icons/star_outline_pink.svg' alt='étoile vide'>", 5);
        }
        $roundedValue = $this->roundToHalf($AvrgRat);
        $fullStars = floor($roundedValue);  
        $hasHalfStar = ($roundedValue - $fullStars) === 0.5;
        $emptyStars = 5 - $fullStars - ($hasHalfStar ? 1 : 0);
        $starsImage = str_repeat("<img src='./assets/icons/star_pink.svg' alt='étoile'>", $fullStars);
        if ($hasHalfStar) {
            $starsImage .= "<img src='./assets/icons/star_half_pink.svg' alt='moitié d'étoile'>";
        }
        $starsImage .= str_repeat("<img src='./assets/icons/star_outline_pink.svg' alt='étoile vide'>", $emptyStars);
        return $starsImage;
    }
}