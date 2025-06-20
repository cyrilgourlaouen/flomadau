<?php

namespace App\Manager;

use App\Entity\Professionnel;
use Floma\Manager\AbstractManager;

class TwoFactorAuthManager extends AbstractManager
{
    /**
     * Find a professional by code
     */
    public function find(int $code): ?Professionnel
    {
        return $this->readOne(Professionnel::class, ['code' => $code]);
    }

    /**
     * Get 2FA secret for a professional
     */
    public function getSecret(int $code): ?string
    {
        $professionnel = $this->find($code);
        return $professionnel ? $professionnel->getCodeA2f() : null;
    }

    /**
     * Set 2FA secret for a professional (enables 2FA)
     */
    public function setSecret(int $code, string $secret): bool
    {
        $this->update(Professionnel::class, ['code_a2f' => $secret], $code, 'code');
        return true;
    }

    /**
     * Check if 2FA is enabled for a professional
     */
    public function isEnabled(int $code): bool
    {
        $secret = $this->getSecret($code);
        return !empty($secret);
    }

    /**
     * Disable 2FA for a professional (set secret to NULL)
     */
    public function disable(int $code): bool
    {
        $this->update(Professionnel::class, ['code_a2f' => null], $code, 'code');
        return true;
    }

    /**
     * Enable 2FA for a professional (same as setSecret, but for clarity)
     */
    public function enable(int $code, string $secret): bool
    {
        return $this->setSecret($code, $secret);
    }
}
