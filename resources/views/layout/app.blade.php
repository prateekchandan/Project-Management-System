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
    <link href="/assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/css/chosen.min.css" rel="stylesheet">
    <link href="/assets/css/redit.min.css" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="/assets/js/modernizr.js"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/chosen.jquery.min.js"></script>
  	<script src="/assets/js/redit.js"></script>
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
          <a class="navbar-brand" href="/">Project Management System</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li><a href="/">HOME</a></li>
            <li><a href="/projects">PROJECTS</a></li>
              @if(!Auth::guest())
	         	 <li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome {{Auth::user()->name}} <b class="caret"></b></a>
	              <ul class="dropdown-menu">
	                <li><a href="/user/{{Auth::user()->userid}}">HOME</a></li>
	                <li><a href="/add-project">ADD NEW PROJECT</a></li>
	                <!--li><a href="/edit-profile">EDIT PROFILE</a></li-->
	                <li><a href="/logout">LOGOUT</a></li>
	              </ul>
	            </li>
	            @else
	        	<li><a href="/login">LOGIN</a></li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

@yield('content')
<div id="footerwrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <h4>About</h4>
          <div class="hline-w"></div>
          <p>Project Management system where students and professors from a particular institute or different institutes can list up the current projects they are working on or have previously worked upon or planning to work.<br>
          </p>
        </div>
        <div class="col-lg-4">
          <h4>Social Links</h4>
          <div class="hline-w"></div>
          <p>
            <a href="https://www.facebook.com/shyam.jvs"><i class="fa fa-facebook"></i></a>
            <a href="https://github.com/shyamjvs"><i class="fa fa-github"></i></a>
          </p>
        </div>
        <div class="col-lg-4">
          <h4>Our Bunker</h4>
          <div class="hline-w"></div>
          <p>
            4th year<br/>
            Department of Computer Science<br/>
            IIT Bombay<br/>
          </p>
        </div>
      
      </div>
    </div>
   </div>
   
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   
  <script src="/assets/js/retina-1.1.0.js"></script>
  <script src="/assets/js/jquery.hoverdir.js"></script>
  <script src="/assets/js/jquery.hoverex.min.js"></script>
  <script src="/assets/js/jquery.prettyPhoto.js"></script>
    <script src="/assets/js/jquery.isotope.min.js"></script>
    <script src="/assets/js/custom.js"></script>

    <script>
// Portfolio
(function($) {
  "use strict";
  var $container = $('.portfolio'),
    $items = $container.find('.portfolio-item'),
    portfolioLayout = 'fitRows';
    
    if( $container.hasClass('portfolio-centered') ) {
      portfolioLayout = 'masonry';
    }
        
    $container.isotope({
      filter: '*',
      animationEngine: 'best-available',
      layoutMode: portfolioLayout,
      animationOptions: {
      duration: 750,
      easing: 'linear',
      queue: false
    },
    masonry: {
    }
    }, refreshWaypoints());
    
    function refreshWaypoints() {
      setTimeout(function() {
      }, 1000);   
    }
        
    $('nav.portfolio-filter ul a').on('click', function() {
        var selector = $(this).attr('data-filter');
        $container.isotope({ filter: selector }, refreshWaypoints());
        $('nav.portfolio-filter ul a').removeClass('active');
        $(this).addClass('active');
        return false;
    });
    
    function getColumnNumber() { 
      var winWidth = $(window).width(), 
      columnNumber = 1;
    
      if (winWidth > 1200) {
        columnNumber = 5;
      } else if (winWidth > 950) {
        columnNumber = 4;
      } else if (winWidth > 600) {
        columnNumber = 3;
      } else if (winWidth > 400) {
        columnNumber = 2;
      } else if (winWidth > 250) {
        columnNumber = 1;
      }
        return columnNumber;
      }       
      
      function setColumns() {
        var winWidth = $(window).width(), 
        columnNumber = getColumnNumber(), 
        itemWidth = Math.floor(winWidth / columnNumber);
        
        $container.find('.portfolio-item').each(function() { 
          $(this).css( { 
          width : itemWidth + 'px' 
        });
      });
    }
    
    function setPortfolio() { 
      setColumns();
      $container.isotope('reLayout');
    }
      
    $container.imagesLoaded(function () { 
      setPortfolio();
    });
    
    $(window).on('resize', function () { 
    setPortfolio();          
  });
})(jQuery);
</script>
  </body>
</html>