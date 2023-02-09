<div class="sidenav">
	<div class="text-white m-5">
		<h1>
			<br/>
		</h1>
		<p><br/></p>
	</div>
</div>
<div class="main">
	<div
		class="d-flex flex-column justify-content-center align-items-center">
		<div class="col-md-6 col-sm-12">
			<div class="login-form">
				<form name="login" action="" method="post" class="m-3">
					<div class="form-group">
						<label>Email</label> <input type="text"
							class="form-control mt-1 mb-3" placeholder="email"
							name="email">
					</div>
					<div class="form-group  mb-3">
						<label>Mot de passe</label> <input type="password"
							class="form-control mt-1" placeholder="mot de passe" name="password">
					</div>
					<input type="submit" class="btn text-white bg-dark  w-25 login"
						value="Login" name="login-btn">
                  <?php if(!empty($loginResult)){?>
                <div class="text-danger"><?php echo $loginResult;?></div>
                <?php }?>
            </form>
			</div>
		</div>
	</div>
</div>