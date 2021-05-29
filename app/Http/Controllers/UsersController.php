<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        $users = Users::all();
        return view('index', compact('users'));
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|max:15',
            'email' => 'email:rfc,dns',

        ]);

        Users::create([
            'name' => $request->name,
            'email' => $request->email,
            'created_at' => now()
        ]);
        return redirect()-> route('user.index')->with('success', 'User has been Registered');
    }

    public function edit(Users $user){
        return view('edit')->with('user', $user);
    }

    public function update(Request $request, Users $user){

        $request->validate([
            'name' => 'required|max:15',
            'email' => 'email:rfc,dns',

        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now()
        ]);
        return redirect()-> route('user.index')->with('success', 'User has been Updated');
    }

    public function destroy(Users $user){
        $user->delete();
        return redirect()-> route('user.index')->with('success', 'User has been Deleted');
    }
}
