<?php

chdir(dirname(__DIR__));
require '../vendor/autoload.php';

use App\Employee\Name;

class NameTestV1
{
	public function testValidateEmptyValues()
	{
		$name = new Name('', '');
		echo 'Validation empty first and last name: ';
		if ($name->getErrors())
		{
			echo 'Ok' . PHP_EOL;
		}
		else
		{
			echo 'Fail' . PHP_EOL;
			exit();
		}

		$name = new Name('', 'Divan');
		echo 'Validation empty first name: ';
		if (array_key_exists(Name::ERROR_VALIDATE_REQUIRE, $name->getErrors()))
		{
			echo 'Ok' . PHP_EOL;
		}
		else
		{
			echo 'Fail' . PHP_EOL;
			exit();
		}

		$name = new Name('Ivan', '');
		echo 'Validation empty last name: ';
		if (array_key_exists(Name::ERROR_VALIDATE_REQUIRE, $name->getErrors()))
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

$test = new NameTestV1();
$test->testValidateEmptyValues();