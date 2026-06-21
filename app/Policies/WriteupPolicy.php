<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Writeup;

class WriteupPolicy
{
    public function view(?User $user, Writeup $writeup): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Writeup $writeup): bool
    {
        return $writeup->user_id === $user->id;
    }

    public function delete(User $user, Writeup $writeup): bool
    {
        return $writeup->user_id === $user->id;
    }
}
