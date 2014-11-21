<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/img/favicon.ico">

    <title>Project Management System</title>

    <!-- Bootstrap core CSS -->
    <link href="${pageContext.request.contextPath}/assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="${pageContext.request.contextPath}/assets/css/style.css" rel="stylesheet">
    <link href="${pageContext.request.contextPath}/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="${pageContext.request.contextPath}/assets/css/chosen.min.css" rel="stylesheet">
    <link href="${pageContext.request.contextPath}/assets/css/redit.min.css" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="${pageContext.request.contextPath}/assets/js/modernizr.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="${pageContext.request.contextPath}/assets/js/bootstrap.min.js"></script>
    <script src="${pageContext.request.contextPath}/assets/js/chosen.jquery.min.js"></script>
  	<script src="${pageContext.request.contextPath}/assets/js/redit.js"></script>
  	<style>
  	.search-field input{
  		height:30px !important;
  	}
  	</style>
  </head>

  <body>
  <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="${pageContext.request.contextPath}/">Project Management System</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a href="${pageContext.request.contextPath}/">HOME</a></li>
            <li><a href="${pageContext.request.contextPath}/projects">PROJECTS</a></li>
            <%
	        String login =  (String)session.getAttribute("login");
	        if(login!=null && login.equals("1"))
	            {
	        String user_name  = (String)session.getAttribute("user_name");
	        String arr[] = user_name.split(" ", 1);
	        user_name=arr[0];
	            %>
	         	 <li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome ${user_name} <b class="caret"></b></a>
	              <ul class="dropdown-menu">
	                <li><a href="${pageContext.request.contextPath}/user/<%= (String)session.getAttribute("uid")%>">HOME</a></li>
	                <li><a href="${pageContext.request.contextPath}/add-project">ADD NEW PROJECT</a></li>
	                <li><a href="${pageContext.request.contextPath}/edit-profile">EDIT PROFILE</a></li>
	                <li><a href="${pageContext.request.contextPath}/logout">LOGOUT</a></li>
	              </ul>
	            </li>
	             <%}
	        else 
            {%>
	        	<li><a href="${pageContext.request.contextPath}/login">LOGIN</a></li>
            <%}
            %>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>