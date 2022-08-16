<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    /**
     * @var array<int,string>
     */
    protected $fillable = [
        'path',
        'type',
    ];

    /**
     * @return Attribute
     */
    public function path(): Attribute
    {
        return new Attribute(
            get: fn($value) => \Storage::disk("public")->url($value),
        );
    }
}
