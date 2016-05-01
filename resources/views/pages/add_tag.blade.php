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
				<h3>Add New Tag</h3>
			</div>
	    </div> 
	</div>
	<div class="container mtb">
	 	<div class="row">
	 	<div class="col-md-10 col-md-offset-1">
	 		<h3 class="ctitle">
				Add New Tag
			</h3>
			<div class="hline"></div>
			<br>
		 	<form role="form" method="post" action="/add-tag">
		 		<input name="_token" type="hidden" value="{{csrf_token()}}"> 
		 		<div class="form-group row">
		 			<label class="col-md-3">Tag Name</label>
		 			<div class="col-md-9">
		 				<input name="tagname" type="text" placeholder="Name of Tag" class="form-control" required>
		 			</div>
		 		</div>
		 		
		 		<div class="form-group row">
		 			<div class="col-md-9 col-md-offset-3">
		 			<button type="submit" class="btn btn-theme">Add</button>
		 			</div>
		 		</div>
		 	</form>
		</div>
	 	
	 		
	 	</div>
	 </div>
	 

@endsection