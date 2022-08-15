<?php
require_once 'inc/session.php';
if (empty($_SESSION['fkl'])) {
    header('location: login.php');
}
if (isset($_GET['msg'])) {
    echo '<script>alert("Invalid FKL ID")</script>';
} elseif (isset($_GET['exist'])){
    echo '<script>alert("Allready exist FKL ID with External Trainning ")</script>';
} elseif (isset($_GET['active']))
    echo '<script>alert("Active FKL ID")</script>';
include_once('inc/head.php');
?>

<body class="m4-cloak h-vh-100">
    <div data-role="navview" data-toggle="#paneToggle" data-expand="xl" data-compact="lg" data-active-state="true">
        <?php include_once('inc/navigation.php'); ?>
        <div class="navview-content h-100">
            <?php include_once('inc/topbar.php');
            ?>

            <div class="content-inner h-100" style="overflow-y: auto">
                <!--file change start-->

                <div class="row border-bottom bd-lightGray m-3">
                    <div class="cell-md-4 d-flex flex-align-center">
                        <h3 class="dashboard-section-title text-center text-left-md w-100">INSERT FKL ID <small><span class="mif-plus"></span></small> </h3>
                    </div>

                    <div class="cell-md-8 d-flex flex-justify-center flex-justify-end-md flex-align-center">
                        <div class="row mt-2">
                            <a href="index.php" style="float: right;text-decoration:none;"><button class="image-button info icon-right ml-2"><span class="mif-meter icon"></span><span style="font-size: 18px;" class="caption">Dashboard</span></button></a>
                        </div>
                        <ul class="breadcrumbs bg-transparent">
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
                        <div class="cell-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Data Entry Form
                                </div>
                                <div class="card-content p-2">
                                    <div class="row">
                                        <div class="cell-lg-12 cell-md-12 mt-2">
                                            <div class="bg-white p-4">
                                                <form action="insert_figher_trainer_info.php" method="GET">


                                                    <label> <strong style="font-size: 20px;">Organization Status:</strong> </label>
                                                    <br>
                                                    <div class="form-group">
                                                        <input type="radio" data-role="radio" name="internal_external" value="internal" data-caption="Internal" checked onclick="$('#effect-demo').attr('data-effect', this.value)">
                                                        <input type="radio" data-role="radio" name="internal_external" value="external" data-caption="External" onclick="$('#effect-demo').attr('data-effect', this.value)">
                                                    </div>
                                                    <br><br>

                                                    <label> <strong style="font-size: 18px;"> FKL ID:</strong></label>
                                                    <div class="form-group">
                                                        <input id="keyup-fake" required type="text" name="fkl_id" id="fkl_id" class="metro-input" data-role="input" placeholder="012000">
                                                        <span class="invalid_feedback">Enter a required value</span>
                                                    </div>
                                                    <br>
                                                    <button type="submit" name="btn" class="button success mt-2" value="true"> <strong style="font-size: 15px;">Submit</strong> </button>


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