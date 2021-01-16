<?php
namespace Gt\TypeSafeGetter;

use DateTimeInterface;

interface TypeSafeGetter {
	public function get(string $name):mixed;
	public function getString(string $name):?string;
	public function getInt(string $name):?int;
	public function getFloat(string $name):?float;
	public function getBool(string $name):?bool;
	public function getDateTime(string $name):DateTimeInterface;
}