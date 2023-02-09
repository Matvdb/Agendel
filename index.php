<?php
use Phppot\Member;
if (! empty($_POST["login-btn"])) {
    require_once __DIR__ . '/bd/Member.php';
    $member = new Member();
    $loginResult = $member->loginMember();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="assets/img/favicon.ico" />
<link rel="icon" type="image/png" href="assets/img/favicon.png" />
<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css"
	crossorigin="anonymous">
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<link href="vendor/fontawesome/css/all.css"
	rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php
if (! empty($_GET["i"])) {
    $template = intval($_GET["i"]);
}

if(empty($template)) {
    $template = 2;
}

require_once __DIR__ . '/template/login-template' . $template . '.php';

?>
</body>
</html>