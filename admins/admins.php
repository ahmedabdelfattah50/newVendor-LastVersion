<?php

    echo "Ahmed";
    session_start();
    if(isset($_SESSION['name'])) {
        include 'init.php';                   // ======== include the init file ========
        if(isset($_GET['do'])) {
            $do = $_GET['do'];
        } else {
            $do = 'Manage';
        }
?>  

    <div class="container">
    <!-- ========= Start Admins Manage_table ========= -->
    <?php
        if($do == 'Manage') {

            $stmt = $con->prepare("SELECT * FROM hosters
                                   WHERE admin_trust = 1 OR admin_trust = 2 AND seller_trust = 0");
            $stmt->execute();
            $rows = $stmt->fetchAll();
    ?>
    <h2 class="header_Manage"><i class="fas fa-users-cog"></i> All Admins</h2>
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
                                    echo "<a href='?do=Edit&adminID=" . base64_encode($row['ID']) . "'class='btn btn-info'>Edit</a>";
                                    echo "<a href='?do=Delete&adminID=" . base64_encode($row['ID']) . "'class='btn btn-danger'>Delete</a>";
                                echo "</div>";
                            echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        <a href="?do=Add" class="Add_Edit_Submit btn btn-success">Add New Admin <i class="fas fa-user-plus"></i></a>
    </div>
    <!-- ========= End Admins Manage_table ========= -->


    <!-- ========= Start Admins Add_Admin ========= -->
    <?php
        } else if($do == "Add") {
    ?>
    <!-- enctype="multipart/form-data" -->
    <form class="Add-Edit_inputs" action="?do=Insert" method="POST">
        <h2 class="header_Add-Edit header_Manage">Add Admin <i class="fas fa-user-plus"></i></h2>
        <div class="total_admin_inputs">
            <div>
                <label for="">First Name</label>
                <input type="text" name="admin_FirName" required>
            </div>
            <div>
                <label for="">Second Name</label>
                <input type="text" name="admin_SecName" required>
            </div>
            <div>
                <label for="">Username</label>
                <input type="text" name="admin_userName" required>
            </div>
            <div>
                <label for="">Password</label>
                <input type="password" name="admin_Pass" required>
            </div>
            <div>
                <label for="">e-mail</label>
                <input type="text" name="admin_email" required>
            </div>
            <div>
                <label for="">Phone 1</label>
                <input type="text" name="admin_Phone1" required>
            </div>
            <div>
                <label for="">Phone 2</label>
                <input type="text" name="admin_Phone2" required>
            </div>
            <div>
                <label for="">Degree of Admin</label>
                <select name="admin_Degree" id="">
                    <option value=""></option>
                    <option value="1">1- Main Admin</option>
                    <option value="2">2- Second Admin</option>
                </select>
            </div>
            <!-- <div>
                <label for="">image</label>
                <input type="file" name="admin_img">
            </div> -->
        </div>
            <input type="submit" class="Add_Edit_Submit btn btn-success" value="Add">
        </form>
    <!-- ========= End Admins Add_Admin ========= -->




    <!-- ========= Start Admins Insert_Admin ========= -->

    <?php
        } else if($do == "Insert") {

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                /*
                // this for the upload image in the project folder and the database
                $admin_img = $_FILES['admin_img'];
                print_r($admin_img);

                $img_name = $_FILES['admin_img']['name'];
                // echo $_FILES['admin_img']['size'] . "<br>";
                $img_TempName = $_FILES['admin_img']['tmp_name'];
                // echo $_FILES['admin_img']['type'] . "<br>";
                $imgAllowedExtintions = array("png" , 'jpeg' , 'jpg' , "gif");

                $imge_name = $_FILES['admin_img']['name'];


                $img_admin = strtolower( end( explode('.' , $imge_name) ));

                if( in_array($img_admin , $imgAllowedExtintions) ) {
                    echo $img_admin;
                    echo "YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY";
                }

                echo rand(0 , 9000000);

                $avtar = rand(0 , 9000000) . "_" . $img_name;

                move_uploaded_file($img_TempName , "uploades\images\\" . $avtar);
                */

                // this is to bring values from the post form
                $admin_username = $_POST['admin_userName'];
                $admin_password = $_POST['admin_Pass'];
                $firt_name      = $_POST['admin_FirName'];
                $second_name    = $_POST['admin_SecName'];
                $admin_email    = $_POST['admin_email'];
                $admin_phone1   = $_POST['admin_Phone1'];
                $admin_phone2   = $_POST['admin_Phone2'];
                $admin_Degree   = $_POST['admin_Degree'];

                // this is the query to insert data which the maib admin add it in the add page
                $stmt = $con->prepare("INSERT INTO hosters(username , password , first_name , second_name , email , phone1 , phone2 , img , admin_trust)
                VALUES(:ADuser , :ADpass , :ADFname , :ADSname , :ADemail , :ADphone1 , :ADphone2 , :ADtrust)");

                // this is to
                $stmt->execute(array(
                    "ADuser"        => $admin_username,
                    "ADpass"        => $admin_password,
                    "ADFname"       => $firt_name,
                    "ADSname"       => $second_name,
                    "ADemail"       => $admin_email,
                    "ADphone1"      => $admin_phone1,
                    "ADphone2"      => $admin_phone2,
                    "ADtrust"       => $admin_Degree
                ));

                // message of success of adding new admin
                echo "<h2>Success To insert data</h2>";

            } else {
                header("location:?do=Add");
            }

    ?>
    <!-- ========= End Admins Insert_Admin ========= -->




    <!-- ========= Start Admins Edit_table ========= -->
    <?php
        } else if($do == "Edit") {
            if(isset($_GET['adminID'])) {

                $hased_ID = $_GET['adminID'];
                $origin_ID = base64_decode($hased_ID);

                // this query to select data which match with the id I want to edit on its data
                $stmt = $con->prepare("SELECT * FROM hosters
                                       WHERE (admin_trust = 1 OR admin_trust = 2 AND seller_trust = 0) AND ID = ? ");
                $stmt->execute(array($origin_ID));
                $row = $stmt->fetch();

                if($origin_ID == $row["ID"]) {
    ?>
    <form class="Add-Edit_inputs" action="?do=Update" method="POST">
        <input type="text" style="visibility:hidden;" name="AD_ID_EDT" value="<?php echo base64_encode($row['ID']); ?>">
        <h2 class="header_Add-Edit header_Manage">Edit Admin <i class="fas fa-user-cog"></i></h2>
        <div class="total_admin_inputs">
            <div>
                <label for="">Frist Name</label>
                <input type="text" name="AD_Fname_EDT" value="<?php echo $row['first_name']; ?>">
            </div>
            <div>
                <label for="">Second Name</label>
                <input type="text" name="AD_Sname_EDT" value="<?php echo $row['second_name']; ?>">
            </div>
            <div>
                <label for="">Username</label>
                <input type="text" name="AD_username_EDT" value="<?php echo $row['username']; ?>">
            </div>
            <div>
                <label for="">Password</label>
                <input type="password" name="AD_pass_EDT" value="<?php echo $row['password']; ?>">
            </div>
            <div>
                <label for="">e-mail</label>
                <input type="text" name="AD_email_EDT" value="<?php echo $row['email']; ?>">
            </div>
            <div>
                <label for="">Phone 1</label>
                <input type="text" name="AD_phone1_EDT" value="<?php echo $row['phone1']; ?>">
            </div>
            <div>
                <label for="">Phone 2</label>
                <input type="text" name="AD_phone2_EDT" value="<?php echo(($row['phone2'] == NULL)?" ":$row['phone2']);  ?>">
            </div>
            <div>
                <label for="">Degree of Admin</label>
                <select name="admin_Degree_EDT" id="">
                    <?php if($row['admin_trust'] == 1) {
                        echo "<option value='1' selected>1- Main Admin</option>";
                        echo "<option value='2'>2- Second Admin</option>";
                    } else {
                        echo "<option value='1'>1- Main Admin</option>";
                        echo "<option value='2' selected>2- Second Admin</option>";
                    } ?>
                </select>
            </div>
        </div>
        <input type="submit" class="Add_Edit_Submit btn btn-success" value="Update">
    </form>
    <!-- ========= End Admins Edit_table ========= -->




    <!-- ========= Start Admins Update_Admin ========= -->
    <?php
            } else {
                echo "<h2>NOOO</h2>";       // ERROR MESSAGE We will use the redirect funtion
            }
        } else {
            echo "ERROR";                   // ERROR MESSAGE We will use the redirect funtion
        }
    } else if($do == "Update") {

        if($_SERVER["REQUEST_METHOD"] == "POST") {

            $AD_ID_EDT         = base64_decode($_POST['AD_ID_EDT']);
            $AD_Fname_EDT      = $_POST['AD_Fname_EDT'];
            $AD_Sname_EDT      = $_POST['AD_Sname_EDT'];
            $AD_username_EDT   = $_POST['AD_username_EDT'];
            $AD_pass_EDT       = $_POST['AD_pass_EDT'];
            $AD_email_EDT      = $_POST['AD_email_EDT'];
            $AD_phone1_EDT     = $_POST['AD_phone1_EDT'];
            $AD_phone2_EDT     = $_POST['AD_phone2_EDT'];
            $admin_Degree_EDT  = $_POST['admin_Degree_EDT'];

            if($AD_pass_EDT == '') {

                // =============
                // ############# this code to select the id from the database
                $stmt = $con->prepare("SELECT * FROM hosters WHERE ID = ?");
                $stmt->execute(array($AD_ID_EDT));
                $row = $stmt->fetch();
                // =============

                // ******* this varable to assign the the old pass to varaible ($oldPass)
                $oldPass = $row['password'];
                $Newpass = $oldPass;

            } else {
                $Newpass = $AD_pass_EDT;
            }


            if($AD_phone1_EDT == '') {

                // =============
                // ############# this code to select the id from the database
                $stmt = $con->prepare("SELECT * FROM hosters WHERE ID = ?");
                $stmt->execute(array($AD_ID_EDT));
                $row = $stmt->fetch();
                // =============

                // ******* this varable to assign the the old pass to varaible ($oldPass)
                $oldPhone1 = $row['phone1'];
                $newPhone1 = $oldPhone1;

            } else {
                $newPhone1 = $AD_phone1_EDT;
            }


            if($AD_phone2_EDT == '') {

                // =============
                // ############# this code to select the id from the database
                $stmt = $con->prepare("SELECT * FROM hosters WHERE ID = ?");
                $stmt->execute(array($AD_ID_EDT));
                $row = $stmt->fetch();
                // =============

                // ******* this varable to assign the the old pass to varaible ($oldPass)
                $oldPhone2 = $row['phone2'];
                $newPhone2 = $oldPhone2;

            } else {
                $newPhone2 = $AD_phone2_EDT;
            }

            $formErrors = array();
            echo "<div class='container main_Errors'>";

            if(empty($AD_Fname_EDT)) {
                $formErrors[] = "First name is empty";
            }

            if(empty($AD_Sname_EDT)) {
                $formErrors[] = "Second name is empty";
            }

            if(empty($AD_username_EDT)) {
                $formErrors[] = "username is empty";
            }

            if(empty($AD_email_EDT)) {
                $formErrors[] = "email is empty";
            }

            foreach($formErrors as $err) {
                echo "<div class='Error_MESG alert alert-danger' style='font-size:20px; margin-top:40px;font-weight:700;' >" . $err . "</div>";
            }

            if(empty($formErrors)) {
                // this for update the data into the database
                $stmt=$con->prepare("UPDATE hosters SET username = ? , password = ? , first_name = ? , second_name = ? ,
                                            email = ? , phone1 = ? , phone2 = ? , admin_trust = ? WHERE ID = ?");

                // I must pass the variable ($AD_ID_EDT) to change data in database and avoid errors
                // the below codes for the new values of the update
                $stmt->execute(array(
                                    $AD_username_EDT ,
                                    $Newpass ,
                                    $AD_Fname_EDT ,
                                    $AD_Sname_EDT ,
                                    $AD_email_EDT ,
                                    $newPhone1 ,
                                    $newPhone2 ,
                                    $admin_Degree_EDT ,
                                    $AD_ID_EDT ));

                // success message
               echo "<h2>The Updates are saved</h2>";
            }

        } else {
            echo "ERROR";                   // ERROR MESSAGE We will use the redirect funtion
        }

    ?>
    <!-- ========= End Admins Update_Admin ========= -->





    <!-- ========= Start Admins Delete_Admin ========= -->
    <?php
        } else if($do == "Delete") {

            $del_ID = base64_decode($_GET['adminID']);

            if(isset($_GET['adminID']) && is_numeric($del_ID)) {

                $stmt = $con->prepare("DELETE FROM hosters WHERE ID = :ADMIN_DEL");
                $stmt->bindParam(":ADMIN_DEL" , $del_ID);
                $stmt->execute();
                echo "<br><br><h2 class='alert alert-dark'>one Admin Deleted</h2>";
                // header("refresh:5;url:admins.php?do=Manage");
                echo "<a href='admins.php?do=Manage' class='btn btn-success'>Admins Page</a>";
            } else {
                echo "<h2 class='alert alert-danger'>Sorry You can't Delete any Admin</h2>";
            }

    ?>
    <!-- ========= End Admins Delete_Admin ========= -->



</div>

<?php
        }
    } else {
        header("location:index.php");
    }
?>
