<?php require_once 'app/views/templates/header.php' ?>

<?php
    function check_completed($reminderObj)
    {
        return(is_null($reminderObj["completed_at"]) == 0);
    }
    
    function check_not_completed($reminderObj)
    {
        return(is_null($reminderObj["completed_at"]) == 1);
    }
?>

<div class="container">
    <div class="page-header" id="banner">
        <div class="row pt-3">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reminders</li>
                  </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1>Reminders</h1>
                <p class="lead"> <?= date("F jS, Y"); ?></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
                <h5>All reminders</h5>
            
                <?php if (count(array_filter($data['reminders'],"check_not_completed")) == 0): ?>
                    <div class="alert alert-primary" role="alert">
                        You have no outstanding reminders.
                    </div>
                
                <?php else : ?>
                    <form id='editTask' action='/reminders/edit' method='post'></form>
                    <form id='deleteTask'action='/reminders/delete' method='post'></form>
                    <form id='markCompleteTast' action='/reminders/mark_complete' method='post'></form>
    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Subject</th>
                                <th>Created</th>
                                <th style="width: 1%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                           
                                foreach (array_filter($data['reminders'],"check_not_completed") as $reminder) {
                                   
                                    echo "<tr>";
                                    echo "<td>" . $reminder['id'] . "</td>";
                                    echo "<td>" . $reminder['subject'] . "</td>";
                                    echo "<td>" . $reminder['created_at'] . "</td>";
                                    
                                    echo "<td>";
                                
                                    
                                    echo "<div class='btn-group' role='group' aria-label='Basic mixed styles example'>";    
                                    echo "<button class='btn btn-sm btn-outline-secondary text-nowrap' type='submit' form='editTask' name='reminder_id' value='" . $reminder['id']  ."'>Edit <i class='bi bi-pencil'></i></button>";   
                                    echo "<button class='btn btn-sm btn-outline-secondary text-nowrap' type='submit' form='deleteTask' name='reminder_id' value='" . $reminder['id']  ."'>Remove <i class='bi bi-trash'></i></button>";  
                                    echo "<button class='btn btn-sm btn-outline-secondary text-nowrap' type='submit' form='markCompleteTask' name='reminder_id' value='" . $reminder['id']  ."'>Complete &check;</button>";
                                    echo "</div>";

                                    echo "</td>";
                                    
                                    echo "</tr>";
                                    
                                }
                            ?>
                        </tbody>
                    </table>

                <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
                <h5>Completed Tasks</h5>

                <?php if (count(array_filter($data['reminders'],"check_completed")) == 0): ?>
                    <div class="alert alert-primary" role="alert">
                        You have no completed tasks
                    </div>
    
                <?php else : ?>
            
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Subject</th>
                                <th>Created</th>
                                <th>Completed</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach (array_filter($data['reminders'],"check_completed") as $reminder) {
        
                                    echo "<tr>";
                                    echo "<td>" . $reminder['id'] . "</td>";
                                    echo "<td>" . $reminder['subject'] . "</td>";
                                    echo "<td>" . $reminder['created_at'] . "</td>";
                                    echo "<td>" . $reminder['completed_at'] . "</td>";
        
                                }
                            ?>
                        </tbody>
                    </table>
                <?php endif;    ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 py-3">
            <a href="/createreminder">
                <button class="btn btn-primary">New reminder</button>
            </a>
        </div>
    </div>
</div>

    <?php require_once 'app/views/templates/footer.php' ?>
