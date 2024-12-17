<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
	private UserService $userService;

	public function __construct(UserService $userService)
	{
		$this->userService = $userService;
	}

	public function index(): \Inertia\ResponseFactory|\Inertia\Response
	{
		$users = $this->userService->List();

		return inertia('User/Users', $users);
	}

	public function create(): \Inertia\ResponseFactory|\Inertia\Response
	{
		return inertia('User/Create');
	}

	public function store(StoreUserRequest $request): \Illuminate\Http\RedirectResponse
	{
		$validated = $request->validated();
		$this->userService->Create($validated);

		return to_route('users.index');
	}
}
