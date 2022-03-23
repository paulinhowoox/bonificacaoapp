<?php

namespace App\Repositories\Contracts;

interface EmployeeRepositoryInterface
{
    public function getAllEmployees();
    public function getEmployeeById($employeeId);
    public function createEmployee(array $employeeDetails);
    public function updateEmployee($employeeId, array $newDetails);
    public function deleteEmployee($employeeId);
}
