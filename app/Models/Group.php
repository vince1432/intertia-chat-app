<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Group extends Model
{
	use HasFactory;

	protected $appends = ['last_message'];

	/**
	 * The members that belong to the Group
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function users(): BelongsToMany
	{
		return $this->belongsToMany(User::class);
	}

	/**
	 * the messages sent to the group
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function messages(): MorphMany
	{
		return $this->morphMany(Message::class, 'messageable');
	}

	/**
	 * last message received from group
	 *
	 * @return \App\Models\Message | null
	 */
	public function getLastMessageAttribute(): Message | null
	{
		return $this->messages()->select('id', 'message', 'sender_id', 'messageable_type', 'messageable_id', 'created_at')
			->orderByDesc('created_at')->with('sender:id,first_name,last_name')->first();
	}
}
