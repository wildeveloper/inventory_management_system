<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function get_all_users()
    {
        $users = User::all();
        return $users;
    }
    public function get_user($id)
    {
        $user = User::where('id', $id)->first();
        return $user;
    }

    public function store(Request $request)
    {
        
        $users = $request->all();
        unset($users['id']);
        $users = User::create($users);
        return json_encode($users);

    }

    public function update(Request $request)
    {
        
        $users = $request->all();
        $users = User::updateOrCreate(['id' => $request->id], $users);
        return json_encode($users);

    }

    public function delete($id)
    {
        
        $users = User::where('id', $id)->delete();
        return json_encode($users);

    }
}
