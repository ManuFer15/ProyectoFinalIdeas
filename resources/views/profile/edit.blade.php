<x-layout.layout>
    <x-form.form title="Editar tu cuenta" subtitle="Actualiza tu información personal.">
        <form action="/profile" method="POST" class="mt-10 space-y-4">
            @csrf
            @method('PATCH')
            <div class="space-y-2">
                <x-form.field type="text" name="name" label="Nombre" :value="$user->name" />
                <x-form.field type="email" name="email" label="Correo Electrónico" :value="$user->email" />
                <x-form.field type="password" name="password" label="Nueva Contraseña" />
            </div>
            <button type="submit" class="btn mt-2 h-10 w-full">Actualizar cuenta</button>
        </form>
    </x-form.form>
</x-layout.layout>

