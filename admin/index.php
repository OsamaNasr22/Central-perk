<?php
session_start();
$nonavbar="";
$pageTitle="Login";
if(isset($_SESSION["admin"])){
    header("Location: dashboard.php");
    exit();
}
include './ini.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $user=$_POST["user"];
    $pass=$_POST["password"];
    $hashpass= sha1($pass);
   $stm=$con->prepare("SELECT id,username,password FROM users WHERE username=? AND password=? AND groupId=1");
   $stm->execute(array($user,$hashpass));
   $row=$stm->fetch();
   $cont=$stm->rowCount();
  if($cont>0){
      $_SESSION["admin"]=$user;
      $_SESSION["id"]=$row["id"];
      header("Location: dashboard.php");
      exit();
  }
}
?>
<form class="login" method="POST" action="<?php echo $_SERVER["PHP_SELF"];?>">
    <h2 class="text-center text-primary">Admin Login</h2>
    <input class="form-control input-lg" type="text" name="user" placeholder="Username" autocomplete="off">
    <input class="form-control input-lg" type="password" name="password" placeholder="Password" autocomplete="new-password">
    <input class="btn btn-primary btn-block btn-lg" type="submit" value="Login">
</form>

<?php
include $tem.'footer.php';
?>

