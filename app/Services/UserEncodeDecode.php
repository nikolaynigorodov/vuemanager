<?php

namespace App\Services;

class UserEncodeDecode
{
    const SALT = "58Y&uhGbnH%87%Lm9";
    public static function encode($userId)
    {
        return openssl_encrypt($userId, "AES-128-ECB", self::SALT);
    }

    public static function decode($hash)
    {
        return openssl_decrypt($hash, "AES-128-ECB", self::SALT);
    }
}
