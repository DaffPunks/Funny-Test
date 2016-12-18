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
    <?=link_tag('css/style.css?'); ?>
    <script src="<?=base_url();?>js/jquery.min.js"></script>
</head>
<body>

<section class="type">
    <div class="container type-container">
        <div class="row type-row flex-v-around">
            <div class="type-title">YOUR RESULTS:</div>
            <div class="row type-main">
                <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 type-img v-center">
                    <div class="type-good">
                        <img src="<?=base_url();?>image/good.png" style="visibility: hidden">
                    </div>
                </div><!--
                --><div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 type-desc v-center">
                    <div>You have a good mood. Good luck today.</div>
                </div>
            </div>
            <div class="type-btn-wrap">
                <a href="/" class="main-button yes-btn type-btn">Try again</a>
            </div>
        </div>
    </div>
</section>


<?php if($isWinner) { ?>
    <div class="modal">
        <img class="modal-cup" src="<?=base_url();?>image/cup.png">
        <div class="modal-title">Congratulations</div>
        <div class="modal-text">You won the lottery.</div>
        <div class="modal-footer">
            <button class="main-button yes-btn modal-btn">Have a beer</button>
        </div>
    </div>

<?php } else { ?>
    <div class="modal">
        <img class="modal-cup" src="<?=base_url();?>image/sorry-cat.png" width="100">
        <div class="modal-title">Sorry</div>
        <div class="modal-text">You didn't win.</div>
        <div class="modal-footer">
            <button class="main-button modal-btn">Don't worry</button>
        </div>
    </div>
<?php } ?>

<!--<script src="--><?///*=base_url();*/?><!--js/script.js"></script>-->
<script>
    $(document).ready(function () {
        $(".modal").addClass("modal-show");

        $(".modal-btn").click(function () {
            $(".modal").removeClass("modal-show");
        });
    });
</script>
</body>
</html>