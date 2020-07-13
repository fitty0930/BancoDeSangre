<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Role_user;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    //
    public function showRoles(){
        $nombrePagina="roles";
        $admin=1;
        $users = User::join('role_user', 'users.id', '=', 'role_user.user_id')
                    ->select('users.*', 'role_user.*')
                    // ->OrderBy('dni','asc')
                    ->get();
    
        return view('roles.allroles', compact('users','nombrePagina','admin'));
    }

    public function changeRole($id){
        $role_user =  Role_user::select('role_user.*')->where('role_user.user_id', $id)->first();
        if($role_user->role_id==1){
            $role_user->role_id= 2;
            $role_user->save();
        }else if($role_user->role_id==2){
            $role_user->role_id= 1;
            $role_user->save();
        }
        return redirect()->route('roles');
    }
}
