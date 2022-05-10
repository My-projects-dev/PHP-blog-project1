<?php
    define('security', true);
    include("header.php");

    $sehife = @$_GET["sehife"];

    switch($sehife){

        case "kateqoriya":
        include("kateqoriya_kontent.php");
        break;

        case "kontent":
        include("content.php");
        break;

        case "search":
        include("search.php");
        break;

        default:
        include ("main.php");
        break;
    }

    include("footer.php"); 
?>