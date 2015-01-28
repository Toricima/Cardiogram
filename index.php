<html>
<head>
<title>Hartslagmeter</title>
</head>
<?php 
require_once 'classes/File.php'; 
require_once 'classes/User.php';
?>
<body>
<form method="POST">
    <table>
        <tr>
            <td>username</td>
            <td><input type="text" name="username"/></td>
        </tr>
        <tr>
            <td>password</td>
            <td><input type="password" name="password"/></td>
        </tr>
        <tr>
            <td></td>
            <td><button name="login">Login!</button></td>
        </tr>
    </table>
</form>
<form action="register.php">
    <button>Register</button>
</form>
<?php

if(isset($_POST['login']))
{
    $user = new User($_POST['username']);
    
    if($user->login($_POST['password']))
    {
        $userFolder = "File/".$user->fetchUserId();
        
        Session_start();
        $_SESSION['user'] = $user->_username;
        $_SESSION['userfolder'] = $userFolder;
        
        Redirect::to("home.php");
       
    }
    else
       echo "your password or username was invalid";
    
    
}
?>
</body>
</html>