@extends('layout.app')
@section('content')
<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>User: {{$user->name}}</h3>
			</div>
	    </div> 
</div>

<div class="container mtb">
	 	<div class="row">
		 	<div class="col-md-10 col-md-offset-1">
		 		<h3 class="ctitle">Personal Info
		 		@if(!Auth::guest() && Auth::user()->userid == $user->userid) 
		 		<span class="pull-right" style="display:block"><a class="btn btn-info" href="/edit-profile"><i class="fa fa-edit"></i>Edit Profile</a></span>
		 		@endif

		 		</h3>
		 		<div class="hline"></div>
		 		
	
		 		
		 		<br>
		 		<div class="row">
		 			<label class="col-md-3">User Id : </label>
		 			<div class="col-md-9">{{$user->userid}}</div>
		 		</div>
		 		<div class="row">
		 			<label class="col-md-3">Name : </label>
		 			<div class="col-md-9">{{$user->name}}</div>
		 		</div>
		 		<div class="row">
		 			<label class="col-md-3">Email : </label>
		 			<div class="col-md-9">{{$user->email}}</div>
		 		</div>
		 		<div class="row">
		 			<label class="col-md-3">Phone No : </label>
		 			<div class="col-md-9">{{$user->phone}}</div>
		 		</div>
		 		<div class="row">
		 			<label class="col-md-3">Institute : </label>
		 			<div class="col-md-9">{{$user->institute}}</div>
		 		</div>
		 		<div class="row">
		 			<label class="col-md-3">Type of User : </label>
		 			<div class="col-md-9" style="text-transform: capitalize">{{$user->utype}}</div>
		 		</div>
		 		<div class="row">
		 			<label class="col-md-3">Roll No : </label>
		 			<div class="col-md-9">{{$user->roll_number}}</div>
		 		</div>
		 		<div class="row">
		 			<label class="col-md-3">Skills </label>
		 			<div class="col-md-9">
				 		@foreach($skills as $skill)
			 				<a class="btn btn-theme" href="/tags/{{$skill->tagname}}" role="button">{{$skill->tagname}}</a>
			 			@endforeach
	 				</div>
	 			</div>
		 		
		 	</div>
	 	</div>
	 	<hr>
	 	<div class="row">
		 	<div class="col-md-10 col-md-offset-1">
		 		<h3 class="ctitle">Projects by {{$user->name}}</h3>
		 		<div class="hline"></div>
		 		<br>
		 		@if(!Auth::guest() && Auth::user()->userid == $user->userid) 
		 				<a class="btn btn-success" href="/add-project">
		 					Add New Project
		 				</a>
		 					<br>	
		 		@endif
		 			
			 			@foreach($ownprojects as $ownproject)
			 			<p>
			 				<a href="/project/{{$ownproject->project_id}}" role="button"><i class="fa fa-angle-right"></i> <b>{{$ownproject->project_name}}</b></a>
			 			</p>
			 			@endforeach
			 		
			 		<br>
		 	</div>
		 </div>
		 <hr>
	 	<div class="row">
		 	<div class="col-md-10 col-md-offset-1">
		 		<h3 class="ctitle">Other's projects {{$user->name}}is working on</h3>
		 		<div class="hline"></div>
		 		<br>
		 		<table class="table">
			 				<tr>
			 				<th>Name of Project</th>
			 				<th>Working Status</th>
			 				<th>Remarks</th>
			 				<th>Started Working on</th>
							<th>Stopped Working on</th>
			 				</tr>
		 			
			 				@foreach($otherprojects as $project)
			 			<tr>
			 				<td>
			 					<a href="/project/{{$project->project_id}}" role="button"><i class="fa fa-angle-right"></i> <b>{{$project->project_name}}</b></a>
			 				</td>
			 				<td>{{$project->status}}</td>
			 				<td>{{$project->remarks}}</td>
			 				<td>{{$project->date}}</td>
			 				<td>{{$project->end_date}}</td>
			 			</tr>
			 			@endforeach
			 			
			 		</table>
		 		<br>
		 	</div>
		 </div>
	 </div>
	 
@endsection