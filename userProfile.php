<?php
require_once 'inc/session.php';
if (empty($_SESSION['fkl'])) {
    header('location: login.php');
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
                
                <div class="row m-3">
                    <div class="cell-lg-4 cell-md-6">
                        <div class="bg-white p-4">
                            <div class="skill-box mt-4-minus">
                                <div class="header border-top border-bottom bd-default">
                                    <div class="title text-center"><strong><?php echo $_SESSION['name'] ?></strong></div>
                                    <div class="subtitle text-center"><strong> <?php echo  $_SESSION['vdesignationname'] ?></strong></div>
                                </div>
                                <ul class="skills">
                                    <li><strong>FKL ID:         </strong> <?php echo  $_SESSION['fkl'] ?></li>
                                    <li><strong>Name:       </strong> <?php echo $_SESSION['name'] ?></li>
                                    <li><strong>Designation:</strong> <?php echo $_SESSION['vdesignationname'] ?></li>
                                    <li><strong>Department: </strong> <?php echo $_SESSION['vdepartmentname'] ?></li>
                                    <li><strong>Role:       </strong> <?php                                     
                                    if($_SESSION['user_role']=='super_admin')
                                    echo "Super Admin";
                                    ?></li>

                                </ul>

                                <!--file change end-->
                            </div>
                        </div>
                    </div>
                    <?php include_once('inc/footer.php'); ?>
</body>

</html>