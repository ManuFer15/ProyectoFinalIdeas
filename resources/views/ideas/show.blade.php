<x-layout.layout>
    <div class="max-w-4xl mx-auto py-8">
        <div class="flex justify-between">
            <a href="{{route('idea.index')}}" class="flex items-center gap-x-2 text-sm font-medium">
                <x-icons.close />
                Volver
            </a>
            <div class="gap-x-3 flex items-center">
                <button class="btn btn-outlined" data-test="edit-idea-button"
                        x-data
                        @click="$dispatch('open-modal', 'edit-idea')"
                >
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
        <div class="mt-8 space-y-6">
            @if($idea->image_path)
                <div class="rounded-lg overflow-hidden">
                    <img src="{{ Storage::url($idea->image_path) }}" alt="" class="w-full h-auto object-cover">
                </div>

            @endif
            <h1 class="font-bold text-4x1">{{$idea->title}}</h1>
            <div>
                <x-ideas.status-label status="{{ $idea->status }}">
                    {{ $idea->status->label() }}
                </x-ideas.status-label>
                <div class="mt-2 flex items-center gap-x-3">
                    <span class="text-sm text-muted-foreground">{{ $idea->created_at->diffForHumans() }}</span>
                </div>
            </div>
            @if($idea->description)
                <x-card>
                    <div class="text-foreground prose prose-invert max-w-none cursor-pointer">
                        {{ $idea->description }}
                    </div>
                </x-card>
            @endif
            @if(count($idea->steps))
                <div>
                    <h3 class="mt-6">Pasos</h3>
                    <div class="mt-3 space-y-3">
                        @foreach($idea->steps as $step)
                            <x-card>
                               <form method="post" action="{{ route('step.update', $step) }}">
                                    @csrf
                                   @method('PATCH')

                                   <div class="flex items-center gap-x-3">
                                       <button type="submit" role="checkbox"
                                           class="size-5 flex items-center justify-center rounded-lg text-primary-foreground {{$step->completada ? 'bg-primary' : 'border border-primary'}}">&check;</button>
                                       <span class="{{$step->completada ? 'line-through text-muted-foreground' : ''}}">{{$step->description}}</span>
                                   </div>
                               </form>
                            </x-card>
                        @endforeach
                    </div>
                </div>
            @endif

            @if(count($idea->links))
                <div>
                    <h3 class="mt-6">Links</h3>
                    <div class="mt-3 space-y-3">
                        @foreach($idea->links as $link)
                            <x-card :href="$link" class="text-primary font-medium flex gap-x-3 items-center">
                                <x-icons.external />
                                {{$link}}
                            </x-card>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <x-ideas.modal :idea="$idea" />
    </div>
</x-layout.layout>
