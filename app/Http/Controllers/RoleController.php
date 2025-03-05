<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::paginate(7);

        return view('admin.roles', compact('roles'));
    }

    public function create(Request $request)
    {
        Role::create([
            'name' => $request['name'],
            'description' => $request['description'],
        ]);
        return redirect('/admin/roles');
    }

    public function getRole(Role $role)
    {
        return view('admin.role_edit', compact('role'));
    }

    public function delete(Role $role)
    {
        try {
            $role->delete();
        }catch (\Exception $exception){
            return redirect('/admin/roles')->with('failed', 'Role is related to many Users, cant be deleted for the moment');
        }
        return redirect('/admin/roles');
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->update([
            'name' => $request['name'],
            'description' => $request['description'],
        ]);

        return redirect('/admin/roles')->with('success', 'Role updated successfully!');
    }
}
