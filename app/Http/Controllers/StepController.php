<?php

namespace App\Http\Controllers;

use App\Models\Step;

class StepController extends Controller
{
    /**
     * Alterna el estado de completado de un paso.
     */
    public function update(Step $step)
    {
        // Nota: la autorización debería resolverse por policy del recurso padre (Idea).
        $step->update(['completada' => ! $step->completada]);

        return back();
    }
}
