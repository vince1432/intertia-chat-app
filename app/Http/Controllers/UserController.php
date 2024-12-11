<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	public function index()
	{
		$per_page = (int)request('per_page') ?? 5;
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
		// dd($pagination);
		return inertia('User/Users', [
			"data" => $data,
			"pagination" => $pagination,
		]);
	}
}
