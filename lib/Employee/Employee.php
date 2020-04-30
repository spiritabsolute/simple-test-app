<?php
namespace App\Employee;

class Employee
{
	private $id;
	private $name;
	private $phones;

	public function __construct($id, Name $name, PhoneCollection $phones)
	{
		$this->id = $id;
		$this->name = $name;
		$this->phones = $phones;
	}

	public function getId()
	{
		return $this->id;
	}

	public function rename(Name $name): void
	{
		$this->name = $name;
	}

	public function addPhone(Phone $phone): void
	{
		$this->phones->add($phone);
	}

	public function removePhone(Phone $phone): bool
	{
		return $this->phones->remove($phone);
	}

	public function getPhones(): array
	{
		return $this->phones->getAll();
	}

	public static function __set_state($array)
	{
		return new self($array['id'], $array['name'], $array['phones']);
	}
}