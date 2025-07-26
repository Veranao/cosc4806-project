<?php if(!isset($_SESSION['auth'])) {
    require 'app/views/templates/headerPublic.php';
} else {
    require 'app/views/templates/header.php';
} ?>

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
                <p class="lead"> Today's Date: <?= date("F jS, Y"); ?></p>
            </div>
    </div>
        <?php if ($data['movie']['Error']): ?>
            <div class="alert alert-primary" role="alert">
                No movie with that name was found.
            </div>
        <?php else : ?>
            <?php $movie = $data['movie'];?>
            <div class="row">
                <div class="col-lg-12">
                    <h5>Movie Info</h5>
                    <div>
                        <h1 class="display-4"> <?php echo $movie['Title']?> </h1>
                        <h4> Synopsis: <?php echo $movie['Plot']?> </h4>                
                    </div>

                    <div class="row my-3">
                        <div class="col-lg-3">
                            <?php if ($movie['Poster'] == "N/A"): ?>
                                <div class="alert alert-primary" role="alert">
                                    No image available for this movie.
                                </div>
                            <?php else: ?>
                                <img src="<?php echo $movie['Poster']?>" alt="picture of movie"  class="img-thumbnail my-3"> 
                            <?php endif; ?>
                                
                        </div>

                        <div class="col-lg-9">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th>Year</th>
                                    <th>Genre(s)</th>
                                    <th>Director</th>
                                    <th>Leading Actors</th> 
                                    <th>IMDB Rating</th>
                                    <th>Number of Votes on IMDB</th>
                                    </tr>
                                </thead> 
                                
                                <tbody>
                                    <?php
                                        echo "<tr>";                
                                        echo "<td>" . $movie['Year'] . "</td>";
                                        echo "<td>" . $movie['Genre'] . "</td>";                             
                                        echo "<td>" . $movie['Director'] . "</td>";
                                        echo "<td>" . $movie['Actors'] . "</td>";
                                        echo "<td>" . $movie['imdbRating'] . "</td>";
                                        echo "<td>" . $movie['imdbVotes'] . "</td>";
                                        echo "</tr>";?>                       
                                </tbody>                    
                            </table> 

                            <div>
                                <?php if ($data['review'] == null): ?>
                            </div>
                        </div>
                    </div>
                </div>            
            </div>         
        <?php endif; ?> 
    </div>

   
</div>

<?php require_once 'app/views/templates/footer.php' ?>
