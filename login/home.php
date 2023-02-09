<?php
session_start();
if (! empty($_SESSION["name"])) {
    $name = $_SESSION["name"];
} else {
    session_unset();
    $url = "./index.php";
    header("Location: $url");
}
session_write_close();
?>
<HTML>
<HEAD>
<TITLE>AGENDEL</TITLE>
<link rel="icon" href="favicon.ico" />
<link rel="icon" type="image/png" href="favicon.png" />
<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css"
	crossorigin="anonymous">
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<link href="vendor/fontawesome-free-5.15.3-web/css/all.css"
	rel="stylesheet">
<link href="assets/css/style.css" rel="stylesheet">
<style>
</style>
</HEAD>
<BODY class="bg-image">
	<div class="row">
		<div class="col-md-12 text-center mt-5">
			<h1>Bonjour <?php echo $name;?><br/>Bienvenue dans l'application Agendel !</h1>
		</div>

</BODY>
</HTML>
