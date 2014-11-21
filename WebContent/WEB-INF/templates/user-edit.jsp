<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"
      %>
<%@ include file="header.jsp"%>
<%@ page import="java.sql.*"%>
<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>User: <%= (String)request.getAttribute("name")%></h3>
			</div><%-- /row --%>
	    </div> <%-- /container --%>
</div>
<%
	String sessionuid=(String)session.getAttribute("uid");
	String useruid=(String)request.getAttribute("uid");
%>
	<div class="container mtb">
	 	<div class="row">
		 	<div class="col-md-10 col-md-offset-1">
		 		<h3 class="ctitle">Edit your Profile
		 		</h3>
		 		<div class="hline"></div>
		 		
		 		<div class="row">
		 			<div class="col-md-12">
		 				<form method="post" class="form">
		 				<br>
							<div class="form-group row">
								<label class="col-md-3">
								User Id :
								</label>
								<div class="col-md-9">
								<input class="form-control" value="${uid}" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3">
								Name :
								</label>
								<div class="col-md-9">
								<input name="name" class="form-control" value="${name}" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3">
								Email :
								</label>
								<div class="col-md-9">
								<input name="email" type="email" class="form-control" value="${email}" required>
								</div>
							</div>
							
							<div class="form-group row">
								<label class="col-md-3">
								Phone No :
								</label>
								<div class="col-md-9">
								<input name="phone" class="form-control" value="${phone}">
								</div>
							</div>
							<div class="form-group row">
								<label class="col-md-3">
								Institute :
								</label>
								<div class="col-md-9">
								<input name="institute" class="form-control" value="${institute}">
								</div>
							</div>
							<div class="form-group row">
							    <label class="col-md-3" for="type">Who are you?</label>
							   	<div class="col-md-9">
								    <select class="form-control" name="utype">
								    	<option value="student" <% if (request.getAttribute("utype").equals("student")) { %> selected <% } %> >Student</option>
								    	<option value="professor" <% if (request.getAttribute("utype").equals("professor")) { %> selected <% } %>>Professor</option>
								    	<option value="alumni" <% if (request.getAttribute("utype").equals("alumni")) { %> selected <% } %>>Alumni</option>
								    	<option value="other" <% if (request.getAttribute("utype").equals("other")) { %> selected <% } %>>Others</option>
								    </select>
							    </div>
							</div>
							<div class="form-group row">
								<label class="col-md-3">
								Roll No:
								</label>
								<div class="col-md-9">
								<input name="roll" class="form-control" value="${roll}">
								</div>
							</div>
							
							<div class="form-group row">
					 			<label class="col-md-3">Update your Skills</label>
					 			<div class="col-md-9">
					 				<select class="form-control chosen-select" name="tags" multiple>
					 					<%
					 				
					 					ResultSet tags=(ResultSet)request.getAttribute("tags");
					 					while(tags.next()){ 
					 					%>
					 						<option><%= tags.getString("tagname") %></option>
					 					<% }
					 				
					 				%>
					 				</select>
					 			</div>
					 		</div>
					 		<div class="col-md-9 col-md-offset-3">
						 		<a href="${pageContext.request.contextPath}/add-tag">Click here to add more tags</a>
						 		<br>
						 		<button class="btn btn-theme">Update</button>
					 		</div>
						</form> 
		 			</div>
		 		</div>
				
		 		
		 		
		 		
		 		
		 	</div>
	 	</div><%--/row --%>

	 </div><%--/container --%>
	 <script>
	  $(".chosen-select").chosen({width: "100%" , height:"40px"});
	 </script>
	 
<%@ include file="footer.jsp"%>