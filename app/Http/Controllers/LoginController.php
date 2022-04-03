<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
  public function __construct(){
    $this->middleware('guest')->except('logout');
  }
  public function form(){
    return view ('login');
  }

  public function check(Request $request){
    // Checking login info

    $request->validate([
      'login' => 'required|string',
      'password' => 'required|string'
    ]);
    //dd($request->all());
    if( auth()->attempt(['login' => $request->login, 'password' => $request->password]) ){
      $request->session()->regenerate();
      return redirect()->route('dashboard');
    }
    else{
      return redirect()->back()->with('error', 'Identifiant ou mot de passe incorrecte');
    }
  }

  public function logout(){
    if( auth()->check() ){
      auth()->logout();
      return redirect()->route('login');
    }
  }
}
