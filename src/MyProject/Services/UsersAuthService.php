<?php

namespace MyProject\Services;

// use MyProject\Models\Users\User;
use Admin\Models\Users\User;

// use MyProject\Controllers;


class UsersAuthService
{
	
	    public static function createToken(User $user): void
    {
        $token = $user->getId() . ':' . $user->getAuthToken();
        setcookie('token', $token, 0, '/', '', false, true);
    }

    public static function getUserByToken(): ?User
    {
        $token = $_COOKIE['token'] ?? '';

        if (empty($token)) {
            return null;
        }

        [$userId, $authToken] = explode(':', $token, 2);

        $user = User::getById((int) $userId);

        if ($user === null) {
            return null;
        }

        if ($user->getAuthToken() !== $authToken) {
            return null;
        }

        return $user;
    }
	
    // public static function createToken(User $user): void
    // {
    //     $token = $user->getId() . ':' . $user->getAuthToken();
    //     setcookie('token', $token, 0, '/', '', false, true);
    // }
    
    // // with user role
    // public static function createToken2(User $user): void
    // {
    //     $token = $user->getRole().':'. $user->getId() . ':' . $user->getAuthToken();
    //     echo $token;
    //     // $token = $user->getId() . ':' . $user->getAuthToken();
    //     setcookie('token', $token, 0, '/', '', false, true);
    // }

    // public static function deleteToken(): void
    // {
    //     // $token = $user->getId() . ':' . $user->getAuthToken();
    //     setcookie('token', "", time() - 3600, '/', '', false, true);
    // }

    // public static function getUserByToken(): ?User
    // {
    //     $token = $_COOKIE['token'] ?? '';

    //     if (empty($token)) {
    //         return null;
    //     }

    //     [$userId, $authToken] = explode(':', $token, 2);

    //     $user = User::getById((int) $userId);

    //     if ($user === null) {
    //         return null;
    //     }

    //     if ($user->getAuthToken() !== $authToken) {
    //         return null;
    //     }

    //     return $user;
    // }

    // public static function getUserByToken2(): ?User
    // {
    //     $token = $_COOKIE['token'] ?? '';

    //     if (empty($token)) {
    //         return null;
    //     }

    //     [$roleId, $userId, $authToken] = explode(':', $token, 3);

    //     $user = User::getById((int) $userId);

    //     if ($user === null) {
    //         return null;
    //     }

    //     if($user->getRole()!=$roleId){
    //         return null;
    //     }

    //     if ($user->getAuthToken() !== $authToken) {
    //         return null;
    //     }

    //     return $user;
    // }
}