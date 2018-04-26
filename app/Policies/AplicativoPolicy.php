<?php

namespace Updater\Policies;

use Updater\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AplicativoPolicy
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

    public function verAplicativo(User $user, Aplicativo $aplicativo) {
        
    }
}
