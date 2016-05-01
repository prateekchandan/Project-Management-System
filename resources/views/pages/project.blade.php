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
	 				<a class="btn btn-primary" href="/edit-project/{{$project->project_project_id}}"><i class="fa fa-edit"></i>Edit this Project</a>
	 			@endif
	 			<hr>
	 			<h3 class="ctitle">Project Description</h3>
		 		<div class="hline"></div>
		 		<br>
		 		{{$project->description}}
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
		 			<% 
		 			
				 	ResultSet op=(ResultSet)request.getAttribute("users");
			 		while(op.next()){
			 			String pname=op.getString("name");
			 			String pid=op.getString("userid");
			 			String status=op.getString("status");
			 			String remarks=op.getString("remarks");
			 			String startdate=op.getString("date");
			 			String enddate=op.getString("end_date");
			 			if(status.equals("hold"))
			 			{
			 				status="On Hold";
			 			}
			 			
			 			%>
			 			
			 			@foreach($users as $user)
			 				
			 			<tr>
			 				<td>
			 					<a href="/user/{{$user->userid}}" role="button"> <b>{{$user->name}}</b></a>
			 				</td>
			 				<td>{{$user->status}}</td>
			 				@if($admin==1)
			 				<td>
			 					<form action="/save-remarks" method="post">
			 						<input type="hidden" name="uid" value="<%=pid %>">
			 						<input class="form-control" name="remarks" value="<%=remarks%>" placeholder="Type remarks and press Enter">
			 						<input type="hidden" name="pid" value="${pid}">
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
									<a href="/change-working-status?pid=${pid}&user=<%=pid%>&action=accept" class="btn btn-xs btn-success">Accept</a>
									<a href="/change-working-status?pid=${pid}&user=<%=pid%>&action=delete" class="btn btn-xs btn-danger">Delete Request</a>
								@elseif($user->status=="working")
									<a href="/change-working-status?pid=${pid}&user=<%=pid%>&action=hold" class="btn btn-xs btn-warning">Put on Hold</a>
									<a href="/change-working-status?pid=${pid}&user=<%=pid%>&action=end" class="btn btn-xs btn-info">Completed Project</a>
								@elseif($user->status=="On Hold")
									<a href="/change-working-status?pid=${pid}&user=<%=pid%>&action=accept" class="btn btn-xs btn-success">Started Working</a>
									<a href="/change-working-status?pid=${pid}&user=<%=pid%>&action=end" class="btn btn-xs btn-info">Completed Project</a>
								@else
									<p class="bg-success">Completed</p>
								@endif
								
								</td>
							@endif
			 			</tr>
			 		
			 			 @endforeach
			 		</table>
		 		<br>
		 		<%
		 		String toapply=(String)request.getAttribute("toapply");
		 		if(toapply!=null && toapply.equals("1") ){%>
		 		<a class="btn btn-primary" href="/apply-project?id=${pid}">Apply For this Project</a>
		 		<%} %>
		 		<hr>
		 		<h3 class="ctitle">Skills used in this project</h3>
		 		<div class="hline"></div>
		 		<br>
		 		<table class="table">
			 				<tr>
			 				<th>Skill</th>
			 				<th>No of Requirements</th>
			 				
			 				</tr>
		 			<% 
				 	ResultSet tset=(ResultSet)request.getAttribute("tagset");
			 		while(tset.next()){
			 			String tname=tset.getString("tagname");
			 			String req=tset.getString("requirement");
			 			%>
			 			@foreach($tagmap as $map)
			 				
			 			<tr>
			 				<td><a href="/tags/<%=tname %>"><b>{{$map->tagname}}</b></a></td>
			 				@if($admin==1)
			 				
				 				<td>	 
				 				<form method="post" action="/change-project-requirements">
				 				<div class="col-md-9">				
					 				<input type="number" name="req" class="form-control" value="<%=req%>">
					 				<input type="hidden" name="tagname" value="<%=tname %>">
					 				<input type="hidden" name="pid" value="${pid}">
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