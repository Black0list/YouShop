<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.users', compact('users', 'roles'));
    }

//    public function create(Request $request)
//    {
//
//        $roleId = Role::whereRaw('LOWER(name) = ?', 'client')->first()->id;
//
//        if (!$roleId) {
//            $role = Role::create(['name' => 'client', 'description' => ' ']);
//            $roleId = $role->id;
//        }
//
//        $user = User::create([
//            'name' => $request['name'],
//            'email' => $request['email'],
//            'password' => bcrypt($request['password']),
//            'role_id' => $roleId,
//        ]);
//
//        return redirect('/admin/users');
//    }

    public function delete(User $user)
    {
        try {
            $user->delete();
        }catch (\Exception $exception){
            return redirect('/admin/users')->with('failed', 'User is related to many commands, cant be deleted for the moment');
        }
    }


    public function update(Request $request, $id)
    {
        $room = User::find($id);

        $room->update([
            'name' => $request['name'],
            'role_id' => $request['role'],
        ]);

        return redirect('/admin/users')->with('success', 'User updated successfully!');
    }
}
