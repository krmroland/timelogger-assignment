<?php

namespace App\Models;

use App\Support\Time;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    use HasFactory;

    protected $appends = ['time'];

    protected $casts = [
        'date' => 'date',
        'categories' => 'array',
    ];

    public function time(): Attribute
    {
        return Attribute::get(fn() => Time::new($this->time_in_minutes));
    }

    public static function csvHeaders(): array
    {
        return ['Date', 'Categories', 'Description', 'Time In Seconds', 'Time'];
    }

    public function toCsvEntry()
    {
        return [
            $this->date->format('Y-m-d'),
            implode(',', $this->categories),
            $this->description,
            $this->time->seconds(),
            $this->time->formated(),
        ];
    }
}
