<?php
 ob_start();
 session_start();
 $pageTitle="Online Reservation";
 include './ini.php';
 $db= new database();
 if($_SERVER['REQUEST_METHOD']=="POST"){
 $data['fullName']=$_POST['fullname'];
 $data['numperson']=$_POST['nump'];
 $data['phonenum']=$_POST['phone'];
 $data['date']=$_POST['date'];
 $data['email']=$_POST['email'];
 $data['time']=$_POST['time'];
 $data['cridit']=$_POST['cridit'];
 $data['post_code']=$_POST['pcode'];
 if(isset($_SESSION['user'])){
     $data['username']=$_SESSION['user'];
 }
$add=$db->Add("reservation", $data);
if($add >0){
    echo "<script>alert('The reservation is done  ');</script>";
} else {
    echo "<script>alert('The reservation is done  ');</script>";
}            
 }
 include $tem .'header.php';
 include $tem .'searchnavbar.php';
 echo ' <div class="content">';
 //start online
 echo '<div class="online-reservation">';
 echo '<div class="blur">';
 include  $tem.'navbar.php'; ?>
 <div class="online-form text-center">
                           <h1>online reservation</h1>
                           <p>Lorem text Lorem text Lorem text Lorem text Lorem text</p>
                           <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                               <div class="row">
                                   <!--`id`, `fullName`, `phonenum`, `email`, `numperson`, `date`, `time`, `cridit`, `post_code`-->
                                   <div class="col-lg-6"><input class="form-control odd" type="text" placeholder="Full Name" name="fullname" required></div>
                                   <div class="col-lg-6">
                                       <select class="form-control" name="nump" required>
                                           <option value="1">1 Person</option>
                                           <option value="2">2 Person</option>
                                           <option value="3">3 Person</option>
                                       </select>
                                   </div>
                                   <div class="col-lg-6"><input class="form-control odd" type="text" placeholder="Phone Num" name="phone" required></div>
                                   <div class="col-lg-6"><input class="form-control even" type="date" placeholder="14/04/2017" name="date" required></div>
                                   <div class="col-lg-6"><input class="form-control odd" type="text" placeholder="E-mail" name="email" required></div>
                                   <div class="col-lg-6"><input class="form-control even" type="time" placeholder="10:00 AM" name="time" required></div>
                                   <div class="col-lg-6"><input class="form-control odd" type="text" placeholder="Cridit" name="cridit" required></div>
                                   <div class="col-lg-6"><input class="form-control even" type="text" placeholder="Post-Code" name="pcode" required></div>
                                   <div class="col-lg-12"><input class="form-control btn btn-danger btn-block" type="submit" value="reserve now"></div>
                                   
                               </div>
                               
                              
                           </form>
               </div>
<?php
 echo '</div>';
 echo '</div>';
 //end online
 echo '</div>';
 include $tem .'footer.php';
 ob_end_flush();
