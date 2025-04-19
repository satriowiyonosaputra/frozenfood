<?php

// app/Helpers/Number.php

namespace App\Helpers;

class Number
{
    public static function currency($amount, $decimals = 0)
    {
        return 'Rp ' . number_format($amount, $decimals, ',', '.');
    }
}
