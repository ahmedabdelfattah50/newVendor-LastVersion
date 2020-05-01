<?php
    $noNavbar = ''; 

    session_start();
    if(isset($_SESSION['name'])) {
        header('location:dashboard.php');
        exit(); 
    } else {
        include 'init.php';

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $seller_user = $_POST['seller_user'];
            $seller_pass  = $_POST['seller_pass'];      // *****************
            // $hashed_pass = password_hash($hoster_pass , PASSWORD_DEFAULT);

            // this code is to bring the data from databse to compare it with data the admin Enter it in the form
            $stmt = $con->prepare("SELECT ID , username , password , first_name , second_name
                                   FROM hosters 
                                   WHERE username = ? 
                                   AND password = ? 
                                   AND (seller_trust = 1 OR seller_trust = 2)");
     
            $stmt->execute(array($seller_user , $seller_pass));     // *****************
            $row = $stmt->fetch();           

            // this for count the row which it found it in the database
            $count = $stmt->rowcount();

            if($count > 0) {
                $_SESSION['userID'] = $row['ID'];
                $_SESSION['name'] = $seller_user;

                // $_SESSION['full_name'] I used it to >>>>>>> put the full name of the admin in the navbar
                $_SESSION['full_name'] = $row['first_name'] . " " . $row['second_name'];

                header('location:dashboard.php');
                exit(); 
            } 
        }                  
?>
 
<div class="container">
    <!-- ========= Start Admin Form ========= -->
    <form class="seller_form" action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
        <h2><i class="fas fa-sign-in-alt"></i> تسجيل دخول البائع</h2>
        <div class="form_filed">
            <label>اسم المستخدم <i class="fas fa-user-cog"></i></label>
            <input type="text" name="seller_user">
        </div>  
        <div class="form_filed">
            <label for="">كلمة السر <i class="fas fa-lock"></i></label>
            <input type="password" name="seller_pass">
        </div>            
        <input class="submit_admin" type="submit" value="تسجيل">
    </form>
    <!-- ========= End Admin Form ========= -->
</div>

<?php       
    }       // end of else of (NO SESSION)
?>
    




