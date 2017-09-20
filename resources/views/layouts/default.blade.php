<?php
/**
 * Created by PhpStorm.
 * User: oshry
 * Date: 27/08/2016
 * Time: 5:33 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel CRUD</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

</head>
<body>

<div class="container">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link" href="/public/main">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/public/status">Status</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/public/request">Requests</a>
        </li>
    </ul>
    @yield('content')
</div>

</body>
</html>
