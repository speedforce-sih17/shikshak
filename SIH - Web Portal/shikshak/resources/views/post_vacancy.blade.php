@extends('template')
@section('title', 'Add Vacancy')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Post a vacancy</h4>

            </div>
            <div class="card-content">
                <form method="post" action="{{ url('addVacancy') }}">
                    <div class="row">
                        <div class="col-md-12">
			<div class="form-group label-floating">
				<label class="control-label">Title</label>
				<input type="text" class="form-control" name="title">
			</div>
                        </div>    
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field">Field:</label>
                    <select class="form-control" id="field" name="field_id">
                        @foreach ($fields as $f)
                            <option value="{{ $f->id }}">{{ $f->name }}</option>
                        @endforeach
                    </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="minimum_qualification">Minimum qualification:</label>
                    <select class="form-control" id="minimum_qualification" name="qualification_id">
                        @foreach ($qualifications as $q)
                            <option value="{{ $q->id }}">{{ $q->name }}</option>
                        @endforeach
                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
			<div class="form-group label-floating">
				<label class="control-label">Experience(years)</label>
				<input type="number" class="form-control" name="years">
			</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
			<div class="form-group label-floating">
				<label for="startdate">Start date:</label>
  								<input type="date" class="form-control" id="startdate" name="start_date" required>
			</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
			<div class="form-group label-floating">
				<label class="control-label">Description</label>
				<input type="text" class="form-control" name="description">
			</div>
                        </div>    
                    </div>

                    <button type="submit" class="btn btn-primary pull-right">Post</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection