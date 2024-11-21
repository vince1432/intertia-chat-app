<?php

namespace App\Services;

use App\Enums\MessageTypes;
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
		$headerId = NULL;
		$headerName = NULL;

		$group = Group::select('id', 'name')
			->with(['messages' => function ($query) {
				$query->select('id', 'message', 'messageable_id', 'messageable_type', 'sender_id', 'created_at')
					->with('sender:id,first_name,last_name')
					->orderBy('created_at')
					->get();
			}])
			->where('id', $group_id)
			->first();

		if ($group) {
			$messages = $group->messages;
			$headerId =  $group->id;
			$headerName = $group->name;
		}

		return [
			"messages" => $messages,
			"header" => [
				"id" => $headerId,
				"name" => $headerName,
				"type" => "GROUP",
			],
		];
	}

	public function ChatMessages(int $viewerId, int $userId): array
	{
		$messages = [];
		$headerId = NULL;
		$headerName = NULL;

		$messages = Message::select('id', 'message', 'sender_id', 'messageable_type', 'messageable_id', 'created_at')
			->with('sender')
			->where(function ($q) use ($userId, $viewerId) {
				$q->where('messageable_id', $userId)
					->orWhere('messageable_id', $viewerId);
			})
			->where(function ($q) use ($userId, $viewerId) {
				$q->where('sender_id', $userId)
					->orWhere('sender_id', $viewerId);
			})
			->isChatMessage()
			->orderBy('created_at')
			->get();

		$user = User::select('id', 'first_name', 'last_name')
			->where('id', $userId)->first();

		if ($user && $messages->count()) {
			$messages = $messages;
			$headerId =  $user->id;
			$headerName = $user->full_name;
		}

		return [
			"messages" => $messages,
			"header" => [
				"id" => $headerId,
				"name" => $headerName,
				"type" => "CHAT",
			],
		];
	}

	public function send(int $sendTo, string $type, string $message): Message
	{
		// try {

		// TODO - add authentication
		$currentUser = 1;
		$result = 0;
		$message_type = MessageTypes::tryFrom($type);

		if (!$message_type) {
			throw new \InvalidArgumentException("Invalid message type: $type");
		}

		if ($message_type === MessageTypes::CHAT) {
			$user = User::findOrFail($sendTo);

			$result = $user->receivedMessages()->create([
				'sender_id' => $currentUser,
				'message' => $message
			]);
		} else if ($message_type === MessageTypes::GROUP) {
			$group = Group::findOrFail($sendTo);
			$result = $group->messages()->create([
				'sender_id' => $currentUser,
				'message' => $message
			]);
		}

		return $result;
	}
}
