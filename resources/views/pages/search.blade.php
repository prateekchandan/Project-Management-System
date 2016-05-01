@extends('layout.app')
@section('content')
<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>Showing {{sizeof($projects)}} projects</h3>
			</div>
	    </div> 
</div>
<div class="container mtb">
	 	<div class="row">
	 	
	 		
	 		<div class="col-lg-8">
	 		@foreach($projects as $project)
	 			
			 		
			 		<h3 class="ctitle">
			 			<a href="/project/{{$project->project_id}}>">{{$project->project_name}}
			 			</a>
			 		</h3>
			 		<p>
				 		<csmall2>By: <a href="/user/{{$project->userid}}">{{$project->name}}</a></csmall2>
			 		</p>
			 		<p>
			 		{{$project->description}}
			 		</p>
			 		<p><a href="/project/{{$project->project_id}}">[Browse Project]</a></p>
			 		<div class="hline"></div>
			 		
			 		<div class="spacing"></div>
	 			
	 		
	 			@endforeach
	 			
		 		
	 		
		 		
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