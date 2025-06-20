<?php
// test_2fa.php - Place this in your project root for testing

require_once '../vendor/autoload.php';
require_once 'src/Service/TwoFactorAuthService.php';

use App\Service\TwoFactorAuthService;

$twoFA = new TwoFactorAuthService();

// Test 1: Generate secret for user ID 1
echo "=== Testing 2FA Service ===\n\n";

$userId = 1;
$email = "test@example.com";

echo "1. Generating 2FA secret for user $userId ($email):\n";
$result = $twoFA->generateSecret($userId, $email);

echo "Secret: " . $result['secret'] . "\n";
echo "QR Code URI: " . $result['qr_code_uri'] . "\n";
echo "Manual Entry Key: " . $result['manual_entry_key'] . "\n\n";

// Test 2: Check if enabled (should be false initially)
echo "2. Is 2FA enabled for user $userId? " . ($twoFA->isEnabled($userId) ? 'YES' : 'NO') . "\n\n";

// Test 3: Enable 2FA
echo "3. Enabling 2FA for user $userId\n";
$twoFA->enable($userId);
echo "Is 2FA enabled now? " . ($twoFA->isEnabled($userId) ? 'YES' : 'NO') . "\n\n";

echo "=== Manual Testing Required ===\n";
echo "To test code verification:\n";
echo "1. Scan the QR code with an authenticator app (Google Authenticator, Authy, etc.)\n";
echo "2. Or manually add this key: " . $result['manual_entry_key'] . "\n";
echo "3. Run: php test_2fa_verify.php [6-digit-code]\n\n";

echo "QR Code can be generated at: " . str_replace('{PROVISIONING_URI}', urlencode($result['qr_code_uri']), 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={PROVISIONING_URI}') . "\n";
?>
