<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class DateService
{
    /**
     * Converte uma data de entrada para o formato YYYY-MM-DD (MySQL).
     *
     * @param string|null $date
     * @return string|null
     */
    public static function formatToDatabase(?string $date): ?string
    {
        return $date ? Carbon::parse($date)->format('Y-m-d') : null;
    }
}
