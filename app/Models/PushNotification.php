<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PushNotification extends Model
{
    use HasFactory;

    /**
     * @var array<int,string>
     */
    protected $fillable = [
        "title",
        "body",
    ];

    /**
     * @return MorphTo
     */
    public function push_notifiable(): MorphTo
    {
        return $this->morphTo();
    }
}
