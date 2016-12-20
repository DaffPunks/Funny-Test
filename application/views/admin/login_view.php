<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <?= link_tag('css/bootstrap.min.css'); ?>
    <?= link_tag('css/admin.css'); ?>
</head>
<body>
<section class="login">
    <form action="admin/login" method="post">
        <div class="login-title">
            Admin Panel
        </div>
        <div>
            <input type="text" name="login" placeholder="Login">
        </div>
        <div>
            <input type="password" name="password" placeholder="Password">
        </div>
        <div>
            <button class="login-btn">Login</button>
        </div>
    </form>
</section>
</body>
</html>