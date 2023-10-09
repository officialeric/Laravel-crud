<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class newMember extends Controller
{


    public function login(Request $request){

          if (auth()->attempt([
            'email' => $request['lemail'],
            'password' => $request['lpassword']
            ])) {
            $request->session()->regenerate();
          }
          return redirect('/home');
    } 

    public function logout() {
        auth()->logout();
        return redirect('/');
    }

    public function signup(Request $request){
        $fields = $request->validate([
          'name' => ['min:3','max:15',Rule::unique('users','name')],
          'email' => ['email',Rule::unique('users','name')],
          'password' => ['min:8','max:15'],
        ]);

        $fields['password'] = bcrypt($fields['password']);
        $user = User::create($fields);
        auth()->login($user); 
        return redirect('/home');
    }
}
