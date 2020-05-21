<?php

chdir(dirname(__DIR__));
require '../vendor/autoload.php';

use App\Employee\Name;

class NameTestV2
{
	public function testValidateEmptyValues()
	{
		$name = new Name('', '');
		$this->assert($name->getErrors(), 'Validation empty first and last name');

		$name = new Name('', 'Divan');
		$this->assert(array_key_exists(Name::ERROR_VALIDATE_REQUIRE, $name->getErrors()), 'Validation empty first name');

		$name = new Name('Ivan', '');
		$this->assert(array_key_exists(Name::ERROR_VALIDATE_REQUIRE, $name->getErrors()), 'Validation empty last name');
	}

	private function assert($condition, $message = '')
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

$test = new NameTestV2();
$test->testValidateEmptyValues();