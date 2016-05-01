@extends('layout.app')
@section('content')
<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>{{$project->project_name}}</h3>
			</div>
	    </div> 
</div>
<div class="container mtb">
	 	<div class="row">
	 	
	 		<div class="col-lg-8">
	 			<h4>Added By : <a href="/user/{{$project->userid}}">{{$project->name}}</a></h4>
	 			@if($admin==1)
	 				<a class="btn btn-primary" href="/edit-project/{{$project->project_id}}"><i class="fa fa-edit"></i>Edit this Project</a>
	 			@endif
	 			<hr>
	 			<h3 class="ctitle">Project Description</h3>
		 		<div class="hline"></div>
		 		<br>
		 		{!!$project->description!!}
		 		@if(sizeof($project->detailed_description)>10)
		 		<h3 class="ctitle">Detailed Description</h3>
		 		<div class="hline"></div>
		 		<br>
		 		{{$project->detailed_description}}
		 		<hr>
		 		@endif
		 		
		 		<h3 class="ctitle">People working on this project</h3>
		 		<div class="hline"></div>
		 		<br>
		 		<table class="table">
			 				<tr>
			 				<th>Name</th>
			 				<th>Working Status</th>
			 				<th>Remarks</th>
			 				<th>Started Working on</th>
							<th>Stopped Working on</th>
							@if($admin==1)
							<th>Action</th>
							@endif
			 				</tr>
		 			
			 			
			 			@foreach($users as $user)
			 				
			 			<tr>
			 				<td>
			 					<a href="/user/{{$user->userid}}" role="button"> <b>{{$user->name}}</b></a>
			 				</td>
			 				<td>{{$user->status}}</td>
			 				@if($admin==1)
			 				<td>
			 					<form action="/save-remarks" method="post">
			 						<input class="hidden" name="_token" value="csrf_token()">
			 						<input type="hidden" name="uid" value="{{$user->userid}}">
			 						<input type="hidden" name="pid" value="{{$project->project_id}}">
			 						<input class="form-control" name="remarks" value="{{$user->remarks}}" placeholder="Type remarks and press Enter">
			 					</form>
			 				</td>
			 				@else
			 				<td>{{$user->remarks}}</td>
			 				@endif
			 				<td>{{$user->date}}</td>
			 				<td>{{($user->end_date)!=""?$user->end_date:""}}</td>
			 				@if($admin==1)
			 					<td>
								@if($user->status=="applied")
									<a href="/change-working-status?pid={{$project->project_id}}&user={{$user->userid}}&action=accept" class="btn btn-xs btn-success">Accept</a>
									<a href="/change-working-status?pid={{$project->project_id}}&user={{$user->userid}}&action=delete" class="btn btn-xs btn-danger">Delete Request</a>
								@elseif($user->status=="working")
									<a href="/change-working-status?pid={{$project->project_id}}&user={{$user->userid}}&action=hold" class="btn btn-xs btn-warning">Put on Hold</a>
									<a href="/change-working-status?pid={{$project->project_id}}&user={{$user->userid}}&action=end" class="btn btn-xs btn-info">Completed Project</a>
								@elseif($user->status=="hold")
									<a href="/change-working-status?pid={{$project->project_id}}&user={{$user->userid}}&action=accept" class="btn btn-xs btn-success">Started Working</a>
									<a href="/change-working-status?pid={{$project->project_id}}&user={{$user->userid}}&action=end" class="btn btn-xs btn-info">Completed Project</a>
								@else
									<p class="bg-success">Completed</p>
								@endif
								
								</td>
							@endif
			 			</tr>
			 		
			 			 @endforeach
			 		</table>
		 		<br>
		 		@if($toapply==1)
		 		<a class="btn btn-primary" href="/apply-project/{{$project->project_id}}">Apply For this Project</a>
		 		@endif
		 		<hr>
		 		<h3 class="ctitle">Skills used in this project</h3>
		 		<div class="hline"></div>
		 		<br>
		 		<table class="table">
			 				<tr>
			 				<th>Skill</th>
			 				<th>No of Requirements</th>
			 				
			 				</tr>
		 			
			 			@foreach($tagmap as $map)
			 				
			 			<tr>
			 				<td><a href="/tags/{{$map->tagname}}"><b>{{$map->tagname}}</b></a></td>
			 				@if($admin==1)
			 				
				 				<td>	 
				 				<form method="post" action="/change-project-requirements">
			 						<input class="hidden" name="_token" value="csrf_token()">
				 				
				 				<div class="col-md-9">				
					 				<input type="number" name="req" class="form-control" value="{{$map->requirement}}">
					 				<input type="hidden" name="tagname" value="{{$map->tagname}}">
					 				<input type="hidden" name="pid" value="{{$project->project_id}}">
					 				<input type="hidden" name="_token" value="{{csrf_token()}}">
					 			</div>
					 			<div class="col-md-3">
					 				<button class="btn btn-success btn-small">Save</button>
					 			</div>
					 			</form>
				 				</td>
				 				
			 				
			 				@else
			 				<td>
			 					{{$map->requirement}}
			 				</td>
			 				@endif
			 			</tr>
			 		
			 			 @endforeach
			 		</table>
		 		<br>
			</div>
	 		
	 		
	 		<div class="col-lg-4">
		 		<h4>Search</h4>
		 		<div class="hline"></div>
		 			<p>
		 				<br/>
		 				<form action="/search">
		 				<input type="text" class="form-control" name="q" placeholder="Search projects or tags">
		 				</form>
		 			</p>
		 			
		 		<div class="spacing"></div>
		 	
		 		
		 		<h4>Browse Projects By Tags</h4>
		 		<div class="hline"></div>
		 			<p>
		 				@foreach($tags as $tag)
		 						<a class="btn btn-theme" href="/tags/{{$tag->tagname}}" role="button">{{$tag->tagname}}</a>
		            	@endforeach
		   
		 			</p>
	 		</div>
	 	</div>
	 </div>

@endsection