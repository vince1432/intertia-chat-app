<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
	public function chats()
	{
		// user messages
		$user_id = 1;
		$user_messages = [];
		$group_messages = [];

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
			->where('id', $user_id)
			->first();

		$user_messages->receivedMessages->each(function (object $item, int $key) use ($user_messages) {
			$item->chat_id = $item->sender->id;
			$item->chat_title = "{$item->sender->first_name} {$item->sender->last_name}";
			unset($item->sender);
		});

		$user_messages->sentMessages->each(function (object $item, int $key) use ($user_messages) {
			$item->chat_id = $item->messageable->id;
			$item->chat_title = "{$item->messageable->first_name} {$item->messageable->last_name}";
			unset($item->messageable);
		});

		$user_messages = $user_messages->receivedMessages->merge($user_messages->sentMessages)->sortByDesc('created_at')->unique('chat_id')->values();
		// dd($user_messages->receivedMessages->toArray(), $user_messages->sentMessages->toArray(), $user_messages1->toArray());

		// group messages
		$user = User::select('id')
			->with(
				'groups:id,name'
			)
			->where('id', $user_id)->first();

		return inertia('Home', [
			"data" => [
				"user_messages" => $user_messages,
				"groups" => $user->groups,
			]
		]);
	}
}
