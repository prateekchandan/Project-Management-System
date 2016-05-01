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
					<form action="${pageContext.request.contextPath}/search">
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
 					<p><br/><a href="${pageContext.request.contextPath}/add-project" class="btn btn-theme">Add Project</a></p>
 				</div>
 				<div class="col-md-4">
 					<i class="fa fa-search"></i>
 					<h4>Browse Projects</h4>
 					<p>Among all the awesome Projects on this platform , increase your knowledge graph to infinity. Browse among multiple projects in our system and read about them. Also you can apply to work on that project.</p>
 					<p><br/><a href="${pageContext.request.contextPath}/projects" class="btn btn-theme">Browse Projects</a></p>
 				</div>
 				<div class="col-md-4">
 					<i class="fa fa-trophy"></i>
 					<h4>Maintain your Profile</h4>
 					<p>Add yourself to the Awesomeness by maintain your project Profile. This can serve you as your project resume where other people can see your work and remarks directly from your project creator.</p>
 					<p><br/><a href="${pageContext.request.contextPath}/edit-profile" class="btn btn-theme">Edit Profile</a></p>
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
            
            		<%
		 				
		 					ResultSet tags=(ResultSet)request.getAttribute("tags");
		 					while(tags.next()){ 
		 					%>
		 					<div class="portfolio-item graphic-design">
								<div class="he-wrap tpl6">
									<div class="" style="padding:4px;background:url('http://subtlepatterns.com/patterns/upfeathers.png') repeat scroll 0% 0% transparent">
										<div class="bg a0">
			                                <h3 class="a1"><%= tags.getString("tagname") %></h3>
			                                <a href="${pageContext.request.contextPath}/tags/<%=tags.getString("tagname")%>" class="dmbutton a2"><i class="fa fa-link"></i></a>
			                        	</div><!-- he bg -->
									</div><!-- he view -->		
								</div><!-- he wrap -->
							</div><!-- end col-12 -->
		 					<% }
		 				
		 				%>
				
                            
              
                    
            </div><!-- portfolio -->
        </div><!-- portfolio container -->
	 </div><!--/Portfoliowrap -->
	 
	 
	<!-- *****************************************************************************************************************
	 MIDDLE CONTENT
	 ***************************************************************************************************************** -->

	 <div class="container mtb">
	 	<div class="row">
	 		<div class="col-lg-4 col-lg-offset-1">
		 		<h4>More About Our Agency.</h4>
		 		<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
 				<p><br/><a href="about.html" class="btn btn-theme">More Info</a></p>
	 		</div>
	 		
	 		<div class="col-lg-3">
	 			<h4>Recent Projects</h4>
	 			<div class="hline"></div>
	 			<%
		 				
		 					ResultSet projects=(ResultSet)request.getAttribute("projects");
		 					while(projects.next()){ 
		 					%>
		 					<p><a href="${pageContext.request.contextPath}/project/<%= projects.getString("project_id") %>"><%= projects.getString("project_name") %></a></p>
		 		<% } %>
	 		
	 		</div>
	 		
	 		<div class="col-lg-3">
	 			<h4>Top Users</h4>
	 			<div class="hline"></div>
	 			<%
		 				
		 					ResultSet Users=(ResultSet)request.getAttribute("users");
		 					while(Users.next()){ 
		 					%>
		 					<p><a href="${pageContext.request.contextPath}/user/<%= Users.getString("userid") %>"><%= Users.getString("name") %></a></p>
		 		<% } %>
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
			 	<h3>OUR Team</h3>
			 	<div class="col-lg-4 col-md-4 col-sm-4">
			 		<h3><a href="http://www.prateekchandan.me">Prateek Chandan</a></h3>
			 	</div>
			 	<div class="col-lg-4 col-md-4 col-sm-4">
			 		<h3><a href="http://www.cse.iitb.ac.in/~anuragshirolkar/">Anurag Shirolkar</a></h3>
			 	</div>
			 	<div class="col-lg-4 col-md-4 col-sm-4">
			 		<h3><a href="http://www.cse.iitb.ac.in/~jvs/">JVS Shyam</a></h3>
			 	</div>
			 	
		 	</div>
		 </div>
	 </div>


@endsection