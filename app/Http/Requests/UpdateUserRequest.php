<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			"first_name" => ['required', 'min:2', 'max:255'],
			"last_name" => ['required', 'min:2', 'max:255'],
			"email" => ['required', 'email:rfc,dns', 'unique:users,email,' . $this->route('user')->id],
			"password" => ['nullable', 'confirmed', Password::min(8)],
		];
	}
}
