<?php

namespace App\Policies;

use App\Models\Acta;
use App\Models\User;

class ActaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Acta $acta): bool
    {
        return $user->id === $acta->user_id || !empty($acta->share_token);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Acta $acta): bool
    {
        return $user->id === $acta->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Acta $acta): bool
    {
        return $user->id === $acta->user_id;
    }

    /**
     * Determine whether the user can share the model.
     */
    public function share(User $user, Acta $acta): bool
    {
        return $user->id === $acta->user_id;
    }

    /**
     * Determine whether the user can download PDF.
     */
    public function downloadPdf(User $user, Acta $acta): bool
    {
        return $user->id === $acta->user_id;
    }

    /**
     * Determine whether the user can edit shared fields.
     */
    public function editShared(User $user, Acta $acta): bool
    {
        return !empty($acta->share_token);
    }
}

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Acta $acta): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Acta $acta): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Acta $acta): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Acta $acta): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Acta $acta): bool
    {
        return false;
    }
}
