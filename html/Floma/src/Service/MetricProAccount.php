<?php

namespace App\Service;

class MetricProAccount 
{
    public function isProExist(mixed $proAccount, $email, $password)
    {
        foreach($proAccount as $account) {
            $accountIds = [];
            if ($account["roleData"]) {
                array_push($accountIds, $account["id"]);
                if ($account["email"] === $email && password_verify($password, $account["mot_de_passe"]) && $account["roleData"][0]["id_compte"] === $account["id"]){
                    return true;
                }
            }
        }
        return false;
    }

    public function getProId(mixed $proAccount, $raisonSociale, $password): string
    {
        foreach($proAccount as $account) {
            if ($account["roleData"]) {
                if ($account["email"] == $raisonSociale && password_verify($password, $account["mot_de_passe"])){
                    return $account["roleData"][0]["code"];
                }
            }
        }
        return false;
    }
    
}