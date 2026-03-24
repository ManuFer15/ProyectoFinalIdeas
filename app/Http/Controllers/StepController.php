<?php

namespace App\Http\Controllers;

use App\Models\Step;
use Illuminate\Http\Request;

class StepController extends Controller
{
    public function update(Step $step)
    {
        //autorizacion
        $step->update(['completada' => !$step->completada]);

        return back();
    }
}
