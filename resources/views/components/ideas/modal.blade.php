@props(['idea' => new App\Models\Idea()])

<x-modal name="{{ $idea->exists ? 'edit-idea' : 'create-idea' }}" title="{{ $idea->exists ? 'Editar Idea' : 'Crear Idea' }}" :max-width="'2xl'">
    <form x-data="{status: @js(old('status', $idea->status->value)),
            newLink: '', links: @js(old('links', $idea->links ?? [])),
            newStep: '', steps: @js(old('steps', $idea->steps)->map(fn($step) => $step->description))}"
          action="{{ $idea->exists ? route('idea.update', $idea) : route('idea.store') }}" method="POST" class="space-y-6"
          enctype="multipart/form-data"
    >
        @csrf
        @if($idea->exists)
            @method('PATCH')
        @endif
        <div class="space-y-6">
            <x-form.field name="title" label="Título" autofocus placeholder="Título de tu idea" required :value="$idea->title" />
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
            <x-form.field type="textarea" name="description" label="Descripción" dusk="description-input" placeholder="Describe tu idea ..." :value="$idea->description" />
        </div>
        <div class="space-y-2">
            <label for="image" class="label">Imagen</label>
            @if($idea->image_path)
                <div class="space-y-2">
                    <img src="{{ Storage::url($idea->image_path) }}" alt="" class="w-full h-48 rounded-lg object-cover">
                    <button class="btn btn-outlined h-10" form="delete-image-form">Eliminar imagen</button>
                </div>

            @endif
            <input type="file" name="image" >
            <x-form.error name="image" />
        </div>
        <div>
            <fieldset class="space-y-3">
                <legend class="label">Pasos</legend>
                <template x-for="(step, index) in steps" :key="step">
                    <div class="flex gap-x-2 items-center">
                        <input class="input" name="steps[]" x-model="step" readonly>
                        <button type="button"
                                @click="steps.splice(index, 1)"
                                class="form-muted-icon"
                                aria-label="Eliminar paso"
                        >
                            <x-icons.plus />
                        </button>
                    </div>
                </template>
                <div class="flex gap-x-2 items-center">
                    <input x-model="newStep"
                           id="new-step"
                           type="text"
                           placeholder="Describe el paso"
                           class="input flex-1"
                           spellcheck="false"
                    >
                </div>
                <button type="button" @click="steps.push(newStep.trim()); newStep = '';"
                        dusk="add-step-button" class="btn" :disabled="!newStep.trim().length === 0"
                        aria-label="Añadir paso"
                >
                    <x-icons.plus />
                </button>
            </fieldset>
        </div>
        <div>
            <fieldset class="space-y-3">
                <legend class="label">Links</legend>
                <template x-for="(link, index) in links" :key="link">
                    <div class="flex gap-x-2 items-center">
                        <input class="input" name="links[]" x-model="link">
                        <button type="button"
                                @click="links.splice(index, 1)"
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
            <button type="submit" dusk="button-create-idea" class="btn">{{ $idea->exists ? 'Actualizar' : 'Crear' }}</button>
        </div>
    </form>
    @if($idea->image_path)
        <form id="delete-image-form" method="POST" action="{{ route('idea.image.destroy', $idea) }}">
            @csrf
            @method('DELETE')
        </form>
    @endif
</x-modal>
