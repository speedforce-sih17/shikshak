<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    function post (Request $r) {
      $email = $r->input('email', '');
      $password = $r->input('password', '');
      if (\Auth::attempt(['email' => $email, 'password' => $password])) {
        return redirect('/');
      } else {
        return redirect('login');
      }
    }

    function api (Request $r) {
      $email = $r->input('email', '');
      $password = $r->input('password', '');
      if (\Auth::attempt(['email' => $email, 'password' => $password])) {
        return ['status' => true, 'id' => \Auth::user()->id];
      } else {
        return ['status' => false];
      }
    }
}
