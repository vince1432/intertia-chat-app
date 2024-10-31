<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Message;
use App\Models\User;

class MessageService
{
	public function __construct()
	{
		return $this;
	}

	public function GroupByUserWithRecentMessage() {}
	public function GroupsWithRecentMessage() {}

	public function GroupMessages(int $group_id): array
	{
		$messages = [];
		$header_id = NULL;
		$header_name = NULL;

		$group = Group::select('id', 'name')
			->with(['messages' => function ($query) {
				$query->select('id', 'message', 'messageable_id', 'messageable_type', 'sender_id', 'created_at')
					->with('sender:id,first_name,last_name')
					->get();
			}])
			->where('id', $group_id)
			->first();

		if ($group) {
			$messages = $group->messages;
			$header_id =  $group->id;
			$header_name = $group->name;
		}

		return [
			"messages" => $messages,
			"header" => [
				"id" => $header_id,
				"name" => $header_name,
			],
		];
	}

	public function ChatMessages(int $viewer_id, int $user_id): array
	{
		$messages = [];
		$header_id = NULL;
		$header_name = NULL;

		$messages = Message::select('id', 'message', 'sender_id', 'messageable_type', 'messageable_id', 'created_at')
			->with('sender')
			->where(function ($q) use ($user_id, $viewer_id) {
				$q->where('messageable_id', $user_id)
					->orWhere('messageable_id', $viewer_id);
			})
			->where(function ($q) use ($user_id, $viewer_id) {
				$q->where('sender_id', $user_id)
					->orWhere('sender_id', $viewer_id);
			})
			->isChatMessage()
			->get();

		$user = User::select('id', 'first_name', 'last_name')
			->where('id', $user_id)->first();

		if ($user && $messages->count()) {
			$messages = $messages;
			$header_id =  $user->id;
			$header_name = $user->full_name;
		}

		return [
			"messages" => $messages,
			"header" => [
				"id" => $header_id,
				"name" => $header_name,
			],
		];
	}
}
