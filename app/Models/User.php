<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use function Laravel\Prompts\select;

class User extends Authenticatable
{
	use HasFactory, Notifiable, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'first_name',
		'last_name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $appends = ['full_name'];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
			'created_at' => 'datetime:M d, Y H:i:s',
			'updated_at' => 'datetime:M d, Y H:i:s',
		];
	}

	/**
	 * Get the user's full concatenated name.
	 * -- Must postfix the word 'Attribute' to the function name
	 *
	 * @return string
	 */
	public function getFullNameAttribute()
	{
		return "{$this->first_name} {$this->last_name}";
	}

	// relations

	/**
	 * Get last messages for displaying a list
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function lastMessageList(): HasMany
	{
		return $this->hasMany(Message::class, 'sender_id');
	}

	/**
	 * Get all of the sent messages of the User
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function sentMessages(): HasMany
	{
		return $this->hasMany(Message::class, 'sender_id');
	}

	/**
	 * Get all of the received messages from Users
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	 */
	public function receivedMessages(): MorphMany
	{
		return $this->morphMany(Message::class, 'messageable');
	}

	/**
	 * The groups that belong to the User
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function groups(): BelongsToMany
	{
		return $this->belongsToMany(Group::class)->select('id', 'name');
	}

	public function messagesFromUser(): BelongsToMany
	{
		return $this->belongsToMany(Group::class);
	}

	// /**
	//  * the messages sent to the group
	//  *
	//  * @return \Illuminate\Database\Eloquent\Relations\MorphMany
	//  */
	// public function messages(): MorphMany
	// {
	// 	return $this->morphMany(Message::class, 'messageable');
	// }
}
