<?php
require_once 'classes/User.php';
require_once 'classes/Folder.php';
require_once 'classes/Logger.php';
?>

<table>
<form method="POST">
    <tr>
        <td>Username</td>
        <td><input type="text" name="username"></input></td>
    </tr>
    <tr>
        <td>password</td>
        <td><input type="password" name="password"></input></td>
    </tr>
    <tr>
        <td>Email:</td>
        <td><input type="email" name="email"></input></td>
    </tr>
    <tr>
        <td></td>
        <td><button name="submit">Register</button></td>
    </tr>
</form>
</table>
<?php

if(isset($_POST['submit']))
{
    $user = new User($_POST['username']);
    if($user->register($_POST['password'],$_POST['email']))
    {
        $id = $user->fetchUserId();
        $dir = "File/".$id;
        
        if(!Folder::exists($dir))
            Folder::create($dir);
        else
            Logger::logError("  unique id is already used as directory","returned false");
            
        echo "U bent geregistreerd";
    }
}
?>