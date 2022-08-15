<?php
require_once 'inc/session.php';
if (empty($_SESSION['fkl'])) {
    header('location: login.php');
}

$fkl = $_GET['fkl_id'];

$queryResult = $userView->getId($fkl);
$totalStatus = $userView->getDataDynamic("select training_date,organization_name,organization_status from fire_training where fkl_id='$fkl' order by training_date desc");

// $userView->test($totalStatus);
//  $queryResult = $userView->getId($_GET['fkl_id']);

$f_id = oci_fetch_assoc($queryResult);
$active = $f_id['EMPSTATUS'];
$fkl = $f_id['VEMPLOYEEID'];
if (isset($fkl) && $active=='In-Active') {
    if ($_GET['internal_external'] == 'external') {

        // $sql = "select fkl_id from fire_training where fkl_id = '$fkl' ";
        $sql = "select fkl_id from fire_training where organization_status = 'external' and fkl_id='$fkl' ";
        $check = $userView->checkDataExistence($sql);
        if ($check == 'exist')
            header('location: create_figher_trainer.php?exist');
    }
}else
header("location:create_figher_trainer.php?active");
if (empty($f_id))
    header('location: create_figher_trainer.php?msg');


if (isset($_POST['btn'])) {
    $userView->onInsertData();
}
if (isset($_POST['org_btn'])) {
    // $u = $userView->orgNameInsert();
    // print_r($_POST);
    // exit();
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

                <div class="row border-bottom bd-lightGray m-3">
                    <div class="cell-md-4 d-flex flex-align-center">
                        <h3 class="dashboard-section-title text-center text-left-md w-100">Add Data <small><span class="mif-plus"></span></small> </h3>
                    </div>

                    <div class="cell-md-8 d-flex flex-justify-center flex-justify-end-md flex-align-center">
                        <ul class="breadcrumbs bg-transparent">
                            <!-- <li class="page-item"><a href="index.php" class="page-link"><span class="mif-meter"></span></a></li> -->
                            <a href="index.php" class="ml-2 mr-2" style="text-decoration: none;"> <button class="image-button info icon-right"><span class="mif-meter icon"></span><span style="font-size: 18px;" class="caption">Dashboard</span></button></a>
                            <!-- <li class="page-item"><a href="index.php" class="page-link">Show Data</a></li> -->
                            <!-- <div style="float: right;"> -->
                            <form action="" method="POST" id="form1">
                                <div class="dialog " data-role="dialog" data-close-button=true id="demoDialog1">
                                    <div class="dialog-title">Write a new organization name</div>
                                    <div class="dialog-content">
                                        <div class="form-group">
                                            <input type="text" name="org_name" data-role="input" placeholder="Name: BGMEA" required>
                                        </div>
                                        <!-- <input type="text" data-role="materialinput" data-label="User email" placeholder="Enter your email"> -->

                                    </div>

                                    <div class="dialog-actions">
                                        <button type="submit" name="org_btn" data-role="button" class="button success js-dialog-close ">Submit</button>
                                    </div>
                            </form>
                    </div>
                    <button type="button" class="button success" onclick="Metro.dialog.open('#demoDialog1')"><span class=" mif-plus"> New Organization</span>
                    </button>





                    <!-- </div> -->
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
            <!-- select vemployeeid,vempname,vfatherhisname,empstatus,vdepartmentname,vdesignationname,vunitname,vlinename,vshift,djoiningdate from hrm_vw_employeeinfo -->
            <div class="m-3">
                <div class="row">
                    <div class="cell-md-5">
                        <table class="table subcompact table-border cell-border" style="margin-left:10px;">
                            <tr style="padding-left:15px;">
                                <td><strong style="padding-right: 3px;"> Fkl No :</strong> <?php echo $f_id['VEMPLOYEEID'] ?></td>
                                <td><strong style="padding-right: 3px;"> Name :</strong> <?php echo $f_id['VEMPNAME'] ?></td>
                                <td><strong style="padding-right: 3px;"> Father Name :</strong> <?php echo $f_id['VFATHERHISNAME'] ?></td>
                            </tr>
                            <tr style="padding-left:15px;">
                                <td><strong style="padding-right: 3px;"> Status :</strong> <?php echo $f_id['EMPSTATUS'] ?></td>
                                <td><strong style="padding-right: 3px;"> Department :</strong> <?php echo $f_id['VDEPARTMENTNAME'] ?></td>
                                <td><strong style="padding-right: 3px;"> Designation :</strong> <?php echo $f_id['VDESIGNATIONNAME'] ?></td>
                            </tr>

                            <tr style="padding-left:15px;">
                                <td><strong style="padding-right: 3px;"> Unit :</strong> <?php echo $f_id['VUNITNAME'] ?></td>
                                <td><strong style="padding-right: 3px;"> Line :</strong> <?php echo $f_id['VLINENAME'] ?></td>
                                <td><strong style="padding-right: 3px;"> Shift :</strong> <?php echo $f_id['VSHIFT'] ?></td>
                            </tr>
                            <tr style="padding-left:15px;">
                                <td><strong style="padding-right: 3px;"> Joining Date :</strong> <?php echo $f_id['DJOININGDATE'] ?></td>


                            </tr>
                        </table>
                    </div>
                       
                    <div class="cell-md-5" style="float: right;">
                        <table class="table subcompact table-border cell-border" style="margin-left:10px;">
                            <tbody>
                                
                                <?php 
                            if(is_array($totalStatus)){
                                $i=1;
                                //    $userView->test($totalStatus);
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

            




            <div class="m-3">
                <div class="row">
                    <div class="cell-md-5">
                        <div class="card">
                            <div class="card-header">
                                Data Entry Form
                            </div>
                            <div class="card-content p-2">
                                <div class="row">
                                    <div class="cell-lg-12 cell-md-12 mt-2">
                                        <div class="bg-white p-4">
                                            <form action="" method="POST" id="form2">


                                                <input type="text" name="fkl_id" hidden id="fkl_id" value="<?php echo $f_id['VEMPLOYEEID'] ?>">
                                                <input type="text" name="internal_external" hidden id="internal_external" value="<?php echo $_GET['internal_external'] ?>">

                                                <!-- <label>Name of Organization:</label>
                                                    <div class="form-group">
                                                     <input required type="text" name="organization_name" id="organization_name" class="metro-input" data-role="input" required>
                                                        <span class="invalid_feedback">Enter a required value</span>
                                                    </div> -->

                                                <label>Name of Organization:</label>
                                                <div class="form-group">
                                                    <select data-role="select" name="organization_name" id="org_name" required>
                                                        <option value="">
                                                            <----Selected--->
                                                        </option>
                                                        <option value="BGMEA">BGMEA</option>
                                                        <option value="BKMEA">BKMEA</option>
                                                        <option value="FIRE SERVICE">FIRE SERVICE</option>
                                                    </select>

                                                    <!-- <input required type="text" name="organization_name" id="organization_name" class="metro-input" data-role="input" required>
                                                        <span class="invalid_feedback">Enter a required value</span> -->
                                                </div>

                                                <label>Training Date:</label>
                                                <div class="form-group">
                                                    <input type="text" required name="training_date" class="todate required-field" data-picker-mode="true" data-role="calendarpicker" data-cls-calendar="compact" data-format="%d-%m-%Y" data-clear-button="true" data-input-format="%d-%m-%y">
                                                    <!-- <input required type="date" data-date-format="DD MMMM YYYY" name="training_date" id="training_date" class="metro-input" data-role="input" required> -->
                                                    <span class="invalid_feedback">Enter a required value</span>
                                                </div>



                                                <label>Training Status:</label>
                                                <div class="form-group">
                                                    <input required type="radio" data-role="radio" name="training_status" value="yes" data-caption="Yes" checked onclick="$('#effect-demo').attr('data-effect', this.value)">
                                                    <input type="radio" data-role="radio" name="training_status" value="no" data-caption="No" onclick="$('#effect-demo').attr('data-effect', this.value)">
                                                </div>

                                                <label>Building Name:</label>
                                                <div class="form-group">
                                                    <input required type="text" name="building_name" id="building_name" class="metro-input" data-role="input" required>
                                                    <span class="invalid_feedback">Enter a required value</span>
                                                </div>

                                                <label>Floor:</label>
                                                <div class="form-group">
                                                    <input required type="text" name="floor_name" id="floor" class="metro-input" data-role="input" required>
                                                    <span class="invalid_feedback">Enter a required value</span>
                                                </div>


                                                <!-- <label>Organization Status:</label>
                                                    <div class="form-group">
                                                        <select name="internal_external[]" id="org_status" data-role="select" multiple>
                                                            <option value="internal">internal</option>
                                                            <option value="external">external</option>
                                                        </select>
                                                    </div> -->

                                                <!-- 
                                                <label>Organization Status:</label>
                                                <div class="form-group">
                                                    <input type="radio" data-role="radio" name="internal_external" value="internal" data-caption="Internal" onclick="$('#effect-demo').attr('data-effect', this.value)">
                                                    <input type="radio" data-role="radio" name="internal_external" value="external" data-caption="External" checked onclick="$('#effect-demo').attr('data-effect', this.value)">
                                                </div> -->

                                                <!-- <label>Address:</label>
                                                    <div class="form-group">
                                                        <textarea patter type="text" name="address" id="address" data-role="textarea"><?php //echo $f_id['address']                                                                                                                                        
                                                                                                                                        ?> </textarea>
                                                    </div> -->

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