<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstituteController extends Controller
{
    function addInstitute (Request $r) {
      $t = new \App\Institute;
      $t->name = $r->input('name', 'MIT');
      $t->university = $r->input('university', 'MIT');
      $t->city_id = $r->input('city_id', 1);
      $t->website = $r->input('website', 'https://google.com');
      $t->logo = $r->input('logo', 'https://pbs.twimg.com/profile_images/839721704163155970/LI_TRk1z.jpg');
      $t->save();

      return redirect('instituteActions');
    }

    function addRepresentative (Request $r) {
      $irep = new \App\InstituteRep;
      $irep->user_id = \Auth::user()->id;
      $irep->institute_id = $r->input('institute_id', 1);
      $irep->save();

      return redirect('/');
    }
}
