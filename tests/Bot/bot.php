<?php

chdir(dirname(__DIR__));
require '../vendor/autoload.php';

var_dump(__DIR__);

foreach (scandir(__DIR__.'/Unit') as $file)
{
	if (substr($file, -8, 8) == 'Test.php')
	{
		$className = pathinfo($file, PATHINFO_FILENAME);
		$class = new \ReflectionClass('Tests\Bot\Unit\\'.$className);
		foreach ($class->getMethods() as $method)
		{
			if (substr($method->name, 0, 4) == 'test')
			{
				echo 'Test '.$method->class.'::'.$method->name.PHP_EOL.PHP_EOL;
				/** @var Tests\Bot\Unit\BaseTest $bot */
				$bot = new $method->class;
				$bot->onBeforeTest();
				$bot->{$method->name}();
				$bot->onAfterTest();
				echo PHP_EOL;
			}
		}
	}
}