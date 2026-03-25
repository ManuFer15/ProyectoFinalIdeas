<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class IdeaImageController extends Controller
{
    /**
     * Elimina la imagen física y limpia su referencia en la idea.
     */
    public function destroy(Idea $idea)
    {
        // Solo el propietario de la idea puede gestionar su imagen.
        Gate::authorize('workWith', $idea);
        // Evita archivos huérfanos al borrar primero del disco.
        Storage::disk('public')->delete($idea->image_path);
        $idea->update(['image_path' => null]);

        return back();
    }
}
