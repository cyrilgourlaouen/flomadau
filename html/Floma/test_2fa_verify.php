<?php
// test_2fa_verify.php - Test code verification

require_once '../vendor/autoload.php';
require_once 'src/Service/TwoFactorAuthService.php';

use App\Service\TwoFactorAuthService;

if ($argc < 2) {
    echo "Usage: php test_2fa_verify.php [6-digit-code]\n";
    exit(1);
}

$code = $argv[1];
$userId = 1;

$twoFA = new TwoFactorAuthService();

echo "Testing code: $code for user $userId\n";

if ($twoFA->verifyCode($userId, $code)) {
    echo "Code is VALID!\n";
} else {
    echo "Code is INVALID!\n";
}
?>
