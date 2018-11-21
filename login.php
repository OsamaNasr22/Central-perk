<?php
ob_start();
session_start();
$pageTitle="login";
if(isset($_SESSION['user'])){
    header('Location:index.php');
    exit();
}
include './ini.php';
include $tem.'headerlog.php'; 
if($_SERVER['REQUEST_METHOD']=="POST"){
    $username=$_POST['username'];
    $pass=$_POST['pass'];
    $hashpass= sha1($pass);
    $db=new database();
    $total=$db->totalItem("*", "users", "WHERE username=? AND password=?",array($username,$hashpass));
    $userid=$db->select("id,regStatus", "users", "WHERE username=? AND password=?", array($username,$hashpass));
    
    if($total>0){
        if($userid[0]['regStatus']==1){
        $_SESSION['user']=$username;
        $_SESSION['userid']=$userid[0]['id'];
        header("Location:index.php");
        exit();} else {
    echo '<script>alert("please wait to admin activate acount")</script>';    
}
    }
    
}
?>

  <div class="login">
            <div class="logo-login" >
                <h3 class="text-center">Central perk</h3>
                <img src="<?php echo $img;?>logo.png">
            </div>
            
            <div class="login-form text-center">
                <h1 class="text-center">Login</h1>
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                    <input class="form-control" type="text" name="username" placeholder="Username" required>
                    <input class="form-control" type="password" name="pass" placeholder="Password" required>
                    <input class="form-control" type="submit"  value="Login">
                </form>
            </div>
        </div>
</body>
</html>
<?php


ob_end_flush();