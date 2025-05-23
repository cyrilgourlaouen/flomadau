<?php

namespace App\Service;

class MetricProAccount 
{
    public function isProExist(mixed $proAccount, $raisonSociale, $password)
    {
        foreach($proAccount as $account) {
            if ($account["roleData"]) {
                if ($account["roleData"][0]["raison_sociale"] == $raisonSociale && password_verify($password, $account["mot_de_passe"])){
                    return true;
                }
            }
        }
        return false;
    }
    
}