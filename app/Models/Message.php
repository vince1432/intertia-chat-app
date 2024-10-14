<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    use HasFactory;

    /**
     * owner of the message
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function messageable(): MorphTo
    {
        return $this->morphTo();
    }
}
