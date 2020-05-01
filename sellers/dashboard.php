<?php

    session_start();
    if(isset($_SESSION['name'])) {
        include 'init.php';                    // ======== include the init file ========   
        
        $current_Seller = $_SESSION['userID'];
        
        $stmt = $con->prepare("SELECT * FROM hosters WHERE ID = ?");
        $stmt->execute(array($current_Seller));
        $row = $stmt->fetch();        
        // this is if the Admin is main Seller


        if($row['seller_trust'] == 1) {             // *****************          
            // echo $current_Seller;
            
?>

<div class="container">
    <!-- ========= Start All stats ========= -->
    <h2 class="seller_header">لوحة التحكم <i class="fas fa-paste"></i></h2>        
    <!-- this is the total counters -->
    <div class="all_stats">            
        <div class="seller_stats">
            <h2><i class="fas fa-users-cog"></i> المحل</h2>
            <a href="#">25</a>
        </div>
        <div class="seller_stats">
            <h2><i class="fas fa-users"></i> المنتجات</h2>
            <a href="#">25</a>
        </div>
        <div class="seller_stats">
            <h2><i class="fas fa-users"></i> بياناتى</h2>
            <a href="#">25</a>
        </div>
    </div>                       
    <!-- ========= End Admin stats ========= -->
</div>

<?php 
        // this is if the Admin is second Seller (work with Sellers)
        } else if($row['seller_trust'] == 2) {                      // *****************
?>

<?php
        }   
    } else {
        header('Location:index.php');
    }
?>







