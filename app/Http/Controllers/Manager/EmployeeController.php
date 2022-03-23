<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Transaction;
use App\Repositories\Contracts\EmployeeRepositoryInterface;

class EmployeeController extends Controller
{

    private $employee, $transaction;

    public function __construct(EmployeeRepositoryInterface $employee, Transaction $transaction)
    {
        $this->employee = $employee;
        $this->transaction = $transaction;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employee->getAllEmployees();
        $full_name = $employees->sortBy('full_name')->pluck('full_name')->unique();

        return view('manager.employees.list', compact('employees', 'full_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\EmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->all();
        $employee = $this->employee->createEmployee($data);

        flash('Funcionário "' . $employee->full_name . '" cadastrado com sucesso!')->success();
        return redirect()->route('manager.employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = $this->employee->getEmployeeById($id);

        return view('manager.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = $this->employee->getEmployeeById($id);

        return view('manager.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\EmployeeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, $id)
    {
        $data = $request->except(['_method', '_token']);
        $employee = $this->employee->getEmployeeById($id);

        $this->employee->updateEmployee($id, $data);

        flash('Funcionário "' . $employee->full_name . '" atualizado com sucesso!')->success();
        return redirect()->route('manager.employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = $this->employee->getEmployeeById($id);
        $this->employee->deleteEmployee($id);

        flash('Funcionário "' . $employee->full_name . '" excluido com sucesso!')->success();
        return redirect()->route('manager.employees.index');
    }

    public function transactions($id)
    {
        if(!$employee = $this->employee->getEmployeeById($id)) {
            return redirect()->route('manager.employees.index');
        }
        $transactions = $employee->transactions()->get();

        return view('manager.employees.show', compact('transactions', 'employee'));
    }
}
