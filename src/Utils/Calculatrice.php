<?php

namespace App\Utils;

class Calculatrice
{
    public function add($a, $b)
    {
        return $a + $b;
    }

    public function sub($a, $b)
    {
        return $a - $b;
    }

    public function mul($a, $b)
    {
        return $a * $b;
    }

    public function div($a, $b)
    {
        return $a / $b;
    }

    public function mod($a, $b)
    {
        return $a % $b;
    }

    public function pow($a, $b)
    {
        return $a ** $b;
    }

    public function sqrt($a)
    {
        return sqrt($a);
    }
}