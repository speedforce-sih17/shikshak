<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('aicte', function () {
  return view('aicte_dashboard');
});

Route::get('logout', function () {
  Auth::logout();
  return redirect('/');
});

Route::get('login', function () {
  return view('login');
})->name('login');
Route::post('login', 'LoginController@post');

Route::get('signup', function () {
  $cities = \App\City::all();
  $fields = \App\Field::all();
  $qualifications = \App\Qualification::all();
  return view('signup', [
    'cities' => $cities,
    'fields' => $fields,
    'qualifications' => $qualifications
  ]);
});
Route::post('signup', 'SignupController@post');

Route::group(['middleware' => 'auth'], function () {
  Route::get('/', 'WelcomeController@index');

  Route::get('instituteActions', function () {
    $ins = \App\Institute::all();
    $cities = \App\City::all();
    return view('add_institute', [
      'institutes' => $ins,
      'cities' => $cities
    ]);
  });

  Route::get('postVacancy', function () {
    $fields = \App\Field::all();
    $qualifications = \App\Qualification::all();
    return view('post_vacancy', [
      'fields' => $fields,
      'qualifications' => $qualifications
    ]);
  });

  Route::post('addInstitute', 'InstituteController@addInstitute');
  Route::post('addRepresentative', 'InstituteController@addRepresentative');
  Route::post('addVacancy', 'VacancyController@post');

  Route::get('deleteVacancy/{id}', 'VacancyController@delete');

  Route::get('vacancies', 'VacancyController@showVacancies');
  Route::get('vacancy/{id}', 'VacancyController@showVacancyDetails');

  Route::get('employment', 'EmploymentController@current');
  Route::post('addEmployment', 'EmploymentController@add');
  Route::post('endEmployment', 'EmploymentController@end');

  Route::get('matchForUser/{v_id}/{u_id}', 'MatchController@forUser');
  Route::get('rejectForUser/{v_id}/{u_id}', 'RejectController@forUser');

  Route::get('matchForVacancy/{v_id}/{u_id}', 'MatchController@forVacancy');
  Route::get('rejectForVacancy/{v_id}/{u_id}', 'RejectController@forVacancy');
  Route::get('me', 'WelcomeController@me');
  Route::get('find/vacancy', 'VacancyController@findVacancy');
});

Route::group(['prefix' => 'api'], function () {

  Route::get('cities', function () {
    $city = \App\City::all();
    return $city;
  });

  Route::post('signup', 'SignupController@api');
  Route::post('login', 'LoginController@api');
  Route::get('vacancies/{id}', 'VacancyController@vacancyapi');
  Route::get('matches/{id}', 'VacancyController@matchesapi');
  Route::get('interested/{id}', 'VacancyController@matchesapi');
  Route::get('both/{id}', 'VacancyController@bothapi');
  Route::get('matchForVacancy/{v_id}/{u_id}', 'MatchController@forVacancyapi');
  Route::get('rejectForVacancy/{v_id}/{u_id}', 'RejectController@forVacancyapi');

  Route::get('insertstate', function () {
    $city = new \App\State;
    $city->name = 'Gujarat';
    $city->save();

    $city = new \App\State;
    $city->name = 'Maharashtra';
    $city->save();

    $city = new \App\State;
    $city->name = 'Rajasthan';
    $city->save();
  });

  Route::get('insertcity', function () {
    $city = new \App\City;
    $city->state_id = 1;
    $city->name = 'Vadodara';
    $city->save();

    $city = new \App\City;
    $city->state_id = 1;
    $city->name = 'Ahmedabad';
    $city->save();

    $city = new \App\City;
    $city->state_id = 3;
    $city->name = 'Jaipur';
    $city->save();

    $city = new \App\City;
    $city->state_id = 2;
    $city->name = 'Mumbai';
    $city->save();

    $city = new \App\City;
    $city->state_id = 2;
    $city->name = 'Pune';
    $city->save();
  });

  Route::get('insertqualifications', function () {
    $q = new \App\Qualification;
    $q->name = 'Bachelor\'s';
    $q->save();
    $q = new \App\Qualification;
    $q->name = 'Master\'s';
    $q->save();
    $q = new \App\Qualification;
    $q->name = 'Doctorate\'s';
    $q->save();
    $q = new \App\Qualification;
    $q->name = 'Other';
    $q->save();
  });

  Route::get('insertfields', function () {
    $f = new \App\Field;
    $f->name = 'Computer Engineering';
    $f->save();

    $f = new \App\Field;
    $f->name = 'Electrical Engineering';
    $f->save();

    $f = new \App\Field;
    $f->name = 'Chemical Engineering';
    $f->save();

    $f = new \App\Field;
    $f->name = 'Mechanical Engineering';
    $f->save();
  });

});