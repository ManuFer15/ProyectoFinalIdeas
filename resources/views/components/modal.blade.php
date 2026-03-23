@props(['name', 'title'])
<div x-data="{show: false, name: @js($name)}"
     x-show="show"
     @open-modal.window="if($event.detail === name) show = true"
     @close-modal="show = false"
     @keydown.escape.window="show = false"
     x-transition:enter="ease-out duration-200"
     x-transition:enter-start="opacity-0 -translate-y-4 -translate-x-4"
     x-transition:enter-end="opacity-100"
     x-transition:leave="ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0 -translate-y-4 -translate-x-4"
     class="fixed inset-0 x-50 flex items-center justify-center bg-black/50 backrop-blur-xs"
     style="display: none"
     aria-modal="true"
     aria-labelledby="modal-{{$name}}-title"
     :aria-hidden="!show"
     tabindex="-1"
     role="dialog">
    <x-card @click.away="show = false" class="shadow-xl max-w-2xl w-full max-h-[80dvh] overflow-auto">
        <div class="flex justify-between items-center mb-6">
            <button @click="show = false" aria-label="cerrar modal">
                <x-icons.close />
            </button>
            <h2 id="modal-{{$name}}-title" class="text-x1 font-bold">{{$title}}</h2>
        </div>
        <div class="mt-4">
            {{ $slot }}
        </div>
    </x-card>
</div>
