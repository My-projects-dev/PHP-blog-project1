<?php
include 'notlink.php';
include 'databaglanti.php'; ?>

<!DOCTYPE html>
<html lang="az">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>

  <!------------------------------ Bootstrap5 ------------------------------------------------->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <!------------------------------ Fontawesome ------------------------------------------------->
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

  <!------------------------------ Custom Style Css ------------------------------------------------->
    <link rel="stylesheet" href="./css/style.css" type="text/css">

</head>

<body class="" style="background-color: #581845;">
  <!-- ----------------------------  Navigation ---------------------------------------------- -->

  <nav class="header-navbar navbar navbar-expand-md navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="?"><i> Yaradılış izləri</i></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="?sehife=main">Ana səhifə</a>
          </li>
        </ul>
        <form class="d-flex" method="post" action="index.php?sehife=search">
          <input class="form-control me-2" type="text" name="search" placeholder="Axtar">
          <button class="btn btn-primary" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>

  <!-- ------------x---------------  Navigation --------------------------x------------------- -->
