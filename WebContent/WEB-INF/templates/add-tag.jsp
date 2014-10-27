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
				<h3>Add New Tag</h3>
			</div><%-- /row --%>
	    </div> <%-- /container --%>
	</div>
	<div class="container mtb">
	 	<div class="row">
	 	<div class="col-md-10 col-md-offset-1">
	 		<h3 class="ctitle">
				Add New Tag
			</h3>
			<div class="hline"></div>
			<br>
		 	<form role="form" method="post" action="${pageContext.request.contextPath}/add-tag">
		 		<div class="form-group row">
		 			<label class="col-md-3">Tag Name</label>
		 			<div class="col-md-9">
		 				<input name="tagname" type="text" placeholder="Name of Tag" class="form-control" required>
		 			</div>
		 		</div>
		 		
		 		<div class="form-group row">
		 			<div class="col-md-9 col-md-offset-3">
		 			<button type="submit" class="btn btn-theme">Add</button>
		 			</div>
		 		</div>
		 	</form>
		</div>
	 	
	 		
	 	</div><%--/row --%>
	 </div><%--/container --%>
	 
<%@ include file="footer.jsp"%>
