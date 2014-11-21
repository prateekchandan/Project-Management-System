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
		 		<h3 class="ctitle">Personal Info
		 		<% if(sessionuid!=null && sessionuid.equals(useruid)) {%>
		 		<span class="pull-right" style="display:block"><a class="btn btn-info" href="${pageContext.request.contextPath}/edit-profile"><i class="fa fa-edit"></i>Edit Profile</a></span>
		 		
		 		<% } %>
		 		</h3>
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
		 	<div class="col-md-10 col-md-offset-1">
		 		<h3 class="ctitle">Projects by <%=(String)request.getAttribute("name")%></h3>
		 		<div class="hline"></div>
		 		<br>
		 		<%
		 			if(sessionuid!=null && sessionuid.equals(useruid) && login!=null && login.equals("1"))
		 			{
		 				%>
		 				<a class="btn btn-success" href="${pageContext.request.contextPath}/add-project">
		 					Add New Project
		 				</a>
		 					<br>	
		 				<%
		 			}
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
		 	<div class="col-md-10 col-md-offset-1">
		 		<h3 class="ctitle">Other's projects <%=(String)request.getAttribute("name") %> is working on</h3>
		 		<div class="hline"></div>
		 		<br>
		 		<table class="table">
			 				<tr>
			 				<th>Name of Project</th>
			 				<th>Working Status</th>
			 				<th>Remarks</th>
			 				<th>Started Working on</th>
							<th>Stopped Working on</th>
			 				</tr>
		 			<% 
				 	op=(ResultSet)request.getAttribute("otherprojects");
			 		while(op.next()){
			 			String pname=op.getString("project_name");
			 			String pid=op.getString("project_id");
			 			String status=op.getString("status");
			 			String remarks=op.getString("remarks");
			 			String startdate=op.getString("date");
			 			String enddate=op.getString("end_date");
			 			
			 			%>
			 			
			 				
			 			<tr>
			 				<td>
			 					<a href="${pageContext.request.contextPath}/project/<%=pid %>" role="button"><i class="fa fa-angle-right"></i> <b><%=pname %></b></a>
			 				</td>
			 				<td><%=status %></td>
			 				<td><%=(remarks!=null &&remarks.equals(""))?"--":remarks %></td>
			 				<td><%=startdate %></td>
			 				<td><%=(enddate==null)?"--":enddate %></td>
			 			</tr>
			 		
			 			 <%
			 			}
			 		%>
			 		</table>
		 		<br>
		 	</div>
		 </div><%--/row --%>
	 </div><%--/container --%>
	 
	 
<%@ include file="footer.jsp"%>