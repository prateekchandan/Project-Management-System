@extends('layout.app')
@section('content')

<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>
				@if(!isset($message))
				Error Occured (Page Not Found)
				@else
				{{$message}}
				@endif
				</h3>
			</div>
	    </div> 
</div>

<div class="container mtb">
	<div class="row">
	 		<div class="col-lg-12">	 			
		 		<img style="width:100%" class="img-responsive" src="/assets/img/error.jpg">
	
			</div>
	 		
	 		
	 	</div>
</div>
@endsection