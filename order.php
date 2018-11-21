<?php
ob_start();
session_start();
 $pageTitle="Online Order";
 include './ini.php';
 $do=$_GET['do'];
 $db=new database();
 if($do=='order'){
     $id=$_GET['id'];
 $items=$db->select("item_name,price,item_desc", "items","WHERE id=?",array($id));
 $row=$db->totalItem("item_name", "items","WHERE id=?",array($id));

      include $tem .'header.php';
 include $tem .'searchnavbar.php';
 echo ' <div class="content">';
 //start online
 echo '<div class="online-reservation">';
 echo '<div class="blur">';
 include  $tem.'navbar.php'; ?>
 <div class="online-form text-center">
                           <h1>Online Order</h1>
                           <p>Lorem text Lorem text Lorem text Lorem text Lorem text</p>
                           <form class="form-horizontal" action="?do=commit" method="post">
                               <div class="row">
                                   <!--`id`, `fullName`, `phonenum`, `email`, `numperson`, `date`, `time`, `cridit`, `post_code`-->
                                   <div class="col-lg-6"><input class="form-control odd" type="text"  s value="<?php echo $items[0]['item_name'];?>" placeholder="Meal name" required disabled=""></div>
                                   <div class="col-lg-6"><input class="form-control even price" type="text" placeholder=" price" required disabled value="<?php echo $items[0]['price'].'$';?>"></div>
                                   <input type="hidden" name="id" value="<?php echo $id;?>">
                                   <input type="hidden" name="price" value="<?php echo $items[0]['price'];?>">
                                   <input type="hidden" name="meal" value="<?php echo $items[0]['item_name'];?>">
                                   <div class="col-lg-6"><input class="form-control odd" type="text" placeholder="Enter Your Name" name="name" required></div>
                                   <div class="col-lg-6"><input class="form-control even" type="text" placeholder="Enter Phone Number" name="phone" required></div>
                                   <div class="col-lg-6"><input class="form-control odd" type="text" placeholder="Your Address" name="address" required ></div>
                                   <div class="col-lg-6"><input class="form-control even" type="text" placeholder="cridit number" name="cridit" required ></div>
                                   <div class="col-lg-12"><textarea class="form-control texta" disabled=""><?php echo $items[0]['item_desc'];?></textarea></div>
                                   <div class="col-lg-12"><input class="form-control btn btn-danger btn-block" type="submit" value="order now"></div>
                                   
                               </div>
                               
                              
                           </form>
               </div>
<?php
 echo '</div>';
 echo '</div>';
 //end online
 $query="INNER JOIN users ON comments.user_id=users.id WHERE item_id =?";
 $comm=$db->select("comments.*,users.*", 'comments',$query,array($id));
 
 ?>

<div class="comments">
                   <div class="container">
                       <h1>Comments</h1>
                       <?php 
                        foreach ($comm as $c){
                            ?>
                        <div class="media">
                                    <div class="media-left media-middle">
                                      <a href="#">
                                          <img class="media-object" src="<?php echo $img.$c['image'];?>" alt="..." width="64" height="64">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading"><?php echo $c['username'];?></h4>
                                      <p><?php echo $c['comment'];?></p>
                                      
                                    </div>
                                     </div>
                       <?php
                        }
                       ?>
                     
                       <?php if(isset($_SESSION['user'])){
                           
                           ?>
                       <div class="comment-text">
                           <form method="post" action="?do=comment">
                               <textarea placeholder="Enter Comment" name="comment"></textarea>
                               <input type="hidden" name="id" value="<?php echo $id;?>">
                               <input type="submit" class="btn btn-primary comment-user" value="comment">
                        
                           </form>
                          
                       </div>
                       
                       <?php 
                       
                           
                       }
 else {
     echo '<div class="empty-rec">Please <a href="login.php">login</a> or <a href="signup.php">sign up</a> to add comment</div>';
 }
                       ?>
                       
                   </div>
               </div>

<?php
 echo '</div>';
include $tem .'footer.php';

 }elseif ($do=='comment') {
     if($_SERVER['REQUEST_METHOD']=='POST'){
         //`id`, `comment`, `status`, `comment_date`, `item_id`, `user_id`
         $data['comment']=$_POST['comment'];
         $data['status']=1;
         $data['item_id']=$_POST['id'];
         $data['user_id']=$_SESSION['userid'];
         $commm=$db->Add('comments', $data);
         if($commm >0){
             redirect("","back",0);
         }
        
     } else {
         redirect("",'back','0');    
     }
 }
 elseif ($do=='commit') {
     if($_SERVER['REQUEST_METHOD']=='POST'){
         //`id`, `mealName`, `fullName`, `address`, `price`, `orderedBy`, `item_id`, `cridit`SELECT * FROM `orders` WHERE 1

               $data['mealName']=$_POST['meal'];
$data['fullName']=$_POST['name'];
$data['address']=$_POST['address'];
$data['price']=$_POST['price'];
        if(isset($_SESSION['user'])){
            $data['orderedBy']=$_SESSION['user'];
        }
        $data['item_id']=$_POST['id'];
        $data['cridit']=$_POST['cridit'];
        $data['phone']=$_POST['phone'];
     
        $row=$db->Add('orders', $data);

        if($row >0){
            echo '<script>alert("your order is done");history.back();</script>';
        } else {
             echo '<script>alert("your order is done");</script>';
        }
          } else {
            //  redirect("","back",0);    
          }
} else {
   // redirect("","back",0);    
}
 

ob_end_flush();