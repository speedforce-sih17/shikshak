<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class VacancyController extends Controller
{
    function post (Request $r) {
      $v = new \App\Vacancy;
      $i = \App\InstituteRep::where('user_id', \Auth::user()->id)->first();
      $v->institute_id = $i->institute_id;
      $v->user_id = \Auth::user()->id;
      $v->title = $r->input('title', 'Vacancy');
      $v->description = $r->input('description', 'No description');
      if (!$v->description) {
        $v->description = 'No description';
      }
      $v->years = $r->input('years', 2);
      $s = explode('-', $r->input('start_date', '01-04-2017'));
      $c = Carbon::createFromDate($s[0], $s[1], $s[2]);
      $v->start_date = $c->toDateString();
      $v->field_id = $r->input('field_id', 1);
      $v->qualification_id = $r->input('qualification_id', 1);

      $v->save();
      return redirect('vacancies');
    }

    function delete ($id) {
      $v = \App\Vacancy::where('id', $id)->first();
      if ($v->user_id == \Auth::user()->id) {
        $v->delete();
      }
      return redirect('vacancies');
    }

    function showVacancies () {
      $user_id = \Auth::user()->id;
      $institute = \App\InstituteRep::where('user_id', $user_id)->first();
      $instituteVacancies = [];
      if (count($institute) > 0) {
        $instituteVacancies = \App\Vacancy::where('institute_id', $institute->institute_id)->get();
        foreach ($instituteVacancies as $v) {
          $v->field = \App\Field::where('id', $v->field_id)->first()->name;
          $v->qualification = \App\Qualification::where('id', $v->qualification_id)->first()->name;
          $c = new Carbon($v->start_date);
          $v->start_date = $c->toFormattedDateString();
        }
      }
      return view('display_vacancies', [
        'vacancies' => $instituteVacancies
      ]);
    }

    function showVacancyDetails ($id) {
      $v = \App\Vacancy::where('id', $id)->first();
      $c = new Carbon($v->start_date);
      $v->start_date = $c->toFormattedDateString();
      $v->qualification = \App\Qualification::where('id', $v->qualification_id)->first()->name;

      $both = \DB::table('match_for_vacancies')
                ->where('match_for_vacancies.vacancy_id', $id)
                ->join('match_for_users', 'match_for_vacancies.user_id', '=', 'match_for_users.user_id')
                ->get();

      $vids = [];
      foreach ($both as $b) {
        if (!in_array($b->user_id, $vids)) {
          array_push($vids, $b->user_id);
        }
      }
      
      $both = \App\User::whereIn('id', $vids)->get();
      foreach ($both as $m) {
        $profile = \App\UserProfile::where('user_id', $m->id)->first();
        $m->qualification = \App\Qualification::where('id', $m->qualification_id)->first()->name;
        $m->field = \App\Field::where('id', $m->field_id)->first()->name;
        $m->current_city = \App\City::where('id', $profile->current_city_id)->first()->name;
      }

      $ids = [];
      $matches = \App\MatchForUser::where('vacancy_id', $v->id)->whereNotIn('user_id', $vids)->get();

      foreach ($matches as $m) {
        if (!in_array($m->user_id, $ids)) {
          array_push($ids, $m->user_id);
        }
      }

      $rejects = \App\RejectForUser::where('vacancy_id', $v->id)->whereNotIn('user_id', $vids)->get();

      foreach ($rejects as $r) {
        if (!in_array($r->user_id, $ids)) {
          array_push($ids, $r->user_id);
        }
      }

      $users = \DB::table('users')
                    ->join('user_profiles', 'users.id', '=', 'user_profiles.user_id')
                    ->whereNotIn('users.id', $ids)
                    ->where('field_id', $v->field_id)
                    ->where('qualification_id', '>=', $v->qualification_id)
                    ->where('experience', '>=', $v->years)
                    ->whereNotIn('users.id', $vids)
                    ->get();

      foreach ($users as $u) {
        $u->current_city = \App\City::where('id', $u->current_city_id)->first()->name;
      }

      // Get matched users
      $matches = \DB::table('match_for_users')
                  ->join('users', 'match_for_users.user_id', '=', 'users.id')
                  ->join('user_profiles', 'match_for_users.user_id', '=', 'user_profiles.user_id')
                  ->where('match_for_users.vacancy_id', '=', $v->id)
                  ->whereNotIn('users.id', $vids)
                  ->get();

      foreach ($matches as $u) {
        $u->current_city = \App\City::where('id', $u->current_city_id)->first()->name;
      }

      $candidates = \DB::table('match_for_vacancies')
                      ->join('users', 'match_for_vacancies.user_id', '=', 'users.id')
                      ->join('user_profiles', 'match_for_vacancies.user_id', '=', 'user_profiles.user_id')
                      ->where('match_for_vacancies.vacancy_id', '=', $v->id)
                      ->whereNotIn('users.id', $vids)
                      ->get();
      foreach ($candidates as $u) {
        $u->current_city = \App\City::where('id', $u->current_city_id)->first()->name;
      }

      foreach ($users as $u) {
        $u->rating = ($u->international_publications * 2) + $u->national_publications;
      }
      foreach ($matches as $u) {
        $u->rating = ($u->international_publications * 2) + $u->national_publications;
      }
      foreach ($candidates as $u) {
        $u->rating = ($u->international_publications * 2) + $u->national_publications;
      }
      foreach ($both as $u) {
        $u->rating = ($u->international_publications * 2) + $u->national_publications;
      }

      $users = collect($users)->sortByDesc('rating')->all();
      $matches = collect($matches)->sortByDesc('rating')->all();
      $candidates = collect($candidates)->sortByDesc('rating')->all();
      $both = collect($both)->sortByDesc('rating')->all();

      // return $matches;

      return view('vacancy_details', [
        'vacancy' => $v,
        'users' => $users,
        'matches' => $matches,
        'candidates' => $candidates,
        'both' => $both
      ]);
    }

    public function findVacancy () {
      $ids = [];

      $matches = \App\MatchForVacancy::where('user_id', \Auth::user()->id)->get();

      foreach ($matches as $m) {
        if (!in_array($m->vacancy_id, $ids)) {
          array_push($ids, $m->vacancy_id);
        }
      }

      $rejects = \App\RejectForVacancy::where('user_id', \Auth::user()->id)->get();

      foreach ($rejects as $r) {
        if (!in_array($r->vacancy_id, $ids)) {
          array_push($ids, $r->vacancy_id);
        }
      }

      $user = \App\User::where('id', \Auth::user()->id)->first();
      $profile = \App\UserProfile::where('user_id', \Auth::user()->id)->first();

      $vacancies = \DB::table('vacancies')
                    ->whereNotIn('id', $ids)
                    ->where('field_id', $user->field_id)
                    ->where('qualification_id', '<=', $user->qualification_id)
                    ->where('years', '<=', $profile->experience)
                    ->get();

      foreach ($vacancies as $v) {
        $i = \App\Institute::where('id', $v->institute_id)->first();
        $v->institute = $i->name;
        $v->city = \App\City::where('id', $i->city_id)->first()->name;
        $v->field = \App\Field::where('id', $v->field_id)->first()->name;
        $v->qualification = \App\Qualification::where('id', $v->qualification_id)->first()->name;
        $c = new Carbon($v->start_date);
        $v->start = $c->toFormattedDateString();
      }

      // Get matched users
      $matches = \App\MatchForVacancy::where('user_id', \Auth::user()->id)->get();
      foreach ($matches as $v) {
        $vac = \App\Vacancy::where('id', $v->vacancy_id)->first();
        $i = \App\Institute::where('id', $vac->institute_id)->first();
        $v->institute = $i->name;
        $v->city = \App\City::where('id', $i->city_id)->first()->name;
        $v->field = \App\Field::where('id', $vac->field_id)->first()->name;
        $v->qualification = \App\Qualification::where('id', $vac->qualification_id)->first()->name;
        $c = new Carbon($v->start_date);
        $v->start = $c->toFormattedDateString();
        $v->title = $vac->title;
        $v->description = $vac->description;
        $v->years = $vac->years;
      }

      // return $matches;

      return view('find_vacancy', [
        'vacancies' => $vacancies,
        'matches' => $matches
      ]);
    }

    public function vacancyapi ($user_id) {
      $ids = [];

      $matches = \App\MatchForVacancy::where('user_id', $user_id)->get();

      foreach ($matches as $m) {
        if (!in_array($m->vacancy_id, $ids)) {
          array_push($ids, $m->vacancy_id);
        }
      }

      $rejects = \App\RejectForVacancy::where('user_id', $user_id)->get();

      foreach ($rejects as $r) {
        if (!in_array($r->vacancy_id, $ids)) {
          array_push($ids, $r->vacancy_id);
        }
      }

      $user = \App\User::where('id', $user_id)->first();
      $profile = \App\UserProfile::where('user_id', $user_id)->first();

      $vacancies = \DB::table('vacancies')
                    ->whereNotIn('id', $ids)
                    ->where('field_id', $user->field_id)
                    ->where('qualification_id', '<=', $user->qualification_id)
                    ->where('years', '<=', $profile->experience)
                    ->get();

      foreach ($vacancies as $v) {
        $i = \App\Institute::where('id', $v->institute_id)->first();
        $v->institute = $i->name;
        $v->city = \App\City::where('id', $i->city_id)->first()->name;
        $v->field = \App\Field::where('id', $v->field_id)->first()->name;
        $v->qualification = \App\Qualification::where('id', $v->qualification_id)->first()->name;
        $c = new Carbon($v->start_date);
        $v->start_date = $c->toFormattedDateString();
      }

      return [
        'status' => true,
        'vacancies' => $vacancies
      ];
    }

    public function matchesapi ($user_id) {
      // Get matched users
      $matches = \App\MatchForVacancy::where('user_id', $user_id)->get();
      foreach ($matches as $v) {
        $vac = \App\Vacancy::where('id', $v->vacancy_id)->first();
        $i = \App\Institute::where('id', $vac->institute_id)->first();
        $v->institute = $i->name;
        $v->city = \App\City::where('id', $i->city_id)->first()->name;
        $v->field = \App\Field::where('id', $vac->field_id)->first()->name;
        $v->qualification = \App\Qualification::where('id', $vac->qualification_id)->first()->name;
        $c = new Carbon($v->start_date);
        $v->start_date = $c->toFormattedDateString();
        $v->title = $vac->title;
        $v->description = $vac->description;
        $v->years = $vac->years;
        $v->institute_id = $vac->institute_id;
      }

      return [
        'status' => true,
        'vacancies' => $matches
      ];
    }

    public function interestedapi ($user_id) {
      $matches = \DB::table('match_for_users')
              ->where('match_for_users.user_id', $user_id)
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

      return [
        'status' => true,
        'vacancies' => $matches
      ];
    }

    public function bothapi () {
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

      return [
        'status' => true,
        'vacancies' => $both,
      ];
    }
}