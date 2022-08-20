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
        "banner",
        "icon",
        "action",
        "hide_notification_if_site_has_focus",
    ];

    /**
     * @var array<string,string>
     */
    protected $casts = [
        "hide_notification_if_site_has_focus" => "boolean",
    ];

    /**
     * @return MorphTo
     */
    public function push_notifiable(): MorphTo
    {
        return $this->morphTo();
    }
}
