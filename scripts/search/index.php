<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title>Open Academia</title>
  <meta name="description" content="Making research open for everyone">
  <meta name="author" content="Shashank">

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- CSS
  ================================================== -->
  <link rel="stylesheet" href="stylesheets/base.css">
  <link rel="stylesheet" href="stylesheets/skeleton.css">
  <link rel="stylesheet" href="stylesheets/layout.css">

  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- Favicons
  ================================================== -->
  <link rel="shortcut icon" href="images/favicon.ico">
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

</head>
<body>


<!-- The container is a centered 960px -->
<div class="container">
  
  <!-- Give column value in word form (one, two..., twelve) -->
  <div class="sixteen columns">
    <h1 style= "text-align: center;margin-top: 145px;">Open Academia</h1>
  </div>


  
  <!-- Sweet nested columns cleared with a clearfix class -->
    <!-- In nested columns give the first column a class of alpha
    and the second a class of omega -->
    <form action='results.php' method='get'>
    <div class="row">

    <div class="eight columns offset-by-four"><input style="width: 100%;height: 21px;" type="text" id="query" name="query"></div>
    </div>
    <div class="eight columns offset-by-seven" style="margin-top: -25px;"><button style = "width: 113px;" type="submit">Search</button></div>

  </form>
 
  <!-- Sweet nested columns cleared by wrapping a .row -->
  
 
  <!-- Can push over by columns -->
  <div class="five columns offset-by-one"></div>
 
</div>
 </body>
 </html>