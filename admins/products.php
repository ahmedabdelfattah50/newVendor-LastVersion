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
        <!-- ========= Start Products Manage_Product ========= -->
        <?php
            if($do == 'Manage') {

            $stmt = $con->prepare("SELECT * FROM products");
            $stmt->execute();
            $rows = $stmt->fetchAll();
        ?>

        <h2 class="header_Manage"><i class="fas fa-shopping-cart"></i> منتجات المحل</h2>
        <a href="?do=Add" class="Add_Edit_Submit btn btn-success"><i class="fas fa-cart-plus"></i> اضافة منتج جديد</a>
        <div class="total_products">

            <?php            
                foreach($rows as $row_prod) {
                echo "<div class='market_product'>";
                // echo $row_prod['name'] . "<br>";
                // echo $row_prod['market_ID'];
                // $mar_ID = $row_prod['market_ID'];

                $stmt = $con->prepare("SELECT * FROM markets WHERE ID = ? ");
                $stmt->execute(array($row_prod['market_ID']));
                $market_name_Product = $stmt->fetch();
                $market_name_path = $market_name_Product['EN_name'];

                $img_path_local = "uploades\products_images\\" . $market_name_path . "\\" . $row_prod['name'] . "\\";
                // echo "<img src='" . $img_path_local . $row_prod['main_img'] . "' alt=''>";
                // echo $img_path_local . $row_prod['main_img'];
                // echo $img_path_local;
                // the path of the folder which want to create it and put image in it 
                // $products_imgs_Marketfolder = "uploades\products_images\\" . $market_name . "\\";

                // this path of folider of the images of the product in the market
                // $product_imgs = $products_imgs_Marketfolder . $product_name . "\\";
                    echo "<div class='main_img'>";
                        echo "<img src='" . $img_path_local . $row_prod['main_img'] . "' alt=''>";
                    echo "</div>";
                    echo "<div class='pro_plus_imgs'>";
                        echo "<div>";
                            echo "<img src='" . $img_path_local . $row_prod['img_1'] . "' alt=''>";
                        echo "</div>";
                        echo "<div>";
                            echo "<img src='" . $img_path_local . $row_prod['img_2'] . "' alt=''>";
                        echo "</div>";
                        echo "<div>";
                            echo "<img src='" . $img_path_local . $row_prod['img_3'] . "' alt=''>";
                        echo "</div>";
                    echo "</div>";
                    echo "<div class='product_info'>";
                        echo "<p class='product_name'><span>Name : </span>" . $row_prod['name'] . "</p>";
                        echo "<p class='product_name'><span>details : </span>" . $row_prod['details'] . "</p>";
                        echo "<div class='pro_size'>";
                            echo "<p><span> sizes : </span></p>";
                            echo "<div class='product_size'>"; 
                                if($row_prod['XS_size'] == 1) {
                                    echo "<span>XS</span>";
                                }

                                if($row_prod['S_size'] == 1) {
                                    echo "<span>S</span>";
                                }

                                if($row_prod['M_size'] == 1) {
                                    echo "<span>M</span>";
                                }

                                if($row_prod['L_size'] == 1) {
                                    echo "<span>L</span>";
                                }

                                if($row_prod['XL_size'] == 1) {
                                    echo "<span>XL</span>";
                                }

                                if($row_prod['XXL_size'] == 1) {
                                    echo "<span>XLL</span>";
                                }
                            echo "</div>";
                        echo "</div>";
                        echo "<p class='product_name'><span>price : </span> " . $row_prod['price'] . " pounds</p>";
                        echo "<p class='product_name'><span>discount : </span> " . $row_prod['discount'] . "%</p>";
                        echo "<p class='product_name'><span>Market Name : </span> " . $market_name_path . "</p>";
                        echo "<p class='product_name'><span>Publisher Name : </span> Ahmed Hassan</p>";
                    echo "</div>";
                    echo "<div class='pro_obtions'>";
                        echo "<a href='?do=Edit&proID=" . base64_encode($row_prod['ID']) . "' class='btn btn-info'>Edit</a>";
                        echo "<a href='?do=Delete&proID=" . base64_encode($row_prod['ID']) . "' class='btn btn-danger'>Delete</a>";
                    echo "</div>";
                echo "</div>";
            }
            ?>

        </div>
        <!-- ========= End Products Manage_Product ========= -->



        <!-- ========= Start Products Add_Product ========= -->
        <?php
            } else if($do == "Add") {
        ?>

        <form class="Add-Edit_inputs" action="?do=Insert" method="POST" enctype="multipart/form-data">
            <h2 class="header_Add-Edit header_Manage">Add New Product <i class="fas fa-cart-plus"></i></h2>
            <div class="total_admin_inputs">
                <div>
                    <label for="">Name</label>
                    <input type="text" name="product_name" required>
                </div>
                <div>
                    <label for="">Details</label>
                    <textarea name="product_detail"></textarea>
                </div>
                <div>
                    <label for="">Sizes</label>
                    <div class="checkbox_inpus">
                        <input name="xs_size_inp" type="checkbox"><span>XS</span>
                        <input name="s_size_inp" type="checkbox"><span>S</span>
                        <input name="m_size_inp" type="checkbox"><span>M</span>
                        <input name="l_size_inp" type="checkbox"><span>L</span>
                        <input name="xl_size_inp" type="checkbox"><span>XL</span>
                        <input name="xll_size_inp" type="checkbox"><span>XLL</span>
                    </div>
                </div>
                <div>
                    <label for="">Price in Pound</label>
                    <input type="tel" name="product_price" required>
                </div>
                <div>
                    <label for="">Discount</label>
                    <select name="product_discount" id="">
                        <option value="">---</option>
                        <option value="0">0%</option>
                        <option value="10">10%</option>
                        <option value="20">20%</option>
                        <option value="30">30%</option>
                        <option value="40">40%</option>
                        <option value="50">50%</option>
                        <option value="60">60%</option>
                        <option value="70">70%</option>
                        <option value="80">80%</option>
                        <option value="90">90%</option>
                    </select>
                </div>
                <div>
                    <label for="">Main Image</label>
                    <input type="file" class="img_upload" name="product_mainImg">
                </div>
                <div>
                    <label for="">Image 1</label>
                    <input type="file" class="img_upload" name="product_Img1">
                </div>
                <div>
                    <label for="">Image 2</label>
                    <input type="file" class="img_upload" name="product_Img2">
                </div>
                <div>
                    <label for="">Image 3</label>
                    <input type="file" class="img_upload" name="product_Img3">
                </div>
                <div>
                    <label for="">Market Name</label>
                    <select name="product_marketID" id="">
                        <option value="">---</option>
                        <?php
                            $stmt4 = $con->prepare("SELECT * FROM markets");
                            $stmt4->execute();
                            $rowsM = $stmt4->fetchAll();

                            foreach($rowsM as $rowM) {
                                // echo "<option>" . $row['AR_name'] . "</option>";
                                echo "<option value='" . $rowM['ID'] . "'>" . $rowM['AR_name'] . "</option>";
                            }
                        ?>
                        <!-- <option value="">أحمد حسن</option> -->
                        <!-- <option value="">تاون تيم</option> -->
                    </select>
                </div>
                <div>
                    <label for="">Publisher Name</label>
                    <select name="product_publisherName" id="">
                        <option value=""></option>
                        <?php
                            $stmt5 = $con->prepare("SELECT * FROM hosters WHERE (seller_trust = 1 OR seller_trust = 2) AND (market_ID != 0)");
                            $stmt5->execute();
                            $rows = $stmt5->fetchAll();

                            foreach($rows as $row) {
                                echo "<option value='" . $row['ID'] . "'>" . $row['first_name'] . " " . $row['second_name'] . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="">Categorie Name</label>
                    <select name="product_CategorieName" id="">
                        <option value=""></option>
                        <option value="1">رجالى</option>
                        <option value="2">حريمى</option>
                        <option value="3">أطفال</option>
                        <?php
                            // $stmt5 = $con->prepare("SELECT * FROM categories WHERE (seller_trust = 1 OR seller_trust = 2) AND (market_ID != 0)");
                            // $stmt5->execute();
                            // $rows = $stmt5->fetchAll();

                            // foreach($rows as $row) {
                            //     echo "<option value='" . $row['ID'] . "'>" . $row['first_name'] . " " . $row['second_name'] . "</option>";
                            // }
                        ?>
                    </select>
                </div>
            </div>
            <input type="submit" class="Add_Edit_Submit btn btn-success" value="Save">
        </form>
        <!-- ========= End Products Add_Product ========= -->


        <!-- ========= Start Products Insert_Product ========= -->
        <?php
        } else if($do == "Insert") {

            if($_SERVER['REQUEST_METHOD'] == "POST") {

                // this is to bring values from the post form
                $product_name             = $_POST['product_name'];
                $product_detail           = $_POST['product_detail'];

                $product_size_XS          = $_POST['xs_size_inp'];      // size 1                
                if ($product_size_XS == "on") {
                    $product_size_XS = 1;
                    echo $product_size_XS . "<br>";
                } else {
                    $product_size_XS = 0;
                    echo $product_size_XS . "<br>";
                }

                $product_size_S           = $_POST['s_size_inp'];       // size 2
                if ($product_size_S == "on") {
                    $product_size_S = 1;
                    echo $product_size_S . "<br>";
                } else {
                    $product_size_S = 0;
                    echo $product_size_S . "<br>";
                }

                $product_size_M           = $_POST['m_size_inp'];       // size 3
                if ($product_size_M == "on") {
                    $product_size_M = 1;
                    echo $product_size_M . "<br>";
                } else {
                    $product_size_M = 0;
                    echo $product_size_M . "<br>";
                }

                $product_size_L           = $_POST['l_size_inp'];       // size 4
                if ($product_size_L == "on") {
                    $product_size_L = 1;
                    echo $product_size_L . "<br>";
                } else {
                    $product_size_L = 0;
                    echo $product_size_L . "<br>";
                }

                $product_size_XL          = $_POST['xl_size_inp'];      // size 5
                if ($product_size_XL == "on") {
                    $product_size_XL = 1;
                    echo $product_size_XL . "<br>";
                } else {
                    $product_size_XL = 0;
                    echo $product_size_XL . "<br>";
                }                

                $product_size_XLL         = $_POST['xll_size_inp'];     // size 6
                if ($product_size_XLL == "on") {
                    $product_size_XLL = 1;
                    echo $product_size_XLL . "<br>";
                } else {
                    $product_size_XLL = 0;
                    echo $product_size_XLL . "<br>";
                }          

                $product_price            = $_POST['product_price'];
                $product_discount         = $_POST['product_discount'];
                $product_publisherName    = $_POST['product_publisherName'];
                $product_marketID         = $_POST['product_marketID'];                
                $product_CategorieName    = $_POST['product_CategorieName'];

                $stmt = $con->prepare("SELECT EN_name FROM markets WHERE ID = ? ");
                $stmt->execute(array($product_marketID));
                $row = $stmt->fetch();   
                $market_name = $row['EN_name'];


                // images of the product
                $product_mainImg          = $_FILES['product_mainImg'];  // the data of the main image I upload it 
                    $pr_mainImg_Name = $_FILES['product_mainImg']['name'];
                    $pr_mainImg_TempName = $_FILES['product_mainImg']['tmp_name'];
                    // this random numbers uesed to add in the front of the images path for advoide the same name 
                    $random_MainNum = rand(0 , 9000000) . "_" . $pr_mainImg_Name;

                $product_Img1             = $_FILES['product_Img1'];    // the data of the image 1 I upload it
                    $pr_Img1_Name = $_FILES['product_Img1']['name'];
                    $pr_Img1_TempName = $_FILES['product_Img1']['tmp_name'];
                    // this random numbers uesed to add in the front of the images path for advoide the same name 
                    $random_Img1Num = rand(0 , 9000000) . "_" . $pr_Img1_Name;

                $product_Img2             = $_FILES['product_Img2'];    // the data of the image 2 I upload it
                    $pr_Img2_Name = $_FILES['product_Img2']['name'];
                    $pr_Img2_TempName = $_FILES['product_Img2']['tmp_name'];
                    // this random numbers uesed to add in the front of the images path for advoide the same name 
                    $random_Img2Num = rand(0 , 9000000) . "_" . $pr_Img2_Name;

                $product_Img3             = $_FILES['product_Img3'];   // the data of the image 3 I upload it
                    $pr_Img3_Name = $_FILES['product_Img3']['name'];
                    $pr_Img3_TempName = $_FILES['product_Img3']['tmp_name'];
                    // this random numbers uesed to add in the front of the images path for advoide the same name 
                    $random_Img3Num = rand(0 , 9000000) . "_" . $pr_Img3_Name;

                // the path of the folder which want to create it and put image in it 
                $products_imgs_Marketfolder = "uploades\products_images\\" . $market_name . "\\";

                // this path of folider of the images of the product in the market
                $product_imgs = $products_imgs_Marketfolder . $product_name . "\\";

                // this code is for add the images of the product into the folder of products of the market 
                if (file_exists($products_imgs_Marketfolder)) {

                    // عاوز ابقى امسح الصور القديمة 
                    echo "<br><p class='alert alert-info'>This file is already Exit<p>";

                    if (file_exists($product_imgs)) {
                        move_uploaded_file($pr_mainImg_TempName , $product_imgs . $random_MainNum);
                        move_uploaded_file($pr_Img1_TempName , $product_imgs . $random_Img1Num);
                        move_uploaded_file($pr_Img2_TempName , $product_imgs . $random_Img2Num);
                        move_uploaded_file($pr_Img3_TempName , $product_imgs . $random_Img3Num);
                    } else {
                        mkdir($product_imgs);  
                        move_uploaded_file($pr_mainImg_TempName , $product_imgs . $random_MainNum);
                        move_uploaded_file($pr_Img1_TempName , $product_imgs . $random_Img1Num);
                        move_uploaded_file($pr_Img2_TempName , $product_imgs . $random_Img2Num);
                        move_uploaded_file($pr_Img3_TempName , $product_imgs . $random_Img3Num);
                    }

                } else {
                    mkdir($products_imgs_Marketfolder); 

                    if (file_exists($product_imgs)) {
                        move_uploaded_file($pr_mainImg_TempName , $product_imgs . $random_MainNum);
                        move_uploaded_file($pr_Img1_TempName , $product_imgs . $random_Img1Num);
                        move_uploaded_file($pr_Img2_TempName , $product_imgs . $random_Img2Num);
                        move_uploaded_file($pr_Img3_TempName , $product_imgs . $random_Img3Num);
                    } else {
                        mkdir($product_imgs);  
                        move_uploaded_file($pr_mainImg_TempName , $product_imgs . $random_MainNum);
                        move_uploaded_file($pr_Img1_TempName , $product_imgs . $random_Img1Num);
                        move_uploaded_file($pr_Img2_TempName , $product_imgs . $random_Img2Num);
                        move_uploaded_file($pr_Img3_TempName , $product_imgs . $random_Img3Num);
                    }
                }

                // this is the query to insert data in the products table in the database
                $stmt = $con->prepare("INSERT INTO products(name , details , XS_size , S_size , M_size , L_size , 
                XL_size , 	XXL_size , price , discount , main_img , img_1 , img_2 , img_3 , publisher_ID , 
                market_ID , category_ID)
                VALUES(:Pname , :Pdetails , :Psize_XS , :Psize_S , :Psize_M , :Psize_L , :Psize_XL , :Psize_XLL , 
                :Pprice , :Pdiscount , :Pmain_img , :Pimg_1 , :Pimg_2 , :Pimg_3 , :Ppublisher_ID , :Pmarket_ID , 
                :Pcategory_ID)");

                // // this is to
                $stmt->execute(array(
                    "Pname"         => $product_name,
                    "Pdetails"      => $product_detail,
                    
                    // sizes insertion
                    "Psize_XS"      => $product_size_XS,
                    "Psize_S"       => $product_size_S, 
                    "Psize_M"       => $product_size_M,
                    "Psize_L"       => $product_size_L,
                    "Psize_XL"      => $product_size_XL,
                    "Psize_XLL"     => $product_size_XLL,

                    "Pprice"        => $product_price,
                    "Pdiscount"     => $product_discount,
                    "Pmain_img"     => $random_MainNum,
                    "Pimg_1"        => $random_Img1Num,
                    "Pimg_2"        => $random_Img2Num,
                    "Pimg_3"        => $random_Img3Num,
                    "Ppublisher_ID" => $product_publisherName, 
                    "Pmarket_ID"    => $product_marketID, 
                    "Pcategory_ID"  => $product_CategorieName
                ));

                // message of success of adding new admin
                echo "<h2 class='alert alert-success'>Success To insert data</h2>";

            } else {
                header("location:?do=Add");
            }

        ?>
        <!-- ========= Start Products Insert_Product ========= -->



        <!-- ========= Start Products Edit_Product ========= -->
        <?php
        } else if($do == "Edit") {
            if(isset($_GET['proID'])) {

                $hased_ID = $_GET['proID'];
                $origin_ID = base64_decode($hased_ID);

                // this query to select data which match with the id I want to edit on its data
                $stmt = $con->prepare("SELECT * FROM products WHERE ID = ? ");
                $stmt->execute(array($origin_ID));
                $row = $stmt->fetch();

                if($origin_ID == $row["ID"]) {
        ?>

        <form class="Add-Edit_inputs">
            <h2 class="header_Add-Edit header_Manage">Edit Product <i class="fas fa-cart-plus"></i></h2>
            <div class="total_admin_inputs">
            <div>
                    <label for="">Name</label>
                    <input type="text" name="" value="<?php echo $row['name']?>">
                </div>
                <div>
                    <label for="">Details</label>
                    <textarea type="text" name=""><?php echo $row['details']?></textarea>
                </div>
                <div>
                    <label for="">Sizes</label>
                    <div class="checkbox_inpus">
                    <?php
                        // if() {
                        //     <input name="xs_size_inp" type="checkbox"><span>XS</span>
                        // }
                        // <input name="s_size_inp" type="checkbox"><span>S</span>
                        // <input name="m_size_inp" type="checkbox"><span>M</span>
                        // <input name="l_size_inp" type="checkbox"><span>L</span>
                        // <input name="xl_size_inp" type="checkbox"><span>XL</span>
                        // <input name="xll_size_inp" type="checkbox"><span>XLL</span>
                    ?>
                    </div>
                </div>
                <div>
                    <label for="">Price in Pound</label>
                    <input type="tel" name="" required>
                </div>
                <div>
                    <label for="">Discount</label>
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
                    <label for="">Main Image</label>
                    <input type="file" class="img_upload" name="" value="<?php echo(($row['phone2'] == NULL)?" ":$row['phone2']);  ?>">
                </div>
                <div>
                    <label for="">Image 1</label>
                    <input type="file" class="img_upload" name="">
                </div>
                <div>
                    <label for="">Image 2</label>
                    <input type="file" class="img_upload" name="">
                </div>
                <div>
                    <label for="">Image 3</label>
                    <input type="file" class="img_upload" name="">
                </div>
                <div>
                    <label for="">Market Name</label>
                    <select name="" id="">
                        <option value=""></option>
                        <option value="">أحمد حسن</option>
                        <option value="">تاون تيم</option>
                    </select>
                </div>
                <div>
                    <label for="">Publisher Name</label>
                    <select name="" id="">
                        <option value=""></option>
                        <option value="">أحمد حسن</option>
                        <option value="">تاون تيم</option>
                    </select>
                </div>
                <div>
                    <label for="">Categorie Name</label>
                    <select name="" id="">
                        <option value=""></option>
                        <option value="">رجالى</option>
                        <option value="">حريمى</option>
                    </select>
                </div>
            </div>
            <input type="submit" class="Add_Edit_Submit btn btn-success" value="حفظ">
        </form>
        <!-- ========= End Products Edit_Product ========= -->


        <!-- ========= Start Products Update_Product ========= -->
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
        <!-- ========= Start Products Update_Product ========= -->




        <!-- ========= Start Products Delete_Product ========= -->
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
        <!-- ========= Start Products Delete_Product ========= -->


    </div>

    <?php
        }
    } else {
        header("Location:index.php");
    }
    ?>
