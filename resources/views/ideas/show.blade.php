<x-layout.layout>
    <div class="max-w-4xl mx-auto py-8">
        <div class="flex justify-between">
            <a href="{{route('idea.index')}}" class="flex items-center gap-x-2 text-sm font-medium">
                <x-icons.close />
                Volver
            </a>
            <div class="gap-x-3 flex items-center">
                <button class="btn btn-outlined">
                    <x-icons.external />
                    Editar Idea
                </button>
                <form method="POST" action="{{ route('idea.destroy', $idea) }}">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-outlined text-red-500">Eliminar</button>
                </form>
            </div>
        </div>
        <h1 class="font-bold text-4x1">{{$idea->title}}</h1>
        <x-card>
            <div class="text-foreground prose prose-invert max-w-none cursor-pointer">
                {{ $idea->description }}
            </div>
        </x-card>
    </div>
</x-layout.layout>
