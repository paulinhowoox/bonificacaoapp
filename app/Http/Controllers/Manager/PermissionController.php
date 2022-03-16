<?php

namespace App\Http\Controllers\Manager;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    private $permission, $role;

    public function __construct(Permission $permission, Role $role)
    {
        $this->permission = $permission;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permission->all();
        return view('manager.permissions.list', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->role->all();
        return view('manager.permissions.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:40',
        ]);

        $name = $request['name'];
        $permission = new Permission();
        $permission->name = $name;

        $roles = $request['roles'];

        $permission->save();

        if (!empty($request['roles'])) { //If one or more role is selected
            foreach ($roles as $role) {
                $r = $this->role->where('id', '=', $role)->firstOrFail(); //Match input role to db record

                $permission = $this->permission->where('name', '=', $name)->first(); //Match input //permission to db record
                $r->givePermissionTo($permission);
            }
        }

        flash('Permissão "' . $permission->name . '" cadastrada com sucesso')->success();
        return redirect()->route('manager.permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = $this->permission->findOrFail($id);

        return view('manager.permissions.edit', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = $this->permission->findOrFail($id);

        return view('manager.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permission = $this->permission->findOrFail($id);
        $this->validate($request, [
            'name' => 'required|max:40',
        ]);
        $input = $request->all();
        $permission->fill($input)->save();

        flash('Permissão "' . $permission->name . '" atualizada com sucesso')->success();
        return redirect()->route('manager.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = $this->permission->findOrFail($id);

        //Make it impossible to delete this specific permission
        if ($permission->name == "Admin") {
            flash('Não é possível excluir a permissão ' . $permission->name)->error();
            return redirect()->route('manager.permissions.index');
        }

        $permission->delete();

        flash('Permissão "' . $permission->name . '" excluida com sucesso')->success();
        return redirect()->route('manager.permissions.index');
    }
}
