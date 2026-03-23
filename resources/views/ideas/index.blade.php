<x-layout.layout>
    <div>
        <header>
            <h1 class="text-3xl font-bold text-center text-foreground">Bienvenido a Ideas</h1>
            <p class="text-center text-foreground mt-4">Comparte tus ideas y descubre las de otros.</p>
            <x-card x-data @click="$dispatch('open-modal', 'create-idea')" is="button" type="button"
                    class="mt-10 space-y-3 cursor-pointer h-32 w-full text-left">
                <p>que es una idea</p>
            </x-card>
        </header>
        <div>
            <a href="/ideas" class="btn {{request()->has('status') ? 'btn-outlined' : ''}}">Todas</a>
            @foreach(App\IdeaStatus::cases() as $status)
                <a href="/ideas?status={{ $status->value }}" class="btn {{request('status') === $status->value ? '' : 'btn-outlined'}}">
                    {{ $status->label() }}<span class="text-xs pl-3">{{$statusCounts->get($status->value)}}</span></a>
            @endforeach
        </div>
        <div clasS="mt-10 text-muted-foreground">
            <div class="grid md:grid-cols-2 gap-6">
                @forelse( $ideas as $idea)
                    <x-card href="/ideas/{{ $idea->id }}">
                        <h3 class="text-xl font-semibold text-foreground">{{ $idea->title }}</h3>
                        <div class="mt-1">
                            <x-ideas.status-label status="{{ $idea->status }}">
                                {{ $idea->status->label() }}
                            </x-ideas.status-label>
                        </div>
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
    <x-modal name="create-idea" title="Crear Nueva Idea">
        <form action="{{ route('idea.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="space-y-6">
                <x-form.field name="title" label="Título" autofocus placeholder="Título de tu idea" required />
                <x-form.field name="description" label="Descripción" placeholder="Describe tu idea con el mayor detalle posible" required />
            </div>

        </form>
    </x-modal>
    </div>
</x-layout.layout>
