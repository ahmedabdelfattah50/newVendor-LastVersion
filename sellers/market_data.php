<?php 

    // فى الصفحة دية قفلة الاقواس مكنتش مظبوطة

    session_start(); 
    if(isset($_SESSION['name'])) {
        include 'init.php';                   // ======== include the init file ========   
        if(isset($_GET['do'])) {
            $do = $_GET['do'];          
        } else {
            $do = 'Manage';         // ***************** غلطتى
        }
?>

    <div class="container">
        <!-- ========= Start market_data Manage_Market ========= -->
        <?php     
        if($do == 'Manage') {   

            $stmt = $con->prepare("SELECT * FROM markets 
                                   WHERE owner_ID = ? ");   // ************** هنا انتى ما عملتيش هتختارى الداتا على اساس ايه
            $stmt->execute(array($_SESSION['userID']));            // **************
            $rows = $stmt->fetch();            

            // حطيت الداتا اللى متخزنة فى الداتا بيز هنا
        ?>
        <div class="Market_Data">
            <h2 class="header_Add-Edit header_Manage"><i class="fas fa-store-alt"></i> بيانات المحل</h2>
            <div class="data_market alert alert-info">
                <h3 for="">الاسم (بالعربى) : <span><?php echo $rows['AR_name'];?></span></h3>
            </div>
            <div class="data_market alert alert-info">
                <h3 for="">الاسم (بالانجليزى) : <span><?php echo $rows['EN_name'];?></span></h3>
            </div>
            <div class="data_market alert alert-info">
                <h3 for="">تليفون 1 : <span><?php echo $rows['phone'];?></span></h3>
            </div>
            <div class="data_market alert alert-info">
                <h3 for="">تليفون 2 : <span><?php echo $rows['owner_ID'];?></span></h3>
            </div>
            <div class="data_market alert alert-info">
                <h3 for="">المدينة : <span><?php echo $rows['city'];?></span></h3>
            </div> 
            <div class="data_market alert alert-info">
                <h3 for="">العنوان : <span><?php echo $rows['address'];?></span></h3>
            </div> 
            <input type="submit" class="Add_Edit_Submit btn btn-info" value="تعديل البيانات">
        </div>
        <!-- ========= End market_data Manage_Market ========= -->




        <!-- ========= Start market_data Edit_Market ========= -->
        <!-- ($do == Edit_Market) -->
        <?php     
        } else if($do == "Edit") {   
            if(isset($_GET['adminID'])) {
                
                $hased_ID = $_GET['adminID'];
                $origin_ID = base64_decode($hased_ID);
                
                // this query to select data which match with the id I want to edit on its data
                $stmt = $con->prepare("SELECT * FROM markets 
                                       WHERE () AND ID = ? ");
                $stmt->execute(array($origin_ID));
                $row = $stmt->fetch();     

        if($origin_ID == $row["ID"]) {    
        ?>
        <form class="Add-Edit_inputs_Sellers" action="?do=Update" method="POST">
            <h2 class="header_Add-Edit header_Manage"><i class="fas fa-store-alt"></i> تعديل بيانات المحل</h2>
            <div class="total_market_data">
                <div>
                    <label for="">الاسم (بالعربى)</label>
                    <input type="text" name="" required>
                </div>
                <div>
                    <label for="">الاسم (بالانجليزى)</label>
                    <input type="text" class="En_input" name="" required>
                </div>
                <div>
                    <label for="">تليفون 1</label>
                    <input type="tel" name="" required>
                </div>
                <div>
                    <label for="">تليفون 2</label>
                    <input type="tel" name="" required>
                </div>
                <div>
                    <label for="">العنوان</label>
                    <input type="text" name="" required>
                </div>
            </div>
            <input type="submit" class="Add_Edit_Submit btn btn-success" value="حفظ">
        </form>        
        <!-- ========= End market_data Edit_Market ========= -->


        <!-- ========= Start market_data Update_Market ========= -->
        <!-- ($do == Update_Market) -->
        <?php
                } 
            }   
        } else if($do == 'Update') {

        }
        ?>
        <!-- ========= Start market_data Update_Market ========= -->
</div> 
<?php
        } else {
        header("location:index.php");
    }
?>  