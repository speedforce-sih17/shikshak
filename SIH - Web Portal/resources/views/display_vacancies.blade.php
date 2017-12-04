@extends('template')
@section('title', 'Vacancies')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Vacancies</h4>									
								<a href="{{ url('postVacancy') }}" class="btn btn-primary pull-right">Post Vacancy</a>
            </div>
            <div class="card-content">
            @foreach ($vacancies as $v)
              <div class="row" style="border-top: 1px solid gray; padding-top: 20px;">
                  <div class="col-md-12">
										<p class="control-label">{{ $v->title }} ({{ $v->years }} years experience)</p>
										<p class="control-label">{{ $v->field }}</p>
										<p class="control-label">{{ $v->description }}</p>
										<p class="control-label">Start Date: {{ $v->start_date }}</p>
										<p class="control-label">Qualification: {{ $v->qualification }}</p>
                  	<a class="btn btn-primary" href="{{ url('vacancy' , $v->id) }}">More about this Vacancy</a>
                  	<a class="btn btn-primary" href="{{ url('deleteVacancy' , $v->id) }}">Remove</a>
									</div>
            	</div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection('content')