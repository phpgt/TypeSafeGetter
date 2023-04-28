<?php
namespace Gt\TypeSafeGetter;

use DateTimeInterface;

interface CallbackTypeSafeGetter {
	public function get(string $name, callable $callback):mixed;
	public function getString(string $name, callable $callback):?string;
	public function getInt(string $name, callable $callback):?int;
	public function getFloat(string $name, callable $callback):?float;
	public function getBool(string $name, callable $callback):?bool;
	public function getDateTime(
		string $name,
		callable $callback
	):?DateTimeInterface;

	/**
	 * @template T of object
	 * @param string $name
	 * @param class-string<T> $className
	 * @param callable():<T> $callback
	 * @return T
	 */
	public function getInstance(string $name, string $className, callable $callback);
}
