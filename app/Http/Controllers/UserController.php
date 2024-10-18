<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller{
    public function register(Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:20', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'max:50'],
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);

        $user = User::Create($incomingFields);

        auth()->login($user);

        return redirect('/homepage ');
    }

    public function login(Request $request){
        $incomingFields = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if(auth()-> attempt(['email' => $incomingFields['email'], 'password' => $incomingFields['password']])){
            $request->session()->regenerate();
            return redirect('/homepage'); 
        }else{
            return redirect('/login'); 
        }

    }

    public function logout() {
        auth()->logout();
        return redirect('/homepage');
    }
}
