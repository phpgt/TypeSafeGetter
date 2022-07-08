<?php
namespace Gt\TypeSafeGetter\Test;

use DateTime;
use PHPUnit\Framework\TestCase;

class TypeSafeGetterTest extends TestCase {
	public function testGetString():void {
		$value = uniqid();
		$sut = new TestGetter([
			"test" => $value,
		]);
		self::assertSame($value, $sut->getString("test"));
	}

	public function testGetString_null():void {
		$sut = new TestGetter();
		self::assertNull($sut->getString("test"));
	}

	public function testGetString_castFromInt():void {
		$sut = new TestGetter([
			"test" => 123,
		]);
		self::assertSame("123", $sut->getString("test"));
	}

	public function testGetInt():void {
		$value = rand(1, 999);
		$sut = new TestGetter([
			"test" => $value,
		]);
		self::assertSame($value, $sut->getInt("test"));
	}

	public function testGetInt_null():void {
		$sut = new TestGetter();
		self::assertNull($sut->getInt("test"));
	}

	public function testGetInt_castFromFloat():void {
		$value = 123.456;
		$sut = new TestGetter([
			"test" => $value,
		]);
		self::assertSame(123, $sut->getInt("test"));
	}

	public function testGetFloat():void {
		$value = 123.456;
		$sut = new TestGetter([
			"test" => $value,
		]);
		self::assertSame($value, $sut->getFloat("test"));
	}

	public function testGetFloat_null():void {
		$sut = new TestGetter();
		self::assertNull($sut->getFloat("test"));
	}

	public function testGetBool():void {
		$sut = new TestGetter([
			"test" => true,
		]);
		self::assertTrue($sut->getBool("test"));
	}

	public function testGetBool_null():void {
		$sut = new TestGetter();
		self::assertNull($sut->getBool("test"));
	}

	public function testGetBool_castFromString():void {
		$sut = new TestGetter([
			"yes" => "truthy",
			"no" => "",
		]);
		self::assertTrue($sut->getBool("yes"));
		self::assertFalse($sut->getBool("no"));
	}

	public function testGetDateTime():void {
		$value = new DateTime();
		$sut = new TestGetter([
			"test" => $value,
		]);
		self::assertSame($value, $sut->getDateTime("test"));
	}

	public function testGetDateTime_null():void {
		$sut = new TestGetter();
		self::assertNull($sut->getDateTime("test"));
	}

	public function testGetDateTime_castFromString():void {
		$dateString = "1988-04-05";
		$sut = new TestGetter([
			"test" => $dateString,
		]);
		$dateTime = $sut->getDateTime("test");
		self::assertSame($dateString, $dateTime->format("Y-m-d"));
	}

	public function testGetDateTime_castFromInt():void {
		$dateString = "1900-04-05";
		$timestamp = strtotime($dateString);
		$sut = new TestGetter([
			"test" => $timestamp,
		]);
		$dateTime = $sut->getDateTime("test");
		self::assertSame($dateString, $dateTime->format("Y-m-d"));
	}
}
