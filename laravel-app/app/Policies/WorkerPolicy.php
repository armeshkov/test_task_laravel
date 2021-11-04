<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Auth\Access\HandlesAuthorization;

class WorkerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     */
    public function viewAny(User $user, Company $company)
    {
        dd('123');
        return $user->id == $company->user_id;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Worker $worker, Company $company)
    {
        return ($company->id == $worker->company->id && $user->id == $company->user_id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Company $company,Worker $worker)
    {
        return ($company->id == $worker->company->id && $user->id == $company->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Worker $worker)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Worker $worker)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Worker  $worker
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Worker $worker)
    {
        //
    }
}
