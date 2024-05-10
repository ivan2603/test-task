<!DOCTYPE html>
<!--[if lt IE 7]>      <html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js" xmlns="http://www.w3.org/1999/html"> <!--<![endif]-->
<head>
    <!-- Мета данные -->
    <meta charset="utf-8">
    <!-- Всегда форсирует последнюю версию IE рендеринга или запрос Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SKGroup</title>
    <!-- Мета данные -->
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <!-- Мета данные -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -- JS
    ================================================== -->
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--animate.css-->
    <link rel="stylesheet" href="/assets/style/animate.css"/>
    <!-- style.css -->
    <link rel="stylesheet" href="/assets/style/style.css"/>
    <!--fontawesome.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>




</head>
<body>
<div class="wrapper">
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="/">SK GROUP</a>
    <ul class="nav navbar-nav">
        <li class="nav-item <?=($_SERVER['REQUEST_URI'] =="/vehicle/list"?"active":"")?>">
            <a class="nav-link" href="/vehicle/list">Vehicle List</a>
        </li>
        <li class="nav-item <?=($_SERVER['REQUEST_URI'] =="/user/login"?"active":"")?>">
            <a class="nav-link" href="/user/login">Login</a>
        </li>
        <li class="nav-item <?=($_SERVER['REQUEST_URI'] =="/user/register"?"active":"")?>">
            <a class="nav-link" href="/user/register">Register</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/user/logout">Logout</a>
        </li>
    </ul>
    <?php
    if(isset($_SESSION['user']['login'])) {
        echo '<li class="nav-item ml-auto"><span class="navbar-text"><i class="fa-solid fa-user"></i> Welcome, ' . $_SESSION['user']['login'] . '</span></li>';
    }
    ?>
</nav>

<div class="content container-fluid">