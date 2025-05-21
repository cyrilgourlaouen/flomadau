<?php

namespace App\Service;

class RestaurantPriceRangeCalculator 
{
    public function numberOfEuros(int $number = 1) {
        return str_repeat("<img src='/assets/icons/euro_symbol_primary.svg' alt='Icone d'euro'>", $number);
    }

    public function calculEuros($priceRange)
    {
        if ($priceRange === null) {
            return null;
        } elseif ($priceRange < 25) {
            return $this->numberOfEuros();
        } elseif ($priceRange >= 25 && $priceRange <= 40) {
            return $this->numberOfEuros(2);
        } else {
            return $this->numberOfEuros(3);
        }
    }
}