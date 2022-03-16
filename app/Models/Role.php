<?php

namespace App\Models;

use Spatie\Permission\Models\Role as Permissions;

class Role extends Permissions
{
    protected $fillable = ['name', 'guard_name'];
}
