<?php require_once 'app/views/templates/header.php' ?>

<div class="container">
    <div class="page-header" id="banner">
        <div class="row pt-3">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/reports">Reports</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                  </ol>
                </nav>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <h1>Report: Users</h1>
                <p class="lead"> <?= date("F jS, Y"); ?></p>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-12">
            <h4>Users</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 my-3">
            <div class="d-flex gap-4">
                <div class="card col-4">
                    <div class="card-body">
                        <h5 class="card-title">Total users</h5>
                        <?php echo count($data['users']) ?>
                    </div>
                </div>

                <div class="card col-4">
                    <div class="card-body">
                        <h5 class="card-title">Total logins</h5>
                        <?php 
                        $total_logins = 0;
                        foreach ($data['users'] as $user) {
                            $total_logins += $user['successful_logins'] + $user['failed_logins'];
                        }
                        echo $total_logins ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">  
            <h5>User List</h5>
            <?php if (count($data['users']) == 0): ?>
                <div class="alert alert-primary" role="alert">
                    There are no users.
                </div>

            <?php else : ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Successful Logins</th>
                            <th>Failed Logins</th>
                            <th>Total Logins</th>
                            <th>Reminders</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                           
                            foreach ($data['users'] as $user) {

                                echo "<tr>";
                                echo "<td>" . $user['username'] . "</td>";    
                                echo "<td>" . $user['successful_logins'] . "</td>";    
                                echo "<td>" . $user['failed_logins'] . "</td>";   
                                echo "<td>" . $user['successful_logins'] + $user['failed_logins'] . "</td>";  
                                echo "<td>" . $user['reminder_count'] . "</td>"; 
                                echo "</tr>";

                            }
                        ?>
                    </tbody>
                </table>

            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mt-4">  
            <h5>Login attempts</h5>
            <?php if (count($data['users']) == 0): ?>
                <div class="alert alert-primary" role="alert">
                    There are no login attempts.
                </div>

            <?php else : ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Attempt</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php                           
                            foreach ($data['logs'] as $log) {
                                // MariaDB stores the timestamp in UTC, so we need to convert it to the local timezone
                                $originalTime = $log['timestamp'];
                                $date = new DateTime($originalTime, new DateTimeZone('UTC'));
                                $date->setTimezone(new DateTimeZone('America/New_York'));
                                
                                echo "<tr>";
                                echo "<td>" . $log['username'] . "</td>";    
                                echo "<td>" . $log['attempt'] . "</td>";    
                                echo "<td>" . $date->format('Y-m-d H:i:s') . "</td>"; 
                                echo "</tr>";

                            }
                        ?>
                    </tbody>
                </table>

            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once 'app/views/templates/footer.php' ?>
