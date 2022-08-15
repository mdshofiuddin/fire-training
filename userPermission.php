<?php
require_once 'inc/session.php';
if (empty($_SESSION['fkl'])) {
    header('location: login.php');
}
if (isset($_POST['btn'])) {
    if (isset($_POST['fkl']))
        $fkl = $_POST['fkl'];
    $exist = $userView->checkDataExistence("select vemployeeid from hrm_vw_employeeinfo where vemployeeid='$fkl' and empstatus='In-Active'");
    if ($exist == 'exist') {
        $notExist = $userView->checkDataExistence("select fkl from useradmin where fkl='$fkl'");
        if ($notExist == 'not exist') {
            $pass = $_POST['password'];
            $permission = $_POST['permission'];
            $status = $_POST['status'];
            $sql = "INSERT INTO USERADMIN (ID,FKL,PASSWORD,USER_ROLE,STATUS) VALUES ((SELECT NVL(MAX(ID),0)+1 FROM USERADMIN),'$fkl','$pass','$permission','$status')";
            $tr = $userView->exicute($sql);
            header('location:permissionTable.php');
        } else
            echo '<script>alert("Allready exist")</script>';
    } else {
        echo '<script>alert("Invalid fkl id")</script>';
    }
}

include_once('inc/head.php');
?>



<body class="m4-cloak h-vh-100">
    <div data-role="navview" data-toggle="#paneToggle" data-expand="xl" data-compact="lg" data-active-state="true">
        <?php include_once('inc/navigation.php'); ?>
        <div class="navview-content h-100">
            <?php include_once('inc/topbar.php'); ?>

            <div class="content-inner h-100" style="overflow-y: auto">
                <!--file change start-->

                <div class="row border-bottom center bd-lightGray m-3">
                    <div class="cell-md-4 d-flex flex-align-center">
                        <h3 class="dashboard-section-title text-center text-left-md w-100">User Create <small><span class="mif-plus"></span></small> </h3>
                    </div>

                    <div class="cell-md-8 d-flex flex-justify-center flex-justify-end-md flex-align-center">
                        <ul class="breadcrumbs bg-transparent">
                            <a href="permissionTable.php" class="ml-2 mr-2" style="text-decoration: none;"> <button class="image-button info icon-right"><span class="mif-display icon"></span><span style="font-size: 18px;" class="caption">Display</span></button></a>
                        </ul>
                    </div>
                </div>

                <?php
                if (isset($tr))
                    echo '<div class="remark primary" style="float:right;"><p2>Successfully Created</p2></div>';
                ?>
                <div class="m-3">
                    <div class="row">
                        <div class="cell-md-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="cell-lg-12 cell-md-12 mt-2">
                                            <div class="bg-white p-4">
                                                <form action="" method="POST">
                                                    <label>FKL ID:</label>
                                                    <div class="form-group">
                                                        <input required type="number" name="fkl" id="fkl" class="metro-input input-small" data-role="input" required>
                                                        <span class="invalid_feedback">Enter a required value</span>
                                                    </div>

                                                    <label>Password:</label>
                                                    <div class="form-group">
                                                        <input required type="password" name="password" id="password" class="input-small metro-input" data-role="input" required>
                                                        <span class="invalid_feedback">Enter a required value</span>
                                                    </div>
                                                    
                                                    <input type="text" hidden name="status" value="1" id="status" >

                                                    <label>Permission:</label>
                                                    <div class="form-group ">
                                                        <select data-role="select" class="input-small" name="permission" id="permission" required>
                                                            <option value="user">User</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="super_admin">Super Admin</option>
                                                        </select>

                                                    </div>

                                                    <button type="submit" id="submitBtn" name="btn" class="button mt-2">Submit</button>
                                                </form>
                                            </div>
                                        </div>



                                    </div>

                                </div>

                            </div>
                        </div>                      
                    </div>

                </div>


                <!--file change end-->
            </div>
        </div>
    </div>
    <?php include_once('inc/footer.php'); ?>
    
</body>

</html>