<?php
namespace Tests\PHPUnit;

use App\Employee\Name;
use PHPUnit\Framework\TestCase;

class NameTest extends TestCase
{
	/**
	 * @dataProvider emptyValues
	 */
	public function testValidateEmptyValues($first, $last)
	{
		$name = new Name($first, $last);
		$this->hasError($name);
	}

	/**
	 * @dataProvider invalidValues
	 */
	public function testValidateInvalidValues($first, $last)
	{
		$name = new Name($first, $last);

		$message = 'Validation invalid first or last names';

		$this->assertNotEmpty($name->getErrors(), $message);
		$this->assertArrayHasKey(Name::ERROR_VALIDATE_INVALID, $name->getErrors(), $message);
	}

	/**
	 * @dataProvider correctValues
	 */
	public function testValidateCorrectValues($first, $last)
	{
		$name = new Name($first, $last);
		$this->assertEmpty($name->getErrors(), 'Correct first and last name');
	}

	/**
	 * @dataProvider correctValues
	 */
	public function testFullNameCorrectValue($first, $last)
	{
		$name = new Name($first, $last);
		$this->assertEquals($name->getFullName(), $first.' '.$last, 'Correct full name');
	}

	public function emptyValues()
	{
		return [
			'empty first and last names' => ['', ''],
			'empty first name' => ['', 'Divan'],
			'empty last name' => ['Ivan', ''],
		];
	}

	public function invalidValues()
	{
		return [
			'invalid first and last names' => ['login1', 'lu'],
			'invalid first name' => ['login1', 'Divan'],
			'invalid last name' => ['Ivan', 'lu'],
		];
	}

	public function correctValues()
	{
		return [
			['Ivan', 'Divan'],
			['Lu', 'Hai'],
		];
	}

	private function hasError(Name $name)
	{
		$this->assertNotEmpty($name->getErrors());
		$this->assertArrayHasKey(Name::ERROR_VALIDATE_REQUIRE, $name->getErrors());
	}
}