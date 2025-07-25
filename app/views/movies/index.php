<?php require_once 'app/views/templates/header.php' ?>

<div class="container">
    <div class="page-header" id="banner">
        <div class="row pt-3">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Movies</li>
                  </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1>Movies</h1>
                <p class="lead"> <?= date("F jS, Y"); ?></p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form action="/movies/search" method="post" >
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="title" placeholder="Search for a movie" aria-label="default input example"/>
                        <button type="submit" class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   
</div>

<?php require_once 'app/views/templates/footer.php' ?>
