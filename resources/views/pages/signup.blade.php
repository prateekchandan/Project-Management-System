@extends('layout.app')
@section('content')
<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>Register</h3>
			</div>
	    </div>
</div>
<div class="container mtb">
	<div>
		<div class="col-lg-8 col-lg-offset-2">
	 			<h4>Signup For Project Management System</h4>
	 			@if(isset($message))
	 			<div class="alert alert-danger" role="alert">
					  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					  {{$message}}
				</div>
	 			@endif
	 			<div class="alert alert-danger" role="alert" id="error-msg" style="display:none">
					  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					  <div id="error-content"></div>
				</div>
	     
	       
	 			<div class="hline"></div>
	 				<p></p>
		 			<form role="form" method="POST" onsubmit="return verify()">
		 				<input name="_token" value="{{csrf_token()}}" type="hidden" />
					  <div class="form-group">
					    <label for="uid">UserID <span style="color:red"><sup>*</sup></span></label>
					    <input type="text" class="form-control" name="uid" required>
					  </div>
					  <div class="form-group">
					    <label for="name">Name <span style="color:red"><sup>*</sup></span></label>
					    <input type="text" class="form-control" name="name" required>
					  </div>
					  <div class="form-group">
					    <label for="email">Email <span style="color:red"><sup>*</sup></span></label>
					    <input type="email" class="form-control" name="email" required>
					  </div>
					   <div class="form-group">
					    <label for="password">Password <span style="color:red"><sup>*</sup></span></label>
					    <input type="password" class="form-control" name="password" id="password" required>
					  </div>
					   
					  <div class="form-group">
					    <label for="repassword">Retype Password <span style="color:red"><sup>*</sup></span></label>
					    <input type="password" class="form-control" name="repassword" id="repassword" required>
					  </div>
					  <div class="form-group">
					    <label for="type">Who are you?<span style="color:red"><sup>*</sup></span></label>
					    <select class="form-control" name="utype">
					    	<option value="student">Student</option>
					    	<option value="professor">Professor</option>
					    	<option value="alumni">Alumni</option>
					    	<option value="other">Others</option>
					    </select>
					  </div>
					  <div class="form-group">
					    <label for="phone">Phone no</label>
					    <input type="text" class="form-control" name="phone">
					  </div>
					  <div class="form-group">
					    <label for="institute">Name of Institution</label>
					    <input type="text" class="form-control" name="institute" placeholder="IIT Bombay">
					  </div>
					  <div class="form-group">
					    <label for="institute">Roll no</label>
					    <input type="text" class="form-control" name="roll">
					  </div>
					  <button type="submit" class="btn btn-theme">Register</button>
					</form>
					<a href="/login" class="btn btn-theme">Already Registered?</a>
			</div>
		</div>
</div>

<script>
function verify(){
	var pass=$('#password').val(),repass=$('#repassword').val();
	console.log(repass);
	if(pass!=repass){
		$('#error-msg').css('display','block');
		$('#error-content').html('Password Mismatch');
		return false;
	}
	return true;
}
</script>
@endsection