<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laravel\Socialite\Facades\Socialite;

class newMember extends Controller
{

  public function redirectToGoogle(){
    return Socialite::driver('google')->redirect();
  }
  public function handleGoogleCallback(){
   try {
        $user = Socialite::driver('google')->user();
    } catch (\Exception $e) {
        return redirect('login');
    }  

    // check if they're an existing user
    $existingUser = User::where('email', $user->email)->first();
    if($existingUser){
        // log them in
        auth()->login($existingUser, true);
    }else {
      // create a new user
      $newUser                  = new User;
      $newUser->name            = $user->name;
      $newUser->email           = $user->email;
      $newUser->google_id       = $user->id;
      $newUser->save();
      auth()->login($newUser, true);
  }
  return redirect('/');
}


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
