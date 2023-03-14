<?php

namespace App\Repository;

use App\Models\User;

class UserRepository
{
    public function returnUserByToken($token)
    {
        $user = User::where('token_for_api', $token)->first();
        if($user) return $user;
        return false;
    }
}
