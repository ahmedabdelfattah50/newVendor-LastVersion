<?php 
    session_start();
    if(isset($_SESSION['name'])) {
        include 'init.php';                   // ======== include the init file ========   
        if(isset($_GET['do'])) {
            $do = $_GET['do'];          
        } else { 
            $do == 'Manage'; 
        }
?>
    <div class="container">
    <!-- ========= Start Sellers_data Manage_Seller ========= -->
    <!-- ($do == Manage_Seller) -->
<?php     
    if($do == 'Manage') {   

        $stmt = $con->prepare("SELECT * FROM hosters 
                                WHERE seller_trust = 1 OR seller_trust = 2");
        $stmt->execute();
        $rows = $stmt->fetchAll();            
?>
    <div class="Market_Data">
        <h2 class="header_Add-Edit header_Manage"><i class="fas fa-store-alt"></i> بيانات صاحب محل أحمد حسن</h2>
        <div class="data_market alert alert-info">
            <h3 for="">الاسم (بالعربى) : <span>أحمد حسن</span></h3>
        </div>
        <div class="data_market alert alert-info">
            <h3 for="">الاسم (بالانجليزى) : <span>Ahmed Hassan</span></h3>
        </div>
        <div class="data_market alert alert-info">
            <h3 for="">اليوزر نيم : <span>Ahmed_Hassan</span></h3>
        </div>
        <div class="data_market alert alert-info">
            <h3 for="">تليفون 1 : <span>01022635745</span></h3>
        </div>
        <div class="data_market alert alert-info">
            <h3 for="">تليفون 2 : <span>010225599</span></h3>
        </div>
        <div class="data_market alert alert-info">
            <h3 for="">الإيميل : <span>ahmedabdo@gmail.com</span></h3>
        </div>
        <div class="data_market alert alert-info">
            <h3 for="">المحل التابع لك : <span>أحمد حسن</span></h3>
        </div>
        <div class="data_market alert alert-info">
            <h3 for="">العنوان : <span>بنها-شارع النجدة - بجوار مستشفى الجامعة</span></h3>
        </div>                    
        <input type="submit" class="Add_Edit_Submit btn btn-info" value="تعديل البيانات">
    </div>
    <!-- ========= End Sellers_data Manage_Seller ========= -->



    <!-- ========= Start Sellers_data Edit_Seller ========= -->
    
    <!-- ($do == Edit_Seller) -->     
    <?php     
        } else if($do == "Edit") {   
            if(isset($_GET['sellerID'])) {
                
                $hased_ID = $_GET['sellerID'];
                $origin_ID = base64_decode($hased_ID);
                
                // this query to select data which match with the id I want to edit on its data
                $stmt = $con->prepare("SELECT * FROM hosters 
                                       WHERE (seller_trust = 1 OR seller_trust = 2) AND ID = ? ");
                $stmt->execute(array($origin_ID));
                $row = $stmt->fetch();     

        if($origin_ID == $row["ID"]) {    
    ?>         
    <form class="Add-Edit_inputs_Sellers" action="?do=Update" method="POST">
        <h2 class="header_Add-Edit header_Manage"><i class="fas fa-user-cog"></i> تعديل بيانات صاحب المحل المحل</h2>
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
                <label for="">اليوزر نيم</label>
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
                <label for="">الإيميل</label>
                <input type="text" name="" required>
            </div>
            <div>
                <label for="">المحل التابع لك</label>
                <input type="text" name="" required>
            </div>
            <div>
                <label for="">العنوان</label>
                <input type="text" name="" required>
            </div>
        </div>
            <input type="submit" class="Add_Edit_Submit btn btn-success" value="حفظ">
    </form>
    <!-- ========= End Sellers_data Edit_Seller ========= -->


    <!-- ========= Start Sellers_data  Update_Seller ========= -->
    <!-- ($do == Update_Seller) --> 
    <!-- ========= Start Sellers_data Update_Seller ========= -->


</div> 