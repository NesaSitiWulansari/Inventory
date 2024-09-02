
<!DOCTYPE html>
<html lang="en"><head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"/>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

</head><body id="page-top">
    <!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    
    <a class="sidebar-brand d-flex align-items-center justify-content-center mt-2 mb-2" href="index.html">
        <div class="sidebar-brand-icon">
        <i class="fas fa-id-card"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SDAM INVENTORY BARANG</div>    
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php
        $role_id = $this->session->userdata('role_id');
        $queryMenu = " SELECT tmenu.id,menu FROM tmenu 
                        INNER JOIN access_menu ON tmenu.id = access_menu.menu_id
                        WHERE access_menu.role_id = $role_id
                        ORDER BY access_menu.menu_id ASC               
                    "; 
        $menu = $this->db->query($queryMenu)->result_array();
        
    ?>

     <!-- Heading Looping Menu -->
    <?php foreach ($menu as $m) :?>
        <div class="sidebar-heading">
            <?= $m['menu']; ?>
        </div>

        <?php
            $menuID = $m['id'];
            $querySubMenu = "SELECT * FROM sub_menu 
                            INNER JOIN tmenu ON sub_menu.menu_id = tmenu.id
                            WHERE sub_menu.menu_id = $menuID
                            AND sub_menu.is_active = 1
                            ";
            $SubMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        <?php foreach ($SubMenu as $sb) : ?>
            <?php if($title == $sb['title']) : ?>
                <li class="nav-item active">
                <?php else : ?>
                    <li class="nav-item">
            <?php endif; ?>
                <a class="nav-link pb-0" href="<?= base_url($sb['url']); ?>">
                    <i class="<?= $sb['icon']; ?>"></i>
                        <span><?= $sb['title']; ?></span>
                </a>
            </li>
        <?php endforeach;?>

            
    <hr class="sidebar-divider mt-3">

    <?php endforeach;?>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>


            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">


                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $login['name']; ?></span>
                        <img class="img-profile rounded-circle"
                            src="<?= base_url('assets/img/') . $login['image'];?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('User'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('Web/logout');?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->