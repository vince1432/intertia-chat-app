<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
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
		$this->userService->Store($validated);

		return to_route('users.index');
	}

	public function edit(User $user): \Inertia\ResponseFactory|\Inertia\Response
	{
		return inertia('User/Edit', ["data" => ["user" =>  $user]]);
	}

	public function update(UpdateUserRequest $request, User $user): \Illuminate\Http\RedirectResponse
	{
		$validated = $request->validated();

		$this->userService->Update($user, $validated);

		return to_route('users.index');
	}

	public function destroy(User $user): \Illuminate\Http\RedirectResponse
	{
		$this->userService->Delete($user);
		return to_route('users.index');
	}
}
