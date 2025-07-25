<?php require_once 'app/views/templates/headerPublic.php'?>
<main role="main" class="container">
		<div class="page-header" id="banner">
				<div class="row">
						<div class="col-lg-12 mt-5 mb-3">
								<h1>Login</h1>
						</div>
				</div>
		</div>

		<?php
		if (isset($_SESSION['flash'])): ?>
		<div class="alert alert-primary" role="alert">
				<?= htmlspecialchars($_SESSION['flash']) ?>
		</div>

		<?php unset($_SESSION['flash']); ?>
		<?php endif; ?>

		<div class="row">
				<div class="col-sm-auto">
						<form action="/login/verify" method="post">
								<fieldset>
										<div class="form-group">
												<label for="username">Username</label>
												<input required type="text" class="form-control" name="username">
										</div>
										<div class="form-group">
												<label for="password">Password</label>
												<input required type="password" class="form-control" name="password">
										</div>
										<br>
										<button type="submit" class="btn btn-primary" style="margin-bottom: 10px">Login</button>
								</fieldset>
						</form>
				</div>
		</div>
		<div class="row">
				<div class="col-sm-auto">
						No account?
						<a href="/create" method="get">
								Create Account
						</a>
				</div>
		</div>
</main>
	
<?php require_once 'app/views/templates/footer.php' ?>
