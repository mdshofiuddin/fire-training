<?php
require_once 'inc/session.php';
if (empty($_SESSION['fkl'])) {
    header('location: login.php');
}
if ($_SESSION['user_role']=='user') {
    header('location: index.php');
}
include_once('inc/head.php');

$queryResult = $userView->getEditId($_GET['id']);
$resultt = oci_fetch_assoc($queryResult);
// print_r($resultt['ORGANIZATION_NAME']);
// exit();

if (isset($_POST['btn'])) {
    $userView->updateData($_POST);
}
?>

<body class="m4-cloak h-vh-100">
    <div data-role="navview" data-toggle="#paneToggle" data-expand="xl" data-compact="lg" data-active-state="true">
        <?php include_once('inc/navigation.php'); ?>
        <div class="navview-content h-100">
            <?php include_once('inc/topbar.php'); ?>

            <div class="content-inner h-100" style="overflow-y: auto">
                <!--file change start-->

                <div class="row border-bottom bd-lightGray m-3">
                    <!-- <div class="cell-md-4 d-flex flex-align-center"> -->
                        <h3 class="dashboard-section-title text-center text-left-md w-100">Edit Data <small><span class="mif-pencil"></span></small> </h3>

                        <div class="cell-md-12 d-flex flex-justify-center flex-justify-end-md flex-align-center">
                        <div class="row mt-2">
                            <a href="create_figher_trainer.php" style="float: right;text-decoration:none;"><button class="image-button success icon-right"><span class="mif-plus icon"></span><span style="font-size: 18px;" class="caption">Create</span></button></a>
                            <a href="index.php" style="float: right;text-decoration:none;"><button class="image-button info ml-2 icon-right"><span class="mif-meter icon"></span><span style="font-size: 18px;" class="caption">Dashboard</span></button></a>
                        </div>
                            <ul class="breadcrumbs bg-transparent">
                                <!-- <div class="row mt-2"> -->
                                <!-- </div> -->
                                <!-- <li class="page-item"><a href="index.php" class="page-link"><span class="mif-meter"></span></a></li> -->
                                <!-- <li class="page-item"><a href="#" class="page-link">Forms</a></li> -->
                                <!-- <li class="page-item"><a href="index.php" class="page-link">Show Data</a></li> -->
                            </ul>
                        </div>
                    <!-- </div> -->
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
                        <div class="cell-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Data Edit Form
                                </div>
                                <div class="card-content p-2">
                                    <div class="row">
                                        <div class="cell-lg-12 cell-md-12 mt-2">
                                            <div class="bg-white p-4">
                                                <form action="" method="POST">
                                                    <input required hidden type="hidden" id="sl" name="sl" hidden value="<?php echo $resultt['SL']
                                                                                                                            ?>" class="metro-input">
                                                    <label>Fkl Id:</label>
                                                    <div class="form-group">
                                                        <input required type="number" name="fkl_id" id="fkl_id" value="<?php echo $resultt['FKL_ID'] ?>" readonly class="metro-input" data-role="input">
                                                        <span class="invalid_feedback">Enter a required value</span>
                                                    </div>

                                                    <!-- <label>Organization Name:</label>
                                                    <div class="form-group">
                                                        <input required type="text" name="organization_name" id="organization_name" value="<?php echo $resultt['ORGANIZATION_NAME'] ?>" class="metro-input" data-role="input">
                                                        <span class="invalid_feedback">Enter a required value</span>
                                                    </div> -->

                                                    <label>Name of Organization:</label>
                                                    <div class="form-group">
                                                        <select data-role="select" name="organization_name" id="org_name" required>
                                                            <option value="BGMEA" <?php if ($resultt['ORGANIZATION_NAME']=='BGMEA') {echo "selected='selected'";}?> >BGMEA</option>
                                                            <option value="BKMEA" <?php if ($resultt['ORGANIZATION_NAME']=='BKMEA') {echo "selected='selected'";} ?> >BKMEA</option>
                                                            <option value="FIRE SERVICE" <?php if ($resultt['ORGANIZATION_NAME']=='FIRE SERVICE') {echo "selected='selected'";} ?> >FIRE SERVICE</option>
                                                        </select>
                                                        </div>

                                                    <label>Training Date:</label>
                                                    <div class="form-group">
                                                        <input type="text" name="training_date" class="todate required-field" value="<?php echo $resultt['TRAINING_DATE']  ?>" data-picker-mode="true" data-role="calendarpicker" data-cls-calendar="compact" data-format="%d-%m-%Y" data-clear-button="true" data-input-format="%d-%m-%y">
                                                        <!-- <input required type="date" data-date-format="DD MMMM YYYY" name="training_date" id="training_date" class="metro-input" data-role="input" required> -->
                                                        <span class="invalid_feedback">Enter a required value</span>
                                                    </div>


                                                    <label>Training Status:</label>
                                                    <div class="form-group">
                                                        <input type="radio" data-role="radio" name="training_status" value="yes" <?php if ($resultt['TRAINING_STATUS'] == 'yes') {
                                                                                                                                        echo "checked";
                                                                                                                                    } ?> data-caption="Yes" onclick="$('#effect-demo').attr('data-effect', this.value)" required>
                                                        <input type="radio" data-role="radio" name="training_status" value="no" <?php if ($resultt['TRAINING_STATUS'] == 'no') {
                                                                                                                                    echo "checked";
                                                                                                                                } ?> data-caption="No" onclick="$('#effect-demo').attr('data-effect', this.value)" required>
                                                    </div>
                                                    <!-- <label>E-mail:</label>
                                    <div class="form-group">                             
                                        <input required type="email" name="email" id="email" value="<?php //echo $resultt['TRAINING_STATUS'] 
                                                                                                    ?>" class="metro-input" placeholder="email" data-role="input">
                                        <span class="invalid_feedback">Enter a required value</span>
                                    </div> -->
                                                    <label>Building Name:</label>
                                                    <div class="form-group">
                                                        <input required type="text" name="building_name" id="building_name" value="<?php echo $resultt['BUILDING_NAME'] ?>" class="metro-input" data-role="input">
                                                        <span class="invalid_feedback">Enter a required value</span>
                                                    </div>

                                                    <label>Floor:</label>
                                                    <div class="form-group">
                                                        <input required type="text" name="floor_name" id="floor_name" value="<?php 
                                                        
                                                        echo $resultt['FLOOR_NAME'] ?>" class="metro-input" data-role="input">
                                                        <span class="invalid_feedback">Enter a required value</span>
                                                    </div>

                                                    <label>Oganization Status:</label>
                                                    <div class="form-group">
                                                        <input type="radio" data-role="radio" name="internal_external" value="internal" <?php  if ($resultt['ORGANIZATION_STATUS'] == 'internal') {
                                                                                                                                            echo "checked";
                                                                                                                                        } ?> data-caption="Internal" onclick="$('#effect-demo').attr('data-effect', this.value)" required>
                                                        <input type="radio" data-role="radio" name="internal_external" value="external" <?php if ($resultt['ORGANIZATION_STATUS'] == 'external') {
                                                                                                                                            echo "checked";
                                                                                                                                        } ?> data-caption="External" onclick="$('#effect-demo').attr('data-effect', this.value)" required>
                                                    </div>

<!-- 
                                                    <label>Organization Status:</label>
                                                    <div class="form-group">
                                                        <select name="internal_external[]" id="org_status" data-role="select" multiple>
                                                            <option value="<?php //echo $resultt['ORGANIZATION_STATUS']; ?>"><?php //echo $resultt['ORGANIZATION_STATUS']; ?></option>
                                                            <option value="<?php //echo $resultt['ORGANIZATION_STATUS']; ?>"><?php //echo $resultt['ORGANIZATION_STATUS']; ?></option>
                                                        </select>
                                                    </div> -->


                                                    <!-- <label>Address:</label>
                                    <div class="form-group">
                                        <textarea type="text" name="address" id="address" data-role="textarea"><?php //echo $resultt['ADDRESS'] 
                                                                                                                ?> </textarea>
                                    </div> -->

                                                    <button type="submit" name="btn" class="button mt-2">Update</button>
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