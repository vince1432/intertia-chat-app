<?php

namespace  App\Enums;

enum MessageTypes: string
{
	case GROUP = "GROUP";
	case CHAT = "CHAT";

	public static function get(string $type): ?string
	{
		$enumCase = constant('self::' . $type);
		return $enumCase->value;
	}
}
