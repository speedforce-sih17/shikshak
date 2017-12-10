<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class EmploymentController extends Controller
{
    function current () {

      $w = \App\WorksAt::where('user_id', \Auth::user()->id)->where('end_date', null)->get();
      if (count($w) == 1) {
        $w = $w->first();
        $showAdd = false;
        $showTerminate = true;
        $c = new Carbon($w->start_date);
        $w->start_date = $c->toFormattedDateString();
        $w->institute = \App\Institute::where('id', $w->institute_id)->first()->name;
      } else if (count($w) == 0) {
        $showAdd = true;
        $showTerminate = false;
      }

      $i = \App\Institute::all();
      return view('employment', [
        'worksAt' => $w,
        'institutes' => $i,
        'showAdd' => $showAdd,
        'showTerminate' => $showTerminate
      ]);
    }

    public function add (Request $r) {
      $w = new \App\WorksAt;
      $w->institute_id = $r->input('institute_id', 1);
      $w->user_id = \Auth::user()->id;
      $s = explode('-', $r->input('start_date', '01-04-2017'));
      $c = Carbon::createFromDate($s[0], $s[1], $s[2]);
      $w->start_date = $c->toDateString();
      $w->save();
      return redirect('employment');
    }

    public function end (Request $r) {
      $w = \App\WorksAt::where('user_id', \Auth::user()->id)->where('end_date', null)->get();
      if (count($w) == 0) return redirect('employment');
      $w = $w->first();
      $s = explode('-', $r->input('end_date', '01-04-2017'));
      $c = Carbon::createFromDate($s[0], $s[1], $s[2]);
      $w->end_date = $c->toDateString();
      $w->save();
      return redirect('employment');
    }
}
