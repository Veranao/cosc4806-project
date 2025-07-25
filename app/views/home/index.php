<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12 pt-5 pb-3">
                <h1>Home</h1>
                <p class="lead"> <?= date("F jS, Y"); ?></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p>Hello! Welcome to the home page for COSC 4806 Assignment 5.</p>
            <p>Here, you will be able to create and view your reminders</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mt-5">
            <hr/>
            <p>Get started by viewing your current reminders.</p>
            <a href="/reminders" method="get">
                <button type="submit" class="btn btn-primary">View reminders</button>
            </a>
        </div>
    </div>
</div>

    <?php require_once 'app/views/templates/footer.php' ?>
