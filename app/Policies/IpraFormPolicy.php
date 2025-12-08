<?php

namespace App\Policies;

use App\Models\IpraForm;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IpraFormPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
       return $user->hasPermission('view_imovels');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IpraForm  $ipraForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, IpraForm $ipraForm)
    {
    return $user->hasPermission('view_imovel');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('create_imovel');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IpraForm  $ipraForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, IpraForm $ipraForm)
    {
        return $user->hasPermission('edit_imovel');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IpraForm  $ipraForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, IpraForm $ipraForm)
    {
        return $user->hasPermission('delete_imovel');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IpraForm  $ipraForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, IpraForm $ipraForm)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IpraForm  $ipraForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, IpraForm $ipraForm)
    {
        //
    }
    /**
     * Determine whether the user can print the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\IpraForm  $ipraForm
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function print(User $user, IpraForm $ipraForm)
    {
        return $user->hasPermission('print_imovel');
    }

    public function history(User $user, IpraForm $ipraForm)
    {
        return $user->hasPermission('view_history_imovel');
    }
    public function excelExport(User $user)
    {
        return $user->hasPermission('export_imovels');
    }
}
