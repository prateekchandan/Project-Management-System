@extends('layout.app')
@section('content')
<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>Login</h3>
			</div>
	    </div> 
</div>
<div class="container mtb">
	<div>
		<div class="col-lg-8 col-lg-offset-2">
	 			<h4>Login Into Project Management System</h4>
	 			
	 			@if(isset($message))
	 			
	 			<div class="alert alert-danger" role="alert">
					  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					  {{$message}}
				</div>
	 			@endif
	     
	       
	 			<div class="hline"></div>
	 				<p></p>
		 			<form role="form" method="POST" action="/login">
		 				<input type="hidden" name="_token" value="{{csrf_token()}}" />

					  <div class="form-group">
					    <label for="name">UserID / email</label>
					    <input type="text" class="form-control" name="uid" required>
					  </div>
					  <div class="form-group">
					    <label for="password">Password</label>
					    <input type="password" class="form-control" name="password" required>
					  </div>
					  <button type="submit" class="btn btn-theme">Login</button>
					</form>
					<a href="/signup" class="btn btn-theme">New User?</a>
			</div>
		</div>
</div>

@endsection