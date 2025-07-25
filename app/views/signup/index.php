<?php require_once 'app/views/templates/headerPublic.php'?>
<?php $error = $data['error'] ?? null; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign up</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Create new user</h1>
                <p>Please enter your username and password to create an account.</p>
                <p>Password must:</p>
                <ul>
                    <li>Be at least 8 characters</li>
                    <li>Include an uppercase letter</li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-auto">
            <form action="/create/submit" method="post" >
            <fieldset>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input required type="text" class="form-control" name="username">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input required type="password" class="form-control" name="password">
                </div>

                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input required type="password" class="form-control" name="confirm_password">
                </div>

                <br>

                <button type="submit" class="btn btn-primary"> Create Account </button>

                <a href="index.php">
                    <button type="button" class="btn btn-secondary">Cancel</button>
                </a>

                <br>

            </form>
            </div>
        </div>
        

       

        <?php if ($error): ?>
            <p style="color: red"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </div>
    
        
</body>
</html>