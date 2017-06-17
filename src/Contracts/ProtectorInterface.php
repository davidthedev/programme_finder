<?php

namespace App\Contracts;

interface ProtectorInterface
{
    public function escape($string, $flag, $encoding);
}
