<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height">
	<title>Welcome to CodeIgniter</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <?=link_tag('css/bootstrap.min.css'); ?>
    <?=link_tag('css/style.css'); ?>
    <script src="<?=base_url();?>js/jquery.min.js"></script>
</head>
<body>
<header>
    <div class="container">
        <div class="row">
            <div class="header-title">
                Question <span class="header-count">1</span> of <span class="header-amount">9</span>
            </div>
            <div class="header-progress">
                <div class="header-progress current-progress">
                </div>
            </div>
        </div>
    </div>
</header>

<section class="main">
    <div class="container main-container">
        <form id="form" action="/result" method="post">
            <div id="questions">
                <p>It's good weather today?</p>
                <p>It's good weather today?</p>
                <p>It's good weather today?</p>
                <p>It's good weather today?</p>
            </div>
        </form>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="flex-between">
                <div class="footer-back footer-btn no-select">BACK</div>
                <div class="footer-next footer-btn no-select">NEXT</div>
            </div>
        </div>
    </div>
</footer>
<script src="<?=base_url();?>js/script.js"></script>
</body>
</html>