<?php

namespace App\Service;

class MetricMembreAccount 
{
    /**
     * Retourne l'index du compte membre si trouvé, sinon false
     */
    public function isMembreExist(array $accounts, string $email, string $password): int|false
{
    foreach ($accounts as $index => $account) {
        if (
            isset($account['email'], $account['mot_de_passe']) &&
            $account['email'] === $email &&
            $account['mot_de_passe'] === $password
        ) {
            return $index;
        }
    }
    return false;
}

}


?>