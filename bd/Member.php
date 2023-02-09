<?php
namespace Phppot;
use PDO;


class Member
{
    private $ds;
    

    function __construct()
    {
        require_once __DIR__ . '/../bd/DataSource.php';
        $this->ds = new DataSource();
    }
    
    public function getMember($username)
    {
        $query = 'SELECT * FROM user where email = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }
    public function loginMember()
    {
        $memberRecord = $this->getMember($_POST["email"]);
        $loginPassword = 0;
        if (! empty($memberRecord)) {
            if (! empty($_POST["password"])) {
                $password = $_POST["password"];
            }
            $hashedPassword = $memberRecord[0]["password"];
            $loginPassword = 0;
            if (password_verify($password, $hashedPassword)) {
                $loginPassword = 1;
            }
        } else {
            $loginPassword = 0;
        }
        if ($loginPassword == 1) {
            // login sucess so store the member's username in
            // the session
            session_start();
            session_regenerate_id();
			$_SESSION['logged_in'] = true;
            $_SESSION["id"] = $memberRecord[0]["id"];
            $_SESSION["email"] = $memberRecord[0]["email"];
            $_SESSION["nom"] = $memberRecord[0]["nom"];
            $_SESSION["prenom"] = $memberRecord[0]["prenom"];
            $_SESSION["civilite"] = $memberRecord[0]["civilite"];
            $_SESSION["role"] = $memberRecord[0]["role"];
            session_write_close();

            $url = "/agendel/home.php";
            header("Location: $url");
            die();

        } else if ($loginPassword == 0) {
            $loginStatus = "email ou mot de passe invalide.";
            return $loginStatus;
        }
    }
}