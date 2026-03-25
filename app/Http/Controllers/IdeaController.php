<?php

namespace App\Http\Controllers;

use App\actions\CreateIdea;
use App\actions\UpdateIdea;
use App\Http\Requests\IdeaRequest;
use App\IdeaStatus;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class IdeaController extends Controller
{
    /**
     * Lista las ideas del usuario autenticado con filtro opcional por estado.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $ideas = $user->ideas()
            // Solo aplica el filtro cuando el estado recibido pertenece al enum.
            ->when(in_array($request->status, IdeaStatus::values()), fn ($query) => $query->where('status', $request->status))
            ->latest()->get();

        return view('ideas.index', [
            'ideas' => $ideas,
            'statusCounts' => Idea::statusCounts($user),
        ]);
    }

    /**
     * El formulario se abre en modal desde la vista index.
     */
    public function create(): void
    {
        //
    }

    /**
     * Crea una idea validada mediante la acción de aplicación.
     */
    public function store(IdeaRequest $request, CreateIdea $action)
    {
        $action->handle($request->safe()->all());

        return to_route('idea.index')->with('success', 'Has creado una nueva idea.');
    }

    /**
     * Muestra el detalle de una idea si el usuario está autorizado.
     */
    public function show(Idea $idea)
    {
        Gate::authorize('workWith', $idea);

        return view('ideas.show', [
            'idea' => $idea,
        ]);
    }

    /**
     * La edición se protege por policy y se renderiza en modal/vista cliente.
     */
    public function edit(Idea $idea): void
    {
        Gate::authorize('workWith', $idea);
    }

    /**
     * Actualiza una idea existente con autorización previa.
     */
    public function update(IdeaRequest $request, Idea $idea, UpdateIdea $action)
    {
        Gate::authorize('workWith', $idea);

        $action->handle($request->safe()->all(), $idea);

        return back()->with('success', 'Has actualizado tu idea.');

    }

    /**
     * Elimina la idea y sus recursos relacionados por cascada.
     */
    public function destroy(Idea $idea)
    {
        Gate::authorize('workWith', $idea);

        $idea->delete();

        return redirect()->route('idea.index');
    }
}
