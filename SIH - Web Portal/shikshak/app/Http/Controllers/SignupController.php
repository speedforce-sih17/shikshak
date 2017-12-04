<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class SignupController extends Controller
{
    function post (Request $r) {
        try {
          $u = new \App\User;
          $u->first_name = $r->input('first_name', 'John');
          $u->middle_name = $r->input('middle_name', 'Bro');
          $u->last_name = $r->input('last_name', 'Doe');
          $u->email = $r->input('email', 'john@doe.com');
          $u->phone = $r->input('phone', '9974768388');
          $u->aadhar_id = $r->input('aadhar_id', '123412341234');
          $s = explode('-', $r->input('birthdate', '01/04/2017'));
          $c = Carbon::createFromDate($s[0], $s[1], $s[2]);
          $u->birthdate = $c->toDateString();
          $u->password = \Hash::make($r->input('password', '123456'));
          $u->qualification_id = $r->input('qualification_id', 4);
          $u->field_id = $r->input('field_id', 1);
          $u->resume = $r->input('resume', '');
          $u->national_publications = rand(0, 6);
          $u->international_publications = rand(0, 6);
          $u->save();

          $p = new \App\UserProfile;
          $p->user_id = $u->id;
          $p->current_city_id = $r->input('current_city_id', 1);
          $p->relocating = $r->input('relocating', true) ? 1 : 0;
          $p->superannuation_age = $r->input('superannuation_age', 60);
          $p->experience = $r->input('experience', 0);
          $p->save();

          return redirect('login');
        } catch (Exception $e) {
          return redirect('signup');
        }
    }

    function api (Request $r) {
        try {
          $u = new \App\User;
          $u->first_name = $r->input('first_name', 'John');
          $u->middle_name = $r->input('middle_name', 'Bro');
          $u->last_name = $r->input('last_name', 'Doe');
          $u->email = $r->input('email', 'john@doe.com');
          $u->phone = $r->input('phone', '9974768388');
          $u->aadhar_id = $r->input('aadhar_id', '123412341234');
          $s = explode('/', $r->input('birthdate', '01/04/2017'));
          $c = Carbon::createFromDate($s[2], $s[1], $s[0]);
          $u->birthdate = $c->toDateString();
          $u->password = \Hash::make($r->input('password', '123456'));
          $u->qualification_id = $r->input('qualification_id', 4);
          $u->field_id = $r->input('field_id', 1);
          $u->resume = $r->input('resume', '');
          $u->national_publications = rand(0, 6);
          $u->international_publications = rand(0, 6);
          $u->save();

          $p = new \App\UserProfile;
          $p->user_id = $u->id;
          $p->current_city_id = $r->input('current_city_id', 1);
          $p->relocating = $r->input('relocating', true) ? 1 : 0;
          $p->superannuation_age = $r->input('superannuation_age', 60);
          $p->experience = $r->input('experience', 0);
          $p->save();

          return ['status' => true];
        } catch (Exception $e) {
          return ['status' => false];
        }
    }
}
