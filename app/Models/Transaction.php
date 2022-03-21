<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['user_id', 'employee_id', 'transaction_type', 'amount', 'description'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
