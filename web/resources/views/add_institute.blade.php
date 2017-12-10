@extends('template')
@section('title', 'Add Institute')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Request to become an Institute Representative</h4>
            </div>
            <div class="card-content">
                <form method="post" action="{{ url('addRepresentative') }}">
                    <div class="row">
                        <div class="col-md-12">
													<div class="form-group">
														<label for="institute_name">Institute Names:</label>
														<select class="form-control" id="institute_name" name="institute_id">
															@foreach ($institutes as $institute)
																<option value="{{ $institute->id }}">{{ $institute->name }}</option>
															@endforeach
														</select>
													</div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">Request</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Add an institute</h4>
            </div>
            <div class="card-content">
                <form action="{{ url('addInstitute') }}" method="post">
                    <div class="row">
                        <div class="col-md-12">
				<div class="form-group label-floating">
					<label class="control-label">Name</label>
					<input type="text" class="form-control" name="name">
				</div>
                    	</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
				<div class="form-group label-floating">
					<label class="control-label">University</label>
					<input type="text" class="form-control" name="university">
				</div>
                    	</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
			<div class="form-group">
				<label for="city_id">Select City: </label>
				<select class="form-control" id="city_id" name="city_id">
					@foreach ($cities as $city)
						<option value="{{ $city->id }}">{{ $city->name }}</option>
					@endforeach
				</select>
			</div>
                        </div>
                    </div>
                   <div class="row">
                        <div class="col-md-12">
				<div class="form-group label-floating">
					<label class="control-label">Website</label>
					<input type="text" class="form-control" name="website" >
				</div>
                    	</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
				<div class="form-group label-floating">
					<label class="control-label">Logo Url</label>
					<input type="text" class="form-control" name="logo">
				</div>
                    	</div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right">ADD</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection