<?php

namespace App\Rules;

use App\Enums\MessageTypes;
use App\Models\Group;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MorphMessageExist implements ValidationRule
{
	public ?string $type;

	public function __construct(?string $type)
	{
		$this->type = $type;
	}

	/**
	 * Run the validation rule.
	 *
	 * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
	 */
	public function validate(string $attribute, mixed $value, Closure $fail): void
	{
		if (!$value)
			return;

		if (
			($this->type === MessageTypes::CHAT->value && !User::where('id', $value)->exists()) ||
			($this->type === MessageTypes::GROUP->value && !Group::where('id', $value)->exists())
		) {
			$fail(':attribute does not exist.');
		}
	}
}
