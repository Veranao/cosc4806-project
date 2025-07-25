<?php require_once 'app/views/templates/headerPublic.php' ?>
<body  style="background-color: #000000; color: #FFFFFF">
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12 pt-5">
                <h1>Assignment Information</h1>
                <p class="lead"> <?= date("F jS, Y"); ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p>Created by: Victor Cao</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <a href="/home" method="get">
                    <button type="submit" class="btn btn-primary"> Back to home page </button>
                </a>
            </div>
        </div>
    </div>

    <?php require_once 'app/views/templates/footer.php' ?>
</body>
