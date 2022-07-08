<?php
namespace Gt\TypeSafeGetter\Test;

use Gt\TypeSafeGetter\TypeSafeGetter;
use Gt\TypeSafeGetter\NullableTypeSafeGetter;

class TestGetter implements TypeSafeGetter {
	use NullableTypeSafeGetter;

	public function __construct(private array $kvp = []) {}

	public function get(string $name):mixed {
		return $this->kvp[$name] ?? null;
	}
}
