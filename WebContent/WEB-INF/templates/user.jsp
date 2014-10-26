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
<div class="container mtb">
	 	<div class="row">
		 	<div class="col-md-8 col-md-offset-2">
		 		<h3 class="ctitle">Personal Info</h3>
		 		<div class="hline"></div>
		 		<br>
		 		<div class="row">
		 			<label class="col-md-3">User Id : </label>
		 			<div class="col-md-9"><%= (String)request.getAttribute("uid")%></div>
		 		</div>
		 		<div class="row">
		 			<label class="col-md-3">Name : </label>
		 			<div class="col-md-9"><%= (String)request.getAttribute("name")%></div>
		 		</div>
		 		<div class="row">
		 			<label class="col-md-3">Email : </label>
		 			<div class="col-md-9"><%= (String)request.getAttribute("email")%></div>
		 		</div>
		 		<div class="row">
		 			<label class="col-md-3">Phone No : </label>
		 			<div class="col-md-9"><%= ((String)request.getAttribute("phone")!=""?(String)request.getAttribute("phone"):"--")%></div>
		 		</div>
		 		<div class="row">
		 			<label class="col-md-3">Institute : </label>
		 			<div class="col-md-9"><%= ((String)request.getAttribute("institute")!=""?(String)request.getAttribute("institute"):"--")%></div>
		 		</div>
		 		<div class="row">
		 			<label class="col-md-3">Type of User : </label>
		 			<div class="col-md-9" style="text-transform: capitalize"><%= (String)request.getAttribute("utype")%></div>
		 		</div>
		 		<div class="row">
		 			<label class="col-md-3">Roll No : </label>
		 			<div class="col-md-9"><%= ((String)request.getAttribute("roll")!=""?(String)request.getAttribute("roll"):"--")%></div>
		 		</div>
		 		<div class="row">
		 			<label class="col-md-3">Skills </label>
		 			<div class="col-md-9">
				 		<% 
				 		ResultSet rs=(ResultSet)request.getAttribute("skills");
			 					while(rs.next()){
			 						String skill=rs.getString("tagname");
			 						%>
			 						<a class="btn btn-theme" href="${pageContext.request.contextPath}/tags/<%=skill %>" role="button"><%=skill %></a>
			 						
			 						 <%
			 					}
			 			%>
	 				</div>
	 			</div>
		 		
		 	</div>
	 	</div><%--/row --%>
	 	<hr>
	 	<div class="row">
		 	<div class="col-md-8 col-md-offset-2">
		 		<h3 class="ctitle">Projects by <%=(String)request.getAttribute("name")%></h3>
		 		<div class="hline"></div>
		 		<br>
		 		<% 
				 	ResultSet op=(ResultSet)request.getAttribute("ownprojects");
			 		while(op.next()){
			 			String pname=op.getString("project_name");
			 			String pid=op.getString("project_id");
			 			%>
			 			<p>
			 				<a href="${pageContext.request.contextPath}/project/<%=pid %>" role="button"><i class="fa fa-angle-right"></i> <b><%=pname %></b></a>
			 			</p>
			 			
			 		
			 			 <%
			 			}
			 		%>
			 		<br>
		 	</div>
		 </div><%--/row --%>
		 <hr>
	 	<div class="row">
		 	<div class="col-md-8 col-md-offset-2">
		 		<h3 class="ctitle">Projects <%=(String)request.getAttribute("name") %> is working on</h3>
		 		<div class="hline"></div>
		 		<br>
		 			
		 		<br>
		 	</div>
		 </div><%--/row --%>
	 </div><%--/container --%>
	 
	 
<%@ include file="footer.jsp"%>