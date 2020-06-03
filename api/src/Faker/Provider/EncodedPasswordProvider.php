<?php

namespace App\Faker\Provider;

use Faker\Provider\Base as BaseProvider;

class EncodedPasswordProvider extends BaseProvider
{
    public static function encodePassword($str)
    {
        return password_hash($str, PASSWORD_ARGON2I);
    }
}
