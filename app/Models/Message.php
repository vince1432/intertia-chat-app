<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Message extends Model
{
    use HasFactory;

    /**
     * message that sent to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function user(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'messagable');
    }

    /**
     * message that sent to a group
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function group(): MorphToMany
    {
        return $this->morphedByMany(Group::class, 'messagable');
    }
}
