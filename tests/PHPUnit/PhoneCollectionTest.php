<?php
namespace Tests\PHPUnit;

use App\Employee\Phone;
use App\Employee\PhoneCollection;
use PHPUnit\Framework\TestCase;

class PhoneCollectionTest extends TestCase
{
	private $collection;

	public function setUp(): void
	{
		$phones = array_map(function ($value)
		{
			return $value[0];
		}, $this->getListPhones());

		$this->collection = new PhoneCollection($phones);
	}

	public function testAddPhoneCorrect()
	{
		$phone = new Phone(7, 9110736189);

		$this->collection->add($phone);

		$this->assertContains($phone, $this->collection->getAll());
	}

	/**
	 * @dataProvider getListPhones
	 */
	public function testRemovePhoneCorrect(Phone $phone)
	{
		$this->collection->remove($phone);

		$this->assertNotContains($phone, $this->collection->getAll());
	}

	/**
	 * @dataProvider getListPhones
	 */
	public function testAddPhoneException(Phone $phone)
	{
		$this->expectException(\Exception::class);

		$this->collection->add($phone);
	}

	/**
	 * @dataProvider getUnknownPhones
	 */
	public function testRemovePhoneException(Phone $phone)
	{
		$this->expectException(\Exception::class);

		$this->collection->remove($phone);
	}

	public function getListPhones()
	{
		return [
			[new Phone(7, 9696830846)],
			[new Phone(8, 9520730404)],
		];
	}

	public function getUnknownPhones()
	{
		return [
			[new Phone(7, 9696830111)],
			[new Phone(8, 9520730222)],
		];
	}
}