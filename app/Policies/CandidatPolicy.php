<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Candidat;
use Illuminate\Auth\Access\HandlesAuthorization;

class CandidatPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function edit(User $current_user, Candidat $c){
        return $current_user->type != 'os';
    }
}
