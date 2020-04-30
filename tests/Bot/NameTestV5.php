<?php

chdir(dirname(__DIR__));
require '../vendor/autoload.php';

use App\Employee\Name;

class NameTestV5 extends Tests\Bot\BaseTestV1
{
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

$class = new \ReflectionClass(NameTestV5::class);
foreach ($class->getMethods() as $method)
{
	if (substr($method->name, 0, 4) == 'test')
	{
		echo 'Test '.$method->class.'::'.$method->name.PHP_EOL.PHP_EOL;
		$bot = new $method->class;
		$bot->{$method->name}();
		echo PHP_EOL;
	}
}