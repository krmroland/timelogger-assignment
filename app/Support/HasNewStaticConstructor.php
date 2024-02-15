<?php

namespace App\Support;

trait HasNewStaticConstructor
{
    public static function new(...$args)
    {
        return new static(...$args);
    }
}
