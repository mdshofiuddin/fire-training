<?php
require_once 'inc/session.php';
if (empty($_SESSION['fkl'])) {
    header('location: login.php');
}
if ($_SESSION['user_role']=='user') {
    header('location: index.php');
}
include_once('inc/head.php');
$id = $_GET['id'];
$queryResult = $userView->exicuteReturn("select * from useradmin where id='$id'");
$result = oci_fetch_assoc($queryResult);

if (isset($_POST['btn'])) {
    extract($_POST);
    $update = $userView->exicute("update useradmin set fkl='$fkl',password='$password',user_role='$user_role' where id='$id'");
    if($update){
        header("location:permissionTable.php");
    }else
    die("Not updated");
}
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
                            <a href="userPermission.php" class="ml-2 mr-2" style="text-decoration: none;"> <button class="image-button success icon-right"><span class="mif-plus icon"></span><span style="font-size: 18px;" class="caption">Create</span></button></a>
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
                                                        <input required type="number" readonly name="fkl" id="fkl" class="metro-input input-small" value="<?php echo $result['FKL']; ?>" data-role="input" required>
                                                        <span class="invalid_feedback">Enter a required value</span>
                                                    </div>

                                                    <label>Password:</label>
                                                    <div class="form-group">
                                                        <input required type="password" name="password" value="<?php echo $result['PASSWORD']; ?>" id="password" class="input-small metro-input" data-role="input" required>
                                                        <span class="invalid_feedback">Enter a required value</span>
                                                    </div>

                                                        <input required type="text" name="status" hidden value="0" id="password" class="input-small metro-input">


                                                    <label>Permission:</label>
                                                    <div class="form-group ">
                                                        <select data-role="select" class="input-small" name="user_role" id="user_role" required>
                                                            <option value="user" <?php if ($result['USER_ROLE']=='user') {echo "selected='selected'";}?> >User</option>
                                                            <option value="admin" <?php if ($result['USER_ROLE']=='admin') {echo "selected='selected'";}?>>Admin</option>
                                                            <option value="super_admin" <?php if ($result['USER_ROLE']=='super_admin') {echo "selected='selected'";}?>>Super Admin</option>
                                                        </select>

                                                    </div>

                                                    <button type="submit" id="submitBtn" name="btn" class="button mt-2">Update</button>
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
    <!-- <script>
        $('#sl').hide(); -->
    </script>
</body>

</html>