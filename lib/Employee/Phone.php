<?php
namespace App\Employee;

class Phone
{
	public $code;
	public $number;

	public function __construct(int $code, int $number)
	{
		$this->code = $code;
		$this->number = $number;
	}

	public function isEqualTo(Phone $phone): bool
	{
		return ($this->code == $phone->code && $this->number == $phone->number);
	}

	public static function __set_state($array)
	{
		return new self($array['code'], $array['number']);
	}
}