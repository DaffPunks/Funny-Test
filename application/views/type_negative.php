<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height">
    <title>Your result</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <?=link_tag('css/bootstrap.min.css'); ?>
    <?=link_tag('css/style.css'); ?>
    <script src="<?=base_url();?>js/jquery.min.js"></script>
</head>
<body>

<section class="type">
    <div class="container type-container">
        <div class="row type-row flex-v-around">
            <div class="type-title">YOUR RESULTS:</div>
            <div class="row type-main">
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 type-img v-center">
                    <div class="type-angry">
                        <img src="<?=base_url();?>image/angry.png" style="visibility: hidden">
                    </div>
                </div><!--
                --><div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 type-desc v-center">
                    <div>It looks like you have a bad mood. Don't worry. Anyway, you are the best.</div>
                </div>
            </div>
            <div class="type-btn-wrap">
                <a href="/" class="main-button yes-btn type-btn">Try again</a>
            </div>
        </div>
    </div>
</section>



