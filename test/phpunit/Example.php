<?php
namespace Gt\TypeSafeGetter\Test;

use Gt\TypeSafeGetter\NullableTypeSafeGetter;

class Example {
	use NullableTypeSafeGetter;

	public function __construct(private array $kvp = []) {}

	public function get(string $name):mixed {
		return $this->kvp[$name] ?? null;
	}
}
