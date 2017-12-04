@extends('template')
@section('title', 'Home')
@section('content')
@if (isset($superannuating) && count($superannuating) > 0)
  <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header" data-background-color="purple">
                  <h4 class="title">Superannuating in the next 6 months</h4>
              </div>
              <div class="card-content">
                      <div class="col-md-12">
                          <ul>
                            @foreach ($superannuating as $s)
                              <li>{{ $s->first_name }} {{ $s->middle_name }} {{ $s->last_name }} - {{ $s->superannuation }}</li>
                            @endforeach
                          </ul>
                      </div>
              </div>
          </div>
      </div>
  </div>
@endif

@if (isset($leaving) && count($leaving) > 0)
  <div class="row">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header" data-background-color="purple">
                  <h4 class="title">Leaving in the next 6 months</h4>
              </div>
              <div class="card-content">
                      <div class="col-md-12">
                          <ul>
                            @foreach ($leaving as $s)
                              <li>{{ $s->first_name }} {{ $s->middle_name }} {{ $s->last_name }} - {{ $s->leaving }}</li>
                            @endforeach
                          </ul>
                      </div>
              </div>
          </div>
      </div>
  </div>
@endif

@if (isset($leaving) || isset($vacancy))
<div class="row">
  <div class="col-md-12">
    <a href="{{ url('postVacancy') }}" class="btn btn-primary">Post Vacancy</a>
  </div>
</div>
@endif
@endsection