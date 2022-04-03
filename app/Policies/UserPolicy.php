<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function see(User $current, User $u){
        return $current->is($u) || $current->is_admin();
    }

    public function edit(User $current, User $u){
        return $current->is_admin();
    }
}
