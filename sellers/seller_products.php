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
        <!-- ========= Start sellers_products Manage_Product ========= -->
        <!-- ($do == Manage_Product) -->
<?php     
    if($do == 'Manage') {   

        $stmt = $con->prepare("SELECT * FROM products 
                                WHERE trust_product = 1");
        $stmt->execute();
        $rows = $stmt->fetchAll();            
?>
        <h2 class="header_Manage"><i class="fas fa-shopping-cart"></i> منتجات المحل</h2>
        <a href="?do=Add" class="Add_Edit_Submit btn btn-success"><i class="fas fa-cart-plus"></i> اضافة منتج جديد</a>
        <div class="total_products"> 
            <div class="market_product">
                <div class="main_img">
                    <img src="<?php echo $img_path; ?>pant_6.png" alt="">
                </div>
                <div class="pro_plus_imgs">
                    <div>
                        <img src="<?php echo $img_path; ?>pant_6.png" alt="">
                    </div>
                    <div>
                        <img src="<?php echo $img_path; ?>pant_7.png" alt="">
                    </div>
                    <div>
                        <img src="<?php echo $img_path; ?>pant_8.png" alt="">
                    </div>
                </div>
                <div class="product_info">
                    <p class="product_name"><span>الاسم : </span> بنطلون رمادى 1</p>
                    <div class="pro_size">
                        <p><span> الأحجام المتوفرة : </span></p>
                        <div class="product_size"> 
                            <span>X</span>
                            <span>XL</span>
                            <span>XLL</span>
                            <span>LG</span>
                        </div>
                    </div>
                    <p class="product_name"><span>السعر : </span> 350 جنية</p>
                    <p class="product_name"><span>التخفيض : </span> 50%</p>                    
                </div>
                <div class="pro_obtions">
                    <a href="#" class="btn btn-info">تعديل</a>
                    <a href="#" class="btn btn-danger">مسح</a>
                </div>
            </div>                                  
        </div>
        <!-- ========= End sellers_products Manage_table ========= -->




        <!-- ========= Start sellers_products Add_Product ========= -->
        <!-- ($do == Add_Product) -->
<?php     
    } else if($do == "Add") {   
?>
        <form class="Add-Edit_inputs_Sellers" action="?do=Insert" method="POST">
            <h2 class="header_Add-Edit header_Manage">اضافة منتج جديد <i class="fas fa-cart-plus"></i></h2>
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
                    <label for="">الاحجام المتوفرة</label>
                    <select name="" id="">
                        <option value="0"></option>
                        <option value="1">X</option>
                        <option value="2">XL</option>
                        <option value="3">XLL</option>
                        <option value="4">LG</option>
                    </select>
                </div>
                <div>
                    <label for="">السعر بالجنية</label>
                    <input type="tel" name="" required>
                </div>
                <div>
                    <label for="">التخفيض</label>
                    <select name="" id="">
                        <option value=""></option>
                        <option value="">0%</option>
                        <option value="">10%</option>
                        <option value="">20%</option>
                        <option value="">30%</option>
                        <option value="">40%</option>
                    </select>
                </div>
            </div>
            <input type="submit" class="Add_Edit_Submit btn btn-success" value="حفظ">
        </form>
        <!-- ========= End sellers_products Add_Product ========= -->


        <!-- ========= Start sellers_products Insert_Product ========= -->
        <!-- ($do == Insert_Product) -->
<?php     
    } else if($do == "Insert") {   
        
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            // this is to bring values from the post form
            $product_Ar_Name = $_POST['product_Ar_Name'];
            $product_En_Name = $_POST['product_En_Name'];
            $product_size    = $_POST['product_size'];
            $product_price   = $_POST['product_price'];
            $product_dis     = $_POST['product_dis'];

            // this is the query to insert data which the maib admin add it in the add page
            $stmt = $con->prepare("INSERT INTO products(first_name , second_name , XS_size , S_size , M_size, XL_size,L_size,XXL_size,price, trust_product) 
            VALUES(:ADFname , :ADSname , :ADXS , :ADS , :ADM ,:ADXL,:ADL,:ADXXL,:ADprice :ADtrust)");

            // this is to 
            $stmt->execute(array( 
                "ADFname"   => $product_Ar_Name, 
                "ADSname"   => $product_En_Name, 
                "ADXS"      => $product_size, 
                "ADS"       => $product_size, 
                "ADM"       => $product_size, 
                "ADXL"      => $product_size, 
                "ADL"       => $product_size, 
                "ADXXL"     => $product_size, 
                "ADprice"   => $product_price 
            ));

            // message of success of adding new admin
            echo "<h2>Success To insert data</h2>";

        } else {
            header("location:?do=Add");
        }
?>
        <!-- ========= End sellers_products Insert_Product ========= -->
        


        <!-- ========= Start sellers_products Edit_Product ========= -->
        <!-- ($do == Edit_Product) -->
<?php     
    } else if($do == "Edit") {   
        if(isset($_GET['adminID'])) {
            
            $hased_ID = $_GET['adminID'];
            $origin_ID = base64_decode($hased_ID);
            
            // this query to select data which match with the id I want to edit on its data
            $stmt = $con->prepare("SELECT * FROM products 
                                    WHERE (trust_product = 1) AND ID = ? ");
            $stmt->execute(array($origin_ID));
            $row = $stmt->fetch();     

    if($origin_ID == $row["ID"]) {    
?>
        <form class="Add-Edit_inputs_Sellers" action="?do=Update" method="POST">
            <h2 class="header_Add-Edit header_Manage">تعديل منتج <i class="fas fa-cart-plus"></i></h2>
            <div class="total_market_data">
                <div>
                    <label for="">الاسم (بالعربى)</label>
                    <input type="text" name="">
                </div>
                <div>
                    <label for="">الاسم (بالانجليزى)</label>
                    <input type="text" class="En_input" name="">
                </div>
                <div>
                    <label for="">الاحجام المتوفرة</label>
                    <select name="" id="">
                        <option value="0"></option>
                        <option value="1">X</option>
                        <option value="2">XL</option>
                        <option value="3">XLL</option>
                        <option value="4">LG</option>
                    </select>
                </div>
                <div>
                    <label for="">السعر بالجنية</label>
                    <input type="tel" name="">
                </div>
                <div>
                    <label for="">التخفيض</label>
                    <select name="" id="">
                        <option value=""></option>
                        <option value="">0%</option>
                        <option value="">10%</option>
                        <option value="">20%</option>
                        <option value="">30%</option>
                        <option value="">40%</option>
                    </select>
                </div>
                <div>
                    <label for="">الصورة الرئيسية</label>
                    <input type="file" class="img_upload" name="">
                </div>
                <div>
                    <label for="">صورة فرعية 1</label>
                    <input type="file" class="img_upload" name="">
                </div>
                <div>
                    <label for="">صورة فرعية 2</label>
                    <input type="file" class="img_upload" name="">
                </div>
                <div>
                    <label for="">صورة فرعية 3</label>
                    <input type="file" class="img_upload" name="">
                </div>
            </div>
            <input type="submit" class="Add_Edit_Submit btn btn-success" value="حفظ">
        </form>        
        <!-- ========= End sellers_products Edit_table ========= -->


        <!-- ========= Start sellers_products Update_Product ========= -->
        <!-- ($do == Update_Product) -->
        <!-- ========= Start sellers_products Update_Product ========= -->


        <!-- ========= Start sellers_products Delete_Product ========= -->
        <!-- ($do == Delete_Product) -->
<?php     
    } else if($do == "Delete") {   

        $del_ID = base64_decode($_GET['sellerID']);

        if(isset($_GET['sellerID']) && is_numeric($del_ID)) {

            $stmt = $con->prepare("DELETE FROM products WHERE ID = :seller_DEL");
            $stmt->bindParam(":seller_DEL" , $del_ID);
            $stmt->execute();
            echo "<h2 class='alert alert-dark'>one Admin Delete Page</h2>";
            // header("refresh:5;url:admins.php?do=Manage");
            echo "<a href='seller_product.php?do=Manage' class='btn btn-success'>All Products</a>";
        } else {
            echo "<h2 class='alert alert-danger'>Sorry You can't Delete any Product</h2>";
        }

?>
        <!-- ========= Start sellers_products Delete_Product ========= -->

</div>       
<?php
        } 
    } else {
        header("location:index.php");
    }
?>