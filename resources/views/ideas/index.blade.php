<x-layout.layout>
    <div>
        <header>
            <h1 class="text-3xl font-bold text-center text-foreground">Bienvenido a Ideas</h1>
            <p class="text-center text-foreground mt-4">Comparte tus ideas y descubre las de otros.</p>
            <x-card x-data @click="$dispatch('open-modal', 'create-idea')" is="button" type="button" dusk="create-idea-button"
                    class="mt-10 space-y-3 cursor-pointer h-32 w-full text-left" data-test="create-idea-button">
                <p>¿Cuál es la idea?</p>
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
            <form x-data="{status: 'pendiente', newLink: '', links: []}" action="{{ route('idea.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="space-y-6">
                    <x-form.field name="title" label="Título" autofocus dusk="title-input" placeholder="Título de tu idea" required />
                    <div class="space-y-2">
                        <label for="status" class="label">Estado</label>
                        <div class="flex gap-x-3">
                            @foreach(App\IdeaStatus::cases() as $status)
                                <button type="button" @click="status = @js($status->value)" data-test="button-status-{{ $status->value }}"
                                        class="btn flex-1 h-10" :class="{'btn-outlined': status !== @js($status->value)}"
                                >
                                    {{$status->label()}}
                                </button>
                            @endforeach
                            <input type="hidden" name="status" :value="status" class="input" />
                        </div>
                        <x-form.error name="status" />
                    </div>
                    <x-form.field type="textarea" name="description" label="Descripción" dusk="description-input" placeholder="Describe tu idea con el mayor detalle posible" />
                </div>
                <div>
                    <fieldset class="space-y-3">
                        <legend class="label">Links</legend>
                        <template x-for="(link, index) in links" :key="link">
                            <div class="flex gap-x-2 items-center">
                                <input class="input" name="links[]" x-model="link">
                                <button type="button"
                                        @click="links = links.splice(index, 1)"
                                        class="form-muted-icon"
                                        aria-label="Eliminar link"
                                >
                                    <x-icons.plus />
                                </button>
                            </div>
                        </template>
                        <div class="flex gap-x-2 items-center">
                            <input type="url"
                                      x-model="newLink"
                                   id="new-link"
                                   placeholder="https://example.com"
                                   autocomplete="url"
                                      class="input flex-1"
                                   spellcheck="false"
                            >
                            <button type="button" @click="links.push(newLink.trim()); newLink = '';"
                                    dusk="add-link-button" class="btn" :disabled="!newLink.trim().length === 0"
                                    aria-label="Añadir link"
                            >
                                <x-icons.plus class="rotate-45" />
                            </button>
                        </div>
                    </fieldset>
                </div>

                <div class="flex justify-end gap-x-5">
                    <button type="submit" @click="$dispatch('close-modal')">Cancelar</button>
                    <button type="submit" dusk="button-create-idea" class="btn">Crear</button>
                </div>
            </form>
        </x-modal>
    </div>
</x-layout.layout>
