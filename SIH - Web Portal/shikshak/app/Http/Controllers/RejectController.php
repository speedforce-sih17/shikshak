<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RejectController extends Controller
{
    public function forUser ($v_id, $u_id) {
      $m = new \App\RejectForUser;
      $m->user_id = $u_id;
      $m->vacancy_id = $v_id;
      $m->save();
      return redirect('vacancy/' . $v_id);
    }

    public function forVacancy ($v_id, $u_id) {
      $m = new \App\RejectForVacancy;
      $m->user_id = $u_id;
      $m->vacancy_id = $v_id;
      $m->save();
      return redirect('find/vacancy');
    }

    public function forVacancyapi ($v_id, $u_id) {
      $m = new \App\RejectForVacancy;
      $m->user_id = $u_id;
      $m->vacancy_id = $v_id;
      $m->save();
      return [
        'status' => true
      ];
    }
}
