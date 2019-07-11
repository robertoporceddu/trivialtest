<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\ChangePassword;

class UserController extends Controller
{
	
    protected function showAll()
    {
    	return response()->json(User::all());
    }

    protected function show(User $user)
    {
    	return response()->json($user);
    }

    protected function store()
    {
    	$inserted = User::create(request()->validate([
		    'name' => 'required|max:255',
		    'email' => 'required|email',
		    'role_id' => 'required',
		    'password' => 'required'
		]));

		return response($inserted ? 'User create correctly!' : NULL, 200);
    }

    protected function update(User $user)
    {
    	$updated = $user->update(
			request()->validate([
			    'name' => 'max:255',
			    'email' => 'email',
			    'role' => '',
			    'password' => ''
			])
		);

		if(request('password')) {
			$user->notify(new ChangePassword());
		}

		return response($updated ? 'User update correctly!' : NULL, 200);
    }
}
