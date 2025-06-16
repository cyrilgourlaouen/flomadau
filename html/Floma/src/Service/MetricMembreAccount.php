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
                $account['email'] === $email &&
                password_verify($password, $account['mot_de_passe'])
            ) {
                return $index;
            }
        }

        return false;
    }
}
?>