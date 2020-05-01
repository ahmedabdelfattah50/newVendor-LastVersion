<!-- ========= Start Navbar ========= -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">Dashboard</a>
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
                    <a class="nav-link" href="sellers.php">Sellers <i class="fas fa-users"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="markets.php">Markets <i class="fas fa-store-alt"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">Products <i class="fas fa-tags"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="users.php">Users <i class="fas fa-users"></i></a>
                </li>
                <li class="nav-item dropdown edit_in">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- The name of the admin in the navbar -->
                        <?php echo $_SESSION['full_name']; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="#">Edit Admin <i class="fas fa-user-edit"></i></a>
                    <a class="dropdown-item" href="#">Logout <i class="fas fa-sign-out-alt"></i></a>
                    </div>
                </li>                     
            </ul>                
        </div>
        <li class="nav-item dropdown edit_out">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- The name of the admin in the navbar -->
                <?php echo $_SESSION['full_name']; ?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="#">Edit Admin <i class="fas fa-user-edit"></i></a>
            <a class="dropdown-item" href="logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
            </div>
        </li>
    </div>        
</nav>
<!-- ========= End Navbar ========= -->