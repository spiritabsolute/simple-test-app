<?php
namespace Tests\Bot\Unit;

class BaseTest
{
	public function onBeforeTest()
	{

	}

	public function onAfterTest()
	{

	}

	protected function assertEqualTo($expected, $actual, $message = '')
	{
		$this->assert($expected === $actual, $message);
	}

	protected function assertTrue($condition, $message = '')
	{
		$this->assert($condition == true, $message);
	}

	protected function assertFalse($condition, $message = '')
	{
		$this->assert($condition == false, $message);
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