<div
	class="d-flex flex-column min-vh-100 justify-content-center align-items-center"
	id="template-bg-3">

	<div class="card mb-5 p-5  bg-dark bg-gradient text-white col-md-4">
		<div class="card-header text-center">
			<h3>Connection</h3>
		</div>
		<div class="card-body mt-3">
			<form name="login" action="" method="post">
				<div class="input-group form-group mt-3">
					<input type="text" class="form-control text-center p-3"
						placeholder="email" name="email">
				</div>
				<div class="input-group form-group mt-3">
					<input type="password" class="form-control text-center p-3"
						placeholder="Mot de passe" name="password">
				</div>
				<div class="text-center">
					<input type="submit" value="Login"
						class="btn btn-primary mt-3 w-100 p-2" name="login-btn">
				</div>
			</form>
                <?php if(!empty($loginResult)){?>
                <div class="text-danger"><?php echo $loginResult;?></div>
                <?php }?>
            </div>
		<div class="card-footer p-3">
			<div class="d-flex justify-content-center">
				<div class="text-primary">Utilisez votre mail et mot de passe.</div>
			</div>
		</div>
	</div>

</div>
