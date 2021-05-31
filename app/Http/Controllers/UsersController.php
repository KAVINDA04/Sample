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
            'firstName' => 'required|max:15',
            'lastName' => 'required|max:15',
            'mobile' => 'required|max:10|min:10',
            'email' => 'email:rfc,dns',

        ]);

        Users::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'mobile' => $request->mobile,
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
            'firstName' => 'required|max:15',
            'lastName' => 'required|max:15',
            'mobile' => 'required|max:10|min:10',
            'email' => 'email:rfc,dns',

        ]);

        $user->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'mobile' => $request->mobile,
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
