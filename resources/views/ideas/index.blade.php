<x-layout.layout>
    <div class="max-w-7x1 mx-auto py-10 text-muted-foreground">
        <header>
            <h1 class="text-3xl font-bold text-center text-foreground">Bienvenido a Ideas</h1>
            <p class="text-center text-foreground mt-4">Comparte tus ideas y descubre las de otros.</p>
        </header>
        <div clasS="mt-10">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse( $ideas as $idea)
                    <x-card>
                        <h3 class="text-xl font-semibold text-foreground">{{ $idea->title }}</h3>
                        <div class="text-foreground mt-2">{{ $idea->description }}</div>
                        <div class="mt-4">{{$idea->created_at->diffForHumans()}}</div>
                    </x-card>
                @empty
                    <x-card>
                        <p class="text-center text-foreground mt-10">No hay ideas para mostrar.</p>
                    </x-card>
                @endforelse
            </div>
        </div>
    </div>
</x-layout.layout>
