<?php

namespace App\Service;

class PasswordVerify 
{
    public function passwordIsCorrect(mixed $password, $passwordWrite)
    {
        if (password_verify($password, $passwordWrite)) {
            return true;
        }
        return false;
    }
    
}