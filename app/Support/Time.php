<?php

namespace App\Support;

use Carbon\CarbonInterval;
use Illuminate\Contracts\Support\Arrayable;

class Time implements Arrayable
{
    use HasNewStaticConstructor;

    protected $minutes;

    protected $interval;

    public function __construct($minutes)
    {
        $this->minutes = $minutes;

        $this->interval = CarbonInterval::minutes($this->minutes)->cascade();
    }

    public function seconds()
    {
        return $this->interval->total('seconds');
    }

    public function hours()
    {
        return $this->interval->total('hours');
    }

    public function formated()
    {
        return sprintf('%sh:%sm', (int) $this->hours(), str_pad($this->interval->minutes, 2, '0'));
    }

    public function toArray()
    {
        return [
            'seconds' => $this->seconds(),
            'formatted' => $this->formated(),
        ];
    }
}
