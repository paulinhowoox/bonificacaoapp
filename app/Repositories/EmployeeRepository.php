<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\Contracts\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAllEmployees()
    {
        return Employee::all();
    }

    public function getEmployeeById($employeeId)
    {
        return Employee::find($employeeId);
    }

    public function createEmployee(array $employeeDetails)
    {
        $user = auth()->user();
        return $user->employee()->create($employeeDetails, ['user_id' => $user->id]);
    }

    public function updateEmployee($employeeId, array $newDetails)
    {
        return Employee::whereId($employeeId)->update($newDetails);
    }

    public function deleteEmployee($employeeId)
    {
        return Employee::destroy($employeeId);
    }

}

