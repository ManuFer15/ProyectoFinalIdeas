@props(['status' => 'pendiente'])
@php
    $classes ='inline-block rounded-full border px-2 py-1 text-xs font-medium';

    if($status === 'pendiente'){
        $classes .= ' bg-yellow-500/10 text-yellow-500 border-yellow-500/20';
    } elseif($status === 'completada'){
        $classes .= ' bg-green-500/10 text-green-500 border-green-500/20';
    } elseif($status === 'en_progreso'){
        $classes .= ' bg-red-500/10 text-red-500 border-red-500/20';
    }
@endphp
<span {{$attributes(['class' => $classes])}}>
     {{ $slot}}
</span>

