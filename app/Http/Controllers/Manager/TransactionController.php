<?php

namespace App\Http\Controllers\Manager;

use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    private $transaction, $employee;

    public function __construct(Transaction $transaction, Employee $employee)
    {
        $this->transaction = $transaction;
        $this->employee = $employee;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = $this->transaction->all();
        $employees = $this->employee->all();

        $employeeName = $employees->sortBy('full_name')->pluck('full_name')->unique();
        $transactionType = $transactions->sortBy('transaction_type')->pluck('transaction_type')->unique();

        return view('manager.transactions.list', compact('transactions', 'employeeName', 'transactionType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = $this->employee->all();

        return view('manager.transactions.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\TransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {
        $data = $request->all();
        $user = auth()->user();

        $transaction = $user->transaction()->create($data, ['user_id' => $user->id]);

        if ($data['transaction_type'] == 'entrada') {
            $employee = $this->employee->where('id', $data['employee_id'])->get();
            $employee[0]->current_balance += $data['amount'];
            $employee[0]->update();
        }

        if ($data['transaction_type'] == 'saida') {
            $employee = $this->employee->where('id', $data['employee_id'])->get();
            $employee[0]->current_balance -= $data['amount'];
            $employee[0]->update();
        }

        $transaction->employees()->sync($data['employee_id']);

        flash('Movimentação do funcionário(a) "' . $transaction->employee->full_name . '" cadastrada com sucesso!')->success();
        return redirect()->route('manager.transactions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = $this->transaction->find($id);

        return view('manager.transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaction = $this->transaction->find($id);
        $employees = $this->employee->all();

        return view('manager.transactions.edit', compact('transaction', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\TransactionRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransactionRequest $request, $id)
    {
        $data = $request->all();
        $user = auth()->user();
        $transaction = $this->transaction->find($id);

        $transaction->update($data, ['user_id' => $user->id]);

        if ($data['transaction_type'] == 'entrada') {
            $employee = $this->employee->where('id', $data['employee_id'])->get();
            $employee[0]->current_balance += $data['amount'];
            $employee[0]->update();
        }

        if ($data['transaction_type'] == 'saida') {
            $employee = $this->employee->where('id', $data['employee_id'])->get();
            $employee[0]->current_balance -= $data['amount'];
            $employee[0]->update();
        }

        $transaction->employees()->sync($data['employee_id']);

        flash('Movimentação do funcionário(a) "' . $transaction->employee->full_name . '" atualizada com sucesso!')->success();
        return redirect()->route('manager.transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = $this->transaction->find($id);
        $transaction->delete();

        flash('Movimentação do funcionário(a) "' . $transaction->employee->full_name . '" excluída com sucesso!')->success();
        return redirect()->route('manager.transactions.index');
    }
}
