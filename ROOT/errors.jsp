<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@taglib prefix="template"  tagdir="/WEB-INF/tags" %>    
<%@ page isErrorPage="true" %>

<template:masterPage>
<div id="blue">
	    <div class="container">
			<div class="row">
				<h3>${pageContext.exception.Message} Error Occured</h3>
			</div><%-- /row --%>
	    </div> <%-- /container --%>
</div>

<div class="container mtb">
	<div class="row">
	 		<div class="col-lg-12">	 			
		 		<img style="width:100%" class="img-responsive" src="${pageContext.request.contextPath}/assets/img/error.jpg">
	
			</div>
	 		
	 		
	 	</div>
</div>
</template:masterPage>