<?php

namespace App\Policies;

use App\ModelWordpress\Services;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicesPolicy
{
    use HandlesAuthorization;



    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\App\ModelWordpress\Services  $services
     * @return mixed
     */
    public function view(User $user, Services $services)
    {
        //
        return $user->id === $services->user_id;
    }
}
