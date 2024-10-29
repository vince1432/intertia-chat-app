<?php

namespace App\Http\Controllers;

use App\Enums\MessageTypes;
use App\Models\Group;
use App\Models\Message;
use App\Models\User;
use Illuminate\Validation\Rule;
use Inertia\Response;

class MessageController extends Controller
{
	/**
	 * Chat data for side nav
	 *
	 * @return \Inertia\ResponseFactory|\Inertia\Response
	 */
	public function chats(): Response
	{
		// user messages
		// TODO - add auth, optimize
		$user_id = 1;
		$user_messages = [];

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

	/**
	 * Chat data for side nav
	 *
	 * @return \Inertia\ResponseFactory|\Inertia\Response
	 */
	public function messages(): Response
	{
		$validated = request()->validate([
			'id' => 'required|integer',
			'type' => ['required', 'string', Rule::enum(MessageTypes::class)],
		]);

		// TODO - add auth
		$user_id = 1;
		$messages = [];
		$chat_header = [];
		if ($validated['type'] === MessageTypes::CHAT->value) {
			$messages = Message::select('id', 'message', 'sender_id', 'messageable_type', 'messageable_id', 'created_at')
				// ->with('sender:id,first_name,last_name')
				->with(['sender' => function ($query) {
					$query->select('id', 'first_name', 'last_name');
				}])
				->where(function ($query) use ($user_id, $validated) {
					$query->where('sender_id', $user_id)->orWhere('sender_id', $validated['id']);
				})
				->where(function ($query) use ($user_id, $validated) {
					$query->where('messageable_id', $user_id)->orWhere('messageable_id', $validated['id']);
				})
				->where('messageable_type', User::class)
				->get();

			$user = User::select('id', 'first_name', 'last_name')->where('id', $validated['id'])->first();
			$chat_header = [
				"id" => $user->id,
				"name" => $user->full_name,
			];
		} else if ($validated['type'] === MessageTypes::GROUP->value) {
			$group = Group::select('id', 'name')
				->with(['messages' => function ($query) {
					$query->select('id', 'message', 'messageable_id', 'messageable_type', 'sender_id', 'created_at')
						->with('sender:id,first_name,last_name')
						->get();
				}])
				->where('id', $validated['id'])
				->first();
			$messages = $group->messages;
			$chat_header = [
				"id" => $group->id,
				"name" => $group->name,
			];
		}

		return inertia('Home', [
			"data" => [
				"header" => $chat_header,
				"messages" => $messages,
			]
		]);
	}
}
