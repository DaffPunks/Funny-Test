<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height">
    <title>Statistic</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <?= link_tag('css/bootstrap.min.css'); ?>
    <?= link_tag('css/admin.css'); ?>
</head>
<body>
<section class="admin">
    <div class="container">
        <div class="row">
            <div class="admin-title">Days statistic</div>
            <div class="admin-days">
                <div class="row">
                    <div class="admin-days-date col-lg-4">
                        Date
                    </div>
                    <div class="admin-days-date col-lg-4">
                        Winner ID
                    </div>
                    <div class="admin-days-date col-lg-4">
                        Participant's
                    </div>
                </div>
                <?php foreach ($days as $day) { ?>
                <div class="row admin-day">
                    <div class="admin-days-date col-lg-4">
                        <?=$day["date"] ?>
                    </div>
                    <div class="admin-days-date col-lg-4">
                        <?php if($day["have_winner"]) {echo $day["user_id"];} else { echo "No winner yet";} ?>
                    </div>
                    <div class="admin-days-date col-lg-4">
                        <?=$day["visitors"] ?>
                    </div>
                </div>
                <?php } ?>

            </div>
            <div class="admin-title">Participant's statistic</div>
            <div class="admin-days">
                <div class="row">
                    <div class="admin-days-date col-lg-4">
                        ID
                    </div>
                    <div class="admin-days-date col-lg-4">
                        Person Type
                    </div>
                    <div class="admin-days-date col-lg-4">
                        Time
                    </div>
                </div>
                <?php foreach ($users as $user) { ?>
                    <div class="row admin-day <?php if($user["is_winner"]) {echo "user-winner";} ?>">
                        <div class="admin-days-date col-lg-4">
                            <?=$user["id"] ?>
                        </div>
                        <div class="admin-days-date col-lg-4">
                            <?=$user["person_type"] ?>
                        </div>
                        <div class="admin-days-date col-lg-4">
                            <?=$user["created_at"] ?>
                        </div>
                    </div>
                <?php } ?>

            </div>

        </div>
    </div>
</section>
</body>
</html>