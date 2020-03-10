<?php


namespace App\Repo;

use App\User;

use Laravel\Socialite\Two\User as UserOAuth;

class UserRepo
{
    public function getUserBySocAccount(UserOAuth $user, string $socName)
    {
        $userInDB = User::query()
            ->where('social_id', $user->id)
            ->where('auth_type', $socName)
            ->first();

        if (empty($userInDB)) {
            $userInDB = new User();

            $userInDB->fill([
                'name' => !empty($user->getName()) ? $user->getName() : '',
                'email' => !empty($user->getEmail()) ? $user->getEmail() : '',
                'password' => '',
                'social_id' => !empty($user->getId()) ? $user->getId() : '',
                'auth_type' => $socName,
                'avatar' => !empty($user->getAvatar()) ? $user->getAvatar() : '',
            ]);

            $userInDB->save();
        }

        return $userInDB;
    }
}
