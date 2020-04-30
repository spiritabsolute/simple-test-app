<?php
namespace App\Employee;

class Name
{
	private $first;
	private $last;

	private $errors = [];

	const ERROR_VALIDATE_REQUIRE = 'require';
	const ERROR_VALIDATE_INVALID = 'invalid-format';

	public function __construct(string $first, string $last)
	{
		$this->validateFirstName($first);
		$this->validateLastName($last);

		$this->first = $first;
		$this->last = $last;
	}

	public function getFullName()
	{
		return trim($this->first . ' ' . $this->last);
	}

	public function getErrors(): array
	{
		return $this->errors;
	}

	private function validateFirstName(string $first): void
	{
		if (!strlen($first))
		{
			$this->addError(self::ERROR_VALIDATE_REQUIRE, 'The required field "first" is not filled');
		}

		if (!preg_match('/^[a-zA-Z]{2,}$/', $first))
		{
			$this->addError(self::ERROR_VALIDATE_INVALID, 'Invalid first name format');
		}
	}

	private function validateLastName(string $last): void
	{
		if (!strlen($last))
		{
			$this->addError(self::ERROR_VALIDATE_REQUIRE, 'The required field "last" is not filled');
		}

		if (!preg_match('/^[a-zA-Z]{3,}$/', $last))
		{
			$this->addError(self::ERROR_VALIDATE_INVALID, 'Invalid last name format');
		}
	}

	private function addError(string $code, string $message): void
	{
		$this->errors[$code] = $message;
	}

	public static function __set_state($array)
	{
		return new self($array['first'], $array['last']);
	}
}