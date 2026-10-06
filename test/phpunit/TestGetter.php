<?php
namespace GT\TypeSafeGetter\Test;

use GT\TypeSafeGetter\TypeSafeGetter;
use GT\TypeSafeGetter\NullableTypeSafeGetter;

class TestGetter implements TypeSafeGetter {
	use NullableTypeSafeGetter;

	/** @param array<string, mixed> $kvp */
	public function __construct(private array $kvp = []) {}

	public function get(string $name):mixed {
		return $this->kvp[$name] ?? null;
	}
}
