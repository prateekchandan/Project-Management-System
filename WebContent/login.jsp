<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ include file="WEB-INF/templates/header.jsp"%>
<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>Login</h3>
			</div><%-- /row --%>
	    </div> <%-- /container --%>
</div>
<div class="container mtb">
	<div>
		<div class="col-lg-8 col-lg-offset-2">
	 			<h4>Login Into Project Management System</h4>
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
					  ${message}
				</div>
	 			<%} %>
	     
	       
	 			<div class="hline"></div>
	 				<p></p>
		 			<form role="form" method="POST">
					  <div class="form-group">
					    <label for="name">UserID / email</label>
					    <input type="text" class="form-control" name="uid" required>
					  </div>
					  <div class="form-group">
					    <label for="password">Password</label>
					    <input type="password" class="form-control" name="password" required>
					  </div>
					  <button type="submit" class="btn btn-theme">Login</button>
					</form>
					<a href="${pageContext.request.contextPath}/signup" class="btn btn-theme">New User?</a>
			</div>
		</div>
</div>
<%@ include file="WEB-INF/templates/footer.jsp"%>