<?php
namespace Tests\PHPUnit;

use App\Employee\Phone;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
	/**
	 * @dataProvider samePhones
	 */
	public function testPhonesEqualTrue(Phone $fistPhone, Phone $secondPhone)
	{
		$this->assertTrue($fistPhone->isEqualTo($secondPhone));
	}

	/**
	 * @dataProvider differentPhones
	 */
	public function testPhonesEqualFalse(Phone $fistPhone, Phone $secondPhone)
	{
		$this->assertFalse($fistPhone->isEqualTo($secondPhone));
	}

	public function samePhones()
	{
		return [
			[new Phone(7, 9110736189), new Phone(7, 9110736189)],
			[new Phone(8, 9520730404), new Phone(8, 9520730404)],
		];
	}

	public function differentPhones()
	{
		return [
			[new Phone(7, 9110736189), new Phone(7, 9110736188)],
			[new Phone(8, 9520730404), new Phone(8, 9520730403)],
		];
	}
}