@props(['is' => 'a'])
<{{$is}} {{$attributes(['class' => 'border border-border rounded-lg bg-card p-4 md:text-sm block hover:bg-card-hover transition-colors duration-300'])}}>
    {{ $slot }}
</{{$is}}>
