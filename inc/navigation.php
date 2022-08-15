<div class="navview-pane">
        <div class="bg-cyan d-flex flex-align-center">
            <button class="pull-button m-0 bg-darkCyan-hover">
                <span class="mif-menu fg-white"></span>
            </button>
            <h2 class="text-light m-0 fg-white pl-5" style="line-height: 52px; color:rgb(241, 110, 110);">Fakir Knitwears</h2>
        </div>


        <ul class="navview-menu" id="side-menu">
            <!-- <li class="item-header">MAIN NAVIGATION</li> -->
            <?php  ?>
            <li>
                <a href="index.php">
                    <span class="icon"><span class="mif-meter"></span></span>
                    <span class="caption">Dashboard</span>
                </a>
            </li>
          
            <li><a href="create_figher_trainer.php">
                <span class="icon"><span class="mif-spinner2"></span></span>
                <span class="caption">Create Figher Trainer</span>
            </a></li>

            <li><a href="table_view.php">
                <span class="icon"><span class="mif-spinner2"></span></span>
                <span class="caption">Print Fire Trainer List</span>
            </a></li>
            <?php if(isset($_SESSION['user_role'])){
                      if($_SESSION['user_role']=='super_admin'){
              ?>
            <li><a href="permissionTable.php">
                <span class="icon"><span class="mif-spinner2"></span></span>
                <span class="caption">User Permission</span>
            </a></li>
            <?php }
                   } ?>
            <!-- <li><a href="insert_figher_trainer_info.php">
                <span class="icon"><span class="mif-spinner2"></span></span>
                <span class="caption">Data Add</span>
            </a></li> -->
            
            <li><a href="?logout=true">
                <span class="icon"><span class="mif-lock"></span></span>
                <span class="caption">Logout</span>
            </a></li>
                        
            
        </ul>

        <div class="w-100 text-center text-small data-box p-2 border-top bd-grayMouse" style="position: absolute; bottom: 0">
            <div>&copy; 2022 <a href="mailto:fklinfo@fakirgroup.com" class="text-muted fg-white-hover no-decor">Fakir Knitwears Limited</a></div>
            <div>Created By <a href="https://fakirknit.com" class="text-muted fg-white-hover no-decor">Fakir Developer's Team</a></div>
        </div>
    </div>