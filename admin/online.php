<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ob_start();
session_start();
$pageTitle="Reservation";
if(isset($_SESSION['admin'])){
    include './ini.php';
     echo '<div class="container mem">';
     $do=(isset($_GET['do']))?$_GET['do']:"manage";
     if($do=="manage"){ 
         $db =new database();
         $members=$db->select("*", "reservation");
            if(!empty($members)){
         ?>
  

        <div class="maintable">
    <h1 class="text-center shadowhead">Online Reservation</h1>
    <table class="table table-bordered table-responsive table-hover">
          <!--`id`, `fullName`, `phonenum`, `email`, `numperson`, `date`, `time`, `cridit`, `post_code`-->

        <tr>
            <th>#ID</th>
            <th>Full Name</th>
            <th>Phone Num</th>
            <th>E-mail</th>
            <th>num person</th>
            <th>Date</th>
            <th>Time</th>
            <th>Manage</th>
            
           
        </tr>
        <?php 
                foreach($members as $mem ){
                  
             $users= <<<MEMBERS
        <tr>
             <td>{$mem['id']}</td>
             <td>{$mem['fullName']}</td>
             <td>{$mem['phonenum']}</td>
             <td>{$mem['email']}</td>
             <td>{$mem['numperson']}</td>
             <td>{$mem['date']}</td>
             <td>{$mem['time']}</td>
             <td>
                 <a href="online.php?do=delete&id={$mem['id']}" class="delete confirm"><i class="fa fa-remove"></i></a>
             
             </td>
        </tr>
MEMBERS;
                 echo $users;
        }
        
       
        ?>
         
    </table>
        </div>

<?php
} else {
             echo '<div class="empty-rec">This Page is not have any record</div>';
        }

     }
     elseif ($do=='delete') {
      echo '<h1 class="text-center shadowhead">Delete Categories</h1>';
        $id=(isset($_GET['id'])&& is_numeric($_GET['id']))?intval($_GET['id']):0;
        $db=new database();
     
        $check=$db->totalItem("id", "reservation", "WHERE id=?", array($id));
       
      
             if($check!=0){
         $row=$db->Delete("reservation", $id);
         redirect("<div class='alert alert-danger'>$row record deleted </div>","back",1);
         
                 
        } else {
            redirect("","back",0);  
        }
        
 }
     else {
         redirect('','back',0);    
     }
     echo '</div>';
    include $tem."footer.php";
} else {
    header('Location:index.php');
    exit();    
}



ob_end_flush();
