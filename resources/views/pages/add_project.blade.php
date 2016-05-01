@extends('layout.app')
@section('content')
<style>
	.redactor_editor{
		min-height:200px;
	}
</style>
<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>Add New Project</h3>
			</div>
	    </div>
	</div>
	<div class="container mtb">
	 	<div class="row">
	 	<div class="col-md-10 col-md-offset-1">
	 		<h3 class="ctitle">
				Fill in Details to Add new Project
			</h3>
			<p>
				Note: All fields are compulsory
			</p>
			<div class="hline"></div>
			<br>
			@if(isset($message))
	 			<div class="alert alert-danger" role="alert">
					  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					  {{$message}}
				</div>
	 		@endif
		 	<form role="form" method="post">
		 		


		 		<input name="_token" type="hidden" value="{{csrf_token()}}"> 
		 		<div class="form-group row">
		 			<label class="col-md-3">Project Name</label>
		 			<div class="col-md-9">
		 				<input name="name" type="text" placeholder="Project Name" class="form-control" required>
		 			</div>
		 		</div>
		 		<div class="form-group row">
		 			<label class="col-md-3">Project Description</label>
		 			<div class="col-md-9">
		 				<textarea name="desc" id="pdesc" placeholder="Add detailed Project Description" class="form-control"></textarea>
		 			</div>
		 		</div>
		 		<div class="form-group row">
		 			<label class="col-md-3">Project Skills Requirements</label>
		 			<div class="col-md-9">
		 				<select class="form-control chosen-select" name="tags[]" multiple>
		 					@foreach($tags as $tag)
		 						<option>{{$tag->tagname}}</option>
		 					@endforeach
		 				</select>
		 			</div>
		 		</div>
		 		<div class="form-group row">
		 			<div class="col-md-9 col-md-offset-3">
		 			<a class="btn btn-success" data-toggle="modal" data-target="#tag-Modal" href="#">Or add New tag</a>
		 			</div>
		 		</div>
		 		<div class="form-group row">
		 			<div class="col-md-9 col-md-offset-3">
		 			<button type="submit" class="btn btn-theme">Submit</button>
		 			</div>
		 		</div>
		 	</form>
		</div>
	 	
	 		
	 	</div>
	 </div>
	 <script>
	 $(function()
			 {
			 $('#pdesc').redactor();
			});
	 $(".chosen-select").chosen({width: "100%" , height:"40px"});
	 </script>
<div class="modal fade" id="tag-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form method="post" action="/add-tag">
	<input name="_token" type="hidden" value="{{csrf_token()}}"> 


  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Tag</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
        	<label>
        		Enter Tag Name
        	</label>
        	<input name="tagname" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add Tag</button>
      </div>
    </div>
  </div>
</form>
</div>


@endsection