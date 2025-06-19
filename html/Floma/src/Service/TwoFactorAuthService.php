<?php

namespace App\Service;

// Include Composer autoloader for OTPHP library
require_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use OTPHP\TOTP;

class TwoFactorAuthService
{
    private string $dataFile;
    
    public function __construct()
    {
        $this->dataFile = dirname(__DIR__, 2) . '/data/2fa_secrets.json';
        $this->ensureDataFileExists();
    }
    
    /**
     * Generate a new TOTP secret for a user
     */
    public function generateSecret(int $userId, string $email): array
    {
        // Create TOTP instance
        $totp = TOTP::create();
        $totp->setLabel($email);
        $totp->setIssuer('PACT Pro'); // Your app name
        
        $secret = $totp->getSecret();
        
        // Store the secret
        $this->storeSecret($userId, $secret);
        
        // Generate QR code URI
        $qrCodeUri = $totp->getQrCodeUri(
            'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={PROVISIONING_URI}',
            '{PROVISIONING_URI}'
        );
        
        return [
            'secret' => $secret,
            'qr_code_uri' => $qrCodeUri,
            'manual_entry_key' => $secret
        ];
    }
    
    /**
     * Verify a TOTP code for a user
     */
    public function verifyCode(int $userId, string $code): bool
    {
        $secret = $this->getSecret($userId);
        
        if (!$secret) {
            return false;
        }
        
        $totp = TOTP::create($secret);
        
        // Verify the code with a window of ±1 period (30 seconds each)
        return $totp->verify($code, null, 1);
    }
    
    /**
     * Check if user has 2FA enabled
     */
    public function isEnabled(int $userId): bool
    {
        $data = $this->loadData();
        return isset($data[$userId]) && ($data[$userId]['enabled'] ?? false);
    }
    
    /**
     * Enable 2FA for a user (after successful verification)
     */
    public function enable(int $userId): void
    {
        $data = $this->loadData();
        if (isset($data[$userId])) {
            $data[$userId]['enabled'] = true;
            $this->saveData($data);
        }
    }
    
    /**
     * Disable 2FA for a user
     */
    public function disable(int $userId): void
    {
        $data = $this->loadData();
        if (isset($data[$userId])) {
            $data[$userId]['enabled'] = false;
            $this->saveData($data);
        }
    }
    
    /**
     * Remove 2FA data for a user
     */
    public function remove(int $userId): void
    {
        $data = $this->loadData();
        if (isset($data[$userId])) {
            unset($data[$userId]);
            $this->saveData($data);
        }
    }
    
    /**
     * Store secret for a user
     */
    private function storeSecret(int $userId, string $secret): void
    {
        $data = $this->loadData();
        $data[$userId] = [
            'secret' => $secret,
            'enabled' => false,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->saveData($data);
    }
    
    /**
     * Get secret for a user
     */
    private function getSecret(int $userId): ?string
    {
        $data = $this->loadData();
        return $data[$userId]['secret'] ?? null;
    }
    
    /**
     * Load data from JSON file
     */
    private function loadData(): array
    {
        if (!file_exists($this->dataFile)) {
            return [];
        }
        
        $content = file_get_contents($this->dataFile);
        return json_decode($content, true) ?: [];
    }
    
    /**
     * Save data to JSON file
     */
    private function saveData(array $data): void
    {
        file_put_contents($this->dataFile, json_encode($data, JSON_PRETTY_PRINT));
    }
    
    /**
     * Ensure the data file exists
     */
    private function ensureDataFileExists(): void
    {
        $dataDir = dirname($this->dataFile);
        if (!is_dir($dataDir)) {
            mkdir($dataDir, 0755, true);
        }
        
        if (!file_exists($this->dataFile)) {
            file_put_contents($this->dataFile, '{}');
        }
    }
}
