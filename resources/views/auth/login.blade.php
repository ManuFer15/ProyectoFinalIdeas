<x-layout.layout>
    <x-form.form title="Inico de sesión" subtitle="Encantados de tenerte de vuelta.">
        <form action="/login" method="POST" class="mt-10 space-y-4">
            @csrf
            <div class="space-y-2">
                <x-form.field type="email" name="email" label="Correo Electrónico" />
                <x-form.field type="password" name="password" label="Contraseña" />
            </div>
            <button type="submit" class="btn mt-2 h-10 w-full">Iniciar sesion</button>
        </form>
    </x-form.form>
</x-layout.layout>
