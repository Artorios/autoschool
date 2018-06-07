<?php

namespace App\Services;

use App\{
    Events\UserPasswordChangedEvent,
    Models\User\User
};

class ChangePasswordService
{
    protected $password;
    protected $user;

    public function __construct(string $password, User $user)
    {
        $this->password = $password;
        $this->user = $user;
    }

    /**
     * @return bool
     */
    public function changeUserPassword()
    {
        $this->user->update([
            'password' => bcrypt($this->password)
        ]);

        event(new UserPasswordChangedEvent($this->user));

        return true;
    }
}