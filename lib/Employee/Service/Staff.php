<?php
namespace App\Employee\Service;

use App\Employee\Employee;
use App\Employee\Name;
use App\Employee\Phone;
use App\Employee\PhoneCollection;
use App\Employee\Storage\Storable;

class Staff
{
	private $storage;

	public function __construct(Storable $storage)
	{
		$this->storage = $storage;
	}

	public function recruitEmployee(Name $name, PhoneCollection $phones): Employee
	{
		$employee = new Employee($this->storage->generateNextId(), $name, $phones);

		return $this->save($employee);
	}

	public function getEmployee(int $id): Employee
	{
		return $this->getEmployeeById($id);
	}

	public function changeEmployeeName(int $id, Name $name): Employee
	{
		$employee = $this->getEmployeeById($id);

		$employee->rename($name);

		return $this->save($employee);
	}

	public function addEmployeePhone(int $id, Phone $phone): Employee
	{
		$employee = $this->getEmployeeById($id);

		$employee->addPhone($phone);

		return $this->save($employee);
	}

	public function removeEmployeePhone(int $id, Phone $phone): Employee
	{
		$employee = $this->getEmployeeById($id);

		$employee->removePhone($phone);

		return $this->save($employee);
	}

	private function save(Employee $employee): Employee
	{
		$this->storage->save($employee);

		return $employee;
	}

	private function getEmployeeById(int $id): Employee
	{
		return $this->storage->find($id);
	}
}