<?php
ob_start();
session_start();
$pageTitle="Sign Up";

include './ini.php';
include $tem.'headersignup.php'; 
if($_SERVER['REQUEST_METHOD']=="POST"){
    $data['username']=$_POST['username'];
    $data['Email']=$_POST['email'];
    $data['address']=$_POST['city']."-".$_POST['street']."-".$_POST['town'];
    $data['postCode']=$_POST['p-code'];
    $data['telephone']=$_POST['tel'];
    $pass=$_POST['pass'];
    $data['password']= sha1($pass);
    $db=new database();
    $total=$db->totalItem("*", "users", "WHERE username=? ",array($data['username']));
    if($total>0){
          echo '<script>alert("sorry user is exist please try another username")</script>';    

    } else {
        $db=new database();
        $insert=$db->Add("users", $data);
        if($insert>0){
            echo '<script>alert("congrats you register in site waite activate acount by admin to allow login")</script>';
        } else {
            echo '<script>alert("failed in register")</script>';
        }
    }
    
}
?>
 <div class="login">
            <div class="logo-login">
                <h3 class="text-center">Central perk</h3>
                <img src="<?php echo $img;?>logo.png">
            </div>
            
            <div class="login-form text-center">
                <h1 class="text-center">Signup</h1>
                <form method="post">
                    <input class="form-control" type="text" name="username" placeholder="Username" required>
                    <input class="form-control" type="email" name="email" placeholder="Email" required>
                    <input class="form-control" type="password" name="pass" placeholder="Password" required>
                    <input class="form-control" type="text" name="p-code" placeholder="Post-code" required>
                    <div class="form-group">
                        <select class="form-control" name="city" required>
                            <option value="City">City</option>
                            <option value="Alex">Alex</option>
                            <option value="Mansoura">Mansoura</option>
                            <option value="aswan">aswan</option>
                        </select>
                        <select class="form-control" name="street" required><option>Street</option></select>
                    <select class="form-control" name="town" required><option>town</option></select>                    </div>
                    <input class="form-control" type="tel" name="tel" placeholder="Telephone" required>
                    
                    <input class="form-control" type="submit"  value="Register">
                </form>
            </div>
        </div>
<?php


ob_end_flush();