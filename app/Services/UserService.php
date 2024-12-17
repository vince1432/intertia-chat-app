<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
	public function __construct()
	{
		return $this;
	}

	public function List(): array
	{
		$per_page = request('per_page') ?? 10;
		$search = request('search') ?? NULL;

		$users =  User::select('id', 'first_name', 'last_name', 'email', 'created_at');

		if ($search) {
			$users->where(function ($query) use ($search) {
				$query->where('id', 'like', "%{$search}%")
					->orWhere('first_name', 'like', "%{$search}%")
					->orWhere('last_name', 'like', "%{$search}%")
					->orWhere('email', 'like', "%{$search}%");
			});
		}

		$users = $users->paginate($per_page)
			->withQueryString()
			->toArray();

		$data = $users["data"];
		$pagination = data_forget($users, "data");

		// remove next and previous link
		array_shift($pagination["links"]);
		array_pop($pagination["links"]);

		return [
			"data" => $data,
			"pagination" => $pagination,
		];
	}

	public function GetById(int $userId): User
	{
		return User::select('id', 'first_name', 'last_name')->where('id', $userId)->first();
	}

	public function GetUserGroups(int $userId): Collection
	{
		$user = User::select('id')->where('id', $userId)->first();
		return $user->groups;
	}

	public function GroupsWithRecentMessage(int $userId): Collection
	{
		// TODO - Optimize
		$user_messages = User::select('id', 'first_name', 'last_name')
			->with([
				'receivedMessages' => function ($q) {
					$q->select('id', 'message', 'sender_id', 'messageable_type', 'messageable_id', 'created_at')
						->with('sender:id,first_name,last_name')
						->orderByDesc('messages.created_at');
				},
				'sentMessages' => function ($q) {
					$q->select('id', 'message', 'sender_id', 'messageable_type', 'messageable_id', 'created_at')
						->with('messageable:id,first_name,last_name')
						->where('messageable_type', User::class)
						->orderByDesc('messages.created_at');
				},
			])
			->where('id', $userId)
			->first();

		$user_messages->receivedMessages->each(function (object $item) {
			$item->chat_id = $item->sender->id;
			$item->chat_title = "{$item->sender->first_name} {$item->sender->last_name}";
			unset($item->sender);
		});


		$user_messages->sentMessages->each(function (object $item) {
			$item->chat_id = $item->messageable->id;
			$item->chat_title = "{$item->messageable->first_name} {$item->messageable->last_name}";
			unset($item->messageable);
		});

		$user_messages = $user_messages->receivedMessages->merge($user_messages->sentMessages)->sortByDesc('created_at')->unique('chat_id')->values();

		return $user_messages;
	}

	public function Create(array $validated): User
	{
		return User::create([
			"first_name" => $validated["first_name"],
			"last_name" => $validated["last_name"],
			"email" => $validated["email"],
			"password" => $validated["password"],
		]);
	}
}
