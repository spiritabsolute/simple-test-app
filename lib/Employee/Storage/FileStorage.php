<?php
namespace App\Employee\Storage;

use App\Employee\Employee;

class FileStorage implements Storable
{
	public function generateNextId(): int
	{
		$nextId = rand(10000, 99999);
		if (file_exists('data/employees/'.$nextId.'.php'))
		{
			return $this->generateNextId();
		}
		else
		{
			return $nextId;
		}
	}

	public function save(Employee $employee): void
	{
		$file = 'data/employees/'.$employee->getId().'.php';
		file_put_contents($file, '<?php return '.var_export($employee, true).';');
	}

	public function find(int $id)
	{
		return include 'data/employees/'.$id.'.php';
	}
}