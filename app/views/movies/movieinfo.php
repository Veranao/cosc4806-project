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
        <?php if (count($data['movie'])) == 0): ?>
            <div class="alert alert-primary" role="alert">
                No movie with that name was found.
            </div>
        <?php else : ?>
            <div class="row">
                <div class="col-lg-12">
                    <h5>Movie Info</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>Title</th>
                            <th>Year</th>
                            <th>Genre</th>
                            <th>Director</th>
                            <th>Actors</th> 
                            <th>Plot</th>
                            <th>Poster</th> 
                            <th>IMDB Rating</th>
                            <th>IMDB Votes</th>
                            </tr>                        </thead>                        <tbody>                            <?php                                foreach ($data['movie'] as $movie)                                {                                    echo "<tr>";                                    echo "<td>" . $movie['Title'] . "</td>";                                    echo "<td>" . $movie['Year'] . "</td>";                                    echo "<td>" . $movie['Genre                                        </td>";                                    echo "<td>" . $movie['Director'] . "</td>";                                    echo "<td>" . $movie['Actors'] . "</td>";                                    echo "<td>" . $movie['Plot'] . "</                                    echo "<td>" . $movie['Poster'] . "</td>";                                    echo "<td>" . $movie['imdbRating'] . "</td>";                                    echo "<td>" . $movie['imdbVotes'] .                                    echo "</tr>";                                }                            ?>                        </tbody>                    </table>                </div>            </div>        <?php endif; ?>                                        </div>   
        <?php endif; ?>
    </div>

   
</div>

<?php require_once 'app/views/templates/footer.php' ?>
