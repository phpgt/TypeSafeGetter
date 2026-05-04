An interface for objects that expose type-safe getter methods.
==============================================================

Throughout PHP.GT repositories, wherever an object represents enclosed data, a consistent interface is used to expose the data in a type-safe manner.

***

<a href="https://github.com/PhpGt/TypeSafeGetter/actions" target="_blank">
	<img src="https://badge.status.php.gt/typesafegetter-build.svg" alt="Build status" />
</a>
<a href="https://app.codacy.com/gh/PhpGt/TypeSafeGetter" target="_blank">
	<img src="https://badge.status.php.gt/typesafegetter-quality.svg" alt="Code quality" />
</a>
<a href="https://app.codecov.io/gh/PhpGt/TypeSafeGetter" target="_blank">
    <img src="https://badge.status.php.gt/typesafegetter-coverage.svg" alt="Code coverage" />
</a>
<a href="https://packagist.org/packages/PhpGt/TypeSafeGetter" target="_blank">
	<img src="https://badge.status.php.gt/typesafegetter-version.svg" alt="Current version" />
</a>
<a href="https://www.php.gt/typesafegetter" target="_blank">
	<img src="https://badge.status.php.gt/typesafegetter-docs.svg" alt="PHP.GT/TypeSafeGetter documentation" />
</a>

This package defines:

+ `GT\TypeSafeGetter\TypeSafeGetter`
+ `GT\TypeSafeGetter\NullableTypeSafeGetter`
+ `GT\TypeSafeGetter\CallbackTypeSafeGetter`

The usual pattern is to implement `get()` yourself and use the `NullableTypeSafeGetter` trait for the common typed methods.

```php
use DateTimeImmutable;
use DateTimeInterface;
use GT\TypeSafeGetter\NullableTypeSafeGetter;
use GT\TypeSafeGetter\TypeSafeGetter;

class DataStore implements TypeSafeGetter {
	use NullableTypeSafeGetter;

	public function __construct(
		private readonly array $data = [],
	) {}

	public function get(string $name):mixed {
		return $this->data[$name] ?? null;
	}
}

$store = new DataStore([
	"id" => "42",
	"active" => 1,
	"created" => "2024-05-01 09:15:00",
]);

echo $store->getInt("id");
var_dump($store->getBool("active"));
echo $store->getDateTime("created")?->format("Y-m-d");
```

`getInstance()` returns an existing object after checking its type:

```php
$store = new DataStore([
	"date" => new DateTimeImmutable("2024-05-01"),
]);

$date = $store->getInstance("date", DateTimeInterface::class);
```

`getDateTime()` accepts:

+ `DateTimeInterface` instances
+ Unix timestamps
+ date/time strings supported by `DateTimeImmutable`

The following methods are defined by this interface:

+ `get(string $name):mixed` - A non-type-safe getter, used for getting keys that are not of an inbuilt type
+ `getString(string $name):?string`
+ `getInt(string $name):?int`
+ `getFloat(string $name):?float`
+ `getBool(string $name):?bool`
+ `getDateTime(string $name):?DateTimeInterface`
+ `getInstance(string $name, class-string<T> $className):?T`

Common areas you will see this interface used:

+ Database rows
+ User input (from the query string or posted form data)
+ Session and cookie storage
+ HTTP header collections
+ Configuration objects
+ PHP.GT's [DataObject](https://www.php.gt/dataobject) repository.

`NullableTypeSafeGetter` trait
------------------------------

A lot of repositories within PHP.GT that utilise this class were repeating the same getter code, so this trait was introduced to remove the repetition. All getter functions of the interface are implemented, introducing a protected helper function `getNullableType` which removes the repetition of checking null values before casting them. The `getNullableType` function also allows a callback to be passed as the type parameter, allowing more complex nullable types to be constructed.

`CallbackTypeSafeGetter` interface
----------------------------------

This interface is for callback-driven lookups where a value may need to be fetched or computed as part of the read operation, such as cache APIs.

Unlike `NullableTypeSafeGetter`, there is no trait implementation in this package for the callback interface. Implementing classes define their own callback behaviour.

# Proudly sponsored by

[JetBrains Open Source sponsorship program](https://www.jetbrains.com/community/opensource/)

[![JetBrains logo.](https://resources.jetbrains.com/storage/products/company/brand/logos/jetbrains.svg)](https://www.jetbrains.com/community/opensource/)
