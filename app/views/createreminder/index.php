<?php require_once 'app/views/templates/header.php' ?>
<div class="container py-3">
    <div class="page-header" id="banner">
        <div class="row pt-3">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                      <li class="breadcrumb-item"><a href="/reminders">Reminders</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Reminder</li>
                  </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1>Create new reminder</h1>
                <p class="lead"> <?= date("F jS, Y"); ?></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
               <form action="/createreminder/create" method="post">
                   <label for="subject">Subject</label>
                   <input type="text" class="form-control" name="subject"  />
                   <button class="btn btn-primary mt-2" type="submit">Create reminder</button>
               </form>
        </div>
    </div>
</div>

    <?php require_once 'app/views/templates/footer.php' ?>
