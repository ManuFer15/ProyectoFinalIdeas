<?php

namespace App\Http\Controllers;

use App\Models\Step;

class StepController extends Controller
{
    public function update(Step $step)
    {
        // autorizacion
        $step->update(['completada' => ! $step->completada]);

        return back();
    }
}
