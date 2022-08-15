<?php
// ob_start();
error_reporting(E_ALL);
require_once 'inc/session.php';
if (empty($_SESSION['fkl'])) {
    header('location: login.php');
}
$data = $userView->fetch_data();
require_once('TCPDF-main/tcpdf.php');
// include_once 'pd.php'; 
if (isset($_POST["create_pdf"])) {
    // $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10);
    $obj_pdf->SetFont('helvetica', '', 8.5);
    $obj_pdf->AddPage();
    $obj_pdf->setCellHeightRatio(0.7);
    // $image = file_get_contents('images/LOGO_157X60.png');
    // $obj_pdf->Image('@'.$image);
    // $imageFile = K_PATH_IMAGES.'images/LOGO_157X60-new.png';
    // $obj_pdf->Image('images/LOGO_157X60.png', 15, 140, 75, 113, 'PNG', '', true, 150, '', false, false, 1, false, false, false);
    $content = '';
    $content .= '  
    <div align="center">
    <img src="/images/LOGO_157X60-new" width="50" height="50" align="center">
      <h3 align="center">Fakir Knitwears Ltd</h3>
      <p>Kayempur, Narayangonj</p>
      <p>Tel: +88-02-55110921-4, 09678005006-7</p>
      <p>Fax: +88-02-9569852 E-mail : fklinfo@fakirgroup.com</p>
      <p align="center">(AN ISO 9001:2008, SCR ,BSCI,SEDEX,ORGANIC & OEKO TEX CERTIFIED COMPANY)</p>
      <hr></hr>
      <br>
      </div>
      <br>
      <div style="line-height=1.5;padding=0;margin=0;" align:left;>
      <table border="0.5"  style="width=100%;line-height=1.5;"  cellspacing="0" cellpadding="3">  
           <tr style="background-color:light-gray;color:white;text-align:center;">  
                <th width="8%">Fkl</th>  
                <th width="12%">Name</th>  
                <th width="5%">Gender</th>  
                <th width="7%">Status</th>  
                <th width="7%">Department</th>  
                <th width="8%">Designation</th>  
                <th width="7%">Unit</th>  
                <th width="6%">Line</th>  
                <th width="10%">Organization name</th>  
                <th width="9%">Trainig date</th>  
                <th width="7%">Building</th>  
                <th width="5%">Floor</th>  
                <th width="9%">Organization status</th>  
           </tr>  
      '; 
    $content .= $data;
    //   $content .= fetch_data();  
    $content .= '</table> </div>';
    $obj_pdf->writeHTML($content, true, false, true, false, '');
    ob_end_clean();
    $obj_pdf->Output('fkl_fire_training_data.pdf', 'I');
}
?>


<?php
include_once('inc/head.php');
?>

<body class="m4-cloak h-vh-100">
    <div data-role="navview" data-toggle="#paneToggle" data-expand="xl" data-compact="lg" data-active-state="true">
        <?php include_once('inc/navigation.php'); ?>
        <div class="navview-content h-100">
            <?php include_once('inc/topbar.php'); ?>
            <form method="post" class="mt-2 ml-5">
                <input type="submit" name="create_pdf" class="button secondary" value="PDF"/>
            </form>
            <div class="content-inner h-100" style="overflow-y: auto">
                <div class="row mt-2 mr-5" style="float: right;">
                    <a href="create_figher_trainer.php" style="text-decoration: none;"> <button class="image-button success icon-right"><span class="mif-plus icon"></span><span style="font-size: 18px;" class="caption">Create</span></button></a>
                    <a href="index.php" class="ml-2" style="text-decoration: none;"> <button class="image-button info icon-right"><span class="mif-meter icon"></span><span style="font-size: 18px;" class="caption">Dashboard</span></button></a>
                </div>
                <!--file change start-->

                <div class="row">
                    <div class="container" style="width:100%;">
                        <h3 align="center">FKL Fire Training List</h3><br />
                        <div class="table-responsive">
                            <table class="table row-border row-hover compact"  data-rownum-title="Sl.">
                                <thead class="table-head-title">
                                <tr class="info">
                                    <th>Fkl</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Unit</th>
                                    <th>Line</th>
                                    <th>Organization Name</th>
                                    <th>Training Date</th>
                                    <th>Building</th>
                                    <th>Floor</th>
                                    <th>Organization Status</th>
                                </tr>
                                </thead>
                                <?php
                                echo $data;
                                ?>
                            </table>
                            <br />
                            <!-- <form method="post">
                        <input type="submit" name="create_pdf" class="btn btn-danger" value="Create PDF" />
                    </form> -->
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