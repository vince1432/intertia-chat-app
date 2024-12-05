<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function index()
	{
		$per_page = (int)request('per_page') ?? 5;

		$users = User::paginate($per_page)->withQueryString()->toArray();
		$data = $users["data"];
		$pagination = data_forget($users, "data");

		// remove next and previous link
		array_shift($pagination["links"]);
		array_pop($pagination["links"]);

		return inertia('User/Users', [
			"data" => $data,
			"pagination" => $pagination,
		]);
	}
}
