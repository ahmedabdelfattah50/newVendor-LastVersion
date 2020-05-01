<?php 
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
        <!-- ========= Start Markets Manage_Market ========= -->
        <?php        
            if($do == 'Manage') {   

                $stmt = $con->prepare("SELECT * FROM markets");
                $stmt->execute();
                $rows = $stmt->fetchAll(); 
        ?>

        <h2 class="header_Manage"><i class="fas fa-store-alt"></i> All Markets</h2>
        <div class="total_tabel">        
            <table class="table manage_table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Arabic Name</th>
                        <th scope="col">English Name</th>
                        <th scope="col">City</th>
                        <th scope="col">Address</th>
                        <th scope="col">Owner</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>                
                <tbody>
                    <?php
                        foreach($rows as $row) {                                                
                            echo "<tr>";
                                echo "<th scope='row'>" . $row['ID'] . "</th>";
                                echo "<td>" . $row['AR_name'] . "</td>";
                                echo "<td>" . $row['EN_name'] . "</td>";
                                echo "<td>" . $row['city'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "<td>" . $row['owner_ID'] . "</td>";
                                echo "<td>";
                                    echo "<div class='btns_control'>";
                                        echo "<a href='?do=Edit&marketID=" . base64_encode($row['ID']) . "'class='btn btn-info'>Edit</a>";
                                        echo "<a href='?do=Delete&marketID=" . base64_encode($row['ID']) . "'class='btn btn-danger'>Delete</a>";                                
                                    echo "</div>";
                                echo "</td>";
                            echo "</tr>";                                                  
                        }
                    ?>
                </tbody>
            </table>        
            <a href="?do=Add" class="Add_Edit_Submit btn btn-success">Add New Market <i class="fas fa-store-alt"></i></a>
        </div>
        <!-- ========= End Markets Manage_Market ========= -->



        <!-- ========= Start Markets Add_Market ========= -->
        <?php
            } else if($do == "Add") {

        ?>
        <form class="Add-Edit_inputs" action="?do=Insert" method="POST">
            <h2 class="header_Add-Edit header_Manage">Add Market <i class="fas fa-store-alt"></i></h2>
            <div class="total_admin_inputs">
                <div>
                    <label for="">Ar Name</label>
                    <input type="text" name="Name_AR_market" required>
                </div>
                <div>
                    <label for="">En Name</label>
                    <input type="text" name="Name_EN_market" required>
                </div>
                <div>
                    <label for="">City</label>
                    <input type="text" name="city_market" required>
                </div>
                <div>
                    <label for="">Address</label>
                    <input type="text" name="address_market" required>
                </div>
                <div>
                    <label for="">Owner</label>
                    <select name="owner_market" id="">
                        <option value="0">---</option>
                        <?php 
                            $stmt = $con->prepare("SELECT * FROM hosters WHERE (seller_trust = 1 OR seller_trust = 2) AND market_ID = 0");
                            $stmt->execute();
                            $rows = $stmt->fetchAll();

                            // this for select all sellers from the hosters table which has not market
                            foreach($rows as $row) {
                                echo "<option value='" . $row['ID'] . "'>" . $row['first_name'] . " " . $row['second_name'] . "</option>";
                            }
                        ?>                        
                    </select>
                </div>
                <div>
                    <label for="">Phone</label>
                    <input type="text" name="phone_market" required>
                </div>
            </div>
            <input type="submit" class="Add_Edit_Submit btn btn-success" value="Add">
        </form>        
        <!-- ========= End Markets Add_Market ========= -->



        <!-- ========= Start Markets Insert_Market ========= -->
        <?php
            } else if($do == "Insert") {
                if($_SERVER['REQUEST_METHOD'] == "POST") {
                    // this is to bring values from the post form
                    $Name_AR_market         = $_POST['Name_AR_market'];
                    $Name_EN_market         = $_POST['Name_EN_market'];                    
                    $city_market            = $_POST['city_market'];
                    $owner_market           = $_POST['owner_market'];
                    $address_market         = $_POST['address_market'];
                    $phone_market           = $_POST['phone_market'];
    
                    // this is the query to insert data which the maib admin add it in the add page
                    $stmt = $con->prepare("INSERT INTO markets(AR_name , EN_name , city , address , phone , owner_ID) 
                    VALUES(:market_AR_name , :market_EN_name , :marketCity , :marketaddress , :marketphone , :marketOwner_ID)");
    
                    // this is to 
                    $stmt->execute(array(
                        "market_AR_name"      => $Name_AR_market, 
                        "market_EN_name"      => $Name_EN_market, 
                        "marketCity"          => $city_market, 
                        "marketaddress"       => $address_market, 
                        "marketphone"         => $phone_market, 
                        "marketOwner_ID"      => $owner_market 
                    ));
    
                    // message of success of adding new admin
                    echo "<h2>Success To insert data</h2>";
    
                } else {
                    header("location:?do=Add");
                }
        ?>
        <!-- ========= Start Markets Insert_Market ========= -->




        <!-- ========= Start Markets Edit_Market ========= -->
        <?php
            } else if($do == "Edit") {
                if(isset($_GET['marketID'])) {
                
                    $hased_ID = $_GET['marketID'];
                    $origin_ID = base64_decode($hased_ID);
                    
                    // this query to select data which match with the id I want to edit on its data
                    $stmt = $con->prepare("SELECT * FROM markets WHERE ID = ? ");
                    $stmt->execute(array($origin_ID));
                    $row = $stmt->fetch();     
    
                    if($origin_ID == $row["ID"]) {
        ?>
        <form class="Add-Edit_inputs" action="?do=Update" method="POST">
            <input type="text" style="visibility:hidden;" name="market_ID_EDT" value="<?php echo base64_encode($row['ID']); ?>">
            <h2 class="header_Add-Edit header_Manage">Edit Market <i class="fas fa-store-alt"></i></h2>
            <div class="total_admin_inputs">
                <div>
                    <label for="">Ar Name</label>
                    <input type="text" name="Name_AR_market_EDT" value="<?php echo $row['AR_name']; ?>">
                </div>
                <div>
                    <label for="">En Name</label>
                    <input type="text" name="Name_EN_market_EDT" value="<?php echo $row['EN_name']; ?>">
                </div>
                <div>
                    <label for="">City</label>
                    <input type="text" name="city_market_EDT" value="<?php echo $row['city']; ?>">
                </div>
                <div>
                    <label for="">Address</label>
                    <input type="text" name="address_market_EDT" value="<?php echo $row['address']; ?>">
                </div>
                <div>
                    <label for="">Owner</label>
                    <select name="owner_market_EDT" id="">
                        <option value="0">---</option>
                        <?php 
                            $stmt2 = $con->prepare("SELECT * FROM hosters WHERE (seller_trust = 1 OR seller_trust = 2) AND market_ID = 0");
                            $stmt2->execute();
                            $rows = $stmt2->fetchAll();

                            // this for select all sellers from the hosters table which has not market
                            foreach($rows as $row2) {
                                echo "<option value='" . $row2['ID'] . "'>" . $row2['first_name'] . " " . $row2['second_name'] . "</option>";
                            }
                        ?>                        
                    </select>
                </div>
                <div>
                    <label for="">Phone</label>
                    <input type="text" name="phone_market_EDT" value="<?php echo $row['phone']; ?>">
                </div>
            </div>
            <input type="submit" class="Add_Edit_Submit btn btn-success" value="Update">
        </form>        
        <!-- ========= End Markets Edit_Market ========= -->



        <!-- ========= Start Markets Update_Market ========= -->
        <?php
                } else {
                    echo "<h2>NOOO</h2>";       // ERROR MESSAGE We will use the redirect funtion
                }    
            } else {
                echo "ERROR";                   // ERROR MESSAGE We will use the redirect funtion
            }
        } else if($do == "Update") {

            if($_SERVER["REQUEST_METHOD"] == "POST") {
            
                $market_ID_EDT            = base64_decode($_POST['market_ID_EDT']);
                $Name_AR_market_EDT       = $_POST['Name_AR_market_EDT'];     
                $Name_EN_market_EDT       = $_POST['Name_EN_market_EDT'];
                $city_market_EDT          = $_POST['city_market_EDT'];
                $address_market_EDT       = $_POST['address_market_EDT'];
                $phone_market_EDT         = $_POST['phone_market_EDT'];
                $owner_market_EDT         = $_POST['owner_market_EDT'];
            
       
                if($phone_market_EDT == '') {    
    
                    // =============
                    // ############# this code to select the id from the database
                    $stmt = $con->prepare("SELECT * FROM markets WHERE ID = ?");
                    $stmt->execute(array($market_ID_EDT));
                    $row = $stmt->fetch();
                    // =============
    
                    // ******* this varable to assign the the old pass to varaible ($oldPass)
                    $oldPhone1 = $row['phone1'];
                    $newPhone1 = $oldPhone1;       
                             
                } else {
                    $newPhone1 = $phone_market_EDT;
                }
    
                $formErrors = array();                    
                echo "<div class='container main_Errors'>";
    
                if(empty($Name_AR_market_EDT)) {
                    $formErrors[] = "AR name is empty";
                }

                if(empty($Name_EN_market_EDT)) {
                    $formErrors[] = "EN name is empty";
                }
    
                if(empty($owner_market_EDT)) {
                    $formErrors[] = "owner of market is empty";
                }
    
                foreach($formErrors as $err) {
                    echo "<div class='Error_MESG alert alert-danger' style='font-size:20px; margin-top:40px;font-weight:700;' >" . $err . "</div>";
                }
    
                if(empty($formErrors)) {
                    // this for update the data into the database
                    $stmt=$con->prepare("UPDATE markets SET AR_name = ? , EN_name = ? , city = ? , address = ? , phone = ? , owner_ID = ? WHERE ID = ?");                        
    
                    // I must pass the variable ($AD_ID_EDT) to change data in database and avoid errors
                    // the below codes for the new values of the update
                    $stmt->execute(array(
                                        $Name_AR_market_EDT ,
                                        $Name_EN_market_EDT ,
                                        $city_market_EDT , 
                                        $address_market_EDT ,
                                        $phone_market_EDT , 
                                        $owner_market_EDT ,
                                        $market_ID_EDT ));
                    
                    // success message
                   echo "<h2>The Updates are saved</ >";
                }
    
            } else {
                echo "ERROR";                   // ERROR MESSAGE We will use the redirect funtion
            }
        ?>
        <!-- ========= Start Markets Update_Market ========= -->




        <!-- ========= Start Markets Delete_Market ========= -->
        <?php
            } else if($do == "Delete") {
                $del_ID = base64_decode($_GET['marketID']);

                if(isset($_GET['marketID']) && is_numeric($del_ID)) {

                    $stmt = $con->prepare("DELETE FROM markets WHERE ID = :Market_DEL");
                    $stmt->bindParam(":Market_DEL" , $del_ID);
                    $stmt->execute();
                    echo "<br><br><h2 class='alert alert-dark'>one Market Deleted</h2>";
                    echo "<a href='markets.php?do=Manage' class='btn btn-success'>Markets Page</a>";
                } else {
                    echo "<h2 class='alert alert-danger'>Sorry You can't Delete any Market</h2>";
                }
        ?>
        <!-- ========= Start Markets Delete_Market ========= -->

    </div>

    <?php
        }   
    } else {
        header("Location:index.php");
    }
    ?>