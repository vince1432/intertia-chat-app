<?php

namespace App\Http\Controllers;

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

	public function store(Request $request): \Illuminate\Http\RedirectResponse
	{
		$validated = $request->validate([
			"first_name" => ['required', 'min:2', 'max:255'],
			"last_name" => ['required', 'min:2', 'max:255'],
			"email" => ['required', 'email:rfc,dns', 'unique:users,email'],
			"password" => ['required', 'confirmed', Password::min(8)],
		]);

		User::create([
			"first_name" => $validated["first_name"],
			"last_name" => $validated["last_name"],
			"email" => $validated["email"],
			"password" => $validated["password"],
		]);

		return to_route('users.index');
	}
}
