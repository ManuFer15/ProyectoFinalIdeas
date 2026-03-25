<nav class="border-b border-border px-6">
    <div class="max-w-7x1 mx-auto flex items-center justify-between h-16">
        <div class="font-black flex items-center space-x-4 text-lg text-foreground hover:text-primary transition-colors duration-300">
            <a href="/">Ideas</a>
        </div>
        <div class="flex items-center gap-x-5">
            @auth
                <a href="{{ route('profile.edit') }}" class="btn text-foreground hover:text-primary transition-colors duration-300">Editar perfil</a>
                <form method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="btn text-foreground hover:text-primary transition-colors duration-300">Cerrar Sesión</button>
                </form>
            @else
                <a href="/register" class="btn text-foreground hover:text-primary transition-colors duration-300">Registro</a>
                <a href="/login" class="btn ml-4 text-foreground hover:text-primary transition-colors duration-300">Iniciar Sesión</a>
            @endauth
        </div>
    </div>
</nav>
