<?php
require_once 'inc/session.php';
if(empty($_SESSION['fkl'])){
    header('location: login.php');
}
if(isset($_SESSION['fkl'])){
    if ($_SESSION['user_role']=='user' || $_SESSION['user_role']=='admin' )
    header('location: login.php');
}
if(isset($_GET['delete'])){
    $id = $_GET['id'];
    $delete = $userView->exicute("delete from useradmin where id='$id'");
    if($delete == true){
        header("location:permissionTable.php");
    }else
     die("Not deleted");
}

if(isset($_GET['permission'])){
    $id = $_GET['id'];
    $status = $_GET['status'];
     if($status == 1){    
        $update = $userView->exicute("update useradmin set status = '0' where id='$id'");
        header("location:permissionTable.php");
    }elseif($status == 0){
    $update = $userView->exicute("update useradmin set status = '1' where id='$id'");
    header("location:permissionTable.php");
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
            <div class="row border-bottom bd-lightGray m-3">
                <div class="cell-md-4 d-flex flex-align-center">
                </div>
                <div class="cell-md-8 d-flex flex-justify-center flex-justify-end-md flex-align-center">
                    <ul class="breadcrumbs bg-transparent">
                     <?php   if ($_SESSION['user_role']=='super_admin'){
                               // header('location: login.php'); ?>
                    <a href="userPermission.php" style="text-decoration: none;" class="ml-2"> <button class="image-button success icon-right"><span class="mif-plus icon"></span><span style="font-size: 18px;" class="caption">Create</span></button></a>
                <?php } ?>    
                </ul>
                </div>
            </div>

            <div class="m-3"> 
            </div>

            <div class="row">
                <div class="cell-md-12">
                        <div class="p-4">
                            <!-- <table  class="cell-border table striped subcompact row-hover table-border table-font-size"   data-pagination-short-mode="true" data-rownum-title="Sl." data-rownum="true" data-role="table" data-cls-table-top="row" data-cls-search="cell-md-6" data-cls-rows-count="cell-md-6" data-rows="20" data-rows-steps="5, 10, 20,30,50,80,100,150,200" data-show-activity="false" data-horizontal-scroll="true"> -->
                            
                            <table class="table compact cell-border table-border striped row-hover" data-pagination-short-mode="true" data-rownum-title="Sl." data-rownum="true" data-role="table" data-rows-steps="10,20,30" data-rows="20">
                            <thead class="table-head-title text-center" >
                                    <tr>
                                        <td class="sortable-column">Fkl</td>
                                        <td class="sortable-column">Name</td>
                                        <td class="sortable-column">Department</td>
                                        <td class="sortable-column">Designation</td>
                                        <td class="sortable-column">Role</td>
                                        <td class="sortable-column">Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data = $userView->exicuteReturn("select id,status,vemployeeid,vempname,vdepartmentname,vdesignationname,user_role from hrm_vw_employeeinfo hr right join useradmin usr on hr.vemployeeid=usr.fkl");
                                    if(isset($data)){
                                    while($user = oci_fetch_assoc($data)){
                                    //   echo $userView->test($data);
                                        // foreach($data as $user){
                                        
                                        ?>
                                        <tr>
                                            <td><?php echo $user['VEMPLOYEEID'] ?></td>
                                            <td><?php echo $user['VEMPNAME'] ?></td>
                                            <td><?php echo $user['VDEPARTMENTNAME'] ?></td>
                                            <td><?php echo $user['VDESIGNATIONNAME'] ?></td>
                                            <td><?php echo $user['USER_ROLE'] ?></td>
                                            <td><?php if($user['STATUS']==1){
                                                echo "<p style='color:green;'>Active</p>";
                                            }else
                                            echo "<p style='color:#bebebe;'>In-Active</p>";
                                            
                                            ?></td>
                                            <td>
                                                <?php if($user['STATUS']==1){ ?>
                                                <a href="?permission=true&id=<?php echo $user['ID']; ?>&status=1"><span class="mif-switch mif-2x fg-green  " title="active" ></span></a>
                                                <?php }else{ ?>                                          
                                                <a href="?permission=true&id=<?php echo $user['ID']; ?>&status=0"><span class="mif-switch mif-2x fg-red  " title="in-active" ></span></a>                                           
                                                <?php } ?>
      
                                                <a href="edit_userPermission.php?id=<?php echo $user['ID']; ?>"><span class="mif-pencil mif-2x fg-gray ml-6 mr-6" title="edit"></span></a>   
                                                                                     
                                                <a href="?delete=true&id=<?php echo $user['ID']; ?>" onclick="return confirm('Are you sure to delete?')"><span class="mif-bin mif-2x mr-3 fg-red" title="delete"></span></a>
                                              
                                            </td>
                                            
                                        </tr>
                                    <?php 
                                    }
                                }
                                    ?>
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