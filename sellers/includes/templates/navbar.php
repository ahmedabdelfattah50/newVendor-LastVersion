<!-- ========= Start Navbar ========= -->
<nav class="navbar navbar-expand-lg"> 
  <div class="container">
      <a class="navbar-brand" href="#">لوحة التحكم</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">                
          <ul class="navbar-nav">
              <!-- Notification bell -->
              <li class="nav-item">
                  <a class="nav-link notification_bell" href="#">
                      <i class="fas fa-bell"></i>
                      <span class="notification_bell_span">100</span>
                  </a>                        
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="market_data.php"><i class="fas fa-store-alt"></i> المحل</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#"><i class="fas fa-tags"></i> المنتجات</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="#"><i class="fas fa-users"></i> بياناتى</a>
              </li>
              <li class="nav-item dropdown edit_in">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo $_SESSION['full_name'];           // ******************** ?>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">تعديل البيانات <i class="fas fa-user-edit"></i></a>
                  <a class="dropdown-item" href="logout.php">الخروج <i class="fas fa-sign-out-alt"></i></a>
                  </div>
              </li>                     
          </ul>                
      </div>
      <li class="nav-item dropdown edit_out">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $_SESSION['full_name'];           // ******************** ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="member.php?do=Edit&userID=<?php echo $_SESSION['userID'];?>"><i class="fas fa-user-edit"></i> تعديل البيانات</a>
          <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> الخروج</a>
          </div>
      </li>
  </div>        
</nav>
<!-- ========= End Navbar ========= -->