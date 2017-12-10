@extends('template')
@section('title', 'Vacancy Details')
@section('content')
<div class="row" style="border-top: 1px solid gray; padding-top: 20px;">
  <div class="col-md-12">
		<p class="control-label">{{ $vacancy->title }} ({{ $vacancy->years }} years experience)</p>
		<p class="control-label">{{ $vacancy->field }}</p>
		<p class="control-label">{{ $vacancy->description }}</p>
		<p class="control-label">Start Date: {{ $vacancy->start_date }}</p>
		<p class="control-label">Qualification: {{ $vacancy->qualification }}</p>
  	<a class="btn btn-primary" href="{{ url('deleteVacancy' , $vacancy->id) }}">Remove</a>
	</div>
</div>

@if (count($both) > 0)
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header" data-background-color="purple">
        <h4 class="title">Candidates where both of you are interested</h4>
      </div>
      <div class="card-content table-responsive">
        <table class="table">
            <thead class="text-primary">
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Current city</th>
                <th>Experience</th>
                <th>National Publications</th>
                <th>International Publications</th>
                <th>Score</th>
                <th>Resume</th>
            </thead>
            <tbody>
                @foreach ($both as $u)
                    <tr>
                        <td>{{ $u->first_name }}</td>
                        <td>{{ $u->middle_name }}</td>
                        <td>{{ $u->last_name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->phone }}</td>
                        <td>{{ $u->current_city }}</td>
                        <td>{{ $u->experience }} years</td>
                        <td>{{ $u->national_publications }}</td>
                        <td>{{ $u->international_publications }}</td>
                        <td>{{ $u->rating }}</td>
                        <td><a href="{{ $u->resume }}">Resume</a></td>
                    </tr>
                @endforeach                            
            </tbody>
        </table>
        </div>
    </div>
  </div>
</div>
@endif

@if (count($candidates) > 0)
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header" data-background-color="purple">
        <h4 class="title">Candidates interested in this Vacancy</h4>
      </div>
      <div class="card-content table-responsive">
        <table class="table">
            <thead class="text-primary">
            	<th>First Name</th>
            	<th>Middle Name</th>
            	<th>Last Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Current city</th>
				<th>Experience</th>
                <th>National Publications</th>
                <th>International Publications</th>
                <th>Score</th>
                <th>Resume</th>
            </thead>
            <tbody>
                @foreach ($candidates as $u)
                    <tr>
                        <td>{{ $u->first_name }}</td>
                        <td>{{ $u->middle_name }}</td>
                        <td>{{ $u->last_name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->phone }}</td>
                        <td>{{ $u->current_city }}</td>
                        <td>{{ $u->experience }} years</td>
                        <td>{{ $u->national_publications }}</td>
                        <td>{{ $u->international_publications }}</td>
                        <td>{{ $u->rating }}</td>
                        <td><a href="{{ $u->resume }}">Resume</a></td>
                    </tr>
                @endforeach                            
            </tbody>
        </table>
    	</div>
	</div>
  </div>
</div>
@endif
@if (count($matches) > 0)
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header" data-background-color="purple">
        <h4 class="title">Candidates you are interested in</h4>
      </div>
      <div class="card-content table-responsive">
        <table class="table">
            <thead class="text-primary">
            	<th>First Name</th>
            	<th>Middle Name</th>
            	<th>Last Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Current city</th>
							<th>Experience</th>
                            <th>National Publications</th>
                            <th>International Publications</th>
                            <th>Score</th>
                            <th>Resume</th>
            </thead>
            <tbody>
            	@foreach ($matches as $u)
            		<tr>
            			<td>{{ $u->first_name }}</td>
            			<td>{{ $u->middle_name }}</td>
            			<td>{{ $u->last_name }}</td>
            			<td>{{ $u->email }}</td>
            			<td>{{ $u->phone }}</td>
            			<td>{{ $u->current_city }}</td>
            			<td>{{ $u->experience }} years</td>
                        <td>{{ $u->national_publications }}</td>
                        <td>{{ $u->international_publications }}</td>
                        <td>{{ $u->rating }}</td>
                        <td><a href="{{ $u->resume }}">Resume</a></td>
            		</tr>
            	@endforeach
            </tbody>
        </table>
    	</div>
		</div>
	</div>
</div>
@endif

@if (count($users) > 0)
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header" data-background-color="purple">
        <h4 class="title">Eligible Candidates</h4>
      </div>
      <div class="card-content table-responsive">
        <table class="table">
            <thead class="text-primary">
            	<th>First Name</th>
            	<th>Middle Name</th>
            	<th>Last Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Current city</th>
							<th>Experience</th>
                            <th>National Publications</th>
                            <th>International Publications</th>
                            <th>Score</th>
                            <th>Resume</th>
							<th colspan="2">Interested?</th>
            </thead>
            <tbody>
            	@foreach ($users as $u)
            		<tr>
            			<td>{{ $u->first_name }}</td>
            			<td>{{ $u->middle_name }}</td>
            			<td>{{ $u->last_name }}</td>
            			<td>{{ $u->email }}</td>
            			<td>{{ $u->phone }}</td>
            			<td>{{ $u->current_city }}</td>
            			<td>{{ $u->experience }} years</td>
                        <td>{{ $u->national_publications }}</td>
                        <td>{{ $u->international_publications }}</td>
                        <td>{{ $u->rating }}</td>
                        <td><a href="{{ $u->resume }}">Resume</a></td>
            			<td>
            				<a href="{{ url('matchForUser/' . $vacancy->id, $u->user_id) }}" class="btn btn-success btn-xs choose-yes">Yes</a>
            			</td>
            			<td>
            				<a href="{{ url('rejectForUser/' . $vacancy->id, $u->user_id) }}" class="btn btn-danger btn-xs choose-no">No</a>
            			</td>
            		</tr>
            	@endforeach
            </tbody>
        </table>
    	</div>
		</div>
	</div>
</div>
@endif

@endsection