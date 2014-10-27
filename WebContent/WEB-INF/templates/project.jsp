<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"
      %>
<%@ include file="header.jsp"%>
<%@ page import="java.sql.*"%>
<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>${pname}</h3>
			</div><%-- /row --%>
	    </div> <%-- /container --%>
</div>
<div class="container mtb">
	 	<div class="row">
	 	
	 		<%-- BLOG POSTS LIST --%>
	 		<div class="col-lg-8">
	 			<h4>Added By : <a href="${pageContext.request.contextPath}/user/${uid}">${uname}</a></h4>
	 			
	 			<hr>
	 			<h3 class="ctitle">Project Description</h3>
		 		<div class="hline"></div>
		 		<br>
		 		${desc}
		 		
		 		<h3 class="ctitle">People working on this project</h3>
		 		<div class="hline"></div>
		 		<br>
		 		<table class="table">
			 				<tr>
			 				<th>Name</th>
			 				<th>Working Status</th>
			 				<th>Remarks</th>
			 				<th>Started Working on</th>
							<th>Stopped Working on</th>
			 				</tr>
		 			<% 
				 	ResultSet op=(ResultSet)request.getAttribute("users");
			 		while(op.next()){
			 			String pname=op.getString("name");
			 			String pid=op.getString("userid");
			 			String status=op.getString("status");
			 			String remarks=op.getString("remarks");
			 			String startdate=op.getString("date");
			 			String enddate=op.getString("end_date");
			 			
			 			%>
			 			
			 				
			 			<tr>
			 				<td>
			 					<a href="${pageContext.request.contextPath}/user/<%=pid %>" role="button"> <b><%=pname %></b></a>
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
			</div><%--/col-lg-8 --%>
	 		
	 		
	 		<%-- SIDEBAR --%>
	 		<div class="col-lg-4">
		 		<h4>Search</h4>
		 		<div class="hline"></div>
		 			<p>
		 				<br/>
		 				<input type="text" class="form-control" placeholder="Search something">
		 			</p>
		 			
		 		<div class="spacing"></div>
		 	
		 		
		 		<h4>Browse Projects By Tags</h4>
		 		<div class="hline"></div>
		 			<p>
		 				<%
		 				
		 					ResultSet tags=(ResultSet)request.getAttribute("tags");
		 					while(tags.next()){ 
		 					%>
		 						<a class="btn btn-theme" href="${pageContext.request.contextPath}/tags/<%=tags.getString("tagname")%>" role="button"><%= tags.getString("tagname") %></a>
		 					<% }
		 				
		 				%>
		            	
		   
		 			</p>
	 		</div>
	 	</div><%--/row --%>
	 </div><%--/container --%>
<%@ include file="footer.jsp"%>