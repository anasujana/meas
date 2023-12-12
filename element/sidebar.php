
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center " href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="img/me.jpg" alt="" width=50px>
                </div>
                <div class="sidebar-brand-text mx-3">Matrix Eye </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="data-control.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Data Control</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="tagane_ng.php">
                    <i class="fa fa-times-circle"></i>
                    <span>Tagane NG</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="history_ng.php">
                    <i class="fa fa-history"></i>
                    <span>Quality Up</span></a>
            </li>

             <!-- Nav Item - Pages Collapse Menu -->
             <?php
                if($_SESSION["id_area"]!=1){
                ?>
                <li class="nav-item">
                <a class="nav-link" href="daily_report.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Data Report</span>
                </a>
                </li>
                <?php   
                }else{
                ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Data Report</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Report:</h6>
                            <a class="collapse-item" href="daily_report.php">Daily Report</a>
                            <a class="collapse-item" href="monthly_report.php">Monthly Report</a>
                        </div>
                    </div>
                </li>
            <?php
                }
            ?>
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
           
        </ul>
    