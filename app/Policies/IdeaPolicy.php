<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;

class IdeaPolicy
{
    /**
     * Permite operar sobre la idea solo a su propietario.
     */
    public function workWith(User $user, Idea $idea): bool
    {
        // Regla de ownership para lectura/edición/eliminación.
        return $idea->user()->is($user);
    }
}
