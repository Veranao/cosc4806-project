<?php if(!isset($_SESSION['auth'])) {
    require 'app/views/templates/headerPublic.php';
} else {
    require 'app/views/templates/header.php';
} ?>
<?php $movie = $data['movie'];?>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row pt-3">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item" aria-current="page"><a href="/movies">Movies</a></li>
                      <li class="breadcrumb-item active" aria-current="page"><?php echo $movie['Title'] ?></li>
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
                    <div class="d-flex">
                        <div>
                            <h1 class="display-4"> <?php echo $movie['Title']?> </h1>
                            <h6><?php echo $movie['Year'] ?> &#8226; <?php echo $movie['Runtime'] ?></h6>      
                        </div>
                        <div class="ms-auto">
                            <div class="fw-bold">IMDb Rating</div>
                            <div class="d-flex">
                                <h2><i class="bi bi-star-fill" style="color: gold;"></i></h2>
                                <div class="ms-2">
                                    <div class="fw-bold"><?php echo $movie['imdbRating']?> / 10</div>
                                    <div style="font-size: small"><?php echo $movie['imdbVotes']?></div>
                                </div>
                            </div>
                        </div>
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
                            <div><b>Synopsis:</b>&nbsp;<span class="fst-italic"><?php echo $movie['Plot']?></span></div>
                            <table class="table table-hover my-3" style="border-top: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Genre</td>
                                        <td><?php echo $movie['Genre']?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Director</td>
                                        <td><?php echo $movie['Director']?></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Actors</td>
                                        <td><?php echo $movie['Actors']?></td>
                                    </tr>                     
                                </tbody>                    
                            </table> 

                            <div>
                                <b>Gemini Review:</b>&nbsp;
                                <?php echo $data["review"] ?>
                            </div>
                        </div>
                    </div>
                </div>            
            </div>         
        <?php endif; ?> 
    </div>

    <?php if (isset($_SESSION['auth'])): ?>
        <h4>Leave a review</h4>
        <style>
            .star-rating {
                direction: rtl;
                display: inline-block;
                cursor: pointer;
            }
    
            .star-rating input {
                display: none;
            }
    
            .star-rating label {
                color: #ddd;
                font-size: 24px;
                padding: 0 2px;
                cursor: pointer;
                transition: all 0.2s ease;
            }
    
            .star-rating label:hover,
            .star-rating label:hover~label,
            .star-rating input:checked~label {
                color: #ffc107;
            }
        </style>

        <form id='ratingForm' action='/movies/review' method='post'>
            <input type="hidden" name="movieID" value="<?php echo $movie['imdbID']?>">
            <input type="hidden" name="title" value="<?php echo $movie['Title']?>">
            <div class="star-rating animated-stars">
                <?php for ($i = 10; $i >= 1; $i--): ?>
                    <input type="radio" id="star<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" onchange="submitForm()">
                    <label for="star<?php echo $i; ?>" class="bi bi-star-fill"></label>
                <?php endfor; ?>
            </div>
        </form>

       <div id="reviewMessage" class="alert alert-success" style="display: none;">Thank you for your review!</div>

        <script>
            function submitForm() {
                setTimeout(() => {
                    document.getElementById('reviewMessage').style.display = "block";
                    setTimeout(() => {
                         document.getElementById('ratingForm').submit();
                    }, 1000);
                }, 500);
               
            }
        </script>
    <?php endif; ?> 

   
</div>

<?php require_once 'app/views/templates/footer.php' ?>
