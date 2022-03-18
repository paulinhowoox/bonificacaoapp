<?php

namespace App\Http\Controllers\Manager;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{

    private $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employee->all();
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
        $user = auth()->user();
        $employee = $user->employee()->create($data, ['user_id' => $user->id]);

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
        $employee = $this->employee->findOrFail($id);

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
        $employee = $this->employee->findOrFail($id);

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
        $data = $request->all();
        $user = auth()->user();
        $employee = $this->employee->find($id);

        $employee->update($data, ['user_id' => $user->id]);

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
        $employee = $this->employee->find($id);
        $employee->delete();

        flash('Funcionário "' . $employee->full_name . '" excluido com sucesso!')->success();
        return redirect()->route('manager.employees.index');
    }
}
