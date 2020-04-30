<?php
namespace App\Employee\Storage;

use App\Employee\Employee;

interface Storable
{
	public function save(Employee $employee): void;

	public function find(int $id);
}