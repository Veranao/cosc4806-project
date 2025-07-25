<?php require_once 'app/views/templates/header.php' ?>

<div class="container">
    <div class="page-header" id="banner">
        <div class="row pt-3">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reports</li>
                  </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h1>Reports</h1>
                <p class="lead"> <?= date("F jS, Y"); ?></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3>Overall Stats</h3>

            <div class="d-flex gap-4">
                <div class="card col-4">
                    <div class="card-body">
                        <h5 class="card-title">Total users</h5>
                        <?php echo count($data['users']) ?>
                    </div>
                </div>

                <div class="card col-4">
                    <div class="card-body">
                        <h5 class="card-title">Total reminders</h5>
                         <?php echo count($data['reminders']) ?>
                    </div>
                </div>

                <div class="card col-4">
                    <div class="card-body">
                        <h5 class="card-title">Most reminders</h5>
                         <?php 
                            $mostReminders = 0;
                            $username = null;
                            foreach ($data['users'] as $user) {
                                if($user['reminder_count'] > $mostReminders) {
                                    $mostReminders = $user['reminder_count'];
                                    $username = $user['username'];
                                }
                            }
    
                            echo $username . " has " . $mostReminders . " ";
                            if ($mostReminders == 1)
                                echo "reminder";
                            else
                                echo "reminders";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

            <?php 
                echo "<script>";
                echo "var xValues = [\"" . implode('", "', array_column($data['users'], 'username')) ."\"];";
                echo "var yValues = [\"" . implode('", "', array_column($data['users'], 'reminder_count')) ."\"];";
                echo "</script>";
            ?>

            <script>
                function generateRandomHexColor() {
                  let randomColorNumber = Math.floor(Math.random() * 16777215);
                  let hexColor = randomColorNumber.toString(16);
                  hexColor = hexColor.padStart(6, '0');
                  return "#" + hexColor.toUpperCase();
                }

                var barColors = [];
                xValues.forEach(x => barColors.push(generateRandomHexColor()));

                new Chart("myChart", {
                      type: "bar",
                      data: {
                        labels: xValues,
                        datasets: [{
                          backgroundColor: barColors,
                          data: yValues
                        }]
                      },
                      options: {
                        legend: {display: false},
                        title: {
                          display: true,
                          text: "Reminders per user"
                        }
                      }
                    });
            </script>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3>Available reports</h3>

            <div class="d-grid gap-2 col-6 mt-4">
              <a class="btn btn-outline-secondary" href="/reports?type=reminders">Reminders</a>
              <a class="btn btn-outline-secondary" href="/reports?type=users">Users</a>
            </div>
        </div>
    </div>
</div>

    <?php require_once 'app/views/templates/footer.php' ?>
