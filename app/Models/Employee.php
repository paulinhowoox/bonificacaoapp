<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['user_id', 'full_name', 'current_balance'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class);
    }
}
