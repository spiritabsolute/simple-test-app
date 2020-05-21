<?php

chdir(dirname(__DIR__));
require '../vendor/autoload.php';

use App\Employee\Name;

class NameTestV3
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

	protected function assertTrue($condition, $message = '')
	{
		$this->assert($condition == true, $message);
	}

	protected function assertArrayHasKey(string $key, array $array, $message = '')
	{
		$this->assert(array_key_exists($key, $array), $message);
	}

	protected function assert($condition, $message = '')
	{
		echo $message.': ';
		if ($condition)
		{
			echo 'Ok' . PHP_EOL;
		}
		else
		{
			echo 'Fail' . PHP_EOL;
			exit();
		}
	}
}

$test = new NameTestV3();
$test->testValidateEmptyValues();