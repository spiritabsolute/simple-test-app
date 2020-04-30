<?php

use App\Employee\Service\Staff;
use App\Employee\Storage\FileStorage;
use Command\EmployeeRecruit;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use Psr\Container\ContainerInterface;

return [
	'dependencies' => [
		"abstract_factories" => [
			ReflectionBasedAbstractFactory::class
		],
		'factories' => [
			Staff::class => function (ContainerInterface $container) {
				return new Staff($container->get(FileStorage::class));
			},
			FileStorage::class => function () {
				return new FileStorage();
			},
			EmployeeRecruit::class => function (ContainerInterface $container) {
				return new EmployeeRecruit($container);
			},
		],
	],
	'console' => [
		'commands' => [
			EmployeeRecruit::class,
		],
	],
];