<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"
      %>
<%@ include file="header.jsp"%>
<%@ page import="java.sql.*"%>
<style>
	.redactor_editor{
		min-height:200px;
	}
</style>
<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>Add New Project</h3>
			</div><%-- /row --%>
	    </div> <%-- /container --%>
	</div>
	<div class="container mtb">
	 	<div class="row">
	 	<div class="col-md-10 col-md-offset-1">
	 		<h3 class="ctitle">
				Fill in Details to Edit ${pname}
			</h3>
			<p>
				Note: All fields are compulsory
			</p>
			<div class="hline"></div>
			<br>
			<%
	 				if(request.getAttribute("message")==null)
	 				{
	 			%>
	 			
	 			<%
	 			}
	 			else
	 			{%>
	 			<div class="alert alert-danger" role="alert">
					  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					  <%=request.getAttribute("message")%>
				</div>
	 			<%} %>
		 	<form role="form" method="post">
		 		<div class="form-group row">
		 			<label class="col-md-3">Project Name</label>
		 			<div class="col-md-9">
		 				<input name="name" type="text" placeholder="Project Name" class="form-control" value="${pname}" required>
		 			</div>
		 		</div>
		 		<div class="form-group row">
		 			<label class="col-md-3">Project Description</label>
		 			<div class="col-md-9">
		 				<div name="desc" id="desc" placeholder="Add detailed Project Description" class="form-control">${desc}</div>
		 			</div>
		 		</div>
		 		<div class="form-group row">
		 			<label class="col-md-3">Detailed Description</label>
		 			<div class="col-md-9">
		 				<div name="d_desc" id="d_desc" placeholder="Add detailed Project Description" class="form-control">${d_desc}</div>
		 			</div>
		 		</div>
		 		<div class="form-group row">
		 			<label class="col-md-3">Project Skills Requirements</label>
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
	 	
	 		
	 	</div><%--/row --%>
	 </div><%--/container --%>
	 <script>
	 $(function()
			 {
			 $('#desc').redactor();
			});
	 $(function()
			 {
			 $('#d_desc').redactor();
			});
	 $(".chosen-select").chosen({width: "100%" , height:"40px"});
	 </script>
<%@ include file="tagmodal.jsp"%>
<%@ include file="footer.jsp"%>
