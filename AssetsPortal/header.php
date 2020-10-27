<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left"><a href="projects-index.html" class="logo"><span><img src="../assets/images/logo-sm.png"
                    alt="logo-small" class="logo-sm"> </span><span><img src="../assets/images/logo.png" alt="logo-large"
                    class="logo-lg logo-light"> <img src="../assets/images/logo-dark.png" alt="logo-large"
                    class="logo-lg"></span></a></div>
    <!--end logo-->
    <!-- Navbar -->
    <nav class="navbar-custom">
        <ul class="list-unstyled topbar-nav float-right mb-0">
            <?php
            $sql = 'SELECT * FROM user WHERE Id ='. $_SESSION['user_id'];
            // echo $sql;
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false"><img src="../assets/images/users/author.png"
                        alt="profile-user" class="rounded-circle"> <span class="ml-1 nav-user-name hidden-sm">
                        <b style="font-size: 17px;">
                            <?php 
                            echo $row['UserName'];
                            ?>
                        </b><i class="mdi mdi-chevron-down"></i>
                    </span></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="../logout.php"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                </div>
            </li>
        </ul>
        <!--end topbar-nav-->
        <ul class="list-unstyled topbar-nav mb-0">
            <li><button class="button-menu-mobile nav-link waves-effect waves-light"><i
                        class="dripicons-menu nav-icon"></i></button></li>
            <!-- <li class="hide-phone app-search">
                <form role="search" class=""><input type="text" placeholder="Search..." class="form-control"> <a
                        href="#"><i class="fas fa-search"></i></a></form>
            </li> -->
            <li>
                <h4 class="mt-4 ml-4" id="headername">Dashboard</h4>
            </li>


        </ul>
    </nav>
    <!-- end navbar-->
</div>
<!-- Top Bar End -->