<?php 

    session_start();
    if( isset($_SESSION['name']) ) {
        include 'init.php';                   // ======== include the init file ========   
        if( isset($_GET['do']) ) {
            $do = $_GET['do'];
        } else {
            $do = "Manage";
        }
?>

<div class="container">
        <!-- ========= Start Users Manage_User ========= -->
        <?php
            if( $do == "Manage" ) {
            
                $stmt = $con->prepare("SELECT * FROM users");
                $stmt->execute();
                $rows = $stmt->fetchAll();
        ?>

        <h2 class="header_Manage"><i class="fas fa-users"></i> All Users</h2>
        <div class="total_tabel">        
            <table class="table manage_table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">username</th>
                        <th scope="col">e-mail</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>                
                <tbody>
                    <?php
                        foreach($rows as $row) {
                            echo "<tr>";
                                echo "<th scope='row'>" . $row['ID'] . "</th>";
                                echo "<td>" . $row['first_name'] . " " . $row['last_name']  . "</td>";
                                echo "<td>" . $row['username']  . "</td>";
                                echo "<td>" . $row['email']  . "</td>";
                                echo "<td>";
                                    echo "<div class='btns_control'>";
                                        echo "<a href='?do=Edit&userID=" . base64_encode($row['ID']) . "' class='btn btn-info'>Edit</a>";
                                        echo "<a href='?do=Delete&userID=" . base64_encode($row["ID"]) . "' class='btn btn-danger'>Delete</a>";
                                    echo "</div>";
                                echo "</td>";
                            echo "</tr>";
                        }                       
                    ?>                       
                </tbody>
            </table>        
        </div>
        <!-- ========= End Users Manage_User ========= -->


        <!-- ========= Start Users Edit_User ========= -->
        <?php 
            } else if ( $do == "Edit" ) {
                
                if( isset($_GET['userID']) ) {
                    $hased_userID = $_GET['userID'];
                    $origin_userID = base64_decode($hased_userID);
                    
                    $stmt = $con->prepare("SELECT * FROM users WHERE ID = ? ");
                    $stmt->execute( array($origin_userID) );
                    $row_user = $stmt->fetch();

                if( $origin_userID == $row_user['ID'] ) { 
        ?>  

        <form class="Add-Edit_inputs" action="?do=Update" method="POST">
            <input type="text" name="userID_EDT" value="<?php echo base64_encode($row_user['ID'])?>" style="visibility:hidden">
            <h2 class="header_Add-Edit header_Manage">Edit User <i class="fas fa-user-cog"></i></h2>
            <div class="total_admin_inputs">
                <div>
                    <label for="">First Name</label>
                    <input type="text" name="FirUser_EDT" value="<?php echo $row_user['first_name']?>">
                </div>
                <div>
                    <label for="">Second Name</label>
                    <input type="text" name="SecUser_EDT" value="<?php echo $row_user['last_name']?>">
                </div>
                <div>
                    <label for="">Username</label>
                    <input type="text" name="usname_USER_EDT" value="<?php echo $row_user['username']?>">
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" name="PassUser_EDT" value="<?php echo $row_user['password']?>">
                </div>
                <div>
                    <label for="">e-mail</label>
                    <input type="text" name="emailUser_EDT" value="<?php echo $row_user['email']?>">
                </div>
            </div>
            <input type="submit" class="Add_Edit_Submit btn btn-success" value="Update">
        </form>        
        <!-- ========= End Users Edit_User ========= -->


        <!-- ========= Start Users Update_User ========= -->
        <?php 
            } else {
                echo "Sorry This User ID is Error";
            }
                } else {
                    echo "<br><br><h2 class='alert alert-danger'>ERROR 404 : Sorry This Page Not Found</h2>";
                    echo "<a href='dashboard.php' class='btn btn-info'>Dashboard</a>";
                }
                    } else if ( $do == "Update" ) {
                        
                        if( $_SERVER['REQUEST_METHOD'] == "POST" ) {

                            $userID_EDT = base64_decode($_POST['userID_EDT']);
                            $FirUser_EDT = $_POST['FirUser_EDT'];
                            $SecUser_EDT = $_POST['SecUser_EDT'];
                            $usname_USER_EDT = $_POST['usname_USER_EDT'];
                            $PassUser_EDT = $_POST['PassUser_EDT'];
                            $emailUser_EDT = $_POST['emailUser_EDT'];

                            if($PassUser_EDT == '') {    

                                // =============
                                // ############# this code to select the id from the database
                                $stmt = $con->prepare("SELECT * FROM users WHERE ID = ?");
                                $stmt->execute(array($userID_EDT));
                                $row = $stmt->fetch();
                                // =============
                
                                // ******* this varable to assign the the old pass to varaible ($oldPass)
                                $oldPass = $row['password'];
                                $Newpass = $oldPass;       
                                         
                            } else {
                                $Newpass = $PassUser_EDT;
                            }

                            $formErrors = array();                    
                            echo "<div class='container main_Errors'>";

                            if(empty($FirUser_EDT)) {
                                $formErrors[] = "First name is empty";
                            }

                            if(empty($SecUser_EDT)) {
                                $formErrors[] = "Second name is empty";
                            }

                            if(empty($usname_USER_EDT)) {
                                $formErrors[] = "username is empty";
                            }            

                            if(empty($emailUser_EDT)) {
                                $formErrors[] = "email is empty";
                            }

                            foreach($formErrors as $err) {
                                echo "<div class='Error_MESG alert alert-danger' style='font-size:20px; margin-top:40px;font-weight:700;' >" . $err . "</div>";
                            }

                            if(empty($formErrors)) {
                                // this for update the data into the database
                                $stmt=$con->prepare("UPDATE users SET username = ? , password = ? , first_name = ? , last_name = ? , 
                                                            email = ? WHERE ID = ?");                        

                                // I must pass the variable ($userID_EDT) to change data in database and avoid errors
                                // the below codes for the new values of the update
                                $stmt->execute(array(
                                    $usname_USER_EDT ,
                                    $Newpass ,
                                    $FirUser_EDT ,
                                    $SecUser_EDT ,
                                    $emailUser_EDT ,
                                    $userID_EDT ));
                                
                                // success message
                            echo "<h2>The Updates are saved</ >";
                            }

                        } else {
                            echo "ERROR";                   // ERROR MESSAGE We will use the redirect funtion
                        }

                        
        ?>
        <!-- ========= Start Users Update_User ========= -->


        <!-- ========= Start Users Delete_User ========= -->
        <?php 
            } else if ( $do == "Delete" ) {

                $del_ID = base64_decode($_GET['userID']);

                if(isset($_GET['userID']) && is_numeric($del_ID)) {
                    $stmt = $con->prepare("DELETE FROM users WHERE ID = :USER_Del_ID");
                    $stmt->bindParam(":USER_Del_ID" , $del_ID);
                    $stmt->execute();

                    echo "<br><br><h2 class='alert alert-dark'>one Admin Delete Page</h2>";
                    echo "<a href='users.php?do=Manage' class='btn btn-success'>Users Page</a>";
                } else {
                    echo "<h2 class='alert alert-danger'>Sorry You can't Delete any admin</h2>";
                }

            } else {
                echo "<br><br><h2 class='alert alert-danger'>ERROR 404 : Sorry This Page Not Found</h2>";
                echo "<a href='dashboard.php' class='btn btn-info'>Dashboard</a>";
            }
        ?>
        <!-- ========= Start Users Delete_User ========= -->
    </div>

<?php
    } else {
        header("Location:index.php");
    }
?>