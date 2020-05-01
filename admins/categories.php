<?php 
    include 'init.php';                   // ======== include the init file ========   
?>

    <div class="container">
    <!-- ========= Start Categories Manage_Category ========= -->
    <!-- ($do == Manage_Category) -->
    <h2 class="header_Manage"><i class="fas fa-shopping-cart"></i> All Categories</h2>
    <div class="total_tabel">        
        <table class="table manage_table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">username</th>
                    <th scope="col">e-mail</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>                
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Ahmed_Abdel_Fattah_Abdel_Moaty_Ahmed</td>
                    <td>Ahmed_Abdo</td>
                    <td>ahmedabdelfatah661540@gmail.com</td>
                    <td>01022635745</td>
                    <td>
                        <div class="btns_control">
                            <a href="#" class="btn btn-info">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>        
        <a href="#" class="Add_Edit_Submit btn btn-success">Add New Category <i class="fas fa-user-plus"></i></a>
    </div>
    <!-- ========= End Categories Manage_Category ========= -->



    <!-- ========= Start Categories Add_Category ========= -->
    <!-- ($do == Add_Category) -->
    <form class="Add-Edit_inputs">
        <h2 class="header_Add-Edit header_Manage">Add Category <i class="fas fa-cart-plus"></i></h2>
        <div>
            <label for="">Name</label>
            <input type="text" name="" required>
        </div>
        <div>
            <label for="">Username</label>
            <input type="text" name="" required>
        </div>
        <div>
            <label for="">Password</label>
            <input type="password" name="" required>
        </div>
        <div>
            <label for="">e-mail</label>
            <input type="text" name="" required>
        </div>
        <div>
            <label for="">Phone</label>
            <input type="text" name="" required>
        </div>
        <input type="submit" class="Add_Edit_Submit btn btn-success" value="Add">
    </form>        
    <!-- ========= End Categories Add_Category ========= -->


    <!-- ========= Start Categories Insert_Category ========= -->
    <!-- ($do == Insert_Category) -->

    <!-- ========= Start Categories Insert_Category ========= -->


    <!-- ========= Start Categories Edit_Category ========= -->
    <!-- ($do == Edit_Category) -->
    <form class="Add-Edit_inputs">
        <h2 class="header_Add-Edit header_Manage">Edit Category <i class="fas fa-tools"></i></h2>
        <div>
            <label for="">Name</label>
            <input type="text" name="" required>
        </div>
        <div>
            <label for="">Username</label>
            <input type="text" name="" required>
        </div>
        <div>
            <label for="">Password</label>
            <input type="password" name="" required>
        </div>
        <div>
            <label for="">e-mail</label>
            <input type="text" name="" required>
        </div>
        <div>
            <label for="">Phone</label>
            <input type="text" name="" required>
        </div>
        <input type="submit" class="Add_Edit_Submit btn btn-success" value="Update">
    </form>        
    <!-- ========= End Categories Edit_Category ========= -->



    
    <!-- ========= Start Categories Update_Category ========= -->
    <!-- ($do == Update_Category) -->

    <!-- ========= Start Categories Update_Category ========= -->





    <!-- ========= Start Categories Delete_Category ========= -->
    <!-- ($do == Delete_Category) -->

    <!-- ========= Start Categories Delete_Category ========= -->



</div>
