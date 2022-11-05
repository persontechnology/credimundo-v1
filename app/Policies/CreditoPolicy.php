<?php

namespace App\Policies;

use App\Models\Credito;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CreditoPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user)
    {
        //
    }
    public function garantes(User $user, Credito $credito)
    {
        if($credito->estado==='ENTREGADO'){
            return false;
        }
        return true;
    }

}
