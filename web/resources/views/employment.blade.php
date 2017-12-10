@extends('template')
@section('title', 'Current Employment')
@section('content')
@if ($showAdd)
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header" data-background-color="purple">
	                <h4 class="title">Current Employement</h4>
	            </div>
	            <div class="card-content">
	                <form method="post" action="{{ url('addEmployment') }}">
	                    <div class="col-md-12">
	                        <div class="form-group">
	                            <label for="field">Institute Name:</label>
					                    <select class="form-control" id="field" name="institute_id">
					                        @foreach ($institutes as $i)
					                        	<option value="{{ $i->id }}">{{ $i->name }}</option>
					                        @endforeach
					                    </select>
	                        </div>
													<div class="form-group label-floating">
														<label for="startdate">Start date:</label>
										  			<input type="date" class="form-control" id="startdate" name="start_date" required>
													</div>
		                    	<button type="submit" class="btn btn-primary pull-left">Add</button>
	                    </div>                    
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
@endif
@if ($showTerminate)
	<div class="row">
	    <div class="col-md-12">
	        <div class="card">
	            <div class="card-header" data-background-color="purple">
	                <h4 class="title">Terminate Employement</h4>
	            </div>
	            <div class="card-content">
	                <form method="post" action="{{ url('endEmployment') }}">
	                	<div class="row">
	                        <div class="col-md-12">
														<div class="form-group label-floating">
															<p>{{ $worksAt->institute }}</p>
															<p>Started on {{ $worksAt->start_date }}</p>
														</div>
														<div class="form-group label-floating">
															<label for="enddate">End date:</label>
											  			<input type="date" class="form-control" id="enddate" name="end_date" required>
														</div>
	                    			<button type="submit" class="btn btn-primary pull-left">Terminate</button>
	                        </div>
	                    </div> 
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
@endif
@endsection