<?php 

    session_start();
    if(isset($_SESSION['name'])) {
        include 'init.php';                   // ======== include the init file ========   
        if(isset($_GET['do'])) {
            $do = $_GET['do'];
        } else {
            $do = "Manage";
        }

?> 

<div class="container">
        <!-- ========= Start Sellers Manage_Seller ========= -->
        <?php
            if($do == "Manage") {     

            $stmt = $con->prepare("SELECT * FROM hosters 
                                   WHERE seller_trust = 1 OR seller_trust = 2 AND admin_trust = 0");
            $stmt->execute();
            $rows = $stmt->fetchAll();      
        ?>  
        <h2 class="header_Manage"><i class="fas fa-users"></i> All Sellers</h2>
        <div class="total_tabel">        
            <table class="table manage_table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">username</th>
                        <th scope="col">e-mail</th>
                        <th scope="col">Phone 1</th>
                        <th scope="col">Phone 2</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>                
                <tbody>
                <?php
                    foreach($rows as $row) {
                        echo "<tr>";
                            echo "<th scope='row'>" . $row['ID'] . "</th>";
                            echo "<td>" . $row['first_name'] . " " . $row['second_name'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['phone1'] . "</td>";
                            echo "<td>" . $row['phone2'] . "</td>";
                            echo "<td>";
                                echo "<div class='btns_control'>";
                                    echo "<a href='?do=Edit&sellerID=" . base64_encode($row['ID']) . "'class='btn btn-info'>Edit</a>";
                                    echo "<a href='?do=Delete&sellerID=" . base64_encode($row['ID']) . "'class='btn btn-danger'>Delete</a>";                                
                                echo "</div>";
                            echo "</td>";
                        echo "</tr>";
                    }
                ?>                    
                </tbody>
            </table>        
            <a href="?do=Add" class="Add_Edit_Submit btn btn-success">Add New Seller <i class="fas fa-user-plus"></i></a>
        </div>
        <!-- ========= End Sellers Manage_Seller ========= -->



        <!-- ========= Start Sellers Add_Seller ========= -->
        <?php 
            } else if($do == "Add") {                
        ?>
        <form class="Add-Edit_inputs" action="?do=Insert" method="POST">
            <h2 class="header_Add-Edit header_Manage">Add Sellers <i class="fas fa-user-plus"></i></h2>
            <div class="total_admin_inputs">
                <div>
                    <label for="">First Name</label>
                    <input type="text" name="seller_FirName" required>
                </div>
                <div>
                    <label for="">Second Name</label>
                    <input type="text" name="seller_SecName" required>
                </div>
                <div>
                    <label for="">Username</label>
                    <input type="text" name="seller_userName" required>
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" name="seller_Pass" required>
                </div>
                <div>
                    <label for="">e-mail</label>
                    <input type="text" name="seller_email" required>
                </div>
                <div>
                    <label for="">Phone 1</label>
                    <input type="text" name="seller_Phone1" required>
                </div>
                <div>
                    <label for="">Phone 2</label>
                    <input type="text" name="seller_Phone2" required>
                </div>
                <div>
                    <label for="">Degree of Seller</label>
                    <select name="seller_Degree" id="">
                        <option value=""></option>
                        <option value="1">1- Main Seller</option>
                        <option value="2">2- Second Seller</option>
                    </select>
                </div>
            </div>
            <input type="submit" class="Add_Edit_Submit btn btn-success" value="Add">
        </form>        
        <!-- ========= End Sellers Add_Seller ========= -->


        <!-- ========= Start Sellers Insert_Seller ========= -->
        <?php 
            } else if($do == "Insert") {   
                
                if($_SERVER['REQUEST_METHOD'] == "POST") {
                    // this is to bring values from the post form
                    $seller_username = $_POST['seller_userName'];
                    $seller_password = $_POST['seller_Pass'];
                    $firt_name       = $_POST['seller_FirName'];
                    $second_name     = $_POST['seller_SecName'];
                    $seller_email    = $_POST['seller_email'];
                    $seller_phone1   = $_POST['seller_Phone1'];
                    $seller_phone2   = $_POST['seller_Phone2'];
                    $seller_Degree   = $_POST['seller_Degree'];
    
                    // this is the query to insert data which the maib admin add it in the add page
                    $stmt = $con->prepare("INSERT INTO hosters(username , password , first_name , second_name , email , phone1 , phone2 , seller_trust) 
                    VALUES(:Seller_user , :Seller_pass , :Seller_Fname , :Seller_Sname , :Seller_email , :Seller_phone1 , :Seller_phone2 , :Seller_trust)");
    
                    // this is to 
                    $stmt->execute(array(
                        "Seller_user"    => $seller_username, 
                        "Seller_pass"    => $seller_password, 
                        "Seller_Fname"   => $firt_name, 
                        "Seller_Sname"   => $second_name, 
                        "Seller_email"   => $seller_email, 
                        "Seller_phone1"  => $seller_phone1, 
                        "Seller_phone2"  => $seller_phone2, 
                        "Seller_trust"   => $seller_Degree 
                    ));
    
                    // message of success of adding new admin
                    echo "<h2>Success To insert data</h2>";
    
                } else {
                    header("location:?do=Add");
                }
        ?>
        <!-- ========= Start Sellers Insert_Seller ========= -->



        <!-- ========= Start Sellers Edit_Seller ========= -->
        <?php 
            } else if($do == "Edit") {   
                
                if(isset($_GET['sellerID'])) {
                
                    $hased_ID = $_GET['sellerID'];
                    $origin_ID = base64_decode($hased_ID);
                    
                    // this query to select data which match with the id I want to edit on its data
                    $stmt = $con->prepare("SELECT * FROM hosters 
                                           WHERE (seller_trust = 1 OR seller_trust = 2 AND admin_trust = 0) AND ID = ? ");
                    $stmt->execute(array($origin_ID));
                    $row = $stmt->fetch();     
    
                    if($origin_ID == $row["ID"]) { 
        ?>
        <form class="Add-Edit_inputs" action="?do=Update" method="POST">
            <input type="text" style="visibility:hidden;" name="SER_ID_EDT" value="<?php echo base64_encode($row['ID']); ?>">
            <h2 class="header_Add-Edit header_Manage">Edit Seller <i class="fas fa-user-cog"></i></h2>
            <div class="total_admin_inputs">
                <div>
                    <label for="">Frist Name</label>
                    <input type="text" name="SER_Fname_EDT" value="<?php echo $row['first_name']; ?>">
                </div>
                <div>
                    <label for="">Second Name</label>
                    <input type="text" name="SER_Sname_EDT" value="<?php echo $row['second_name']; ?>">
                </div>
                <div>
                    <label for="">Username</label>
                    <input type="text" name="SER_username_EDT" value="<?php echo $row['username']; ?>">
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" name="SER_pass_EDT" value="<?php echo $row['password']; ?>">
                </div>
                <div>
                    <label for="">e-mail</label>
                    <input type="text" name="SER_email_EDT" value="<?php echo $row['email']; ?>">
                </div>
                <div>
                    <label for="">Phone 1</label>
                    <input type="text" name="SER_phone1_EDT" value="<?php echo $row['phone1']; ?>">
                </div>
                <div>
                    <label for="">Phone 2</label>
                    <input type="text" name="SER_phone2_EDT" value="<?php echo(($row['phone2'] == NULL)?" ":$row['phone2']);  ?>">
                </div>
                <div>
                    <label for="">Degree of Admin</label>
                    <select name="seller_Degree_EDT" id="">
                        <?php if($row['seller_trust'] == 1) {
                            echo "<option value='1' selected>1- Main Seller</option>";
                            echo "<option value='2'>2- Second Seller</option>";
                        } else {
                            echo "<option value='1'>1- Main Seller</option>";
                            echo "<option value='2' selected>2- Second Seller</option>";  
                        } ?>                    
                    </select>
                </div>
            </div>
            <input type="submit" class="Add_Edit_Submit btn btn-success" value="Update">
        </form>        
        <!-- ========= End Sellers Edit_table ========= -->


        <!-- ========= Start Sellers Update_Seller ========= -->
        <?php 
                } else {
                    echo "<h2>NOOO</h2>";       // ERROR MESSAGE We will use the redirect funtion
                }    
            } else {
                echo "ERROR";                   // ERROR MESSAGE We will use the redirect funtion
            }
        } else if($do == "Update") {     

            if($_SERVER["REQUEST_METHOD"] == "POST") {
            
                $SER_ID_EDT         = base64_decode($_POST['SER_ID_EDT']);
                $SER_Fname_EDT      = $_POST['SER_Fname_EDT'];
                $SER_Sname_EDT      = $_POST['SER_Sname_EDT'];
                $SER_username_EDT   = $_POST['SER_username_EDT'];
                $SER_pass_EDT       = $_POST['SER_pass_EDT'];
                $SER_email_EDT      = $_POST['SER_email_EDT'];
                $SER_phone1_EDT     = $_POST['SER_phone1_EDT'];
                $SER_phone2_EDT     = $_POST['SER_phone2_EDT'];
                $seller_Degree_EDT  = $_POST['seller_Degree_EDT'];
    
                if($SER_pass_EDT == '') {    
    
                    // =============
                    // ############# this code to select the id from the database
                    $stmt = $con->prepare("SELECT * FROM hosters WHERE ID = ?");
                    $stmt->execute(array($SER_ID_EDT));
                    $row = $stmt->fetch();
                    // =============
    
                    // ******* this varable to assign the the old pass to varaible ($oldPass)
                    $oldPass = $row['password'];
                    $Newpass = $oldPass;       
                             
                } else {
                    $Newpass = $SER_pass_EDT;
                }
    
    
                if($SER_phone1_EDT == '') {    
    
                    // =============
                    // ############# this code to select the id from the database
                    $stmt = $con->prepare("SELECT * FROM hosters WHERE ID = ?");
                    $stmt->execute(array($SER_ID_EDT));
                    $row = $stmt->fetch();
                    // =============
    
                    // ******* this varable to assign the the old pass to varaible ($oldPass)
                    $oldPhone1 = $row['phone1'];
                    $newPhone1 = $oldPhone1;       
                             
                } else {
                    $newPhone1 = $SER_phone1_EDT;
                }
    
    
                if($SER_phone2_EDT == '') {    
    
                    // =============
                    // ############# this code to select the id from the database
                    $stmt = $con->prepare("SELECT * FROM hosters WHERE ID = ?");
                    $stmt->execute(array($SER_ID_EDT));
                    $row = $stmt->fetch();
                    // =============
    
                    // ******* this varable to assign the the old pass to varaible ($oldPass)   
                    $oldPhone2 = $row['phone2'];
                    $newPhone2 = $oldPhone2;   
                             
                } else {
                    $newPhone2 = $SER_phone2_EDT;
                }
    
                $formErrors = array();                    
                echo "<div class='container main_Errors'>";
    
                if(empty($SER_Fname_EDT)) {
                    $formErrors[] = "First name is empty";
                }
    
                if(empty($SER_Sname_EDT)) {
                    $formErrors[] = "Second name is empty";
                }
    
                if(empty($SER_username_EDT)) {
                    $formErrors[] = "username is empty";
                }            
    
                if(empty($SER_email_EDT)) {
                    $formErrors[] = "email is empty";
                }
    
                foreach($formErrors as $err) {
                    echo "<div class='Error_MESG alert alert-danger' style='font-size:20px; margin-top:40px;font-weight:700;' >" . $err . "</div>";
                }
    
                if(empty($formErrors)) {
                    // this for update the data into the database
                    $stmt=$con->prepare("UPDATE hosters SET username = ? , password = ? , first_name = ? , second_name = ? , 
                                                email = ? , phone1 = ? , phone2 = ? , seller_trust = ? WHERE ID = ?");                        
    
                    // I must pass the variable ($AD_ID_EDT) to change data in database and avoid errors
                    // the below codes for the new values of the update
                    $stmt->execute(array(
                                        $SER_username_EDT ,
                                        $Newpass , 
                                        $SER_Fname_EDT ,
                                        $SER_Sname_EDT ,
                                        $SER_email_EDT , 
                                        $newPhone1 ,
                                        $newPhone2 , 
                                        $seller_Degree_EDT ,
                                        $SER_ID_EDT ));
                    
                    // success message
                   echo "<h2>The Updates are saved</ >";
                }
    
            } else {
                echo "ERROR";                   // ERROR MESSAGE We will use the redirect funtion
            }
        ?>
        <!-- ========= Start Sellers Update_Seller ========= -->


        <!-- ========= Start Sellers Delete_Seller ========= -->
        <?php 
            } else if($do == "Delete") {        
                $del_ID = base64_decode($_GET['sellerID']);

                if(isset($_GET['sellerID']) && is_numeric($del_ID)) {

                    $stmt = $con->prepare("DELETE FROM hosters WHERE ID = :SELLER_DEL");
                    $stmt->bindParam(":SELLER_DEL" , $del_ID);
                    $stmt->execute();
                    echo "<br><br><h2 class='alert alert-dark'>one Seller Deleted</h2>";
                    // header("refresh:5;url:admins.php?do=Manage");
                    echo "<a href='sellers.php?do=Manage' class='btn btn-success'>Sellers Page</a>";
                } else {
                    echo "<h2 class='alert alert-danger'>Sorry You can't Delete any Seller</h2>";
                }        
        ?>
        <!-- ========= Start Sellers Delete_Seller ========= -->
    </div>   

    <?php
    }   
        } else {
        header("Location:index.php");
    }
    ?>