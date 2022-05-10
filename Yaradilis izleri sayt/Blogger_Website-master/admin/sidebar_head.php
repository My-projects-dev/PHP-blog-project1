<?php include '../notlink.php'; ?>

<!DOCTYPE html>
<html lang="az">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Blogger</title>

  <!------------------------------ Bootstrap5 -------------------->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <!------------------------------ Fontawesome ------------------->
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!------------------------------ Custom Style Css -------------->
  <link type="text/css" rel="stylesheet" href="css/sidebar_style.css" />

  <!------------------------------ JQuery ------------------------>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="js/jquery.sidebar.js"></script>

  <!------------------------------ PHP Rich Text Editor ------------------------>
  <script src="//cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>

</head>

<body>
  <div id="wrapper">
   <div class="overlay"></div>

   <!-- Sidebar -->
   <nav class="navbar navbar-inverse fixed-top" id="sidebar-wrapper" role="navigation">
     <ul class="nav sidebar-nav">
       <div class="sidebar-header">
         <div class="sidebar-brand">
           <a href="#" class ="text-decoration-none">Bloq</a></div></div>
           <li class="mt-3"><a href="?sehife=kateqoriyalar">Kateqoriyalar</a></li>
           <li><a href="?sehife=movzular">Mövzular</a></li>
           <li><a href="?sehife=hesabım">Hesabım</a></li>
          <li><a href="logout.php">Çıxış</a></li>
        </ul>
      </nav>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">
        <button type="button" class="hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
          <span class="hamb-top"></span>
          <span class="hamb-middle"></span>
          <span class="hamb-bottom"></span>
        </button>
        <div class="container">
          <div class="row">

