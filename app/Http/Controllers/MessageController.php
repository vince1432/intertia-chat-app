<?php

namespace App\Http\Controllers;

use App\Enums\MessageTypes;
use App\Http\Requests\MessagesRequest;
use App\Http\Requests\SendMessageRequest;
use App\Services\MessageService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class MessageController extends Controller
{
	private MessageService $messageService;
	private UserService $userService;

	public function __construct(MessageService $messageService, UserService $userService)
	{
		$this->messageService = $messageService;
		$this->userService = $userService;
	}

	/**
	 * Chat data for side nav
	 *
	 * @return \Inertia\ResponseFactory|\Inertia\Response
	 */
	public function chats(): Response
	{
		// TODO - add auth, optimize
		$user_id = 1;
		// user messages
		$user_messages = $this->userService->GroupsWithRecentMessage($user_id);
		// group messages
		$user_groups = $this->userService->GetUserGroups($user_id);

		return inertia('Home', [
			"data" => [
				"user_messages" => $user_messages,
				"groups" => $user_groups,
			]
		]);
	}

	public function messages(MessagesRequest $request): Response
	{
		$validated = $request->validated();

		// TODO - add auth
		$user_id = 1;
		if ($validated['type'] === MessageTypes::CHAT->value) {
			$messages = $this->messageService->ChatMessages($user_id, $validated['id']);
		} else if ($validated['type'] === MessageTypes::GROUP->value) {
			$messages = $this->messageService->GroupMessages($validated['id']);
		}

		return inertia('Home', [
			"data" => [
				"header" => $messages["header"],
				"messages" => $messages["messages"],
			]
		]);
	}

	public function sendMessage(SendMessageRequest $validated)
	{
		$message = $this->messageService->send($validated["send_to"], $validated["type"], $validated["message"]);
		// add extra data
		$message->load('sender');
		$message->sender->append('full_name');

		return inertia("Home", [
			"data" => ["message" => $message]
		]);
		// return to_route("messages", [
		// 	"data" => ["message" => $message]
		// ]);
	}
}
