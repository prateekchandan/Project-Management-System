<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"
      %>
<%@ include file="header.jsp"%>
<%@ page import="java.sql.*"%>
<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>${message}</h3>
			</div><%-- /row --%>
	    </div> <%-- /container --%>
</div>
<div class="container mtb">
	 	<div class="row">
	 	
	 		<%-- BLOG POSTS LIST --%>
	 		<div class="col-lg-8">
	 			<%
	 				String error=(String)request.getAttribute("error");
	 				if(error!=null)
	 				{
	 					ResultSet rs=(ResultSet)request.getAttribute("rs");
	 					while(rs.next()){
	 						String Pid=rs.getString("Project_id");
	 						String Pname=rs.getString("project_name");
	 						String Uname=rs.getString("name");
	 						String Uid=rs.getString("userid");
	 						String PDesc=rs.getString("description");
	 			%>
			 		
			 		<h3 class="ctitle">
			 			<a href="${pageContext.request.contextPath}/project/<%=Pid%>"><%=Pname%>
			 			</a>
			 		</h3>
			 		<p>
				 		<csmall2>By: <a href="${pageContext.request.contextPath}/user/<%=Uid%>"><%=Uname%></a></csmall2>
			 		</p>
			 		<p>
			 		<%=PDesc%>
			 		</p>
			 		<p><a href="${pageContext.request.contextPath}/project/<%=Pid%>">[Browse Project]</a></p>
			 		<div class="hline"></div>
			 		
			 		<div class="spacing"></div>
	 			
	 			<%
	 					}//End of Whle
	 				} // End of If
	 			%>
	 			
		 		
	 		
		 		
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