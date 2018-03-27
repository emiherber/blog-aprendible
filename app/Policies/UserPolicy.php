<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    
    /**
     * Se ejecuta antes que cualquier otro de los metodos aqui definidos.
     * @param \App\User $user
     */
    public function before($user){
        if($user->hasRole('Admin')){
            return true;
        }
    }
    
    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $authuser
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $authuser, User $user)
    {
        return $authuser->id === $user->id || $authuser->hasPermissionTo('Listar usuarios');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('Crear usuarios');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $authuser
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $authuser, User $user)
    {
        return $authuser->id === $user->id || $user->hasPermissionTo('Actualizar usuarios');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $authuser
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $authuser, User $user)
    {
        return $authuser->id === $user->id || $user->hasPermissionTo('Eliminar usuarios');
    }
}
