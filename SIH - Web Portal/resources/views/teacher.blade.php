@extends('template')
@section('title', 'Vacancies')
@section('content')

@if (count($both) > 0)
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Vacancies where you and Institute both are interested</h4> 
            </div>
            <div class="card-content">
            @foreach ($both as $v)
              <div class="row" style="border-top: 1px solid gray; padding-top: 20px;">
                  <div class="col-md-12">
                    <p><strong>{{ $v->institute }}, {{ $v->city }}</strong></p>
                    <p class="control-label">{{ $v->title }} ({{ $v->years }} years experience)</p>
                    <p class="control-label">{{ $v->field }}</p>
                    <p class="control-label">{{ $v->description }}</p>
                    <p class="control-label">Start Date: {{ $v->start }}</p>
                    <p class="control-label">Qualification: {{ $v->qualification }}</p>
                  </div>
              </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endif

@if (count($vacancies) > 0)
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Institutes interested in you</h4>									
            </div>
            <div class="card-content">
            @foreach ($vacancies as $v)
              <div class="row" style="border-top: 1px solid gray; padding-top: 20px;">
                  <div class="col-md-12">
                    <p><strong>{{ $v->institute }}, {{ $v->city }}</strong></p>
										<p class="control-label">{{ $v->title }} ({{ $v->years }} years experience)</p>
										<p class="control-label">{{ $v->field }}</p>
										<p class="control-label">{{ $v->description }}</p>
										<p class="control-label">Start Date: {{ $v->start }}</p>
										<p class="control-label">Qualification: {{ $v->qualification }}</p>
									</div>
            	</div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endif

@if (count($vacancies) < 1 && count($both) < 1)
<div class="row">
  <div class="col-md-12">
    <h4>No matches yet.</h4>
  </div>
</div>
@endif

@endsection('content')