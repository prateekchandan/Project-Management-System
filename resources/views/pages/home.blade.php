@extends('layout.app')
@section('content')

<style>
	.btn-search{
		position:absolute;
		right:10px;
		background:transparent;
		top:0px;
	}
</style>
	<!-- *****************************************************************************************************************
	 HEADERWRAP
	 ***************************************************************************************************************** -->
	<div id="headerwrap">
	    <div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
					<h3>Show your work with this system</h3>
					<h1>Project Management System	</h1>
					<h5>Add your project , document it , let people apply to work on your project and you can work on other's too.</h5>
					<h5>Start by searching a project</h5>				
				</div>
				<br>
				<div class="col-lg-8 col-lg-offset-2 himg">
					<form action="/search">
		 				<input type="text" class="form-control" name="q" id="search-box" placeholder="Search projects or tags">
		 				<button class="btn btn-search"> <i class="fa fa-search"></i></button>
		 			</form>
				</div>
			</div><!-- /row -->
	    </div> <!-- /container -->
	</div><!-- /headerwrap -->

	<!-- *****************************************************************************************************************
	 SERVICE LOGOS
	 ***************************************************************************************************************** -->
	 <div id="service">
	 	<div class="container">
 			<div class="row centered">
 				<div class="col-md-4">
 					<i class="fa fa-heart-o"></i>
 					<h4>Add your Project</h4>
 					<p>Show your skills and add your project awesomely on this platform and let people see and learn from it</p>
 					<p><br/><a href="/add-project" class="btn btn-theme">Add Project</a></p>
 				</div>
 				<div class="col-md-4">
 					<i class="fa fa-search"></i>
 					<h4>Browse Projects</h4>
 					<p>Among all the awesome Projects on this platform , increase your knowledge graph to infinity. Browse among multiple projects in our system and read about them. Also you can apply to work on that project.</p>
 					<p><br/><a href="/projects" class="btn btn-theme">Browse Projects</a></p>
 				</div>
 				<div class="col-md-4">
 					<i class="fa fa-trophy"></i>
 					<h4>Maintain your Profile</h4>
 					<p>Add yourself to the Awesomeness by maintain your project Profile. This can serve you as your project resume where other people can see your work and remarks directly from your project creator.</p>
 					<p><br/><a href="/edit-profile" class="btn btn-theme">Edit Profile</a></p>
 				</div>		 				
	 		</div>
	 	</div>
	 </div>
	 
	<!-- *****************************************************************************************************************
	 PORTFOLIO SECTION
	 ***************************************************************************************************************** -->
	 <div id="portfoliowrap">
        <h3>Browse From Multiple Tags</h3>

        <div class="portfolio-centered">
            <div class="recentitems portfolio">
            
            		@foreach($tags as $tag)
		 					<div class="portfolio-item graphic-design">
								<div class="he-wrap tpl6">
									<div class="" style="padding:4px;background:url('http://subtlepatterns.com/patterns/upfeathers.png') repeat scroll 0% 0% transparent">
										<div class="bg a0">
			                                <h3 class="a1">{{$tag->tagname}}</h3>
			                                <a href="/tags/{{$tag->tagname}}" class="dmbutton a2"><i class="fa fa-link"></i></a>
			                        	</div><!-- he bg -->
									</div><!-- he view -->		
								</div><!-- he wrap -->
							</div><!-- end col-12 -->
		 					@endforeach
				
                            
              
                    
            </div><!-- portfolio -->
        </div><!-- portfolio container -->
	 </div><!--/Portfoliowrap -->
	 
	 
	<!-- *****************************************************************************************************************
	 MIDDLE CONTENT
	 ***************************************************************************************************************** -->

	 <div class="container mtb">
	 	<div class="row">
	 		<div class="col-lg-4 col-lg-offset-1">
		 		<h4>More About Our Project.</h4>
		 		<p>Project Workflow management system is a Web-based PHP application where students, professors and alumni from a particular institute or different institutes can list up the current projects they are working on or have previously worked upon or planning to work in the future.
		 		</p>
 				<p><br/><a href="about.html" class="btn btn-theme">More Info</a></p>
	 		</div>
	 		
	 		<div class="col-lg-3">
	 			<h4>Recent Projects</h4>
	 			<div class="hline"></div>
	 			@foreach($projects as $project)
		 					<p><a href="/project/{{$project->project_id}}">{{$project->project_name}}</a></p>
		 		@endforeach
	 		
	 		</div>
	 		
	 		<div class="col-lg-3">
	 			<h4>Top Users</h4>
	 			<div class="hline"></div>
	 			@foreach($users as $user)
	 			
		 					<p><a href="/user/{{$user->userid}}">{{$user->name}}</a></p>
		 		@endforeach
	 		</div>
	 		
	 	</div>
	 </div>
	 
	<!-- *****************************************************************************************************************
	 TESTIMONIALS
	 ***************************************************************************************************************** -->
	 <div id="twrap">
	 	<div class="container centered">
	 		<div class="row">
	 			<div class="col-lg-8 col-lg-offset-2">
	 			<i class="fa fa-comment-o"></i>
	 			<p>This project is going to be very much helpful to the students and professors of students all over India. It will help people to learn and get educated by other's work. Once built up properly it has the potential to be a huge database  As big as even wikipedia</p>
	 			<h4><br/>An Old Monk</h4>
	 			<p>Master of Universe</p>
	 			</div>
	 		</div>
	 	</div>
	 </div>
	 
	<!-- *****************************************************************************************************************
	 OUR CLIENTS
	 ***************************************************************************************************************** -->
	 <div id="cwrap">
		 <div class="container">
		 	<div class="row centered">
			 	<h2>OUR Team</h2>
			 	<div class="col-lg-4 col-md-4 col-sm-4 col-md-offset-2 col-lg-offset-2 col-sm-offset-2">
			 		<h2><a href="http://www.cse.iitb.ac.in/~jvs/">Shyam JVS</a></h2>
			 	</div>
			 	<div class="col-lg-4 col-md-4 col-sm-4">
			 		<h2><a href="http://www.cse.iitb.ac.in/~vikasgarg/">Vikas Garg</a></h2>
			 	</div>
		 	</div>
		 </div>
	 </div>


@endsection