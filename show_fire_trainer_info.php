<?php
require_once 'inc/session.php';
if (empty($_SESSION['fkl'])) {
    header('location: login.php');
}

$queryResult = $userView->getData($_GET['id']);
$f_id = oci_fetch_assoc($queryResult);
$fkl = $f_id['VEMPLOYEEID'];
$totalStatus = $userView->getDataDynamic("select training_date,organization_name,organization_status from fire_training where fkl_id='$fkl' order by training_date desc");
// $userView->test($totalStatus);
if (empty($f_id))
    header('location: create_figher_trainer.php?msg');


include_once('inc/head.php');
?>

<body class="m4-cloak h-vh-100">
    <div data-role="navview" data-toggle="#paneToggle" data-expand="xl" data-compact="lg" data-active-state="true">
        <?php include_once('inc/navigation.php'); ?>
        <div class="navview-content h-100">
            <?php include_once('inc/topbar.php'); ?>

            <div class="content-inner h-100" style="overflow-y: auto">
                <!--file change start-->

                <div class="row border-bottom bd-lightGray m-3">
                    <div class="cell-md-4 d-flex flex-align-center">
                        <h3 class="dashboard-section-title text-center text-left-md w-100"><?php echo $f_id['VEMPNAME'] ?><small> <span class="mif-eye"></span> <span>Fkl: <?php echo $f_id['VEMPLOYEEID'] ?></span></small> </h3>
                     <!-- <p class="dashboard-section-title text-left-md w-100">Fkl: <?php //echo $f_id['VEMPLOYEEID'] ?></p> -->
                    </div>

                    <div class="cell-md-8 d-flex flex-justify-center flex-justify-end-md flex-align-center">
                        <ul class="breadcrumbs bg-transparent">
                            <div class="row mt-2">
                                <a href="create_figher_trainer.php" style="float: right;text-decoration:none;"><button class="image-button rounded shadowed success icon-right"><span class="mif-plus icon"></span><span style="font-size: 18px;" class="caption">Create</span></button></a>
                                <?php if(isset($_SESSION['user_role'])){
                                        if($_SESSION['user_role']=='super_admin' || $_SESSION['user_role']=='admin' ){
                                            ?>
                                <a href="edit_figher_trainer_info.php?id=<?php echo $_GET['id']; ?>" style="float: right;text-decoration:none;"><button class="image-button rounded shadowed yellow icon-right ml-2"><span class="mif-pencil icon"></span><span style="font-size: 18px;" class="caption">Edit</span></button></a>
                                <?php }
                                } ?>
                                <a href="index.php" style="float: right;text-decoration:none;"><button class="image-button rounded shadowed info icon-right ml-2"><span class="mif-meter icon"></span><span style="font-size: 18px;" class="caption">Dashboard</span></button></a>
                            </div>
                            <!-- <li class="page-item"><a href="index.php" class="page-link"><span class="mif-meter"></span></a></li> -->
                            <!-- <li class="page-item"><a href="#" class="page-link">Forms</a></li> -->
                            <!-- <li class="page-item"><a href="index.php" class="page-link">Show Data</a></li> -->
                        </ul>
                    </div>
                </div>
                <style>
                    .color-picker.required,
                    .file.required,
                    .input.required,
                    .metro-input.required,
                    .select.required,
                    .spinner.required,
                    .tag-input.required,
                    .textarea.required {
                        border: 1px #1ba1e2 solid !important;
                    }
                </style>
                <div class="m-3">
                    <div class="row">
                        <div class="cell-md-8">
                            <table class="table table-border cell-border subcompact cell-hover" style="width: 100%;font-size:17px;margin:20px; ">
                                <tr style="padding-left:15px;">
                                    <td><strong style="padding-right: 3px;"> Fkl No :</strong> <?php echo $f_id['VEMPLOYEEID'] ?></td>
                                    <td><strong style="padding-right: 3px;"> Name :</strong> <?php echo $f_id['VEMPNAME'] ?></td>
                                    <td><strong style="padding-right: 3px;"> Father's Name :</strong> <?php echo $f_id['VFATHERHISNAME'] ?></td>
                                    <td><strong style="padding-right: 3px;"> Mother's Name :</strong> <?php echo $f_id['VMOTHERSNAME'] ?></td>
                                </tr>
                                <tr style="padding-left:15px;">
                                    <td><strong style="padding-right: 3px;"> Employee status :</strong> <?php echo $f_id['EMPSTATUS'] ?></td>
                                    <td><strong style="padding-right: 3px;"> Department :</strong> <?php echo $f_id['VDEPARTMENTNAME'] ?></td>
                                    <td><strong style="padding-right: 3px;"> Designation :</strong> <?php echo $f_id['VDESIGNATIONNAME'] ?></td>
                                    <td><strong style="padding-right: 3px;"> Joining date :</strong> <?php echo $f_id['DJOININGDATE'] ?></td>
                                </tr>

                                <tr style="padding-left:15px;">
                                    <td><strong style="padding-right: 3px;"> Unit :</strong> <?php echo $f_id['VUNITNAME'] ?></td>
                                    <td><strong style="padding-right: 3px;"> Line :</strong> <?php echo $f_id['VLINENAME'] ?></td>
                                    <td><strong style="padding-right: 3px;"> Training Status :</strong> <?php echo $f_id['T_STATUS'] ?></td>
                                    <td><strong style="padding-right: 3px;"> Organization Name :</strong> <?php echo $f_id['ORG_NAME'] ?></td>
                                </tr>
                                <tr style="padding-left:15px;">
                                    <td><strong style="padding-right: 3px;"> Training date :</strong> <?php echo $f_id['T_DATE'] ?></td>
                                    <td><strong style="padding-right: 3px;"> Building name :</strong> <?php echo $f_id['BUILDING'] ?></td>
                                    <td><strong style="padding-right: 3px;"> Floor :</strong> <?php echo $f_id['FLOOR'] ?></td>
                                    <td><strong style="padding-right: 3px;"> Organization status :</strong> <?php echo $f_id['ORG_STATUS'] ?></td>
                                </tr>
                                <tr style="padding-left:15px;">
                                    <td><strong style="padding-right: 3px;"> Gender :</strong> <?php echo $f_id['VSEX'] ?></td>
                                    <td><strong style="padding-right: 3px;"> Shift :</strong> <?php echo $f_id['VSHIFT'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>


                        <div class="m-3">
                        <div class="row">
                <div class="cell-md-8">
                        <table class="table subcompact table-border cell-border " style="width: 100%;font-size:17px;margin:20px; ">
                            <tbody>
                                
                                <?php 
                            if(is_array($totalStatus)){
                                $i=1;
                                    // $userView->test($totalStatus);
                            foreach($totalStatus as $status){ 
                                ?>
                            <tr style="padding-left:15px;">
                            <td style="margin-left: 2px;"><?php echo $i."."; ?></td>
                            <td><strong > Training Date :</strong> <?php echo $status['TRAINING_DATE'] ?></td>                                                                                                 
                            <td><strong > Organization Name :</strong> <?php echo $status['ORGANIZATION_NAME'] ?></td>                                                                                                       
                            <td><strong > Organization Status :</strong> <?php echo $status['ORGANIZATION_STATUS'] ?></td>
                            
                        </tr>
                        <?php
                            $i++;  
                        }  
                    } 
                    ?>
                    </tbody>
                        </table>
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