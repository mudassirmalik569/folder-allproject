<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Job Portal</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="admin_assests/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME ICONS STYLES-->
    <link href="admin_assests/css/font-awesome.css" rel="stylesheet" />
    <!--CUSTOM STYLES-->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
    <link href="admin_assests/css/style.css" rel="stylesheet" />

      <!-- HTML5 Shiv and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

 <style type="text/css">
 
.notifications-wrapper .nav {
    background-color: #262626;
}


.notifications-wrapper .nav > li > a {
    background-color: rgb(40, 141, 203);
    color: #fff;
}

.notifications-wrapper .nav > li > a:hover, .nav > li > a:focus {


background: #262626;
color:rgb(40, 141, 203);

}


.navbar-cls-top .navbar-brand {
    background-color: #262626;
    color:rgb(40, 141, 203);
    border-bottom:1px solid  rgb(40, 141, 203);
    border-right:1px solid  #288dcb;

}

.navbar-cls-top .navbar-brand:hover {
    background: #262626;
    color: #fff;
}


.sidebar-collapse .nav > li > a {


    color: white;
    background: #288dcb;
    text-shadow: none;
    border-bottom: 1px solid #262626;
}

.active-menu {
    background-color: #262626!important;
    border-left: 5px solid #288dcb;
}



.user-img-div {
    min-height: 130px;
    padding: 20px;
    background-color: black;
    text-align: center;
}

.user-img-div img {
    height: 130px;
    border: 5px solid #288dcb;
}


.sidebar-collapse .nav > li > a:hover, .sidebar-collapse .nav > li > a:focus {
    background: #262626;
    outline: 0;
}

 </style>   


</head>
<body>
<?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>