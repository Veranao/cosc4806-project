<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12 pt-5 pb-3">
                <h1>The Movie Critic</h1>
                <p class="lead"> <?= date("F jS, Y"); ?></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <p>View movies, read reviews, and leave your own review!</p>
            <button class='btn btn-primary' onclick="window.location.href='/movies'">View Movies</button>
        </div>
    </div>
</div>

    <?php require_once 'app/views/templates/footer.php' ?>
