<?php

    echo "Ahmed";
    session_start();
    if(isset($_SESSION['name'])) {
        include 'init.php';                    // ======== include the init file ========   
        
        $current_Admin = $_SESSION['userID'];
        
        $stmt = $con->prepare("SELECT * FROM hosters WHERE ID = ?");
        $stmt->execute(array($current_Admin));
        $row = $stmt->fetch();         
             

        // this is if the Admin is main admin
        if($row['admin_trust'] == 1) {            
            // echo $current_Admin;
?>
 
    <div class="container">
        <!-- ========= Start All stats ========= -->
        <h2 class="admin_header">Dashboard <i class="fas fa-paste"></i></h2>        
        <!-- this is the total counters -->
        <div class="all_stats">            
            <div class="admin_stats">
                <h2>All Admins <i class="fas fa-users-cog"></i></h2>
                <a href="admins.php?do=Manage">25</a>
            </div>
            <div class="admin_stats">
                <h2>All Users <i class="fas fa-users"></i></h2>
                <a href="users.php">25</a>
            </div>
            <div class="admin_stats">
                <h2>All Sellers <i class="fas fa-users"></i></h2>
                <a href="sellers.php?do=Manage">25</a>
            </div>
            <div class="admin_stats">
                <h2>All Markets <i class="fas fa-store-alt"></i></h2>
                <a href="markets.php?do=Manage">25</a>
            </div>            
            <div class="admin_stats">
                <h2>All Products <i class="fas fa-tags"></i></h2>
                <a href="#">25</a>
            </div>
            <div class="admin_stats">
                <h2>New Products <i class="fas fa-shopping-bag"></i></h2>
                <a href="#">25</a>
            </div>
        </div>   
        <div class="depart_header">
            <h2><i class="fas fa-project-diagram"></i> Categories</h2>
            <a href="#">5</a>
        </div>
        <!-- this is the total departments -->
        <div class="depart_sec">                        
            <div class="part">
                <h3>Male <i class="fas fa-male"></i></h3>
                <a href="#">3</a>
            </div>
            <div class="part">
                <h3>Female <i class="fas fa-female"></i></h3>
                <a href="#">3</a>
            </div>
            <div class="part">
                <h3>Children <i class="fas fa-child"></i></h3>
                <a href="#">3</a>
            </div>
            <div class="part">
                <h3>Clothing Sets (أطقم)</h3>
                <a href="#">3</a>
            </div>
            <div class="part">
                <h3>shoes <i class="fas fa-shoe-prints"></i></h3>
                <a href="#">3</a>
            </div>
        </div>                       
        <!-- ========= End Admin stats ========= -->
    </div> 



    <?php 
        // this is if the Admin is second admin (work with admins)
        } else if($row['admin_trust'] == 2) {
    ?>



    <div class="container">
        <!-- ========= Start All stats ========= -->
        <h2 class="admin_header">Dashboard <i class="fas fa-paste"></i></h2>        
        <!-- this is the total counters -->
        <div class="all_stats">            
            <div class="admin_stats">
                <h2>All Users <i class="fas fa-users"></i></h2>
                <a href="#">25</a>
            </div>
            <div class="admin_stats">
                <h2>All Sellers <i class="fas fa-users"></i></h2>
                <a href="#">25</a>
            </div>
            <div class="admin_stats">
                <h2>All Markets <i class="fas fa-store-alt"></i></h2>
                <a href="#">25</a>
            </div>            
            <div class="admin_stats">
                <h2>All Products <i class="fas fa-tags"></i></h2>
                <a href="#">25</a>
            </div>
            <div class="admin_stats">
                <h2>New Products <i class="fas fa-shopping-bag"></i></h2>
                <a href="#">25</a>
            </div>
        </div>   
        <div class="depart_header">
            <h2><i class="fas fa-project-diagram"></i> Categories</h2>
            <a href="#">5</a>
        </div>
        <!-- this is the total departments -->
        <div class="depart_sec">                        
            <div class="part">
                <h3>Male <i class="fas fa-male"></i></h3>
                <a href="#">3</a>
            </div>
            <div class="part">
                <h3>Female <i class="fas fa-female"></i></h3>
                <a href="#">3</a>
            </div>
            <div class="part">
                <h3>Children <i class="fas fa-child"></i></h3>
                <a href="#">3</a>
            </div>
            <div class="part">
                <h3>Clothing Sets (أطقم)</h3>
                <a href="#">3</a>
            </div>
            <div class="part">
                <h3>shoes <i class="fas fa-shoe-prints"></i></h3>
                <a href="#">3</a>
            </div>
        </div>                       
        <!-- ========= End Admin stats ========= -->
    </div> 



<?php
        }   
    } else {
        header('Location:index.php');
    }
?>

        


    





