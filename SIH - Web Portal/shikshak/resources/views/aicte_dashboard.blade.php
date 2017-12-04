@extends('template')
@section('title', 'AICTE Dashboard')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Institutes</h4>

            </div>
            
            <div class="card-content table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                	<th>Name</th>
                                	<th>City</th>
                                	<th>No. of teachears</th>
																	<th>No. of vacancies</th>
                                </thead>
                                <tbody>
                                    <tr class="danger">
                                    	<td>Babaria Institute of Technology</td>
                                    	<td>Vadodara</td>
                                    	<td>200</td>
																			<td>40</td>
                                    </tr>
                                    <tr>
                                    	<td>IIT Kanpur</td>
                                    	<td>IIT Kanpur</td>
                                    	<td>400</td>
																			<td>30</td>
                                    </tr>
                                    <tr>
                                    	<td>JSS</td>
                                    	<td>Vadodara</td>
                                    	<td>300</td>
																			<td>15</td>
                                    </tr>
                                </tbody>
                            </table>
</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Pending Institute Approvals</h4>

            </div>
            
            <div class="card-content table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                	<th>Name</th>
                                	<th>University</th>
                                	<th>City</th>
								<th colspan="2" style="text-align: center;">Action</th>
                                </thead>
                                <tbody>
                                    <tr>
                                    	<td>Babaria Institute of Technology</td>
                                    	<td>Gujarat Technological University</td>
                                    	<td>Vadodara</td>
									<td><button class="btn btn-success btn-xs">Approve</button></td>
									<td><button class="btn btn-danger btn-xs">Reject</button></td>
                                    </tr>
                                    <tr>
                                    	<td>IIT Kanpur</td>
                                    	<td>IIT Kanpur</td>
                                    	<td>Kanpur</td>
									<td><button class="btn btn-success btn-xs">Approve</button></td>
									<td><button class="btn btn-danger btn-xs">Reject</button></td>
                                    </tr>
                                    <tr>
                                    	<td>JSS</td>
                                    	<td>JSS</td>
                                    	<td>Noida</td>
									<td><button class="btn btn-success btn-xs">Approve</button></td>
									<td><button class="btn btn-danger btn-xs">Reject</button></td>
                                    </tr>	                                        
                                </tbody>
                            </table>
</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Pending Respresentative Approvals</h4>

            </div>
            
            <div class="card-content table-responsive">
                            <table class="table">
                                <thead class="text-primary">
                                	<th>Name</th>
                                	<th>Institute</th>
								<th colspan="2" style="text-align: center;">Action</th>
                                </thead>
                                <tbody>
                                    <tr>
                                    	<td>Soham Dodia</td>
                                    	<td>Babaria Institute of Technology</td>
									<td><button class="btn btn-success btn-xs">Approve</button></td>
									<td><button class="btn btn-danger btn-xs">Reject</button></td>
                                    </tr>
                                    <tr>
                                    	<td>Umang Galaiya</td>
                                    	<td>IIT Kanpur</td>
									<td><button class="btn btn-success btn-xs">Approve</button></td>
									<td><button class="btn btn-danger btn-xs">Reject</button></td>
                                    </tr>
                                    <tr>
                                    	<td>Zarrar Shaikh</td>
                                    	<td>JSS</td>
									<td><button class="btn btn-success btn-xs">Approve</button></td>
									<td><button class="btn btn-danger btn-xs">Reject</button></td>
                                    </tr>	                                        
                                </tbody>
                            </table>
</div>
        </div>
    </div>
</div>
@endsection