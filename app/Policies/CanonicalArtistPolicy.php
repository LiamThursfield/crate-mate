<?php

namespace App\Policies;

use App\Models\CanonicalArtist;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CanonicalArtistPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * A user can view a CanonicalArtist if they own it or if it is verified.
     */
    public function view(User $user, CanonicalArtist $canonicalArtist): bool
    {
        return $canonicalArtist->user_id === $user->id || $canonicalArtist->isVerified();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * A user can update a CanonicalArtist only if they own it, and it is not verified.
     */
    public function update(User $user, CanonicalArtist $canonicalArtist): bool
    {
        return $canonicalArtist->user_id === $user->id && $canonicalArtist->isNotVerified();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CanonicalArtist $canonicalArtist): bool
    {
        return $this->update($user, $canonicalArtist);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CanonicalArtist $canonicalArtist): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CanonicalArtist $canonicalArtist): bool
    {
        return false;
    }
}
