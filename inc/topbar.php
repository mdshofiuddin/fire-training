<div data-role="appbar" class="pos-absolute bg-darkCyan fg-white">

            <a href="#" class="app-bar-item d-block d-none-lg" id="paneToggle"><span class="mif-menu"></span></a>

            <div class="app-bar-container ml-auto">
                <div class="app-bar-container">
                    <a href="#" class="app-bar-item">
                        <img src="images/a.png" class="avatar">
                        <span class="ml-2 app-bar-name"><?php echo $_SESSION['name']; ?></span>
                    </a>
                    <div class="user-block shadow-1" data-role="dropdown" data-collapsed="true">
                        <div class="bg-darkCyan fg-white p-2 text-center">
                            <img src="images/a.png" class="avatar">
                            <div class="h4 mb-0"><?php echo $_SESSION['name'] ?></div>
                        </div>
                        <div class="bg-white d-flex flex-justify-between flex-equal-items p-2 bg-light">
                            <a href="userProfile.php" class="button mr-1 fg-dark">Profile</a>
                            <a href="?logout=true" class="button ml-1 fg-dark">Sign out</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>