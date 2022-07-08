<?php
namespace Gt\TypeSafeGetter;

use DateTimeInterface;

interface CallbackTypeSafeGetter {
	public function get(string $name, ?callable $callback = null):mixed;
	public function getString(string $name, ?callable $callback = null):?string;
	public function getInt(string $name, ?callable $callback = null):?int;
	public function getFloat(string $name, ?callable $callback = null):?float;
	public function getBool(string $name, ?callable $callback = null):?bool;
	public function getDateTime(string $name, ?callable $callback = null):?DateTimeInterface;
}
