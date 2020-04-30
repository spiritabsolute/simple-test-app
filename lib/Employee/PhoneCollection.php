<?php
namespace App\Employee;

class PhoneCollection
{
	/**
	 * @var Phone[]
	 */
	private $phones;

	public function __construct(array $phones = [])
	{
		$this->phones = $phones;
	}

	public function add(Phone $newPhone)
	{
		foreach ($this->phones as $phone)
		{
			if ($phone->isEqualTo($newPhone))
			{
				throw new \Exception('Phone already exists');
			}
		}
		$this->phones[] = $newPhone;
	}

	public function remove(Phone $removedPhone): bool
	{
		foreach ($this->phones as $key => $phone)
		{
			if ($phone->isEqualTo($removedPhone))
			{
				unset($this->phones[$key]);
				return true;
			}
		}
		throw new \Exception('Phone not found');
	}

	public function getAll(): array
	{
		return $this->phones;
	}

	public static function __set_state($array)
	{
		return new self();
	}
}