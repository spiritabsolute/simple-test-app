<?php
namespace Tests\Bot\Unit;

use App\Employee\Name;

class NameTest extends BaseTest
{
	public function onBeforeTest()
	{
		parent::onBeforeTest();
	}

	public function onAfterTest()
	{
		parent::onAfterTest();
	}

	public function testValidateEmptyValues()
	{
		$name = new Name('', '');
		$this->assertTrue($name->getErrors(), 'Validation empty first and last name');
		$name = new Name('', 'Divan');
		$this->assertArrayHasKey(Name::ERROR_VALIDATE_REQUIRE, $name->getErrors(), 'Validation empty first name');
		$name = new Name('Ivan', '');
		$this->assertArrayHasKey(Name::ERROR_VALIDATE_REQUIRE, $name->getErrors(), 'Validation empty last name');
	}

	public function testValidateInvalidValues()
	{
		$name = new Name('login1', 'lu');
		$this->assertTrue($name->getErrors(), 'Validation invalid first and last name');
		$name = new Name('login1', 'Divan');
		$this->assertArrayHasKey(Name::ERROR_VALIDATE_INVALID, $name->getErrors(), 'Validation invalid first name');
		$name = new Name('Ivan', 'lu');
		$this->assertArrayHasKey(Name::ERROR_VALIDATE_INVALID, $name->getErrors(), 'Validation invalid last name');
	}

	public function testValidateCorrectValues()
	{
		$name = new Name('Ivan', 'Divan');
		$this->assertFalse($name->getErrors(), 'Correct first and last name');
	}

	public function testFullNameCorrectValue()
	{
		$name = new Name('Ivan', 'Divan');
		$this->assertEqualTo($name->getFullName(), 'Ivan Divan', 'Correct full name');
	}
}

