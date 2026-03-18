<?php

namespace App;

enum IdeaStatus: string
{
    case PENDIENTE = 'pendiente';
    case EN_PROGRESO = 'en_progreso';
    case COMPLETADA = 'completada';

    public function label(): string
    {
        return match ($this) {
            self::PENDIENTE => 'PENDIENTE',
            self::EN_PROGRESO => 'EN PROGRESO',
            self::COMPLETADA => 'COMPLETADA',
        };
    }
}
