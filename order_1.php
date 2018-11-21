<?php
 ob_start();
 session_start();
 $pageTitle="Online Order";
 include './ini.php';
 $db= new database();
//`id`, `mealName`, `fullName`, `address`, `price`, `orderedBy`, `item_id`, `cridit`SELECT * FROM `orders` WHERE 1

     
    
 

       
    
        

if($_SERVER['REQUEST_METHOD']=="GET" && @$_GET['id']!=""&&isset($_GET['do'])){
    
    $do=$_GET['do'];
     $id=$_GET['id'];
 $items=$db->select("item_name,price,item_desc", "items","WHERE id=?",array($id));
 $row=$db->totalItem("item_name", "items","WHERE id=?",array($id));
 
      if($do=='order'){
          if($row>0){
      $id=$_GET['id'];
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
                                   <div class="col-lg-6"><input class="form-control odd" type="text" value="<?php echo $items[0]['item_name'];?>" placeholder="Meal name" name="meal" required disabled=""></div>
                                   <div class="col-lg-6"><input class="form-control even price" type="text" placeholder=" price" name="price" required disabled value="<?php echo $items[0]['price'].'$';?>"></div>
                                   <input type="hidden" name="id" value="<?php echo $id;?>">
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
 ?>

<div class="comments">
                   <div class="container">
                       <h1>Comments</h1>
                        <div class="media">
                                    <div class="media-left media-middle">
                                      <a href="#">
                                          <img class="media-object" src="../images/bing.PNG" alt="..." width="64" height="64">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading">Chandler Bing</h4>
                                      <p>Too Mnay Jokes to moke joey</p>
                                      
                                    </div>
                                     </div>
                       
                       <div class="media">
                                    <div class="media-left media-middle">
                                      <a href="#">
                                          <img class="media-object " src="../images/phoebe.jpg" alt="..." width="64" height="64">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading">Phoebe</h4>
                                      <p>i have to go before i put your head throught a wall</p>
                                      
                                    </div>
                                     </div>
                       
                       <div class="media">
                                    <div class="media-left media-middle">
                                      <a href="#">
                                          <img class="media-object" src="../images/ROSS.png" alt="..." width="64" height="64">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading">Ross</h4>
                                      <p>Hiiiii</p>
                                      
                                    </div>
                                     </div>
                       
                        <div class="media">
                                    <div class="media-left media-middle">
                                      <a href="#">
                                          <img class="media-object" src="../images/joey.PNG" alt="..." width="64" height="64">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <h4 class="media-heading">joey</h4>
                                      <p>joey doesn't share food</p>
                                      
                                    </div>
                                     </div>
                       <div class="comment-text">
                           <textarea placeholder="Enter Comment"></textarea>
                       <a  class="btn btn-primary comment-user">Comment</a>     
                       </div>
                       
                   </div>
               </div>

<?php
 echo '</div>';
include $tem .'footer.php';
     } else {
         redirect("","back",0);
     }
        
      }elseif($do=='commit'){
          if($_SERVER['REQUEST_METHOD']=='POST'){
               $data['mealName']=$_POST['meal'];
$data['fullName']=$_POST['name'];
$data['address']=$_POST['address'];
$data['price']=$_POST['price'];
echo $data['fullNames'];
        if(isset($_SESSION['user'])){
            $data['orderedBy']=$_SESSION['user'];
        }
        $data['item_id']=$_POST['id'];
        $data['cridit']=$_POST['cridit'];
        $add=$db->Add('orders', $data);
        if($add>0){
            echo '<script>alert("your order is done");</script>';
        } else {
             echo '<script>alert("your order is done");</script>';
        }
          } else {
              redirect("","back",0);    
          }
          
      }
     
 
 } else {
                // echo '<script>alert("page not founded");history.back();</script>';

 }
 


 ob_end_flush();
