<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class WelcomeController extends Controller
{
    public function index () {
      $rep = \App\InstituteRep::where('user_id', \Auth::user()->id)->get();
      $superannuating = [];
      $userIDs = [];
      if (count($rep) > 0) {
        $rep = $rep->first();
        // Superannuating
        $wa = \App\WorksAt::where('institute_id', $rep->institute_id)->whereNull('end_date')->orderBy('start_date', 'desc')->get();
        foreach ($wa as $w) {
          $user = \App\User::where('id', $wa->first()->user_id)->first();
          $now = Carbon::today();
          $now = $now->addMonths(6);
          $birthdate = new Carbon($user->birthdate);
          $s_age = \App\UserProfile::where('user_id', $user->id)->first()->superannuation_age;
          $superannuation = $birthdate->addYears($s_age);
          if ($superannuation->lt($now)) {
            if (!in_array($user->id, $userIDs)) {
              $user->superannuation = $superannuation->toFormattedDateString();
              array_push($userIDs, $user->id);
              array_push($superannuating, $user);
            }
          }
        }

        // Leaving
        $leaving = [];
        $wa = \App\WorksAt::where('institute_id', $rep->institute_id)->whereNotNull('end_date')->orderBy('start_date', 'desc')->get();
        foreach ($wa as $w) {
          $now = Carbon::today();
          $now = $now->addMonths(6);
          $end_date = new Carbon($w->end_date);
          if ($end_date->lt($now)) {
            $user = \App\User::where('id', $w->user_id)->first();
            if (!in_array($user->id, $userIDs)) {
              $user->leaving = $end_date->toFormattedDateString();
              array_push($userIDs, $user->id);
              array_push($leaving, $user);
            }
          }
        }

        return view('welcome', [
          'superannuating' => $superannuating,
          'leaving' => $leaving
        ]);
      } else {
        return redirect('me');
      }

    }

    public function me () {
      $both = \DB::table('match_for_users')
                ->where('match_for_users.user_id', \Auth::user()->id)
                ->join('match_for_vacancies', 'match_for_vacancies.vacancy_id', '=', 'match_for_users.vacancy_id')
                ->get();

      $vids = [];
      foreach ($both as $b) {
        if (!in_array($b->vacancy_id, $vids)) {
          array_push($vids, $b->vacancy_id);
        }
      }
      
      $both = \App\Vacancy::whereIn('id', $vids)->get();
      foreach ($both as $m) {
        $m->qualification = \App\Qualification::where('id', $m->qualification_id)->first()->name;
        $m->field = \App\Field::where('id', $m->field_id)->first()->name;
        $m->city = \App\City::where('id', \App\Institute::where('id', $m->institute_id)->first()->city_id)->first()->name;
        $m->institute = \App\Institute::where('id', $m->institute_id)->first()->name;
        $c = new Carbon($m->start_date);
        $m->start = $c->toFormattedDateString();
      }

      $matches = \DB::table('match_for_users')
              ->where('match_for_users.user_id', \Auth::user()->id)
              ->whereNotIn('match_for_users.vacancy_id', $vids)
              ->join('vacancies', 'match_for_users.vacancy_id', '=', 'vacancies.id')
              ->get();

      foreach ($matches as $m) {
        $m->qualification = \App\Qualification::where('id', $m->qualification_id)->first()->name;
        $m->field = \App\Field::where('id', $m->field_id)->first()->name;
        $m->city = \App\City::where('id', \App\Institute::where('id', $m->institute_id)->first()->city_id)->first()->name;
        $m->institute = \App\Institute::where('id', $m->institute_id)->first()->name;
        $c = new Carbon($m->start_date);
        $m->start = $c->toFormattedDateString();
      }

      return view('teacher', [
        'vacancies' => $matches,
        'both' => $both
      ]);
    }
}
