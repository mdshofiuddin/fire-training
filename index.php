<?php
require_once 'inc/session.php';
if(empty($_SESSION['fkl'])){
    header('location: login.php');
}
if(isset($_GET['delete'])){
    $userView->deleteData($_GET['id']);
}
$totalManPower = $userView->totalManPower();
$male = $userView->totalMale();
$female = $userView->totalFemale();
$fire = $userView->totalTrainer();

$total = $totalManPower['ACTIVE'];
$mportion = $male['ACTIVE'];
$fportion = $female['ACTIVE'];

$male_percent = $userView->percentage($total,$mportion);
$female_percent = $userView->percentage($total,$fportion);


$uniq_id = $userView->dataFetch("select count( DISTINCT(fkl_id))fkl from fire_training");
// $userView->test($uniq_id);
$total_fire_fighter = $uniq_id['FKL'];
$fire_fighter_percent = $userView->percentage($total,$total_fire_fighter);


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

                </div>

                <div class="cell-md-8 d-flex flex-justify-center flex-justify-end-md flex-align-center">
                    <ul class="breadcrumbs bg-transparent">
                        <!-- <li class="page-item"><a href="#" class="page-link"><span class="mif-meter"></span></a></li> -->
                        <!-- <li class="page-item"><a href="create_figher_trainer.php" class="page-link">Create Trainer</a></li> <div class="content-inner h-100" style="overflow-y: auto"> -->
                    <a href="table_view.php" class="ml-2" style="text-decoration: none;"> <button class="image-button info icon-right"><span class="mif-printer icon"></span><span style="font-size: 18px;" class="caption">Print</span></button></a>
                    <a href="create_figher_trainer.php" style="text-decoration: none;" class="ml-2"> <button class="image-button success icon-right"><span class="mif-plus icon"></span><span style="font-size: 18px;" class="caption">Create</span></button></a>
                    </ul>
                </div>
            </div>

            <div class="m-3">
                <!-- <div class="row" style="float: right;">
                <a href="create_figher_trainer.php"> <button class="image-button success icon-right"><span class="mif-plus icon"></span ><span style="font-size: 18px;" class="caption">Create</span></button></a>
                </div> -->

                <div class="row">
                    <div class="cell-lg-3 cell-md-6 mt-2">
                        <div class="more-info-box bg-cyan fg-white">
                            <div class="content">
                                <h2 class="text-bold mb-0"><?php echo $totalManPower['ACTIVE']; ?></h2>
                                
                                <div>Total Man Power</div>
                            </div>
                            <div class="icon">
                                <span class="mif-user-check"></span>
                            </div>
                            <a href="" class="more"> More info <span class="mif-arrow-right"></span></a>
                        </div>
                    </div>
                    <div class="cell-lg-3 cell-md-6 mt-2">
                        <div class="more-info-box bg-green fg-white">
                            <div class="content">
                                <!-- <h2 class="text-bold mb-0"><?php //echo $male['ACTIVE']; ?></h2> -->
                                <h2 class="text-bold mb-0"><?php echo $male_percent; ?><span style="font-weight: 300;margin-left:40px;">(<?php echo $male['ACTIVE']; ?>)</span></h2>
                                <div>Total Male</div>
                            </div>
                            <div class="icon">
                                <span class="mif-male"></span>
                            </div>
                            <a href="" class="more"> More info <span class="mif-arrow-right"></span></a>
                        </div>
                    </div>
                    <div class="cell-lg-3 cell-md-6 mt-2">
                        <div class="more-info-box bg-orange fg-white">
                            <div class="content">
                            <h2 class="text-bold mb-0"><?php echo $female_percent; ?><span style="font-weight: 300;margin-left:40px;">(<?php echo $female['ACTIVE']; ?>)</span></h2>
                                <div>Total Female</div>
                            </div>
                            <div class="icon">
                                <span class="mif-female"></span>
                            </div>
                            <a href="" class="more"> More info <span class="mif-arrow-right"></span></a>
                        </div>
                    </div>
                    <div class="cell-lg-3 cell-md-6 mt-2">
                        <div class="more-info-box bg-red fg-white">
                            <div class="content">
                                <h2 class="text-bold mb-0"><?php echo $fire_fighter_percent; ?><span style="font-weight: 300;margin-left:40px;">(<?php echo $uniq_id['FKL']; ?>)</span></h2>
                                <!-- <h2 class="text-bold mb-0"><?php //echo $fire['TRAINER']; ?></h2> -->
                                <div>Total Fire Trainer</div>
                            </div>
                            <div class="icon">
                                <span class="mif-user-check"></span>
                            </div>
                            <a href="" class="more"> More info <span class="mif-arrow-right"></span></a>
                        </div>
                    </div>
                </div>

                <hr>

            </div>

            <div class="row">
                <div class="cell-md-12">
                    <!-- <div data-role="panel" data-title-caption="Staff salary" data-collapsible="true" class="mt-4"> -->
                        <div class="p-4">
                            <table  class="cell-border table striped subcompact row-hover table-border table-font-size"  data-pagination-short-mode="true" data-rownum-title="Sl." data-rownum="true" data-role="table" data-cls-table-top="row" data-rows="20" data-rows-steps="5, 10, 20,30,50,80,100,150,200" data-show-activity="false" data-horizontal-scroll="true">
                            <thead class="table-head-title text-center" >
                                    <tr>
                                        <td class="sortable-column">Fkl Id</td>
                                        <td class="sortable-column">Name</td>
                                        <!-- <td class="sortable-column">Father</td> -->
                                        <td class="sortable-column">Status</td>
                                        <td class="sortable-column">Department</td>
                                        <td class="sortable-column">Designation</td>
                                        <td class="sortable-column">Unit</td>
                                        <td class="sortable-column">Line</td>
                                        <!-- <td class="sortable-column">Shift</td> -->
                                        <td class="sortable-column">Join_dt</td>
                                        <td class="sortable-column">Training<br>(Status)</td>
                                        <td class="sortable-column">Organization<br>(Name)</td>
                                        <td class="sortable-column">Training<br>(Date)</td>
                                        <td class="sortable-column">Building</td>
                                        <td class="sortable-column">Floor</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $data = [];
                                    $data = $userView->allDataShow();
                                    // print_r($data);
                                    // exit();
                                  
                                    while ($user = oci_fetch_assoc($data)) { ?>
                                    <!-- while ($user = mysqli_fetch_assoc($data)) { ?> -->
                                        <!-- select vemployeeid,vempname,vfatherhisname,empstatus,vdepartmentname,vdesignationname,vunitname,vlinename,vshift,djoiningdate from hrm_vw_employeeinfo -->

                                        <tr>
                                            <td><?php echo $user['VEMPLOYEEID'] ?></td>
                                            <td><?php echo $user['VEMPNAME'] ?></td>
                                            <!-- <td><?php //echo $user['VFATHERHISNAME'] ?></td> -->
                                            <td><?php 
                                            
                                            if($user['EMPSTATUS']=='Active') 
                                            echo "<p style='color:green;'>Active</p>";
                                            elseif($user['EMPSTATUS']=='In-Active')
                                            echo "<p style='color:red;'>In-active</p>";
                                            elseif($user['EMPSTATUS']=='Resigned')
                                            echo "<p style='color:#bebebe;'>Resigned</p>";
                                            ?></td>
                                            <td><?php echo $user['VDEPARTMENTNAME'] ?></td>
                                            <td><?php echo $user['VDESIGNATIONNAME'] ?></td>
                                            <td><?php echo $user['VUNITNAME'] ?></td>
                                            <td><?php echo $user['VLINENAME'] ?></td>
                                            <!-- <td><?php //echo $user['VSHIFT'] ?></td> -->
                                            <td><?php echo $user['DJOININGDATE'] ?></td>
                                            <td><?php echo $user['T_STATUS'] ?></td>
                                            <td><?php echo $user['ORG_NAME'] ?></td>
                                            <td><?php echo $user['T_DATE'] ?></td>
                                            <td><?php echo $user['BUILDING'] ?></td>
                                            <td><?php echo $user['FLOOR'] ?></td>
                                           
                                            <td>
                                                <?php if(isset($_SESSION['user_role'])){
                                                    if($_SESSION['user_role']=='super_admin' || $_SESSION['user_role']=='admin'){
                                                        ?>
                                               <a href="edit_figher_trainer_info.php?id=<?php echo $user['SL']; ?>"><span class="mif-pencil mif-2x fg-gray mr-4 " title="edit" ></span></a>                                           
                                                <?php }
                                               } ?>
                                                <?php if(isset($_SESSION['user_role'])){
                                                    if($_SESSION['user_role']=='super_admin'){
                                                        ?>                        
                                                <a href="?delete=true&id=<?php echo $user['SL']; ?>" onclick="return confirm('Are you sure to delete')"><span class="mif-bin mif-2x mr-3 fg-red"  title="delete"></span></a>                                               
                                                <?php }
                                               } ?>      
                                                                                                                                   
                                               <a href="show_fire_trainer_info.php?id=<?php  echo $user['SL']; ?>"><span class="mif-eye mif-2x fg-gray  " title="show" ></span></a>                                           
                                               
                                            </td>
                                            
                                        </tr>
                                    <?php 
                                    } ?>
                                </tbody>

                            </table>
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