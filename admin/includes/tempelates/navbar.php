<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navboard" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php"><?php echo lang("BRAND");?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navboard">
      <ul class="nav navbar-nav">
          <li <?php echo ((isset($pageTitle)&&$pageTitle=="Categories"))?'class="active"':""; ?>><a href="categories.php"><?php echo lang("SECTIONS");?></a></li>
        <li <?php echo ((isset($pageTitle)&&$pageTitle=="Items"))?'class="active"':""; ?>><a href="items.php"><?php echo lang("ITEMS");?></a></li>
        <li <?php echo ((isset($pageTitle)&&$pageTitle=="Members"))?'class="active"':""; ?>><a href="Members.php"><?php echo lang("MEMBERS");?></a></li>
          <li <?php echo ((isset($pageTitle)&&$pageTitle=="Banners"))?'class="active"':""; ?>><a href="banners.php"><?php echo lang("STAT");?></a></li>
           <li <?php echo ((isset($pageTitle)&&$pageTitle=="Comments"))?'class="active"':""; ?>><a href="comments.php"><?php echo lang("LOG");?></a></li>
           <li <?php echo ((isset($pageTitle)&&$pageTitle=="Reservation"))?'class="active"':""; ?>><a href="online.php"><?php echo lang("Reservation");?></a></li>
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo lang("ADMIN_NAME");?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
              <li><a href="Members.php?do=Edit&id=<?php echo $_SESSION["id"];?>"><?php echo lang("Edit_profile");?></a></li>
            <li><a href="#"><?php echo lang("SETTINGS");?></a></li>
     
            <li><a href="logout.php"><?php echo lang("LOGOUT");?></a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>