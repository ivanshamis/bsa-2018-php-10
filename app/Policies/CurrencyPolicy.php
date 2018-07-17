<?php

namespace App\Policies;

use App\User;
use App\Entity\Currency;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurrencyPolicy
{
    use HandlesAuthorization;

    public function put(User $user, Currency $currency = NULL)
    {
        return (($user->is_admin) and ($currency!==NULL));
    }
}