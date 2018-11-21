<div class="header">    
        <div class="search-navbar">
            <div class="container-fluid">
                 <div class="row"> 
                  <div class="left col-xs-4">
                      <?php
                      if(isset($_SESSION['user'])){ ?>
                          <a href="#" id="open"><img  src="<?php echo $img;?>reload.png"></a>
                      <?php }
                      ?>
                      
                    <div class="search">
                        <form class="form-inline" action="categories.php" method="gat">
                           <!--<i class="fa fa-search"></i>-->
                            <input class="btn btn-success"  type="submit" value="Search">
                        <input type="text" name="search" autocomplete="off">
                        </form>
                        
                        </div>
            </div>
                     <div class=" col-xs-offset-4 col-xs-4 right pull-right">
                         <?php 
                         if(isset($_SESSION['user'])){
                             ?>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $_SESSION['user'];?>
                                    <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="profile.php">Profile</a></li>
                                      <li><a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>Location</a></li>
                                     
                                      <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                    </div>
                         <?php
                         } else { ?>
                         <ul class="log-in">
                              <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Signup</a></li>
                <li><i class="fa fa-map-marker" aria-hidden="true"></i>
</li>
                </ul>
                         
                            <?php 
                         }
                         ?>
           
            </div>
                 </div>
            </div>
            </div>    
        </div>