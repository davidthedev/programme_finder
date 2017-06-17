<?php

namespace App\Services;

use App\Contracts\ProtectorInterface;

class Protector implements ProtectorInterface
{
    /**
     * Convert special characters to HTML entities
     *
     * @param  string $string
     * @param         $flag
     * @param  string $encoding
     * @return string
     */
    public function escape($string, $flag = ENT_COMPAT, $encoding = 'UTF-8')
    {
        return htmlspecialchars($string, $flag, $encoding);
    }
}
